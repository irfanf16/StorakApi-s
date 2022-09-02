<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "order_status";

    protected $fillable = [
        'status',
        'status_ar',
        'message',
        'message_ar',
        'description',
        'description_ar',
        'background_color'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];


    /*
    |================================================================
    | Get the Orders Listing of That Order-Status
    |================================================================
    */
    public function orders()
    {
        return $this->hasMany(Order::class, 'order_status_id', 'id');
    }


}
