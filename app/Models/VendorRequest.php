<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class VendorRequest extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'user_id',
        'is_reviewed',
        'review_note',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    
    
    /*
    |========================================================
    | Get User Detail of that Vendor-Request
    |========================================================
    */
    public function userDetail()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}
