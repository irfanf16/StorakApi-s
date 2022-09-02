<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

class Collection extends Model
{
    use SoftDeletes;
    use HasFactory;


    protected $fillable = [
        'name',
        'name_ar',
        'code',
        'user_store_id',
        'views',
        'likes',
        'shares',
        'follows',
        'visibility'
    ];

    protected $appends = ['is_liked', 'is_followed'];

    public function getIsLikedAttribute(){
        if(Auth::check()){
            $is_liked=  $this->likers()->where('user_id' , Auth::user()->id)->exists();
            if($is_liked){
                return 1;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }

    public function getIsFollowedAttribute(){
        if(Auth::check()){
            $is_followed=  $this->followers()->where('user_id' , Auth::user()->id)->exists();
            if($is_followed){
                return 1;
            }
            else{
                return 0;
            }
        }
        else{
            return 0;
        }
    }


    public function products()
    {
        return $this->belongsToMany(Product::class, 'collection_product' , 'collection_id' , 'product_id' )->withTimestamps();
    }

    public function likers()
    {
        return $this->belongsToMany(User::class , 'collection_likers' , 'collection_id' , 'user_id')->withTrashed()->withTimestamps();
    }

    public function followers()
    {
        return $this->belongsToMany(User::class , 'collection_followers' , 'collection_id' , 'user_id')->withTrashed()->withTimestamps();
    }

    public function store()
    {
        return $this->belongsTo(UserStore::class, 'user_store_id',);
    }
}
