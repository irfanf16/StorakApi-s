<?php

namespace App\Models;

use COM;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
// use Laravel\Scout\Searchable;
use Illuminate\Support\Str;
use ReflectionClass;

class Product extends Model
{
    use HasFactory ;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_ar',
        'category_id',
        'subcategory_id',
        'childcategory_id',
        'brand_id',
        'store_id',
        'video_url',

        'short_description',
        'short_description_ar',
        'detailed_description',
        'detailed_description_ar',
        'package_contents',
        'primary_image',

        'warranty_type',
        'warranty_period_id',
        'warranty_policy',

        'package_weight',
        'package_length',
        'package_width',
        'package_height',
        'good_type',

        'translation_verified',
        'status',
        'featured',
        'slug',
        'tags',
        'specifications',
        'keywords',
    ];

    protected $hidden = [
//        'created_at',
//        'updated_at',
        'deleted_at'
    ];

    protected $appends = ['model_type' ,'keyword'];

    public function setSlugAttribute(){
        $this->attributes['slug'] =  Str::slug($this->name, "-");
    }
    public function getModelTypeAttribute(){
        $reflection = new ReflectionClass($this);
        return $reflection->getShortName();
    }

    public function getKeywordAttribute(){
        return $this->name;
    }


    /*
    |========================================================
    | Get the Category Details of that Product
    |========================================================
    */

    const SEARCHABLE_FIELDS = [ 'id' , 'name'];

    public function toSearchableArray(){
        return $this->only(self::SEARCHABLE_FIELDS);
    }




    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    /*
    |========================================================
    | Get the Sub-Category Details of that Product
    |========================================================
    */
    public function subcategory()
    {
        return $this->belongsTo(SubCategory::class, 'subcategory_id', 'id');
    }

    /*
    |========================================================
    | Get the Child-Category Details of that Product
    |========================================================
    */
    public function childcategory()
    {
        return $this->belongsTo(ChildCategory::class, 'childcategory_id', 'id');
    }

    /*
    |========================================================
    | Get the Brand Details of that Product
    |========================================================
    */
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }

    /*
    |========================================================
    | Get the Store Details of that Product
    |========================================================
    */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }


    /*
    |=========================================================
    | Get Product-Variants Listing For That Product
    |=========================================================
    */
    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id', 'id');
    }


    /*
    |=========================================================
    | Get Product-Images Listing For That Product
    |=========================================================
    */
    public function images()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }


    /*
    |==========================================================
    | Get Variants Details For That Product
    |==========================================================
    */
    public function firstVariant()
    {
        return $this->hasOne(ProductVariant::class, 'product_id', 'id');
    }



    /*
    |===============================================
    | Get Attributes Listing For That Product
    |===============================================
    */
    public function productAttributes()
    {
        return $this->hasMany(ProductAttribute::class, 'product_id', 'id');
    }


    /*
    |=========================================================
    | Get Questions Listing For That Product
    |=========================================================
    */
    public function questions()
    {
        return $this->hasMany(ProductQuestion::class, 'product_id', 'id');
    }


    /*
    |========================================================
    | Get the Fulfillments Listing For This Product
    |========================================================
    | fulfillment_product => pivot table name
    | product_id          => foreign key of products (parent) table
    | fulfillment_id      => foreign key of fulfillments (child) table
    */
    public function fulfillments()
    {
        return $this->belongsToMany(Fulfillment::class, 'fulfillment_product', 'product_id', 'fulfillment_id');
    }


    /*
    |=========================================================
    | Get Review-Images For This Product
    |=========================================================
    */
    public function  reviewImages()
    {

        return $this->HasManyThrough(
            ReviewImage::class, // Final
            ProductReview::class, // Intermediate
            'product_id', // Foreign key on Intermediate
            'product_review_id', // Foreign key on Final
            'id', // Local key on Current
            'id' // Local key on Intermediate
        );
    }


    /*
    |=========================================================
    | Get Collection Listing For This Product
    |=========================================================
    */
    public function  collections()
    {
        return $this->belongsToMany(Collection::class);
    }

    /*
       |=========================================================
       | Get most sold product
       |=========================================================
       */
    public function mostSoldProducts(){
        return $this->hasMany(OrderPackageItem::class,'product_id','id');
    }
    /*
       |=========================================================
       | Get most wishlist product
       |=========================================================
       */
    public function mostWishlistProducts(){
        return $this->hasMany(WishlistItem::class,'product_id','id');
    }


}
