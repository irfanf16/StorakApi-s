<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CartItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'product_id',
        'product_variant_id',
        'quantity',
        'price',
    ];

    // protected $hidden = [
    //     'created_at',
    //     'updated_at',
    // ];


    /*
    |=============================================================
    | Get User-Details of That Cart Item
    |=============================================================
    */
    public function userDetail()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }


    /*
    |=============================================================
    | Get Product-Details of That Cart Item
    |=============================================================
    */
    public function productDetail()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


    /*
    |=============================================================
    | Get Product-Variant-Detail of That Cart Item
    |=============================================================
    */
    public function variantDetail()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }


    /*
    |=============================================================
    | Get Latest-Cart-Items For Login User
    |=============================================================
    */
    public function myCart()
    {
        return CartItem::where('user_id', \Auth::id())
                        ->with([
                            'productDetail:id,name,store_id',
                            'productDetail.store:id,store_name'
                        ])
                        ->with('variantDetail')
                        ->get()
                        ->makeHidden('user_id');
    }


}
