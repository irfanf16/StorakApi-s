<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductReviewsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        if ($this['orderPackages'][0]['packageItems'][0]['productDetail']) {
            return [
                'id' => $this['id'],
                'order_no' => $this['order_no'],
                'user_id' => $this['user_id'],
                'billing_address_id' => $this['billing_address_id'],
                'shipping_address_id' => $this['shipping_address_id'],
                'packages_bill' => $this['packages_bill'],
                'final_bill' => $this['final_bill'],
                'payment_method' => $this['payment_method'],
                'billing_status' => $this['billing_status'],
                'created_at' => $this['created_at'],
                'updated_at' => $this['updated_at'],
                'order_packages' => ProductReviewsOrderPackagesResource::collection($this['orderPackages'])
            ];
        }

    }
}

class ProductReviewsOrderPackagesResource extends JsonResource
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
            'order_id' => $this['order_id'],
            'package_no' => $this['package_no'],
            'store_id' => $this['store_id'],
            'fulfillment_id' => $this['fulfillment_id'],
            'order_status_id' => $this['order_status_id'],
            'fulfillment_charges' => $this['fulfillment_charges'],
            'package_bill' => $this['package_bill'],
            'store_detail' => ProductReviewsOrderPackageStoreResource::make($this['storeDetail']),
            'package_items' => ProductReviewsOrderPackageItemsResource::collection($this['packageItems'])

        ];
    }
}

class ProductReviewsOrderPackageStoreResource extends JsonResource
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
            'store_name' => $lang == 'ar' ? $this['store_name_ar'] : $this['store_name'],
            'keyword' => $lang == 'ar' ? $this['store_name_ar'] : $this['store_name'],
            'model_type' => 'Store',
        ];
    }
}

class ProductReviewsOrderPackageItemsResource extends JsonResource
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
            'order_package_id' => $this['order_package_id'],
            'product_id' => $this['product_id'],
            'product_variant_id' => $this['product_variant_id'],
            'quantity' => $this['quantity'],
            'price' => $this['price'],
            'product_detail' => ProductReviewDetailResource::make($this['productDetail']),
            'variant_detail' => PrdocutVariantResource::make($this['variantDetail']),
        ];
    }

}

class ProductReviewDetailResource extends JsonResource
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
            'model_type' => 'Product',
            'primary_image' => $this['primary_image'],
            'brand_id' => $this['brand_id'],
            'likes' => $this['likes'],
            'views' => $this['views'],
            'sales' => $this['sales'],
            'reports' => $this['reports'],
            'total_reviews' => $this['total_reviews'],
            'avg_rating' => $this['avg_rating'],
            'brand' => BrandResource::make($this['brand']),
        ];
    }
}

class PrdocutVariantResource extends JsonResource
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
            'product_id' => $this['product_id'],
            'quantity' => $this['quantity'],
            'seller_sku' => $this['seller_sku'],
            'availability' => $this['availability'],
            'image' => $this['image'],
        ];
    }
}
