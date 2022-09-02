<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Key extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'name_ar',
        'slug',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
        'pivot'
    ];


    /*
    |===============================================
    | Get attributes Listing For This Key
    |===============================================
    | attribute_key => pivot table name
    | key_id        => foreign key of keys (parent) table
    | attribute_id  => foreign key of attributes (child) table
    */
    public function attributes()
    {
        return $this->belongsToMany(Attribute::class, 'attribute_key', 'key_id', 'attribute_id');
    }


    /*
    |========================================================
    | Get Variant-Attributes Listing For This Key
    |========================================================
    */
    public function variantAttribute()
    {
        return $this->hasMany(VariantAttribute::class, 'key_id', 'id');
    }


}
