<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserStore extends JsonResource
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
            'name'=>$lang == 'ar' ? $this->name_ar: $this->name,
            'tag_line'=>$lang == 'ar' ? $this->tag_line_ar: $this->tag_line,
            'code'=>$this->code,
            'description'=>$lang == 'ar' ? $this->description_ar:$this->description,
            'profile'=>$this->profile,
            'cover'=>$this->cover,
            'views'=>$this->views,
            'likes'=>$this->likes,
            'shares'=>$this->shares,
            'follows'=>$this->follows,
            'visibility'=>$this->visibility,
            'Social_media_links'=>SocialMediaLinks::collection($this->socialLink),
            'collections_count'=>$this->collections_count,
            'is_liked'=>$this->is_liked,
            'likers'=>$this->likers,
            'is_followed'=>$this->is_followed,
            'followers'=>$this->followers,
            'collections'=>UserStoreCollections::collection($this->collections),


        ];
    }
}
class SocialMediaLinks extends JsonResource
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
            'social_media_title'=>$this->socialMedia->title,
            'logo'=>$this->socialMedia->logo,
            'link'=>$this->link,
            'social_link_id'=>$this->socialMedia->id,
        ];
    }
}
class UserStoreCollections extends JsonResource
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
            'id'=>$this['id'],
            'slug'=>$this['slug'],
            'name'=>$lang == 'ar' ? $this['name_ar']: $this['name'],
            'code'=>$this['code'],
            'user_store_id'=>$this['user_store_id'],
            'views'=>$this['views'],
            'likes'=>$this['likes'],
            'follows'=>$this['follows'],
            'shares'=>$this['shares'],
            'visibility'=>$this['visibility'],
            'created_at'=>$this['created_at'],
            'updated_at'=>$this['updated_at'],
            'products_count'=>$this['products_count'],
            'is_liked'=>$this['is_liked'],
            'is_followed'=>$this['is_followed'],
//            'products'=>$this->products,
            'products'=>UserStoreCollectionProducts::collection($this['products']),
        ];
    }
}
class UserStoreCollectionProducts extends JsonResource
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
            'product_id'=>$this['id'],
            'slug'=>$this['slug'],
            'name'=>$lang == 'ar' ? $this['name_ar']: $this['name'],
            'keyword'=>$lang == 'ar' ? $this['name_ar']: $this['name'],
            'brand_id'=>$this['brand_id'],
            'store_id'=>$this['store_id'],
            'primary_image'=>$this['primary_image'],
            'avg_rating'=>$this['avg_rating'],
            'total_reviews'=>$this['total_reviews'],
            'model_type'=>$this['model_type'],
            'pivot'=>UserStoreCollectionProductsPivot::make($this['pivot']),
            'first_variant'=>FirstVariantResource::make($this['firstVariant']),
            'brand'=>BrandResource::make($this['brand']),
            'store'=>UserStoreCollectionProductsStore::make($this['store'])


        ];
    }
}
class UserStoreCollectionProductsStore extends JsonResource
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
            'model_type'=>'Store',
            'keyword'=>$lang=='ar' ? $this['store_name_ar']:$this['store_name'],
        ];
    }
}
class UserStoreCollectionProductsPivot extends JsonResource
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
            'collection_id'=>$this['collection_id'],
            'product_id'=>$this['product_id'],
            'created_at'=>$this['created_at'],
            'updated_at'=>$this['updated_at'],
        ];
    }
}
