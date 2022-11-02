<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\MassuploadController;
use Illuminate\Support\Facades\Route;

/*
|=========================================================
| AJAX API ROUTES
|=========================================================
*/
Route::group(['prefix' => 'ajax/', 'middleware' => []], function () {

    Route::get('categories', [AdminAjaxRequestsController::class, 'categoriesList']);
    Route::get('subcategories', [AdminAjaxRequestsController::class, 'subcategoriesList']);
    Route::get('childcategories', [AdminAjaxRequestsController::class, 'childcategoriesList']);
    Route::get('variants', [AdminAjaxRequestsController::class, 'variantsList']);
    Route::get('multiple-subcategories', [AdminAjaxRequestsController::class, 'multipleSubCategories']);
    Route::get('multiple-childcategories', [AdminAjaxRequestsController::class, 'multipleChildCategories']);
});

/*
|=========================================================
| STORAK-ADMIN API ROUTES
|=========================================================
*/
Route::group(['prefix' => '',], function () {

    // DASHBOARD
    Route::get('dashboard', [AdminDashboardController::class, 'index']);

    // CATEGORIES-MANAGEMENT
    Route::prefix('categories')->group(function () {
        Route::get('/archive', [AdminCategoriesController::class, 'showArchive']);
        Route::post('/restore', [AdminCategoriesController::class, 'restoreCategory']);
        Route::post('/order/update', [AdminCategoriesController::class, 'orderUpdate']);
        Route::get('/{id}/subcategories', [AdminCategoriesController::class, 'subcategories']);
        Route::get('/change/status', [AdminCategoriesController::class, 'changeStatus']);
    });
    Route::resource('categories', AdminCategoriesController::class);

    Route::prefix('subcategories')->group(function () {
        Route::get('/archive', [AdminSubcategoriesController::class, 'showArchive']);
        Route::post('/restore', [AdminSubcategoriesController::class, 'restoreCategory']);
        Route::post('/order/update', [AdminSubcategoriesController::class, 'orderUpdate']);
        Route::get('/change/status', [AdminSubcategoriesController::class, 'changeStatus']);
        Route::get('/count', [AdminSubcategoriesController::class, 'countSub']);

        Route::get('/{id}/childcategories', [AdminSubCategoriesController::class, 'childcategories']);
    });
    Route::resource('subcategories', AdminSubcategoriesController::class);

    Route::prefix('childcategories')->group(function () {
        Route::get('childcategories/status/changes/{id}', [AdminAttributesController::class, 'statusChanged']);
        Route::get('/archive', [AdminChildcategoriesController::class, 'showArchive']);
        Route::post('/restore', [AdminChildcategoriesController::class, 'restoreCategory']);
        Route::post('/order/update', [AdminChildcategoriesController::class, 'orderUpdate']);
    });
    Route::get('/child/change/status', [AdminChildcategoriesController::class, 'changeStatus']);
    Route::get('child/count', [AdminChildcategoriesController::class, 'countChild']);
    Route::resource('childcategories', AdminChildcategoriesController::class);

    //CUSTOMER-MANAGEMENT

    Route::get('customer/profiles', [AdminCustomerController::class, 'allCustomers']);
    Route::get('customer/wishlist', [AdminCustomerController::class, 'wishlist']);
    Route::get('customer/cartItems', [AdminCustomerController::class, 'cartItems']);
    Route::get('customer/detail/{id}', [AdminCustomerController::class, 'show']);
    Route::get('/customer/status', [AdminCustomerController::class, 'changeStatus']);


    // VENDORS-MANAGEMENT
    Route::group(['prefix' => 'vendor/', 'middleware' => []],
        function () {
            Route::get('profiles', [AdminVendorsController::class, 'allVendors']);
            Route::get('profiles/incomplete', [AdminVendorsController::class, 'incompleteVendors']);
            Route::get('profiles/under-review', [AdminVendorsController::class, 'underReviewVendors']);
            Route::get('profiles/approved', [AdminVendorsController::class, 'approvedVendors']);
            Route::get('profiles/rejected', [AdminVendorsController::class, 'rejectedVendors']);

            // PROFILE DETAILS
            Route::get('profile/incomplete/{id}', [AdminVendorsController::class, 'incompleteVendorDetail']);
            Route::get('profile/detail/{id}', [AdminVendorsController::class, 'vendorProfileDetail']);

            // UPDATE VENDOR STATUS
            Route::post('profile/update-status/{id}', [AdminVendorsController::class, 'updateVendorStatus']);
        });


    Route::get('/vendor/store/status', [AdminVendorStoresController::class, 'changeStatus']);
    Route::resource('stores/vendor', AdminVendorStoresController::class);
    Route::resource('stores/customer', AdminCustomerStoresController::class);
    Route::get('/customer/collections/{id}', [AdminCustomerStoresController::class, 'collections']);
    Route::get('/customer/store/status', [AdminCustomerStoresController::class, 'changeStatus']);
    Route::get('/collection/visibility', [AdminCustomerStoresController::class, 'collectionVisibility']);
    Route::resource('buyers', AdminBuyersController::class);

    Route::prefix('brands')->group(function () {
        Route::get('/archive', [AdminBrandsController::class, 'showArchive']);
        Route::post('/restore', [AdminBrandsController::class, 'restoreCategory']);
        Route::get('/count', [AdminBrandsController::class, 'countBrand']);
    });
    Route::get('/brand/change/status', [AdminBrandsController::class, 'changeStatus']);
    Route::resource('brands', AdminBrandsController::class);

    // Attribute
    Route::resource('attributes', AdminAttributesController::class);
    Route::get('/attr/count', [AdminAttributesController::class, 'countAttrib']);
    Route::get('attribute/change/status', [AdminAttributesController::class, 'changeStatus']);

    // keys
    Route::resource('keys', AdminKeysController::class);
    Route::get('key/change/status', [AdminKeysController::class, 'changeStatus']);

    // PRODUCT MODULE
    Route::resource('/product', AdminProductsController::class);
    Route::get('/product/change/status', [AdminProductsController::class, 'changeStatus']);
    Route::resource('variants', AdminVariantsController::class);
    Route::resource('partners', AdminPartnersController::class);
    Route::get('products/count', [AdminProductsController::class, 'countProduct']);
    Route::get('/product/{id}/editTranslation', [AdminProductsController::class, 'editTranslation']);
    Route::post('/product/{id}/updateTranslation', [AdminProductsController::class, 'updateTranslation']);

    // PRODUCT VARIANTS
    Route::get('products/{pid}/variants', [AdminProductVariantsController::class, 'index']);
    Route::get('products/{pid}/variants/create', [AdminProductVariantsController::class, 'create']);
    Route::post('products/{pid}/variants', [AdminProductVariantsController::class, 'store']);
    Route::get('products/{pid}/variants/{vid}/edit', [AdminProductVariantsController::class, 'edit']);
    Route::put('products/{pid}/variants/{vid}', [AdminProductVariantsController::class, 'update']);
    Route::delete('products/{pid}/variants/{vid}', [AdminProductVariantsController::class, 'destroy']);
    Route::post('products/{pid}/variants/{vid}/addstock', [AdminProductVariantsController::class, 'addStock']);

//    stock management

    Route::get('product/stocks/list', [AdminStockController::class, 'index']);
    Route::get('product/stocks/availability', [AdminStockController::class, 'changeStatus']);


    // PRODUCT RATINGS-AND-REVIEWS
    Route::get('products/{id}/reviews', [AdminProductReviewsController::class, 'index']);
    Route::post('products/reviews/filtered', [AdminProductReviewsController::class, 'filteredReviews']);
    Route::get('products/review/{id}/detail', [AdminProductReviewsController::class, 'reviewDetail']);
    Route::post('products/review/{id}/status', [AdminProductReviewsController::class, 'changeReviewStatus']);

    // all reviews

    Route::get('reviews', [AdminProductReviewsController::class, 'reviewsList']);
    Route::get('review/status', [AdminProductReviewsController::class, 'changeStatus']);


    // PRODUCT QUESTIONS
    Route::get('products/{pid}/questions', [AdminProductQuestionsController::class, 'index']);
    Route::get('products/{pid}/questions/{qid}/edit', [AdminProductQuestionsController::class, 'edit']);
    Route::put('products/{pid}/questions/{qid}', [AdminProductQuestionsController::class, 'update']);
    Route::delete('products/{pid}/questions/{qid}', [AdminProductQuestionsController::class, 'destroy']);


    // all questions

    Route::get('questions', [AdminProductQuestionsController::class, 'questionsList']);
    Route::get('question/status', [AdminProductQuestionsController::class, 'changeStatus']);
    // SETTINGS
    Route::resource('cities', AdminCitiesController::class);

    // WEBSITE BANNERS
    Route::prefix('website/banners')->group(function () {
        Route::post('/delete/multiple', [AdminWebsiteBannersController::class, 'deleteMultipleBanners']);
        Route::get('/delete/all', [AdminWebsiteBannersController::class, 'deleteAllBanners']);
        Route::get('/archive', [AdminWebsiteBannersController::class, 'showArchiveBanners']);
        Route::post('/restore', [AdminWebsiteBannersController::class, 'restoreBanner']);
        Route::post('/order/update', [AdminWebsiteBannersController::class, 'orderUpdate']);
    });
    Route::resource('website/banners', AdminWebsiteBannersController::class);


    Route::resource('mobile/covers', AdminMobileCoversController::class);

    // BUSINESS DOCUMENTS
    Route::resource('business-documents', AdminBusinessDocumentsController::class);
    Route::get('documents/with-inputs', [AdminBusinessDocumentsController::class, 'documentsWithInputs']);

    Route::get('document/{did}/inputs', [AdminBusinessDocumentInputsController::class, 'index']);
    Route::get('document/{did}/input/create', [AdminBusinessDocumentInputsController::class, 'create']);
    Route::post('document/{did}/input', [AdminBusinessDocumentInputsController::class, 'store']);
    Route::get('document/{did}/input/{id}/edit', [AdminBusinessDocumentInputsController::class, 'edit']);
    Route::put('document/{did}/input/{id}', [AdminBusinessDocumentInputsController::class, 'update']);
    Route::delete('document/{did}/input/{id}', [AdminBusinessDocumentInputsController::class, 'destroy']);


    Route::post('massupload/product', [MassuploadController::class, 'store']);

//    Orders
//    Route::prefix('orders')->group(function (){
//        Route::get('list',[AdminOrderController::class,'ordersList']);
//        Route::get('detail/{id}',[AdminOrderController::class,'orderDetail']);
//    });


//    orders

    Route::resource('order', AdminOrderController::class);
    Route::get('order/status/{id}', [AdminOrderController::class, 'ordersByStatus']);
    Route::post('order/status/listing', [AdminOrderController::class, 'orderStatusListing']);
    Route::post('order/status/{id}', [AdminOrderController::class, 'updateOrderStatus']);
    Route::get('order-invoice/{id}', [AdminOrderController::class, 'orderInvoice']);


    Route::prefix('commissions')->group(function () {
        Route::get('/', [AdminCommissionController::class, 'index'])->name('commissions');
        Route::get('/applied', [AdminCommissionController::class, 'appliedCommissionSection'])->name('commissions.applied');
    });

    Route::get('/social', [AdminSocialLinkController::class, 'index']);
    Route::post('/social/store', [AdminSocialLinkController::class, 'store']);
    Route::get('/social/edit/{id}', [AdminSocialLinkController::class, 'edit']);
    Route::post('/social/update/{id}', [AdminSocialLinkController::class, 'update']);
    Route::delete('/social/delete/{id}', [AdminSocialLinkController::class, 'destroy']);

    //Settings

    Route::get('app/settings', [AdminAppSettingController::class, 'index']);
    Route::get('app/settings/edit/{id}', [AdminAppSettingController::class, 'edit']);
    Route::put('app/settings/update/{id}', [AdminAppSettingController::class, 'update']);
    Route::post('app/settings/status/{id}', [AdminAppSettingController::class, 'changeStatus']);
    Route::delete('app/settings/delete/{id}', [AdminAppSettingController::class, 'destroy']);

    //subscribers

    Route::get('/subscribers', [AdminSubscribersController::class, 'index']);

    //contacts

    Route::get('/contacts', [AdminContactsController::class, 'index']);


    // Vendor Sub User Management
    Route::prefix('/users')->group(function () {
        Route::post('/', [UserManagementController::class, 'createUser']);
        Route::patch('/{id}', [UserManagementController::class, 'updateUser']);
        Route::get('/', [UserManagementController::class, 'listUser']);
        Route::get('/{id}', [UserManagementController::class, 'findUser']);

    });

    Route::prefix('/subrole')->group(function () {
        Route::post('/', [UserManagementController::class, 'createSubrole']);
        Route::get('/', [UserManagementController::class, 'listSubrole']);
        Route::get('/{id}', [UserManagementController::class, 'findSubrole']);
        Route::patch('/{id}', [UserManagementController::class, 'updateSubrole']);

        // set permission of subroles
        Route::post('/permissions', [UserManagementController::class, 'createSubrolePermissions']);


        // Assign role to Users
        Route::post('/assign', [UserManagementController::class, 'assignSubrole']);

    });


});

