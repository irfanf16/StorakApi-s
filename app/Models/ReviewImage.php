<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ReviewImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [ 
        'id',
    ];

    protected $fillable = [ 
        'product_review_id',
        'image',
        'status',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    
    /*
    |===========================================================
    | Get Review-Details For That Review
    |===========================================================
    */
    public function reviewDetail()
    {
        return $this->belongsTo(ProductReview::class, 'product_review_id', 'id'); 
    }


}
