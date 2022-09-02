<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class ChildCategory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'category_id',
        'subcategory_id',
        'title',
        'title_ar',
        'description',
        'image',
        'featured',
        'status',
        'order',
        'popular'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
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
    | Get Category For That Childcategory
    |===============================================
    */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    /*
    |===============================================
    | Get Subcategory For That Childcategory
    |===============================================
    */
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class);

    }

    public function products()
    {
        return $this->hasMany(Product::class, 'childcategory_id','id');
    }

    public function brands()
    {
        return $this->belongsToMany(
            Brand::class,
            'brand_childcategory', // pivot table name
            'childcategory_id',
            'brand_id',
        );
    }


    public function attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'attribute_childcategory', // pivot table name
            'childcategory_id',
            'attribute_id',
        );
    }

    public function sku_attributes()
    {
        return $this->belongsToMany(
            Attribute::class,
            'sku_attribute_childcategory', // pivot table name
            'childcategory_id',
            'attribute_id',
        );
    }
    public function commission(){
        return $this->hasMany(Commission::class,'child_category_id','id');
    }
    public function appliedCommission(){
        return $this->hasOne(Commission::class,'child_category_id','id')->latest();
    }


}
