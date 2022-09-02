<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'document_title',
        'document_status',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];



    /*
    |========================================================
    | Get the All Inputs Detail of that Business Document
    |========================================================
    */
    public function inputs()
    {
        return $this->hasMany(DocumentInput::class, 'document_id', 'id');
    }



    /*
    |========================================================
    | Get the Active Inputs Detail of that Business Document
    |========================================================
    */
    public function activeInputs()
    {
        return $this->hasMany(DocumentInput::class, 'document_id', 'id')
                    ->select('id','input_name','input_type','document_id')
                    ->where('input_status',1);
    }
    

}
