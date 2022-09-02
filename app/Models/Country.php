<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
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
    | Get Cities Listing For That Country 
    |=============================================================
    */
    public function cities()
    {
        return $this->hasMany(City::class, 'country_id', 'id');
    }

}
