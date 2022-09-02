<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class HomeScreenResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');

        return [
            'id' => $this['id'],
            'slug' => $this['slug'],
            'title' => $lang == 'ar' ? $this['title_ar'] : $this['title'],
            'keyword' => $lang == 'ar' ? $this['title_ar'] : $this['title'],
            'model_type' => 'Category',
            'brands' => BrandResource::collection($this['brands']),
            'subcategories' => HomeScreenSubCategoryResource::collection($this['subcategories']),
        ];
    }
}
class HomeScreenSubCategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');
        return [
            'id' => $this['id'],
            'slug' => $this['slug'],
            'image' => $this['image'],
            'title' => $lang == 'ar' ? $this['title_ar'] : $this['title'],
            'keyword' => $lang == 'ar' ? $this['title_ar'] : $this['title'],
            'model_type' => 'SubCategory',
            'childcategories' => ChildCategoryResource::collection($this['childcategories'])
        ];
    }
}
