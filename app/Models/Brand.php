<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

// use

class Brand extends Model
{
    use HasFactory;
    use SoftDeletes;
    // use ;

    protected $fillable = [
        'name',
        'name_ar',
        'description',
        'logo_image',
        'cover_image',
        'featured',
        'status'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];


    protected $appends = ['model_type' , 'keyword'];

    public function getModelTypeAttribute(){
        $reflection = new ReflectionClass($this);
        return $reflection->getShortName();
    }

    public function getKeywordAttribute(){
        return $this->name;
    }


    /*
    |========================================================
    | Get the Categories Listing of that Brand
    |========================================================
    | brand_category => pivot table name
    | brand_id       => foreign key of brands (parent) table
    | category_id    => foreign key of categories (child) table
    */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'brand_category', 'brand_id', 'category_id');
    }


    public function subcategories()
    {
        return $this->belongsToMany(SubCategory::class, 'brand_subcategory', 'brand_id', 'subcategory_id');
    }


    public function childcategories()
    {
        return $this->belongsToMany(ChildCategory::class, 'brand_childcategory', 'brand_id', 'childcategory_id');
    }

    public function products()
    {
        return $this->hasMany(Product::class,'brand_id','id');
    }
}
