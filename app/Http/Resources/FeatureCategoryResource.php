<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeatureCategoryResource extends JsonResource
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
            'title'=>$lang=='ar' ? $this['title_ar']: $this['title'],
            'keyword'=>$lang=='ar' ? $this['title_ar']: $this['title'],
            'logo_image'=>$this['logo_image'],
            'mobile_image'=>$this['mobile_image'],
            'model_type'=>'Category',
            'products_count'=>$this['products_count'],
            'subcategories'=>SubCategoryResource::collection($this['subcategories'])
        ];
    }
}
