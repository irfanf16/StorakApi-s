<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'product_id',
        'image',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    
    /*
    |========================================================
    | Get the Product Details of that Product-Image
    |========================================================
    */
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
