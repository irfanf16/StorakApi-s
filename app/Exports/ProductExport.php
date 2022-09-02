<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;


class ProductExport implements FromView
{
    public $request;
    public function __construct(Request $request){
        $this->request=$request;
    }
    /**
    * @return \Illuminate\Support\Collection
    */
//    public function collection()
//    {
//        return Product::all();
//    }
    public function view(): View
    {
        $request=$this->request;
        $collections = Product::with('firstVariant')->with('brand')->whereHas('firstVariant')
//            ->select('id','slug','name','short_description','primary_image')

//            ->limit(20)
//            ->inRandomOrder()
            ->get();
//        dd($collections);
       $products= $collections->map(function($product, $key) {
//           if (str_contains($product->detailed_description,'storage/product/detail')){
//               $var1 =  $product->detailed_description;
//               $filename = str_replace("storage/product/detail/", "", $var1);
//               $file=Storage::disk('product')->get("detail/$filename");
//               $product['detailed_description'] = (json_decode($file))->content;
//           }
//           dd($product->brand->name);
            return [
                'id' => $product['slug'],
                'title' =>$product['name'],
                'description' =>Str::lower( $product['short_description']) ,
                'price' =>$product->firstVariant->price.' QAR',
                'brand' =>$product->brand->name,
                'condition'=>'new',
                'availability'=>'in stock',
                'link'=>'https://storak.qa/product-detail/'.$product['slug'],
                'image_link'=>'https://api.storak.qa/storage/product/images/md/'.$product['primary_image'],
            ];
        });
//        dd($products);
         if ($request->data_type=='facebook'){
             return view('admin.products.productsExportsFacebook', [
                 'products' =>$products,
             ]);
         }
        return view('admin.products.productsExportsGoogle', [
            'products' =>$products,
        ]);
    }
}
