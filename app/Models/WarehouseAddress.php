<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarehouseAddress extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [ 
        'id',
    ];

    protected $fillable = [
        'store_id',
        'warehouse_name',
        'warehouse_phone_no',
        'warehouse_email',
        'warehouse_address',
        'country_id',
        'city_id',
        'warehouse_zone_no',
        'warehouse_street_no',
        'warehouse_building_no',
        'warehouse_floor_no',
        'warehouse_appartment_no',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    /*
    |========================================================
    | Get Store Details For That Warehouse Address
    |========================================================
    */
    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }


    /*
    |========================================================
    | Get City Details For That Warehouse Address
    |========================================================
    */
    public function city()
    {
        return $this->belongsTo(City::class, 'city_id', 'id');
    }
    
}
