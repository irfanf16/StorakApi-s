<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductQuestion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [ 
        'id',
    ];

    protected $fillable = [ 
        'product_id',
        'user_id',
        'customer_question',
        'vendor_reply',
        'status',
    ];
    
    protected $hidden = [
        // 'created_at',
        // 'updated_at',
        'deleted_at'
    ];

    
    /*
    |============================================================
    | Get Product-Details For That Question 
    |============================================================
    */
    public function productDetail()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }


    /*
    |============================================================
    | Get User-Details For That Question 
    |============================================================
    */
    public function userDetail()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


}
