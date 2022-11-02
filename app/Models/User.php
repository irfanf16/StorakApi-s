<?php

namespace App\Models;

use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'role_id',
        'registered_with',
        'provider_id',
        'email',
        'is_email_verified',
        'email_verified_at',
        'country_code',
        'mobile',
        'is_mobile_verified',
        'phone',
        'profile_image',
        'status',
        'vendor_profile_status',
        'last_login',
        'password',
        'remember_token'
    ];

    protected $hidden = [
        'password',
        'remember_token',
        // 'created_at',
        // 'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /*
    |========================================================================
    | Get the identifier that will be stored in the subject claim of the JWT.
    |========================================================================
    */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    /*
    |===============================================================================
    | Return a key value array, containing any custom claims to be added to the JWT.
    |===============================================================================
    */
    public function getJWTCustomClaims()
    {
        return [];
    }


    /*
    |========================================================================
    | Get Vendor User Profile Status -- Incomplete,Under Review,Verified
    |========================================================================
    */
    public function getVendorProfileStatus()
    {
        return User::where('id', Auth::id())->first()->vendor_profile_status;
    }


    /*
    |===========================================================
    | Get Addresses Listing For That User
    |===========================================================
    */
    public function addresses()
    {
        return $this->hasMany(UserAddress::class);
    }


    /*
    |===========================================================
    | Get Business Information For That User
    |===========================================================
    */
    public function businessInfo()
    {
        return $this->hasOne(BusinessInformation::class)->with('city:id,name');
    }

    public function ActivityLog()
    {
        return $this->hasMany(ActivityLog::class, 'user_id');
    }


    /*
    |===========================================================
    | Get Vendor Store Details For That Store
    |===========================================================
    */
    public function store()
    {
        return $this->hasOneThrough(Store::class, StoreUser::class, 'user_id', 'id', 'id', 'store_id');
    }


    public function stores()
    {
        $withDetail = $this->belongsToMany(Store::class, 'store_user')->wherePivot('active', 'true');
        return $withDetail;
    }


    /*
    |===========================================================
    | Get Bank Account Information For That User
    |===========================================================
    */
    public function bankAccount()
    {
        return $this->hasOne(BankAccount::class);
    }


    /*
    |===========================================================
    | Get Vendor Requests Listing of that Vendor
    |===========================================================
    */
    public function vendorRequests()
    {
        return $this->hasMany(VendorRequest::class, 'user_id', 'id');
    }


    /*
    |===========================================================
    | Get Orders Listing of that Buyer
    |===========================================================
    */
    public function orders()
    {
        return $this->hasMany(Order::class, 'user_id', 'id');
    }


    /*
    |===========================================================
    | Get Auth-User Liked Products Listing
    |===========================================================
    */
    public function likedProducts()
    {
        return $this->hasMany(ProductLike::class);
    }


    /*
    |============================================================
    | Get the Order-Packages Listings of That User
    |============================================================
    */
    public function orderPackages()
    {
        return $this->hasManyThrough(
            OrderPackage::class, // Final Model to Access
            Order::class, // Intermediate Model
            'user_id', // Foreign Key on the Intermediate Table (orders table)
            'order_id', // Foreign Key on the Final Table (order_packages table)
            'id', // Local Key in this table (users table)
            'id' // Local Key on the Intermediate table (orders table)
        );
    }


    /*
    |============================================================
    | Get the Subrole of That User
    |============================================================
    */
    public function Subrole()
    {
        return $this->hasOneThrough(
            SubRole::class,
            subrole_user::class,
            'user_id',
            'id',
            'id',
            'subrole_id');
    }

    public function role()
    {
        return $this->belongsToMany(SubRole::class, 'subrole_user', 'user_id', 'subrole_id', 'id');
    }


    public function user_store()
    {
        return $this->hasOne(UserStore::class);
    }


    public function customerStore()
    {
        return $this->hasOne(UserStore::class);
    }

    public function user_stores()
    {
        return $this->hasMany(UserStore::class, 'user_id', 'id');
    }

    public function productQuestions()
    {
        return $this->hasMany(ProductQuestion::class, 'user_id', 'id');
    }

    public function productReviews()
    {
        return $this->hasMany(ProductReview::class, 'user_id', 'id');
    }

}
