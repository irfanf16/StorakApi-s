<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class OrderDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this['id'],
            'order_no' => $this['order_no'],
            'packages_bill' => $this['packages_bill'],
            'discount' => $this['discount'],
            'final_bill' => $this['final_bill'],
            'payment_method' => $this['payment_method'],
            'order_packages_count' => $this['order_packages_count'],
            'user' => OrderDetailUserResource::make($this['user']),
            'billing_address' => OrderDetailBillingAddressResource::make($this['billingAddress']),
            'shipping_address' => OrderDetailBillingAddressResource::make($this['shippingAddress']),
            'order_packages' => OrderPackagesResource::collection($this['orderPackages']),
            'created_at' => $this['created_at'],
            'updated_at' => $this['updated_at'],
        ];
    }
}

class OrderDetailUserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this['id'],
            'name' => $this['name'],
            'email' => $this['email'],
            'country_code' => $this['country_code'],
            'mobile' => $this['mobile'],

        ];
    }
}

class OrderDetailBillingAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this['id'],
            'user_id' => $this['user_id'],
            'country_id' => $this['country_id'],
            'city_id' => $this['city_id'],
            'address_type_id' => $this['address_type_id'],
            'user_default_address' => $this['user_default_address'],
            'user_zone_no' => $this['user_zone_no'],
            'user_street_no' => $this['user_street_no'],
            'user_building_no' => $this['user_building_no'],
            'user_floor_no' => $this['user_floor_no'],
            'user_appartment_no' => $this['user_appartment_no'],
            'user_address' => $this['user_address'],
            'country_detail' => OrderDetailBillingAddressCountryDetailResource::make($this['countryDetail']),
            'city_detail' => OrderDetailBillingAddressCityDetailResource::make($this['cityDetail'])


        ];
    }
}

class OrderDetailBillingAddressCountryDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this['id'],
            'name' => $this['name'],
        ];
    }
}

class OrderDetailBillingAddressCityDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this['id'],
            'name' => $this['name'],
        ];
    }
}


class OrderPackagesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'order_id' => $this['order_id'],
            'package_no' => $this['package_no'],
            'user_id' => $this['user_id'],
            'package_items_count' => $this['package_items_count'],
            'store_detail' => OrderPackageStoreResource::make($this['storeDetail']),
            'order_status_id' => $this['order_status_id'],
            'order_status_detail' => OrderStatusResource::make($this['orderStatusDetail']),
            'package_histories' => OrderPackageStatusHistoryResource::collection($this['packageHistories']),
            'package_items' => OrderPackageItemsResource::collection($this['packageItems']),
            'created_at' => $this['created_at'],
            'updated_at' => $this['updated_at'],
        ];
    }
}

class OrderPackageStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');
        return [
            'id' => $this['id'],
            'slug' => $this['slug'],
            'store_name' => $lang == 'ar' ? $this['store_name_ar'] : $this['store_name'],
            'tag_line' => $lang == 'ar' ? $this['tag_line_ar'] : $this['tag_line'],
            'keyword' => $lang == 'ar' ? $this['store_name_ar'] : $this['store_name'],
            'logo_image' => $this['logo_image'],
            'cover_image' => $this['cover_image'],
            'model_type' => 'Store',
        ];
    }
}

class OrderPackageItemsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {

        return [
            'id' => $this['id'],
            'order_package_id' => $this['order_package_id'],
            'product_id' => $this['product_id'],
            'product_variant_id' => $this['product_variant_id'],
            'quantity' => $this['quantity'],
            'price' => $this['price'],
            'product_detail' => OrderProductDetailResource::make($this['productDetail']),
            'variant_detail' => OrderPrdocutVariantResource::make($this['variantDetail']),
        ];
    }

}

class OrderProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');

        return [
            'id' => $this['id'],
            'slug' => $this['slug'],
            'name' => $lang == 'ar' ? $this['name_ar'] : $this['name'],
            'keyword' => $lang == 'ar' ? $this['name_ar'] : $this['name'],
            'model_type' => 'Product',
            'primary_image' => $this['primary_image'],
            'brand_id' => $this['brand_id'],
            'likes' => $this['likes'],
            'views' => $this['views'],
            'sales' => $this['sales'],
            'reports' => $this['reports'],
            'total_reviews' => $this['total_reviews'],
            'avg_rating' => $this['avg_rating'],
            'brand' => BrandResource::make($this['brand']),
        ];
    }
}

class OrderPrdocutVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'price' => $this['price'],
            'special_price' => $this['special_price'],
            'product_id' => $this['product_id'],
            'quantity' => $this['quantity'],
            'seller_sku' => $this['seller_sku'],
            'availability' => $this['availability'],
            'image' => $this['image'],
        ];
    }
}

class OrderPackageStatusHistoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'order_package_id' => $this['order_package_id'],
            'order_status_id' => $this['order_status_id'],
            'package_status_detail' => OrderStatusResource::make($this['packageStatusDetail']),
            'created_at' => $this['created_at'],
            'updated_at' => $this['updated_at'],

        ];
    }
}

class OrderStatusResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');

        return [
            'id' => $this['id'],
            'status' => $lang=='ar' ? $this['status_ar']:$this['status'],
            'status_for' => $this['status_for'],
            'message' => $lang=='ar' ? $this['message_ar']:$this['message'],
            'description' =>$lang=='ar' ? $this['description_ar']:$this['description'],
            'background_color' => $this['background_color'],
            'icon' => $this['icon'],
            'created_at' => $this['created_at'],
            'updated_at' => $this['updated_at'],
        ];
    }
}




