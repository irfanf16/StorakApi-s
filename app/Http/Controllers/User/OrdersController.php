<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderDetailResource;
use App\Mail\SendOrderStatusEmail;
use App\Mail\UserAccount;
use App\Models\Commission;
use App\Models\Product;
use App\Models\UserAddress;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

// MODELS
use App\Models\User;
use App\Models\Order;
use App\Models\Fulfillment;
use App\Models\Notification;
use App\Models\OrderPackage;
use App\Models\ProductVariant;
use App\Models\OrderPackageItem;
use App\Models\OrderPackageHistory;

// E-MAILS
use App\Mail\SendBuyerEmail;
use App\Mail\SendVendorEmail;

// EVENTS
use App\Events\OrderNotifications;
use App\Models\CartItem;

class OrdersController extends Controller
{
    /*
    |===================================================
    | Place A New Order -- Website + Mobile App
    |===================================================
    */
    public function placeOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'billing_address_id' => 'nullable|integer',
            'shipping_address_id' => 'nullable|integer',
            'delivery_slot_id' => 'nullable|integer',
            'packages' => 'required',
            'payment_method' => 'required',
            'billing_status' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        DB::beginTransaction();
        try {
            if (!$request->billing_address_id && !$request->shipping_address_id) {
                $addressData = [
                    'user_id' => auth()->id(),
                    'country_id' => $request->country_id ?? 1,
                    'city_id' => $request->city_id ?? 1,
                    'address_type_id' => $request->address_type_id ?? 1,
                    'user_default_address' => $request->user_default_address ?? 0,
                    'user_zone_no' => $request->user_zone_no ?? "Not Provided",
                    'user_street_no' => $request->user_street_no ?? "Not Provided",
                    'user_building_no' => $request->user_building_no ?? "Not Provided",
                    'user_floor_no' => $request->user_floor_no ?? "Not Provided",
                    'user_appartment_no' => $request->user_appartment_no ?? "Not Provided",
                    'user_address' => $request->user_address ?? "Not Provided",
                ];
                $user_address = UserAddress::create($addressData);
                $request['billing_address_id'] = $user_address->id;
                $request['shipping_address_id'] = $user_address->id;
            }
            if ($request->billing_address_id && !$request->shipping_address_id) {
                $request['billing_address_id'] = $request->billing_address_id;
                $request['shipping_address_id'] = $request->billing_address_id;
            }
            if (!$request->billing_address_id && $request->shipping_address_id) {
                $request['billing_address_id'] = $request->shipping_address_id;
                $request['shipping_address_id'] = $request->shipping_address_id;
            }

            // CALCULATE PACKAGES BILL
            $packages_total = 0;
            $packages = $request->packages;

            $package_charges = [];

            foreach ($packages as $key => $package) {
                $package_bill = 0;
                $fulfillment_charges = Fulfillment::find($package['fulfillment_id'])->charges;

                foreach ($package['products'] as $product) {
                    $user_id = Auth::user()->id;
                    $product_id = $product['product_id'];
                    $variant_id = $product['variant_id'];
                    $cart_item = CartItem::where(['user_id' => $user_id, 'product_id' => $product_id, 'product_variant_id' => $variant_id])->first();
                    if ($cart_item) {
                        CartItem::destroy($cart_item->id);
                    }
                    $package_bill = $package_bill + (ProductVariant::find($product['variant_id'])->price) * $product['quantity'];
                }
                $packages_total = $packages_total + $package_bill + $fulfillment_charges;

                $packages[$key]['package_bill'] = $package_bill;
                $packages[$key]['fulfillment_charges'] = $fulfillment_charges;

            }

            // FINAL BILL (PACKAGES-BILL - DISCOUNT)
            $final_bill = $packages_total - 0;

            // GENERATE ORDER NUMBER
            $order_number = $this->generateOrderNumber();

            $formData = [
                'order_no' => $order_number,
                'user_id' => Auth::id(),
                'billing_address_id' => $request->billing_address_id,
                'shipping_address_id' => $request->shipping_address_id,
                'delivery_slot_id' => $request->delivery_slot_id,
                'packages_bill' => $packages_total,
                'discount' => 0,
                'final_bill' => $final_bill,
                'payment_method' => $request->payment_method,
                'billing_status' => $request->billing_status,
            ];
            // STORE ORDER DETAILS
            $new_order = new Order();
            $order_details = $new_order->create($formData);

            // STORE ORDER-PACKAGES DETAILS
            foreach ($packages as $package) {

                // GENERATE PACKAGE-NUMBER
                $package_number = $this->generatePackageNumber();

                $ordered_package = new OrderPackage();
                $ordered_package->order_id = $order_details->id;
                $ordered_package->package_no = $package_number;
                $ordered_package->store_id = $package['store_id'];
                $ordered_package->fulfillment_id = $package['fulfillment_id'];
                $ordered_package->order_status_id = 1;
                $ordered_package->fulfillment_charges = $package['fulfillment_charges'];
                $ordered_package->package_bill = $package['package_bill'];
                $ordered_package->save();


                // STORE PACKAGE-ITEMS DETAILS
                foreach ($package['products'] as $item) {

                    //commission calculate
                    $product = Product::with('childcategory')->find($item['product_id']);
                    $child_category_id = $product->childcategory->id;
                    $store_id = $package['store_id'];
                    $commission = Commission::where(['store_id' => $store_id, 'child_category_id' => $child_category_id])->latest()->first();
                    if (!$commission) {
                        $commission = Commission::where(['child_category_id' => $child_category_id])->latest()->first();
                    }
                    $productVariant = ProductVariant::find($item['variant_id']);
                    if (!$productVariant->availability || $productVariant->quantity == 0) {
                        DB::rollback();
                        return response()->json([
                            "status" => 100,
                            "errors" => $product->name . ' This product is out of Stock'
                        ]);
                    }
//                 **************  product variant quantity dec  ********************************
                    if (!$productVariant->quantity >= $item['quantity']) {
                        DB::rollback();
                        return response()->json([
                            "status" => 100,
                            "errors" => $product->name . ' This product is insufficient Stock'
                        ]);
                    }
                    $productVariant->quantity = $productVariant->quantity - $item['quantity'];
                    $productVariant->save();
//                    **************************  product variant module end ******************
                    $price = $productVariant->price;
                    $storak_commission = ($price * $item['quantity'] / 100) * ($commission->storak_commission ?? 5);
                    $user_store_commission = ($price * $item['quantity'] / 100) * ($commission->user_stores_commission ?? 2);
                    $seller_commission = $price * $item['quantity'] - $storak_commission;

//                  end commission calculate
                    $package_item = new OrderPackageItem();
                    $package_item->order_package_id = $ordered_package->id;
                    $package_item->product_id = $item['product_id'];
                    $package_item->product_variant_id = $item['variant_id'];
                    $package_item->quantity = $item['quantity'];
                    $package_item->price = $price;
                    $package_item->storak_commission = $storak_commission;
                    $package_item->seller_commission = $seller_commission;
                    $package_item->user_store_commission = $user_store_commission;
                    $package_item->storak_commission_percentage = $commission->storak_commission ?? 5;
                    $package_item->user_store_commission_percentage = $commission->user_stores_commission ?? 2;

                    $package_item->save();
                }
//                    commission calculate

                $storak_commission = OrderPackageItem::where('order_package_id', $ordered_package->id)->sum('storak_commission');
                $seller_commission = OrderPackageItem::where('order_package_id', $ordered_package->id)->sum('seller_commission');
                $user_stores_commission = OrderPackageItem::where('order_package_id', $ordered_package->id)->sum('user_store_commission');
                $ordered_package->storak_commission = $storak_commission;
                $ordered_package->seller_commission = $seller_commission;
                $ordered_package->user_stores_commission = $user_stores_commission;
                $ordered_package->save();
//                 end   commission calculate
                // LOG NEWLY CREATED ORDER-PACKAGE STATUS
                $log_order = new OrderPackageHistory();
                $log_order->order_package_id = $ordered_package->id;
                $log_order->order_status_id = 1;
                $log_order->save();

                // STORE NEW NOTIFICATION
                $notification = new Notification();
                $notification->store_id = $package['store_id']; // VENDOR-ID
                $notification->message = "New Order Received - $order_details->order_no";
                $notification->link = "vendor/orders/$ordered_package->id";
                $notification->icon = "order";
                $notification->status = false;
                $notification->save();

                // SEND NEW-ORDER EMAIL TO VENDOR
                $this->sendVendorEmail($ordered_package->id);
            }
//                    commission calculate

            $storak_commission = OrderPackage::where('order_id', $order_details->id)->sum('storak_commission');
            $sellers_commission = OrderPackage::where('order_id', $order_details->id)->sum('seller_commission');
            $user_stores_commission = OrderPackage::where('order_id', $order_details->id)->sum('user_stores_commission');
            $order_details->storak_commission = $storak_commission;
            $order_details->sellers_commission = $sellers_commission;
            $order_details->user_stores_commission = $user_stores_commission;
            $order_details->save();
//                  end  commission calculate

            // SEND NEW-ORDER EMAIL TO BUYER
            $this->sendBuyerEmail($order_details->id);

            DB::commit();
            return response()->json([
                'status' => 200,
                'message' => "Congratulations, Your Order is Successfully Placed",
            ]);

        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }

    }

    public function placeGuestOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_address_id' => 'nullable|integer',
            'delivery_slot_id' => 'nullable|integer',
            'packages' => 'required',
            'payment_method' => 'required',
            'billing_status' => 'required',
