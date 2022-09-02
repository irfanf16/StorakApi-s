<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStoreSocialLink extends Model
{
    use HasFactory;

    protected $fillable=['social_link_id','user_store_id','link'];
    public function socialMedia(){
      return  $this->belongsTo(SocialLink::class,'social_link_id','id');
    }
}
