<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VariantAttribute extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'product_variant_id',
        'attribute_id',
        'key_id',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];
    
    
    /*
    |========================================================
    | Get the Variant Details of that Variant-Attribute
    |========================================================
    */
    public function variantDetail()
    {
        return $this->belongsTo(ProductVariant::class, 'product_variant_id', 'id');
    }


    /*
    |========================================================
    | Get the Attribute Details of that Variant-Attribute
    |========================================================
    */
    public function attributeDetail()
    {
        return $this->belongsTo(Attribute::class, 'attribute_id', 'id');
    }


    /*
    |========================================================
    | Get the Key Details of that Variant-Attribute
    |========================================================
    */
    public function keyDetail()
    {
        return $this->belongsTo(Key::class, 'key_id', 'id');
    }


}
