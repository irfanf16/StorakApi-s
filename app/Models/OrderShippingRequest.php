<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderShippingRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'shipping_company_id',
        'order_package_id',
        'goods_type_id',
        'order_status_id',
        'payment_method',
        'receivable_amount',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    /*
    |================================================================
    | Get the Vendor-Details of that Order Shipping Request
    |================================================================
    */
    public function vendorDetails()
    {
        return $this->belongsTo(User::class, 'vendor_id', 'id');
    }


    /*
    |================================================================
    | Get the Buyer-Details of that Order Shipping Request
    |================================================================
    */
    public function buyerDetails()
    {
        return $this->belongsTo(User::class, 'buyer_id', 'id');
    }


    /*
    |================================================================
    | Get the Goods-Type-Details of that Order Shipping Request
    |================================================================
    */
    public function goodsTypeDetail()
    {
        return $this->belongsTo(GoodsType::class, 'goods_type_id', 'id');
    }


    /*
    |================================================================
    | Get the Shipping-Company-Details of that Order Shipping Request
    |================================================================
    */
    public function shipppingCompanyDetails()
    {
        return $this->belongsTo(ShippingCompany::class, 'shipping_company_id', 'id');
    }


}
