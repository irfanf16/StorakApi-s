<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commission extends Model
{
    use HasFactory;
    protected $fillable=['child_category_id','storak_commission','user_stores_commission'];
    public function childCategory(){
        return $this->belongsTo(ChildCategory::class,'child_category_id','id');
    }
}
