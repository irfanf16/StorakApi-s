<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class BusinessDocument extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [ 
        'business_information_id',
        'document_id',
        'document_input_id',
        'document_input_value',
        'created_at',
        'updated_at',
    ];
    
    protected $hidden = [
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    
    
    /*
    |========================================================
    | Get the Category Details of that Brand
    |========================================================
    */
    public function categoryDetails()
    {
        return $this->hasMany(Category::class, 'category_id', 'id');
    }

}
