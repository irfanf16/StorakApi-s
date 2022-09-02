<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WebsiteBanner extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'title',
        'description',
        'image',
        'link',
        'order',
        'status',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

}
