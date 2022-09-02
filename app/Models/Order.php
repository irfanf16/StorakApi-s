<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_no',
        'user_id',
        'billing_address_id',
        'shipping_address_id',
        'delivery_slot_id',
        'packages_bill',
        'discount',
        'final_bill',
        'payment_method',
        'billing_status',
    ];

    protected $hidden = [
        // 'created_at',
        // 'updated_at',
        'deleted_at',
    ];



    /*
    |================================================================
    | Get the User Details of That Order
    |================================================================
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



    /*
    |================================================================
    | Get the Order-Packages Listing of That Order
    |================================================================
    */
    public function orderPackages()
    {
        return $this->hasMany(OrderPackage::class, 'order_id', 'id');
    }



    /*
    |=================================================================
    | Get the Billing-Address Details of That Order
    |=================================================================
    */
    public function billingAddress()
    {
        return $this->belongsTo(UserAddress::class, 'billing_address_id', 'id');
    }


    /*
    |=================================================================
    | Get the Shipping-Address Details of That Order
    |=================================================================
    */
//    public function shippingAddress()
//    {
//        return $this->belongsTo(UserAddress::class, 'shipping_address_id', 'id');
//    }
    public function shippingAddress()
    {
        return $this->belongsTo(UserAddress::class, 'billing_address_id', 'id');
    }


}
