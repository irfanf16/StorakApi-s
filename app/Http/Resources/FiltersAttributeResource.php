<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FiltersAttributeResource extends JsonResource
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
            'title'=>$lang=='ar' ? $this['title_ar']:$this['title'],
            'keys'=>FiltersAttributeKeysResource::collection($this['keys'])
        ];
    }
}
class FiltersAttributeKeysResource extends JsonResource
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
            'name'=>$lang=='ar' ? $this['name_ar']:$this['name'],
        ];
    }
}
