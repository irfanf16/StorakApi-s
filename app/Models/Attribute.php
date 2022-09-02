<?php

namespace App\Models;

use App\Traits\ApiDataGenerate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    use SoftDeletes;
    use ApiDataGenerate;

    protected $fillable = [
        'title',
        'title_ar',
        'slug',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];
    public function setSlugAttribute($value)
    {
        $this->attributes['slug'] = $this->createSlug('attributes',$value);
    }

    /*
    |===============================================
    | Get keys Listing For This Attribute
    |===============================================
    | attribute_key => pivot table name
    | attribute_id  => foreign key of attributes (parent) table
    | key_id        => foreign key of keys (child) table
    */
    public function keys()
    {
        return $this->belongsToMany(Key::class, 'attribute_key', 'attribute_id','key_id');
    }


    /*
    |==========================================================
    | Get Subcategories Listing For This Attribute
    |==========================================================
    | attribute_subcategory => pivot table name
    | attribute_id          => foreign key of attributes (parent) table
    | subcategory_id        => foreign key of sub_categories (child) table
    */
    public function subcategories()
    {
        return $this->belongsToMany(SubCategory::class, 'attribute_subcategory', 'attribute_id','subcategory_id');
    }


    public function childcategories()
    {
        return $this->belongsToMany(ChildCategory::class, 'attribute_childcategory', 'attribute_id','childcategory_id');
    }


    /*
    |========================================================
    | Get Variant-Attributes Listing For This Attribute
    |========================================================
    */
    // public function variantAttribute()
    // {
    //     return $this->hasMany(VariantAttribute::class, 'attribute_id', 'id');
    // }


    public function productVariant()
    {
        return $this->belongsToMany(ProductVariant::class);
    }


}
