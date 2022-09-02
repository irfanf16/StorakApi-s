<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BusinessInformation extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "business_information";

    protected $guarded = [
        'id',
    ];

    protected $fillable = [
        // BUSINESS DETAILS
        'user_id',
        'company_name',
        'country_id',
        'city_id',
        'company_zone_no',
        'company_street_no',
        'company_building_no',
        'company_floor_no',
        'company_appartment_no',
        'company_address',

        // BUSINESS PERSON DETAILS
        'person_incharge_name',
        'person_incharge_mobile',
        'person_incharge_email',
        'person_id_type',
        'person_id_no',
        'person_id_front_image',
        'person_id_back_image',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];



    /*
    |====================================================================
    | Get Business-Documents-Listing For That Business-Information
    |====================================================================
    */
    public function businessDocs()
    {
        return $this->hasMany(BusinessDocument::class, 'business_information_id', 'id');
    }



    /*
    |====================================================================
    | Get User Details For That Business-Information
    |====================================================================
    */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id')->withTrashed();
    }


    /*
    |====================================================================
    | Get City Details For That Business-Information
    |====================================================================
    */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }


}
