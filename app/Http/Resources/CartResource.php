<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CartResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        $lang=$request->header('lang');
        return [
            'id'=>$this['id'],
            'product_id'=>$this['product_id'],
            'product_variant_id'=>$this['product_variant_id'],
            'quantity'=>$this['quantity'],
            'price'=>$this['price'],
            'product_detail'=>CartProductDetailResource::make($this['productDetail']),
            'variant_detail'=>CartVariatnDetailResource::make($this['variantDetail'])

        ];
    }
}
class CartVariatnDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
//        $lang=$request->header('lang');
        return [
            'id'=>$this['id'],
            'product_id'=>$this['product_id'],
            'price'=>$this['price'],
            'special_price'=>$this['special_price'],
            'quantity'=>$this['quantity'],
            'sold_stock'=>$this['sold_stock'],
            'seller_sku'=>$this['seller_sku'],
            'availability'=>$this['availability'],
            'image'=>$this['image'],


        ];
    }
}
class CartProductDetailResource extends JsonResource
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
            'name'=>$lang=='ar' ? $this['name_ar']: $this['name'],
            'keyword'=>$lang=='ar' ? $this['name_ar']: $this['name'],
            'store_id'=>$this['store_id'],
            'primary_image'=>$this['primary_image'],
            'slug'=>$this['slug'],
            'model_type'=>'Product',
            'store'=>CartProductStoreResource::make($this['store'])

        ];
    }
}
class CartProductStoreResource extends JsonResource
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
            'store_name'=>$lang=='ar' ? $this['store_name_ar']: $this['store_name'],
            'keyword'=>$lang=='ar' ? $this['store_name_ar']: $this['store_name'],
            'slug'=>$this['slug'],
            'model_type'=>'Store',

        ];
    }
}
