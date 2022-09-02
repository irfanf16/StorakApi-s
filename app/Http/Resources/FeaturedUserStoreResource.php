<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class FeaturedUserStoreResource extends JsonResource
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
            'profile'=>$this['profile'],
            'cover'=>$this['cover'],
            'visibility'=>$this['visibility'],
            'code'=>$this['code'],
            'views'=>$this['views'],
            'likes'=>$this['likes'],
            'shares'=>$this['shares'],
            'follows'=>$this['follows'],
            'is_liked'=>$this['is_liked'],
            'is_followed'=>$this['is_followed'],
            'collections_count'=>$this['collections_count'],
            'collections'=>FeaturedUserStoreCollectionsResource::collection($this['collections']),
            'likers'=>LikersResource::collection($this['likers']),
            'followers'=>FollowersResource::collection($this['followers']),
        ];
    }
}
class LikersResource extends JsonResource
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
            'name'=>$this['name'],
            'profile_image'=>$this['profile_image'],

        ];
    }
}
class FollowersResource extends JsonResource
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
            'name'=>$this['name'],
            'profile_image'=>$this['profile_image'],

        ];
    }
}

class FeaturedUserStoreCollectionsResource extends JsonResource
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
            'visibility'=>$this['visibility'],
            'code'=>$this['code'],
            'views'=>$this['views'],
            'likes'=>$this['likes'],
            'shares'=>$this['shares'],
            'follows'=>$this['follows'],
            'is_liked'=>$this['is_liked'],
            'is_followed'=>$this['is_followed'],
        ];
    }
}
