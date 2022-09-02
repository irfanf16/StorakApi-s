<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/*
|=========================================================
| This is a Pivot Table -- coupons + product_variants
|=========================================================
*/
class CouponProductVariant extends Pivot
{
    use HasFactory;

    protected $table = 'coupon_product_variants';

}