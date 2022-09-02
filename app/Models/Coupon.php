<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'store_id',
        'title',
        'description',
        'apply_to',
        'product_variant_id',
        'code',
        'quantity',
        'discount_type',
        'discount_value',
        'minimum_order_value',
        'status',
        'remaining_coupons',
        'per_user_limit',
        'start_at',
        'expire_at',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];



    /*
    |================================================================
    | Get the Store Details of That Coupon
    |================================================================
    */
    public function storeDetail()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }



    /*
    |========================================================
    | Get the Product-Variants Listing of That Coupon
    |========================================================
    | coupon_product_variant => pivot table name
    | coupon_id              => foreign key of coupons (parent) table
    | product_variant_id     => foreign key of product_variants (child) table
    */
    public function productVariants()
    {
        return $this->belongsToMany(ProductVariant::class, // CHILD MODEL
                            'coupon_product_variant', // PIVOT TABLE
                            'coupon_id', // FOREIGN KEY OF PARENT TABLE
                            'product_variant_id' // FOREIGN KEY OF CHILD TABLE
                        );
    }



}
