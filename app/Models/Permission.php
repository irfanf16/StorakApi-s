<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    protected $fillable=['name','slug','display_name','description'];
    public function role(){
        return $this->belongsToMany(SubRole::class,'subrole_permissions','permission_id','subrole_id','id');
    }
}
