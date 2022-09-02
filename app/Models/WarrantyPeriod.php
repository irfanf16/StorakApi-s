<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class WarrantyPeriod extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'period',
        'status',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];


    /*
    |===============================================
    | Get Product Detail of That WarrantPeriod
    |===============================================
    */
    public function productDetail()
    {
        return $this->belongsTo(Product::class);
    }

}
