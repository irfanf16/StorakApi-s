<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductReview extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [ 
        'id',
    ];

    protected $fillable = [ 
        'product_id',
        'user_id',
        'customer_rating',
        'customer_review',
        'vendor_reply',
        'status',
        'likes_on_review',
        'likes_on_reply',
    ];
    
    // protected $hidden = [
    //     'created_at',
    //     'updated_at',
    //     'deleted_at'
    // ];

    
    /*
    |===========================================================
    | Get Product-Details For That Review
    |===========================================================
    */
    public function productDetail()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id'); 
    }


    /*
    |===========================================================
    | Get User-Details For That Review
    |===========================================================
    */
    public function userDetail()
    {
        return $this->belongsTo(User::class, 'user_id', 'id'); 
    }


    /*
    |===========================================================
    | Get Images-Listing For That Review
    |===========================================================
    */
    public function images()
    {
        return $this->hasMany(ReviewImage::class, 'product_review_id', 'id'); 
    }


}
