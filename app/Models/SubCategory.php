<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class SubCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'title',
        'title_ar',
        'description',
        'image',
        'featured',
        'status',
        'order',
        'popular',
        'slug'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];

    protected $appends = ['model_type', 'keyword'];

    public function getModelTypeAttribute(){
        $reflection = new ReflectionClass($this);
        return $reflection->getShortName();
    }

    public function getKeywordAttribute(){
        return $this->title;
    }


    /*
    |===============================================
    | Get Main-Category For That Subcategory
    |===============================================
    */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'subcategory_id', 'id');
    }

    /*
    |===============================================
    | Get Child-Categories For That Subcategory
    |===============================================
    */
    public function childcategories()
    {
        return $this->hasMany(ChildCategory::class, 'subcategory_id', 'id')
                    ->where('status',1)
                    ->select('id','slug','title','title_ar','subcategory_id','image');
    }


    /*
    |==========================================================
    | Get Attributes Listing For This Subcategory
    |==========================================================
    */
    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attribute_subcategory', // pivot table name
            'subcategory_id',  // foreign key of sub_categories (parent) table
            'attribute_id' // foreign key of attributes (child) table
        );
    }

    /*
    |==========================================================
    | Get Brands Listing For This Subcategory
    |==========================================================
    */
    public function brands()
    {
        return $this->belongsToMany(
            Brand::class,
            'brand_subcategory', // pivot table name
            'subcategory_id', // foreign key of sub_categories (parent) table
            'brand_id',  // foreign key of attributes (child) table
        );
    }


    /*
    |===========================================================
    | Get Keys Listing For That Subcategory -- HasManyThrough
    |===========================================================
    */
    public function keys()
    {
        return $this->hasManyThrough(
            key::class,
            AttributeSubcategory::class, // Through Table
            'attribute_id',
            'key_id',
            'id', // Local Key in subcategories table
        );
    }


}
