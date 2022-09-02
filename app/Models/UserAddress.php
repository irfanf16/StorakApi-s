<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [ 
        'id',
    ];

    protected $fillable = [ 
        'user_id',
        'country_id',
        'city_id',
        'address_type_id',
        'user_default_address',
        'user_zone_no',
        'user_street_no',
        'user_building_no',
        'user_floor_no',
        'user_appartment_no',
        'pob',
        'user_address',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    
    /*
    |===============================================
    | Get User Details For That Address 
    |===============================================
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }



    /*
    |===============================================
    | Get Country-Details For That User Address 
    |===============================================
    */
    public function countryDetail()
    {
        return $this->belongsTo(Country::class, 'country_id', 'id');
    }



    /*
    |===============================================
    | Get City-Details For That User Address 
    |===============================================
    */
    public function cityDetail()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }


    /*
    |===============================================
    | Get Address-Type For That User Address 
    |===============================================
    */
    public function addressType()
    {
        return $this->belongsTo(AddressType::class, 'address_type_id', 'id');
    }


}
