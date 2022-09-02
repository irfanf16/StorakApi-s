<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubRole extends Model
{
    use HasFactory;
    protected $table = 'subroles';
    protected $fillable = [
        'name',
        'owner_id'
    ];


    public function users(){
        return $this->belongsToMany(User::class , 'subrole_user'  , 'subrole_id'  );
    }


}