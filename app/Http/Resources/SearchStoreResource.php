<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SearchStoreResource extends JsonResource
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
            'store_name'=>$lang=='ar' ? $this['store_name_ar']:$this['store_name'],
            'tag_line'=>$lang=='ar' ? $this['tag_line_ar']:$this['tag_line'],
            'logo_image'=>$this['logo_image'],
            'cover_image'=>$this['cover_image'],
            'model_type'=>'Store',
            'keyword'=>$lang=='ar' ? $this['store_name_ar']:$this['store_name']

        ];
    }
}
