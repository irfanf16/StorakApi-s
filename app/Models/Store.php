<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;
use ReflectionClass;

class Store extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'seller_id',
        'store_name',
        'store_name_ar',
        'tag_line',
        'tag_line_ar',
        'category_id',
        'short_description',
        'short_description_ar',
        'detailed_description',
        'detailed_description_ar',
        'logo_image',
        'cover_image',
        'holiday_mode',
        'holiday_start_date',
        'holiday_end_date',
        'featured',
        'status',
        'slug',
    ];

    protected $hidden = [
//        'created_at',
        'updated_at',
        'deleted_at'
    ];


    protected $appends = ['model_type' , 'keyword'];

    public function getModelTypeAttribute(){
        $reflection = new ReflectionClass($this);
        return $reflection->getShortName();
    }

    public function getKeywordAttribute(){
        return $this->store_name;
    }


    /* REMOVE THIS AFTER NEW MIGRATIONS AND BACKEND IS DONE
    |========================================================
    | Get the User (Vendor) that owns that Store
    |========================================================
    */
    public function vendorDetails()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }


    /*
    |========================================================
    | Get the User (Vendor) that owns that Store
    |========================================================
    */
    public function user()
    {
        return $this->belongsToMany(User::class )->withTrashed();
    }


    /*
    |========================================================
    | Get the Category Details of that Store
    |========================================================
    */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }


    /*
    |========================================================
    | Get the Products Listing of that Store
    |========================================================
    */
    public function products()
    {
        return $this->hasMany(Product::class, 'store_id', 'id')
//                    ->orderBy('id','desc')
                    ->inRandomOrder()
                    ->take(6);
    }
    /*
      |========================================================
      | Get the all Products Listing of that Store
      |========================================================
      */
    public function allProducts()
    {
        return $this->hasMany(Product::class, 'store_id', 'id');

    }

    /*
    |========================================================
    | Get the Warehouse Address Of That Store
    |========================================================
    */
    public function warehouseAddress()
    {
        return $this->hasOne(WarehouseAddress::class)->with('city:id,name');
    }


    /*
    |========================================================
    | Get the Return Address Of That Store
    |========================================================
    */
    public function returnAddress()
    {
        return $this->hasOne(ReturnAddress::class)->with('city:id,name');
    }

    /*
    |========================================================
    | Get the Notifications (Vendor) that owns that Store
    |========================================================
    */
    public function notifications()
    {
        return $this->hasMany(Notification::class);
    }


    /*
    |===========================================================
    | Get Vendor Products Questions Listing
    |===========================================================
    */
    public function vendorReviews()
    {
        return $this->hasManyThrough(
            ProductReview::class,  // Final Model
            Product::class, // Intermediate Model
        )->with('productDetail');
    }


    /*
    |===========================================================
    | Get Vendor Products Questions Listing
    |===========================================================
    */
    public function vendorQuestions()
    {
        return $this->hasManyThrough(
            ProductQuestion::class,  // Final Model
            Product::class, // Intermediate Model
        );
    }

}
