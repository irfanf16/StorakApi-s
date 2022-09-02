<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang=$request->header('lang');

        return [
            'id'=>$this['id'],
            'slug'=>$this['slug'],
            'name'=>$lang=='ar' ? $this['name_ar']: $this['name'],
            'keyword'=>$lang=='ar' ? $this['name_ar']: $this['name'],
            'model_type'=>'Product',
            'primary_image'=>$this['primary_image'],
            'brand_id'=>$this['brand_id'],
            'likes'=>$this['likes'],
            'views'=>$this['views'],
            'sales'=>$this['sales'],
            'reports'=>$this['reports'],
            'total_reviews'=>$this['total_reviews'],
            'avg_rating'=>$this['avg_rating'],
            'created_at'=>$this['created_at'],
            'updated_at'=>$this['updated_at'],
            'most_sold_products_count'=>$this['most_sold_products_count'],
            'most_wishlist_products_count'=>$this['most_wishlist_products_count'],
            'category'=>CategoryResource::make($this['category']),
            'brand'=>BrandResource::make($this['brand']),
            'first_variant'=>FirstVariantResource::make($this['firstVariant']),
        ];
    }
}

