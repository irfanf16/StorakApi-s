<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductVariant extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'product_id',
        'price',
        'special_price',
        'quantity',
        'seller_sku',
        'availability',
        'image'
    ];

//    protected $hidden = [
//        'created_at',
//        'updated_at',
//        'deleted_at'
//    ];


    /*
    |========================================================
    | Get the Product Details of that Product-Variant
    |========================================================
    */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


    /*
    |========================================================
    | Get the Attributes Listing of that Product-Variant
    |========================================================
    */
    public function variantAttributes()
    {
        return $this->hasMany(VariantAttribute::class, 'product_variant_id', 'id');
    }

    /*
    |========================================================
    | Get the Attributes Listing of that Product-Variant
    |========================================================
    */
    public function attributeDetail()
    {
        return $this->hasMany(VariantAttribute::class, 'product_variant_id', 'id');
    }




    /*
    |========================================================
    | Get the Coupons Listing of That Product-Variant
    |========================================================
    | coupon_product_variant => pivot table name
    | product_variant_id     => foreign key of product_variants (parent) table
    | coupon_id              => foreign key of coupons (child) table
    */
    public function coupons()
    {
        return $this->belongsToMany(Coupon::class, // CHILD MODEL
            'coupon_product_variant', // PIVOT TABLE
            'product_variant_id', // FOREIGN KEY OF PARENT TABLE
            'coupon_id', // FOREIGN KEY OF CHILD TABLE
        );
    }



}
