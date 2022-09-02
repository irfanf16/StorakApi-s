<?php

namespace App\Models;

use App\Traits\ApiDataGenerate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;

class UserStore extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'name',
        'slug',
        'name_ar',
        'tag_line',
        'tag_line_ar',
        'code',
        'description',
        'description_ar',
        'profile',
        'cover',
        'views',
        'likes',
        'shares',
        'follows',
        'visibility',
        'featured',
        'status'
    ];

    protected $appends = ['is_liked', 'is_followed'];


    /*
    |=================================================================
    | Check If Auth User Has Already Liked This User-Store --
    |=================================================================
    */

    public function getIsLikedAttribute()
    {
        if (Auth::check()) {
            $is_liked = $this->likers()->where('user_id', Auth::user()->id)->exists();
            if ($is_liked) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }


    /*
    |=================================================================
    | Check If Auth User Has Already Followed This User-Store --
    |=================================================================
    */
    public function getIsFollowedAttribute()
    {
        if (Auth::check()) {
            $is_followed = $this->followers()->where('user_id', Auth::user()->id)->exists();
            if ($is_followed) {
                return 1;
            } else {
                return 0;
            }
        } else {
            return 0;
        }
    }


    /*
    |=================================================================
    | Get The Collections Listing For This User-Store --
    |=================================================================
    */
    public function collections()
    {
        return $this->hasMany(Collection::class);
    }


    /*
    |=================================================================
    | Get The Liked-By (Users) Listing For This User-Store --
    |=================================================================
    */
    public function likers()
    {
        return $this->belongsToMany(User::class, 'user_store_likers', 'user_store_id', 'user_id')
            ->withTimestamps();
    }


    /*
    |=================================================================
    | Get The Follower (Users) Listing For This User-Store --
    |=================================================================
    */
    public function followers()
    {
        return $this->belongsToMany(User::class, 'user_store_followers', 'user_store_id', 'user_id')
            ->withTimestamps();
    }


    public function customerDetails()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



    /*
    |=================================================================
    | Get User-Store Products Listing --
    |=================================================================
    */
    // public function products()
    // {
    //     $collections = $this->collections()->with('products' , function($q){
    //         $q->orderBy('views', 'DESC');
    //     });

    //     return $collections;
    // }

//    user store link

    public function socialLink()
    {
      return  $this->hasMany(UserStoreSocialLink::class,'user_store_id','id');

    }


}
