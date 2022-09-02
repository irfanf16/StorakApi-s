<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderPackageHistory extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'order_package_id',
        'order_status_id'
    ];
    
    protected $hidden = [
        // 'created_at',
        // 'updated_at',
        'deleted_at',
    ];


    /*
    |================================================================
    | Get the Package-Status-Detail of That Order-Status-Log
    |================================================================
    */
    public function packageStatusDetail()
    {
        return $this->belongsTo(OrderStatus::class, 'order_status_id', 'id');
    }


    /*
    |================================================================
    | Get the Package-Detail of That Order-Package-History
    |================================================================
    */
    public function packageDetail()
    {
        return $this->belongsTo(OrderPackage::class, 'order_package_id', 'id');
    }

}
