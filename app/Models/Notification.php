<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'store_id',
        'message',
        'link',
        'icon',
        'status',
    ];
    
    protected $hidden = [
        // 'created_at',
        // 'updated_at',
        'deleted_at',
    ];

    
    
    /*
    |========================================================
    | Get the Store-Details of That Notification
    |========================================================
    */
    public function storeDetail()
    {
        return $this->belongsTo(Store::class, 'store_id', 'id');
    }


}
