<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FirstVariantResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id'=>$this['id'],
            'price'=>$this['price'],
            'special_price'=>$this['special_price'],
            'product_id'=>$this['product_id'],
            'quantity'=>$this['quantity'],
            'availability'=>$this['availability'],

        ];
    }
}
