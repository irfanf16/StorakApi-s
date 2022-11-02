<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\TestController;
use App\Http\Controllers\ProductsBulkUploadController;
use Stichoza\GoogleTranslate\GoogleTranslate;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('cache', function(){
    Artisan::call('optimize');
    Artisan::call('cache:clear');
    Artisan::call('route:cache');
    Artisan::call('route:clear');
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    return 'cache cleared';
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test/remove-duplicates' , [TestController::class , 'RemoveDuplicates'] );

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// LOGIN ROUTE -- REDIRECT TO ACCESS DEINED SCREEN
Route::get('/login', function () {
    return response()->json([
        "code" => 403,
        "message" => "Access Denied",
    ]);
})->name('login');

// REGISTER ROUTE -- REDIRECT TO ACCESS DEINED SCREEN
Route::get('/register', function () {
    return response()->json([
        "code"    => 403,
        "message" => "Access Denied",
    ]);
})->name('register');

// data uploaded
Route::get('/bulk-upload/products/default', [ProductsBulkUploadController::class, 'defaultVariantForm']);
Route::post('/bulk-upload/products/default', [ProductsBulkUploadController::class, 'bulkUploadWithDefaultVariant'])->name('bulk-upload');
Route::get('/bulk-upload/products/detailed', [ProductsBulkUploadController::class, 'detailedProductsForm']);
Route::post('/bulk-upload/products/detailed', [ProductsBulkUploadController::class, 'productDetailImages']);
Route::get('/products/variant/price/update', [ProductsBulkUploadController::class, 'productsVariantPricesForm']);
Route::post('/products/variant/price/update', [ProductsBulkUploadController::class, 'productsVariantPricesUpdate'])->name('stock_update');


Route::get('slugs',[\App\Http\Controllers\TranslationController::class,'slugs']);
Route::get('slugs/products',[\App\Http\Controllers\TranslationController::class,'slugsProducts']);

// translations arbic

Route::get('translation/category',[\App\Http\Controllers\TranslationController::class,'categoryTranslation']);
Route::get('translation/keys',[\App\Http\Controllers\TranslationController::class,'translationKeys']);
Route::get('translation/products',[\App\Http\Controllers\TranslationController::class,'productTranslation']);
Route::get('translation/brands',[\App\Http\Controllers\TranslationController::class,'brandsTranslation']);
Route::get('translation/order/status',[\App\Http\Controllers\TranslationController::class,'orderStatusTranslation']);
Route::get('translation/store',[\App\Http\Controllers\TranslationController::class,'storeTranslation']);
Route::get('translation/user/store',[\App\Http\Controllers\TranslationController::class,'userStoreTranslation']);
Route::get('translation/attributes',[\App\Http\Controllers\TranslationController::class,'attributesTranslation']);
Route::get('translation/collections',[\App\Http\Controllers\TranslationController::class,'collectionsTranslation']);


//export products in excel file for google and facebook purpose

Route::get('products/export/facebook',[\App\Http\Controllers\ExportProductsController::class,'exportProductsFacebook']);
Route::get('products/export/google',[\App\Http\Controllers\ExportProductsController::class,'exportProductsGoogle']);

// product data update on live via localhost

Route::get('products/data/update',[\App\Http\Controllers\DataManagementController::class,'updateProductRecords']);
Route::get('products/images',[\App\Http\Controllers\DataManagementController::class,'updateProductsDetailImages']);
