<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FiltersResource extends JsonResource
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

        if ($this->model_type=='Store'){

            return [
                'id'=>$this->id,
                'slug'=>$this->slug,
                'store_name'=>$lang=='ar' ? $this->store_name_ar: $this->store_name,
                'keyword'=>$lang=='ar' ? $this->store_name_ar: $this->store_name,
                'model_type'=>'Store'
            ];
        }
        if ($this->model_type=='Category'){
            return [
                'id'=>$this->id,
                'slug'=>$this->slug,
                'title'=>$lang=='ar' ? $this->title_ar: $this->title,
                'keyword'=>$lang=='ar' ? $this->title_ar: $this->title,
                'model_type'=>'Category'
            ];
        }if ($this->model_type=='SubCategory'){
            return [
                'id'=>$this->id,
                'slug'=>$this->slug,
                'title'=>$lang=='ar' ? $this->title_ar: $this->title,
                'keyword'=>$lang=='ar' ? $this->title_ar: $this->title,
                'model_type'=>'SubCategory'
            ];
        } if ($this->model_type=='ChildCategory'){
            return [
                'id'=>$this->id,
                'slug'=>$this->slug,
                'title'=>$lang=='ar' ? $this->title_ar: $this->title,
                'keyword'=>$lang=='ar' ? $this->title_ar: $this->title,
                'model_type'=>'ChildCategory'
            ];
        }
        if ($this->model_type=='ChildCategory'){
            return [
                'id'=>$this->id,
                'slug'=>$this->slug,
                'title'=>$lang=='ar' ? $this->title_ar: $this->title,
                'keyword'=>$lang=='ar' ? $this->title_ar: $this->title,
                'model_type'=>'ChildCategory'
            ];
        }
        if ($this->model_type=='Brand'){
            return [
                'id'=>$this->id,
                'slug'=>$this->slug,
                'name'=>$lang=='ar' ? $this->name_ar: $this->name,
                'keyword'=>$lang=='ar' ? $this->name_ar: $this->name,
                'model_type'=>'Brand'
            ];
        }


    }
}
