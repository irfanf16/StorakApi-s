<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'country_id', 
        'name',
        'status',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    /*
    |=============================================================
    | Get Country Details For That City 
    |=============================================================
    */
    public function country()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }

}
