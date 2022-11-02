<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        'title',
        'title_ar',
        'description',
        'logo_image',
        'mobile_image',
        'banner_image',
        'featured',
        'popular',
        'status',
        'order',
        'slug'
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
        return $this->title;
    }


    /*
    |===============================================
    | Get Subcategories For That Category
    |===============================================
    */
    public function subcategories()
    {
        return $this->hasMany(SubCategory::class, 'category_id', 'id')
                    ->where('status',1)
                    ->select('id','slug','title','title_ar','image','category_id'); // NOTE-1

        // NOTE-1 NEED TO DEFINE FORIGN-KEY IN SELECT CLAUSE
    }


    /*
    |===============================================
    | Get Child-Categories For That Category
    |===============================================
    */
    public function childcategories()
    {
        return $this->hasMany(ChildCategory::class, 'category_id', 'id')
                    ->where('status',1)
                    ->select('id','slug','title','title_ar','category_id','image');
    }


    /*
    |===============================================
    | Get Child-Categories For That Category
    |===============================================
    */
    public function stores()
    {
        return $this->hasMany(Store::class, 'category_id', 'id')
                    ->select('id','store_name','slug','store_name_ar','category_id');
    }


    /*
    |========================================================
    | Get the Brands Listing of that Category
    |========================================================
    | brand_category => pivot table name
    | category_id    => foreign key of categories (parent) table
    | brand_id       => foreign key of brands (child) table
    */
    public function brands()
    {
        return $this->belongsToMany(Brand::class, 'brand_category', 'category_id', 'brand_id');
    }


    /*
    |===============================================
    | Get Products For That Category
    |===============================================
    */
    public function products()
    {
        return $this->hasMany(Product::class, 'category_id', 'id');
    }


}
