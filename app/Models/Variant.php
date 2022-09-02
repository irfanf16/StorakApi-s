<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    use SoftDeletes;
    

    protected $fillable = [
        'attribute_id',
        'title',
        'description',
        'status',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    /*
    |===============================================
    | Get Attribute For That Variant 
    |===============================================
    */
    public function attribute()
    {
        return $this->belongsTo(Attribute::class)->select('id','title');
    }


}
