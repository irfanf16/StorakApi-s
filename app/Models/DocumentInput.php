<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class DocumentInput extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'document_id',
        'input_name',
        'input_type',
        'input_status',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    
    
    /*
    |========================================================
    | Get the Document Details of that Document Input Field
    |========================================================
    */
    public function document()
    {
        return $this->belongsTo(Document::class, 'document_id', 'id');
    }

}
