<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class ShippingCompany extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'name',
        'email',
        'mobile',
        'address',
        'logo',
        'status',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    
    /*
    |===================================================================
    | Get Listing of Orders-Shipping-Request For That Shipping Company
    |===================================================================
    */
    public function orderShippingRequests()
    {
        return $this->hasMany(OrderShippingRequest::class, 'shipping_company_id', 'id');
    }


}
