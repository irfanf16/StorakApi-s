<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use App\Models\Brand;
use App\Models\ChildCategory;
use App\Models\Product;
use App\Models\Store;


class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $child_category = ChildCategory::where('title', $row['childcategory_id'])
                                        ->with('category:id','subcategory:id')
                                        ->select('id','category_id','subcategory_id')
                                        ->first();

        $brand = Brand::where('name', $row['brand_id'])->first();
        $store = Store::where('store_name', $row['store_id'])->first();

        // Find 
        new Product([
            'name'                => $row['name'],
            'category_id'         => $child_category->category->id,
            'subcategory_id'      => $child_category->subcategory->id,
            'childcategory_id'    => $child_category->id,
            'brand_id'            => $brand->id,
            'store_id'            => $store->id,
            'video_url'           => $row['video_url'] ?? null,
            'short_description'   => $row['short_description'],
            'detailed_description'=> $row['detailed_description'],
            'package_contents'    => $row['package_contents'],
            'primary_image'       => $row['primary_image'] ?? "default.jpg",
            'warranty_type'       => 1,
            'warranty_period_id'  => 1,
            'warranty_policy'     => $row['warranty_policy'],
            'package_weight'      => 1,
            'package_length'      => 1,
            'package_width'       => 1,
            'package_height'      => 1,
            'good_type'           => 1,
            'status'              => 1,
        ]);

        return;
    }

}
