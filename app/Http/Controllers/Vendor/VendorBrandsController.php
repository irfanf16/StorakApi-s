<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Brand;
use App\Models\Attribute;
use App\Models\Variant;


class VendorBrandsController extends Controller
{
    /*
    |========================================================
    | GET LIST OF ACTIVE BRANDS
    |========================================================
    */
    public function brands()
    { 
        $brands = Brand::where('status',1)
                        ->select('id','name','logo_image')
                        ->get();

        return response()->json([
            'status' => 200,
            'brands' => $brands,
        ]);
    }


    /*
    |==================================================
    | GET LIST OF ACTIVE ATTRIBUTES
    |==================================================
    */
    public function attributes()
    { 
        $attributes = Attribute::where('status',1)
                                ->select('id','title')
                                ->get();

        return response()->json([
            'status'    => 200,
            'attributes'=> $attributes,
        ]);
    }


    /*
    |==================================================
    | GET LIST OF ACTIVE ATTRIBUTES WITH VARIANTS
    |==================================================
    */
    public function attributesWithVariants()
    { 
        $attributes = Attribute::with('variants:id,title,attribute_id')
                                ->where('status',1)
                                ->select('id','title')
                                ->get();

        return response()->json([
            'status'    => 200,
            'attributes'=> $attributes,
        ]);
    }


    /*
    |==================================================
    | GET LIST OF ACTIVE VARIANTS
    |==================================================
    */
    public function variants()
    { 
        $variants = Variant::where('status',1)
                                ->select('id','title')
                                ->get();

        return response()->json([
            'status'   => 200,
            'variants' => $variants,
        ]);
    }

    
}