//            user informations

            'name' => 'required',
            'email' => 'required|email',
            'country_code' => 'nullable|string|max:4',
            'mobile' => 'nullable|string|min:8|max:11',
            'password' => 'nullable',
            'country_id' => 'nullable',
            'city_id' => 'nullable',
            'address_type_id' => 'nullable',
            'user_default_address' => 'nullable|boolean',
            'user_zone_no' => 'nullable|string|max:20',
            'user_street_no' => 'nullable|string|max:20',
            'user_building_no' => 'nullable|string|max:20',
            'user_floor_no' => 'nullable|string|max:20',
            'user_appartment_no' => 'nullable|string|max:20',
            'user_address' => 'nullable|max:500',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

//        user create

        // VALIDATE DUPLICATE MOBILE NUMBER
//        if (User::where(['country_code' => $request->country_code, 'mobile' => $request->mobile])->first()) {
//            return response()->json([
//                'status' => 100,
//                'errors' => "mobile number already exists",
//            ]);
//        }
//        if (User::where([ 'email' => $request->email])->first()) {
//            return response()->json([
//                'status' => 100,
//                'errors' => "email already exists",
//            ]);
//        }

        DB::beginTransaction();
        try {
            $flag = 0;
            $user = User::where(['email' => $request->email])
//            ->orWhere(['country_code' => $request->country_code, 'mobile' => $request->mobile])
                ->first();
            if (!$user) {
                // save user
                $pass = rand(99999999, 99999999999);
                $userData = [
                    'role_id' => 3,
                    'name' => $request->name,
                    'email' => $request->email,
                    'country_code' => $request->country_code,
                    'mobile' => $request->mobile,
                    'password' => bcrypt($pass),
                    'registered_with' => "guest",
                ];
                $user = User::create($userData);
                $flag = 1;
                $request['password'] = $pass;
                Mail::to($user->email)->send(new UserAccount($user->email, $pass));
            }

            $user_id = $user->id;
// address create
            $addressData = [
                'user_id' => $user_id,
                'country_id' => $request->country_id ?? 1,
                'city_id' => $request->city_id ?? 1,
                'address_type_id' => $request->address_type_id ?? 1,
                'user_default_address' => $request->user_default_address ?? 0,
                'user_zone_no' => $request->user_zone_no ?? "Not Provided",
                'user_street_no' => $request->user_street_no ?? "Not Provided",
                'user_building_no' => $request->user_building_no ?? "Not Provided",
                'user_floor_no' => $request->user_floor_no ?? "Not Provided",
                'user_appartment_no' => $request->user_appartment_no ?? "Not Provided",
                'user_address' => $request->user_address ?? "Not Provided",
            ];

            $user_address = UserAddress::create($addressData);


//            $user_address->create($addressData);


            // CALCULATE PACKAGES BILL
            $packages_total = 0;
            $packages = $request->packages;

            $package_charges = [];

            foreach ($packages as $key => $package) {
                $package_bill = 0;
                $fulfillment_charges = Fulfillment::find($package['fulfillment_id'])->charges;

                foreach ($package['products'] as $product) {

                    $product_id = $product['product_id'];
                    $variant_id = $product['variant_id'];
                    $cart_item = CartItem::where(['user_id' => $user_id, 'product_id' => $product_id, 'product_variant_id' => $variant_id])->first();
                    if ($cart_item) {
                        CartItem::destroy($cart_item->id);
                    }
                    $package_bill = $package_bill + (ProductVariant::find($product['variant_id'])->price) * $product['quantity'];
                }
                $packages_total = $packages_total + $package_bill + $fulfillment_charges;

                $packages[$key]['package_bill'] = $package_bill;
                $packages[$key]['fulfillment_charges'] = $fulfillment_charges;

            }

            // FINAL BILL (PACKAGES-BILL - DISCOUNT)
            $final_bill = $packages_total - 0;

            // GENERATE ORDER NUMBER
            $order_number = $this->generateOrderNumber();

            $formData = [
                'order_no' => $order_number,
                'user_id' => $user_id,
                'billing_address_id' => $user_address->id,
                'shipping_address_id' => $user_address->id,
                'delivery_slot_id' => $request->delivery_slot_id ?? null,
                'packages_bill' => $packages_total,
                'discount' => 0,
                'final_bill' => $final_bill,
                'payment_method' => $request->payment_method,
                'billing_status' => $request->billing_status,
            ];


            // STORE ORDER DETAILS
            $new_order = new Order();
            $order_details = $new_order->create($formData);

            // STORE ORDER-PACKAGES DETAILS
            foreach ($packages as $package) {

                // GENERATE PACKAGE-NUMBER
                $package_number = $this->generatePackageNumber();

                $ordered_package = new OrderPackage();
                $ordered_package->order_id = $order_details->id;
                $ordered_package->package_no = $package_number;
                $ordered_package->store_id = $package['store_id'];
                $ordered_package->fulfillment_id = $package['fulfillment_id'];
                $ordered_package->order_status_id = 1;
                $ordered_package->fulfillment_charges = $package['fulfillment_charges'];
                $ordered_package->package_bill = $package['package_bill'];
                $ordered_package->save();

                // STORE PACKAGE-ITEMS DETAILS
                foreach ($package['products'] as $item) {

                    $product = Product::with('childcategory')->find($item['product_id']);
                    $child_category_id = $product->childcategory->id;
                    $store_id = $package['store_id'];

                    //commission calculate

                    $commission = Commission::where(['store_id' => $store_id, 'child_category_id' => $child_category_id])->latest()->first();
                    if (!$commission) {
                        $commission = Commission::where(['child_category_id' => $child_category_id])->latest()->first();
                    }
                    $productVariant = ProductVariant::find($item['variant_id']);
                    if (!$productVariant->availability || $productVariant->quantity == 0) {
                        DB::rollback();
                        return response()->json([
                            "status" => 100,
                            "errors" => $product->name . ' This product is out of Stock'
                        ]);
                    }
//                 **************  product variant quantity dec  ********************************
                    if (!$productVariant->quantity >= $item['quantity']) {
                        DB::rollback();
                        return response()->json([
                            "status" => 100,
                            "errors" => $product->name . ' This product is insufficient Stock'
                        ]);
                    }
                    $productVariant->quantity = $productVariant->quantity - $item['quantity'];
                    $productVariant->save();
//                    **************************  product variant module end ******************
                    $price = $productVariant->price;
                    $storak_commission = ($price * $item['quantity'] / 100) * ($commission->storak_commission ?? 5);
                    $user_store_commission = ($price * $item['quantity'] / 100) * ($commission->user_stores_commission ?? 2);
                    $seller_commission = $price * $item['quantity'] - $storak_commission;

//                  end commission calculate


                    $package_item = new OrderPackageItem();
                    $package_item->order_package_id = $ordered_package->id;
                    $package_item->product_id = $item['product_id'];
                    $package_item->product_variant_id = $item['variant_id'];
                    $package_item->quantity = $item['quantity'];
                    $package_item->price = $price;
                    $package_item->storak_commission = $storak_commission;
                    $package_item->seller_commission = $seller_commission;
                    $package_item->user_store_commission = $user_store_commission;
                    $package_item->storak_commission_percentage = $commission->storak_commission ?? 5;
                    $package_item->user_store_commission_percentage = $commission->user_stores_commission ?? 2;

//                    $package_item->user_store_reference_key = $item['user_store_reference_key'];
                    $package_item->save();
                }
//                    commission calculate

                $storak_commission = OrderPackageItem::where('order_package_id', $ordered_package->id)->sum('storak_commission');
                $seller_commission = OrderPackageItem::where('order_package_id', $ordered_package->id)->sum('seller_commission');
                $user_stores_commission = OrderPackageItem::where('order_package_id', $ordered_package->id)->sum('user_store_commission');
                $ordered_package->storak_commission = $storak_commission;
                $ordered_package->seller_commission = $seller_commission;
                $ordered_package->user_stores_commission = $user_stores_commission;
                $ordered_package->save();
//                 end   commission calculate

                // LOG NEWLY CREATED ORDER-PACKAGE STATUS
                $log_order = new OrderPackageHistory();
                $log_order->order_package_id = $ordered_package->id;
                $log_order->order_status_id = 1;
                $log_order->save();

                // STORE NEW NOTIFICATION
                $notification = new Notification();
                $notification->store_id = $package['store_id']; // VENDOR-ID
                $notification->message = "New Order Received - $order_details->order_no";
                $notification->link = "vendor/orders/$ordered_package->id";
                $notification->icon = "order";
                $notification->status = false;
                $notification->save();

                // SEND NEW-ORDER EMAIL TO VENDOR
                $this->sendVendorEmail($ordered_package->id);
            }
//                    commission calculate

            $storak_commission = OrderPackage::where('order_id', $order_details->id)->sum('storak_commission');
            $sellers_commission = OrderPackage::where('order_id', $order_details->id)->sum('seller_commission');
            $user_stores_commission = OrderPackage::where('order_id', $order_details->id)->sum('user_stores_commission');
            $order_details->storak_commission = $storak_commission;
            $order_details->sellers_commission = $sellers_commission;
            $order_details->user_stores_commission = $user_stores_commission;
            $order_details->save();
//                  end  commission calculate


            // SEND NEW-ORDER EMAIL TO BUYER
            $this->sendBuyerEmail($order_details->id);

            DB::commit();
            if ($flag == 0) {
                return response()->json([
                    'status' => 200,
                    'message' => "Congratulations, Your Order is Successfully Placed",
                ]);
            }
            $token = auth()->attempt(request(['email', 'password']));
            $notifications_count = Notification::where('store_id', $user_id->store->id ?? 0)->count();

            return response()->json([
                'status' => 201,
                'message' => "Successfully logged In",
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->factory()->getTTL() * 60,
                // 'expires_in' => config('ttl'), // CUSTOMIZATION OF TOKEN-EXPIRE-TIME
                'user' => $user,
                'user_addresses' => $user_address,
                'notifications' => $notifications_count
            ]);


        } catch (\Exception $e) {
            DB::rollback();

            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }


    }

    public function orderCancel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_id'=>'required|integer',
            'reason' => 'required',
            'comments' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }
        $id=$request->order_id;

        $order = Order::with('orderPackages', 'user')->findorfail($id);

        if ($order->order_status == 'cancelled') {
            return response()->json([
                'status' => 100,
                'message' => "Order is already cancelled",
            ]);
        }
        $buyer_email = $order->user->email;

        foreach ($order->orderPackages as $package) {

            DB::beginTransaction();
            try {
                // UPDATE ORDER-PACKAGE STATUS
                OrderPackage::where('id', $package->id)
                    ->update(['order_status_id' => 4]);

                // STORE PACKAGE-HISTORY
                $is_already_existing = OrderPackageHistory::where([
                    'order_package_id' => $package->id,
                    'order_status_id' => 4
                ])->first();
                if (!$is_already_existing) {
                    OrderPackageHistory::create([
                        'order_package_id' => $id,
                        'order_status_id' => 4
                    ]);
                    // FIND PACKAGE-DETAILS
                    $package_details = OrderPackage::where('id', $package->id)->first();

                    // SEND EMAIL TO BUYER -- ON PACKAGE STATUS CHANGE
                    // Mail::to('dev.shahzadmahota@gmail.com')->send(new SendOrderStatusEmail($package_details)); // Testing
//                    Mail::to($buyer_email)->send(new SendOrderStatusEmail($package_details)); // Origional
                }
                $order->order_status = 'cancelled';
                $order->save();
                DB::commit();
                return response()->json([
                    "status" => 200,
                    "message" => "Order cancelled Successfully",
                ]);

            } catch (\Exception $e) {

                DB::rollback();
                return response()->json([
                    "status" => 100,
                    "message" => $e->getMessage(),
                ]);
            }
        }
    }

    public function orderPackageCancel(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'order_package_id'=>'required|integer',
            'reason' => 'required',
            'comments' => 'nullable',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 100,
                'errors' => $validator->errors()->all()
            ]);
        }

        DB::beginTransaction();
        try {
            $id=$request->order_package_id;
            $orderPackage = OrderPackage::find($id);
            if ($orderPackage->order_status_id == 4) {
                return response()->json([
                    'status' => 100,
                    'message' => "Order package is already cancelled",
                ]);
            }
            if ($orderPackage) {
                $order = Order::with('orderPackages', 'user')
                    ->findorfail($orderPackage->order_id);
//                dd(count($order->orderPackages->where('order_status_id', '!=', 4)));
                if (!$order) {
                    return response()->json([
                        'status' => 100,
                        'message' => "Order is already cancelled",
                    ]);
                }
                if ($order->order_status == 'cancelled') {
                    return response()->json([
                        'status' => 100,
                        'message' => "Order is already cancelled",
                    ]);
                }

                $buyer_email = $order->user->email;
                if (count($order->orderPackages->where('order_status_id', '!=', 4)) == 1) {
                    // UPDATE ORDER-PACKAGE STATUS
                    OrderPackage::where('id', $orderPackage->id)
                        ->update(['order_status_id' => 4]);

                    // STORE PACKAGE-HISTORY
                    $is_already_existing = OrderPackageHistory::where([
                        'order_package_id' => $orderPackage->id,
                        'order_status_id' => 4
                    ])->first();
                    if (!$is_already_existing) {
                        OrderPackageHistory::create([
                            'order_package_id' => $id,
                            'order_status_id' => 4
                        ]);
                        // FIND PACKAGE-DETAILS
                        $package_details = OrderPackage::where('id', $orderPackage->id)->first();

                        // SEND EMAIL TO BUYER -- ON PACKAGE STATUS CHANGE
                        // Mail::to('dev.shahzadmahota@gmail.com')->send(new SendOrderStatusEmail($package_details)); // Testing
//                    Mail::to($buyer_email)->send(new SendOrderStatusEmail($package_details)); // Origional
                    }
                    $order->order_status = 'cancelled';
                    $order->save();
                    DB::commit();

                    return response()->json([
                        "status" => 200,
                        "message" => "Order cancelled Successfully",
                    ]);
                }

                // UPDATE ORDER-PACKAGE STATUS
                OrderPackage::where('id', $orderPackage->id)
                    ->update(['order_status_id' => 4]);

                // STORE PACKAGE-HISTORY
                $is_already_existing = OrderPackageHistory::where([
                    'order_package_id' => $orderPackage->id,
                    'order_status_id' => 4
                ])->first();
                if (!$is_already_existing) {
                    OrderPackageHistory::create([
                        'order_package_id' => $id,
                        'order_status_id' => 4
                    ]);
                    // FIND PACKAGE-DETAILS
                    $package_details = OrderPackage::where('id', $orderPackage->id)->first();

                    // SEND EMAIL TO BUYER -- ON PACKAGE STATUS CHANGE
                    // Mail::to('dev.shahzadmahota@gmail.com')->send(new SendOrderStatusEmail($package_details)); // Testing
//                Mail::to($buyer_email)->send(new SendOrderStatusEmail($package_details)); // Origional
                }
                DB::commit();

                return response()->json([
                    "status" => 200,
                    "message" => "Order package  cancelled Successfully",
                ]);
            }
        } catch (\Exception $e) {

            DB::rollback();
            return response()->json([
                "status" => 100,
                "message" => $e->getMessage(),
            ]);
        }
    }

    /*
    |======================================================
    | GENERATE NEW ORDER-NUMBER
    |======================================================
    */
    public function generateOrderNumber()
    {
        $latest_order = Order::latest()->first();
        return '#' . str_pad($latest_order->id ?? 0 + 1, 8, "0", STR_PAD_LEFT);
    }


    /*
    |======================================================
    | GENERATE NEW PACKAGE-NUMBER
    |======================================================
    */
    public function generatePackageNumber()
    {
        $latest_package = OrderPackage::latest()->first();
        return '#' . str_pad($latest_package->id ?? 0 + 1, 8, "0", STR_PAD_LEFT);
    }


    /*
    |======================================================
    | SEND NEW-ORDER EMAIL TO VENDOR
    |======================================================
    */
    public function sendVendorEmail($package_id)
    {
        $package_details = OrderPackage::withCount('packageItems')
            ->with(
                'storeDetail.vendorDetails',
                'fulfillmentDetail',
            // 'orderDetail.user',
            )
            ->with([
                'orderDetail' => function ($query) {
                    $query->select('*');
                },
                'orderDetail.user' => function ($query) {
                    $query->select('*');
                },
                'orderDetail.billingAddress.countryDetail' => function ($query) {
                    $query->select('*');
                },
                'orderDetail.billingAddress.cityDetail' => function ($query) {
                    $query->select('*');
                },
                'orderDetail.shippingAddress.countryDetail' => function ($query) {
                    $query->select('*');
                },
                'orderDetail.shippingAddress.cityDetail' => function ($query) {
                    $query->select('*');
                }
            ])
            ->with([
                'packageItems.productDetail.firstVariant.variantAttributes.attributeDetail' => function ($query) {
                    $query->select('*');
                },
                'packageItems.productDetail.firstVariant.variantAttributes.keyDetail' => function ($query) {
                    $query->select('*');
                },
            ])
            ->where('id', $package_id)
            ->first();


        // Mail::to("dev.shahzadmahota@gmail.com")->send(new SendVendorEmail($package_details)); // TESTING ONLY
        Mail::to($package_details->storeDetail->vendorDetails->email)->send(new SendVendorEmail($package_details)); // ORIGIONAL
//        dd($package_details->orderDetail->billingAddress->user_address);

        // ORDER-NOTIFICATION EVENT
        $vendor_id = $package_details->storeDetail->vendorDetails->id;
        event(new OrderNotifications($vendor_id));
    }


    /*
    |======================================================
    | SEND NEW-ORDER EMAIL TO BUYER
    |======================================================
    */
    private function sendBuyerEmail($order_id)
    {
        $order_details = Order::with(
            'user:id,name,email,mobile',
            'billingAddress:id,user_address',
            'shippingAddress:id,user_address'
        )
            ->with([
                'billingAddress.countryDetail' => function ($query) {
                    $query->select('*');
                },
                'billingAddress.cityDetail' => function ($query) {
                    $query->select('*');
                },
                'shippingAddress.countryDetail' => function ($query) {
                    $query->select('*');
                },
                'shippingAddress.cityDetail' => function ($query) {
                    $query->select('*');
                }
            ])
            ->with([
                'orderPackages.storeDetail' => function ($query) {
                    $query->select('*');
                },
                'orderPackages.packageItems.productDetail.firstVariant.variantAttributes.attributeDetail' => function ($query) {
                    $query->select('*');
                },
                'orderPackages.packageItems.productDetail.firstVariant.variantAttributes.keyDetail' => function ($query) {
                    $query->select('*');
                },
            ])
            ->where('id', $order_id)
            ->first();

        // dd($order_details->shippingAddress->cityDetail->name);

        // Mail::to("dev.shahzadmahota@gmail.com")->send(new SendBuyerEmail($order_details)); //Testing
        Mail::to($order_details->user->email)->send(new SendBuyerEmail($order_details)); //Original
    }


    /*
    |==================================================================
    | Get Auth User All Orders -- Listing
    |==================================================================
    */
    public function myOrders()
    {
        try {
            $orders = Order::where('user_id', Auth::id())
                //    ->with('orderPackages.storeDetail')
                //    ->with('orderPackages.packageItems.productDetail')
                //    ->with('orderPackages.packageItems.variantDetail')
                ->orderBy('created_at', 'DESC')
                ->get();

            return response()->json([
                'status' => 200,
                'orders' => $orders
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }


    /*
    |==================================================================
    | Get Auth User Order Detail
    |==================================================================
    */
    public function orderDetail($id)
    {
        try {
            $order_detail = Order::where('id', $id)
                ->with(
                    'user:id,name,email,mobile,country_code',
                    'billingAddress:id,user_address',
                    'shippingAddress:id,user_address'
                )
                ->with([
                    'billingAddress.countryDetail' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'billingAddress.cityDetail' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'shippingAddress.countryDetail' => function ($query) {
                        $query->select('id', 'name');
                    },
                    'shippingAddress.cityDetail' => function ($query) {
                        $query->select('id', 'name');
                    }
                ])
                ->with('orderPackages.storeDetail')
                ->with('orderPackages.orderStatusDetail')
                ->with('orderPackages.packageHistories.packageStatusDetail')
                ->withCount('orderPackages')
                ->with('orderPackages', function ($query) {
                    $query->withCount('packageItems');
                    $query->with('packageItems.productDetail');
                    $query->with('packageItems.variantDetail');
                })
                ->first();
            $order_detail = OrderDetailResource::make($order_detail);
            return response()->json([
                'status' => 200,
                'order_detail' => $order_detail
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "status" => 100,
                "errors" => $e->getMessage()
            ]);
        }
    }

}
