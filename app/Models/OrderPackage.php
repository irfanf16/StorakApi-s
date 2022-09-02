<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderPackage extends Model
{
    use \Znck\Eloquent\Traits\BelongsToThrough;

    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_id',
        'store_id',
        'fulfillment_id',
        'order_status_id',
        'fulfillment_charges',
        'package_bill',
        'storak_commission',
        'seller_commission',
        'user_stores_commission',
    ];

    protected $hidden = [
        // 'created_at',
        // 'updated_at',
        'deleted_at',
    ];


    /*
    |================================================================
    | Get the Package-Items-Listing of That Order-Package
    |================================================================
    */
    public function packageItems()
    {
        return $this->hasMany(OrderPackageItem::class, 'order_package_id', 'id');
    }


    /*
    |=================================================================
    | Get the Package-Histories-Listing of That Order-Package
    |=================================================================
    */
    public function packageHistories()
    {
        return $this->hasMany(OrderPackageHistory::class, 'order_package_id', 'id');
    }


    /*
    |================================================================
    | Get the Order-Details of That Order-Package
    |================================================================
    */
    public function orderDetail()
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }



    /*
    |================================================================
    | Get the Store-Details of That Order-Package
    |================================================================
    */
    public function storeDetail()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }


    /*
    |====================================================================
    | Get the Fulfillment (Delivery Option) Details of That Order-Package
    |====================================================================
    */
    public function fulfillmentDetail()
    {
        return $this->belongsTo(Fulfillment::class, 'fulfillment_id', 'id');
    }


    /*
    |=================================================================
    | Get the Order-Status Details of That Order-Package
    |=================================================================
    */
    public function orderStatusDetail()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }


    /*
    |=================================================================
    | Get the Order-Status Details of That Order-Package
    |=================================================================
    */
    public function productDetail()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


    /*
    |============================================================
    | Get the User Details of That Order-Package
    |============================================================
    */
    public function user()
    {
        return $this->belongsToThrough(User::class, Order::class);
    }


}
