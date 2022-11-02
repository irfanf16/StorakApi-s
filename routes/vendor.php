<?php

namespace App\Http\Controllers\Vendor;

use Illuminate\Support\Facades\Route;


/*
|=========================================================
| VENDOR API ROUTES
|=========================================================
*/
Route::group(['prefix' => '', 'middleware' => ['jwt.verify', 'isVendor']], function () {

    // Vendor Account setting
    Route::prefix('/account')->group(function () {
        Route::patch('/{id}', [VendorProfileController::class, 'update_account']);

    });

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

    Route::prefix('module')->group(function () {
        Route::get('/', [UserManagementController::class, 'listModules']);
    });

    // DASHBOARD
    Route::get('dashboard', [VendorDashboardController::class, 'index']);

    // VENDOR PROFILE
    Route::get('profile/basic', [VendorProfileController::class, 'profileDetails']);
    Route::post('profile/basic', [VendorProfileController::class, 'basicInfoUpdate']);
    Route::post('profile/business', [VendorProfileController::class, 'businessInfoUpdate']);
    Route::post('profile/business/documents', [VendorProfileController::class, 'businessDocumentsUpdate']);
    Route::post('profile/store', [VendorProfileController::class, 'storeInfoUpdate']);
    Route::post('profile/bank', [VendorProfileController::class, 'bankInfoUpdate']);
    Route::post('profile/warehouse', [VendorProfileController::class, 'warehouseInfoUpdate']);
    Route::post('profile/return', [VendorProfileController::class, 'returnInfoUpdate']);
    Route::post('profile/review', [VendorProfileController::class, 'requestProfileApproval']);
    Route::get('documents-with-inputs', [VendorProfileController::class, 'documentsWithInputs']);

    // PREVIEW BUSINESS DOCUMENT
    Route::get('doc/preview/{id}', [VendorProfileController::class, 'previewBusinessDocument']);

    // Store
    Route::get('store/getowner/{id}', [StoreController::class, 'getOwner']);

    // PRODUCTS
    Route::prefix('products')->group(function () {
        Route::get('/list', [VendorProductsController::class, 'productList']);
        Route::get('/variant/{id}', [VendorProductsController::class, 'variantDelete']);
        Route::post('/variant/{id}/add-variant', [VendorProductsController::class, 'addNewVariant']);
        Route::get('/{id}/edit/vendorTranslation', [VendorProductsController::class, 'editTranslation']);
        Route::post('/{id}/update/vendorTranslation', [VendorProductsController::class, 'updateTranslation']);
        Route::get('/change/status', [VendorProductsController::class, 'changeStatus']);

    });
    Route::resource('products', VendorProductsController::class);

    Route::post('product/subcategories-brands', [VendorProductsController::class, 'subcategoriesAndBrands']);
    Route::post('product/childcategories-attributes', [VendorProductsController::class, 'childcategoriesAndAttributes']);
    Route::post('product/childcategory-brands', [VendorProductsController::class, 'childcategory_brands']);
    Route::post('product/image/delete', [VendorProductsController::class, 'deleteProductImage']);

    // ORDERS (PACKAGES)
    Route::resource('orders', VendorOrdersController::class);
    Route::get('order/status/{id}', [VendorOrdersController::class, 'ordersByStatus']);
    Route::post('order/status/listing', [VendorOrdersController::class, 'orderStatusListing']);
    Route::post('order/status/{id}', [VendorOrdersController::class, 'updateOrderStatus']);

    // NOTIFICATIONS
    Route::get('notifications/recent', [VendorNotificationsController::class, 'recentNotifications']);
    Route::get('notifications/all', [VendorNotificationsController::class, 'allNotifications']);

    // COUPONS
    Route::resource('coupons', VendorCouponsController::class);
    Route::post('coupon/update-status', [VendorCouponsController::class, 'updateStatus']);

    // VERIFICATION
    Route::post('{vid}/email/verification', [VendorCategoriesController::class, 'setVerificationToken']);
    Route::get('{vid}/email/verification', [VendorCategoriesController::class, 'getVerificationToken']);
    Route::get('{vid}/mobile/verification', [VendorCategoriesController::class, 'mobileVerified']);

    // RATTINGS AND REVIEWS
    Route::get('reviews', [VendorProductReviewsController::class, 'index']);
    Route::post('review/reply', [VendorProductReviewsController::class, 'replyReview']);
    Route::post('review/report', [VendorProductReviewsController::class, 'reportReview']);
    Route::get('products/{id}/reviews', [VendorProductReviewsController::class, 'productReview']);


    // QUESTIONS
    Route::get('questions', [VendorProductQuestionsController::class, 'index']);
    Route::post('question/reply', [VendorProductQuestionsController::class, 'replyQuestion']);
    Route::post('question/report', [VendorProductQuestionsController::class, 'reportQuestion']);
    Route::get('products/{id}/questions', [VendorProductQuestionsController::class, 'productQuestions']);


//    commission
    Route::prefix('commissions')->group(function () {
        Route::get('structure', [VendorCommissionController::class, 'commissionStructure']);
        Route::get('items', [VendorCommissionController::class, 'itemsCommissions']);
    });
    Route::prefix('inside')->group(function () {
        Route::get('statistic', [VendorStatisticController::class, 'index']);
    });
});
