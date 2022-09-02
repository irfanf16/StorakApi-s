<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderPackageItem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'order_package_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'price',
        'storak_commission',
        'seller_commission',
        'user_store_commission',
        'user_store_reference_key'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    /*
    |================================================================
    | Get the Package-Details of That Order-Package-Item
    |================================================================
    */
    public function packageDetail()
    {
        return $this->belongsTo(OrderPackage::class, 'package_id', 'id');
    }


    /*
    |================================================================
    | Get the Product Details of That Order-Package-Item
    |================================================================
    */
    public function productDetail()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


    /*
    |================================================================
    | Get the Product-Variant Details of That Order-Package-Item
    |================================================================
    */
    public function variantDetail()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }


}
