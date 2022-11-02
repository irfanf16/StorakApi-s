<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WishlistItem extends Model
{
    use HasFactory;

    protected $fillable = [ 
        'user_id',
        'product_id',
        'product_variant_id',
    ];
    
    // protected $hidden = [
    //     'created_at',
    //     'updated_at',
    // ];


    /*
    |=============================================================
    | Get User-Details of That Wishlist Item 
    |=============================================================
    */
    public function userDetail()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    /*
    |=============================================================
    | Get Product-Details of That Wishlist Item 
    |=============================================================
    */
    public function productDetail()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


    /*
    |=============================================================
    | Get Product-Variant-Detail of That Wishlist Item 
    |=============================================================
    */
    public function variantDetail()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }

}
