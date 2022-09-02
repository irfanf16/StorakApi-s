<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BrandResource extends JsonResource
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
            'logo_image'=>$this['logo_image'],
            'cover_image'=>$this['cover_image'],
            'keyword'=>$lang=='ar' ? $this['name_ar']: $this['name'],
            'model_type'=>'Brand',
        ];
    }
}
