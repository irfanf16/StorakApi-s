<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Fulfillment extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'name',
        'background_color',
        'description',
        'status'
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    
    
    /*
    |========================================================
    | Get the Products Listing For that Fulfillment
    |========================================================
    | fulfillment_product => pivot table name
    | fulfillment_id      => foreign key of fulfillments (parent) table
    | product_id          => foreign key of products (child) table
    */
    public function products()
    {
        return $this->belongsToMany(Product::class, 'fulfillment_product', 'fulfillment_id', 'product_id');
    }

}
