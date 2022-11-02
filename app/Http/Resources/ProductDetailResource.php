<?php

namespace App\Http\Resources;

use App\Models\WishlistItem;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');
        if ($lang == 'ar') {
            if (str_contains($this->detailed_description_ar, 'storage/product/detail')) {
                $var1 = $this->detailed_description_ar;
                $filename = str_replace("storage/product/detail/", "", $var1);
                $file = Storage::disk('product')->get("detail/$filename");
                $this['detailed_description'] = (json_decode($file))->content;
            }
        } else {
            if (str_contains($this->detailed_description, 'storage/product/detail')) {
                $var1 = $this->detailed_description;
                $filename = str_replace("storage/product/detail/", "", $var1);
                $file = Storage::disk('product')->get("detail/$filename");
                $this['detailed_description'] = (json_decode($file))->content;
            }
        }
        $is_wishlist_item = 0;

        if (Auth::check() && WishlistItem::where(['user_id' => Auth::id(), 'product_id' => $this['id']])->exists()) {
            $is_wishlist_item = 1;
        }


        return [
            'id' => $this['id'],
            'slug' => $this['slug'],
            'name' => $lang == 'ar' ? $this['name_ar'] : $this['name'],
            'keyword' => $lang == 'ar' ? $this['name_ar'] : $this['name'],
            'short_description' => $lang == 'ar' ? $this['short_description_ar'] : $this['short_description'],
            'detailed_description' => $this['detailed_description'],
            'primary_image' => $this['primary_image'],
            'video_url' => $this['video_url'],
            'package_contents' => $this['package_contents'],
            'warranty_type' => $this['warranty_type'],
            'warranty_period_id' => $this['warranty_period_id'],
            'warranty_policy' => $this['warranty_policy'],
            'package_weight' => $this['package_weight'],
            'package_length' => $this['package_length'],
            'package_width' => $this['package_width'],
            'package_height' => $this['package_height'],
            'good_type' => $this['good_type'],
            'brand_id' => $this['brand_id'],
            'likes' => $this['likes'],
            'views' => $this['views'],
            'recently_viewed' => $this['recently_viewed'],
            'sales' => $this['sales'],
            'reports' => $this['reports'],
            'total_reviews' => $this['total_reviews'],
            'total_rating' => $this['total_rating'],
            'avg_rating' => $this['avg_rating'],
            'wishlist_item' => $is_wishlist_item,

            'model_type' => 'Product',
            'most_sold_products_count' => $this['most_sold_products_count'],
            'most_wishlist_products_count' => $this['most_wishlist_products_count'],
            'category' => CategoryResource::make($this['category']),
            'subcategory' => SubCategoryResource::make($this['subcategory']),
            'childcategory' => ChildCategoryResource::make($this['childcategory']),
            'brand' => BrandResource::make($this['brand']),
            'first_variant' => FirstVariantResource::make($this['firstVariant']),
            'variants' => ProductVariants::collection($this['variants']),
            'product_attributes' => ProductAttributes::collection($this['productAttributes']),
            'images' => ProductDetailImages::collection($this['images']),
            'store' => ProductDetailStoreResource::make($this['store'])
        ];
    }
}


class ProductDetailImages extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'product_id' => $this['product_id'],
            'image' => $this['image'],
        ];
    }
}

class ProductVariants extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'price' => $this['price'],
            'special_price' => $this['special_price'],
            'quantity' => $this['quantity'],
            'availability' => $this['availability'],
            'seller_sku' => $this['seller_sku'],
            'image' => $this['image'],
            'variant_attributes' => ProductVariantAttributes::collection($this['variantAttributes']),

        ];
    }
}

class ProductVariantAttributes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'product_variant_id' => $this['product_variant_id'],
            'attribute_id' => $this['attribute_id'],
            'key_id' => $this['key_id'],
            'attribute_detail' => AttributeDetail::make($this['attributeDetail']),
            'key_detail' => KeyDetail::make($this['keyDetail']),
        ];
    }
}

class ProductAttributes extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this['id'],
            'product_id' => $this['product_variant_id'],
            'attribute_id' => $this['attribute_id'],
            'key_id' => $this['key_id'],
            'attribute_detail' => AttributeDetail::make($this['attributeDetail']),
            'key_detail' => KeyDetail::make($this['keyDetail']),
        ];
    }
}

class AttributeDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');
        return [
            'id' => $this['id'],
            'title' => $lang == 'ar' ? $this['title_ar'] : $this['title'],
        ];
    }
}

class KeyDetail extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');
        return [
            'id' => $this['id'],
            'name' => $lang == 'ar' ? $this['name_ar'] : $this['name'],
        ];
    }
}


class ProductDetailStoreResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');

        return [
            'id' => $this['id'],
            'slug' => $this['slug'],
            'store_name' => $lang == 'ar' ? $this['store_name_ar'] : $this['store_name'],
            'tag_line' => $lang == 'ar' ? $this['tag_line_ar'] : $this['tag_line'],
            'logo_image' => $this['logo_image'],
            'cover_image' => $this['cover_image'],
            'model_type' => 'Store',
            'keyword' => $lang == 'ar' ? $this['store_name_ar'] : $this['store_name'],
            'products' => StoreProductResource::collection($this['products'])

        ];
    }
}

class StoreProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $lang = $request->header('lang');

        return [
            'id' => $this['id'],
            'slug' => $this['slug'],
            'name' => $lang == 'ar' ? $this['name_ar'] : $this['name'],
            'keyword' => $lang == 'ar' ? $this['name_ar'] : $this['name'],
            'primary_image' => $this['primary_image'],
            'model_type' => 'Product',
        ];
    }
}
