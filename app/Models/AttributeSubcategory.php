<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/*
|=========================================================
| This is a Pivot Table -- attributes + subcategories
|=========================================================
*/
class AttributeSubcategory extends Pivot
{
    use HasFactory;

    protected $table = 'attribute_subcategory';

}