<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DeliverySlotsResource extends JsonResource
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
            'start_time'=>$this['start_time'],
            'end_time'=>$this['end_time'],
            'name'=>$lang=='ar' ? $this['name_ar']: $this['name'],
        ];
    }
}
