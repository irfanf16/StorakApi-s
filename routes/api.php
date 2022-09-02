<?php

use App\Http\Controllers\Admin\AdminCommissionController;
use App\Http\Controllers\AppSettingController;
use App\Http\Controllers\User\SubscriberController;
use App\Http\Controllers\Vendor\VendorCommissionController;
use App\Http\Controllers\Vendor\VendorStatisticController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// JWT CONTROLLER
use App\Http\Controllers\JwtAuthController;

// OTP CONTROLLER
use App\Http\Controllers\OtpController;

// ACTIVITY CONTROLLER
use App\Http\Controllers\ActivityController;


//  ADMIN CONTROLLERS
use App\Http\Controllers\Admin\AdminOrderController;
use App\Http\Controllers\Admin\AdminProductsController;
use App\Http\Controllers\Admin\AdminAjaxRequestsController;
use App\Http\Controllers\Admin\AdminAppSettingController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminCategoriesController;
use App\Http\Controllers\Admin\AdminSubcategoriesController;
use App\Http\Controllers\Admin\AdminChildcategoriesController;
use App\Http\Controllers\Admin\AdminVendorsController;
use App\Http\Controllers\Admin\AdminBuyersController;
use App\Http\Controllers\Admin\AdminVendorStoresController;

use App\Http\Controllers\Admin\AdminProductReviewsController;
use App\Http\Controllers\Admin\AdminProductQuestionsController;

use App\Http\Controllers\Admin\AdminBrandsController;
use App\Http\Controllers\Admin\AdminAttributesController;
use App\Http\Controllers\Admin\AdminVariantsController;

use App\Http\Controllers\Admin\AdminPartnersController;
use App\Http\Controllers\Admin\AdminCitiesController;

use App\Http\Controllers\Admin\AdminWebsiteBannersController;
use App\Http\Controllers\Admin\AdminMobileCoversController;

use App\Http\Controllers\Admin\AdminBusinessDocumentsController;
use App\Http\Controllers\Admin\AdminBusinessDocumentInputsController;
use App\Http\Controllers\Admin\AdminCustomerController;
use App\Http\Controllers\Admin\AdminCustomerStoresController;
use App\Http\Controllers\Admin\AdminKeysController;
use App\Http\Controllers\MassuploadController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\Admin\AdminProductVariantsController;
use App\Http\Controllers\Admin\AdminSocialLinkController;
use App\Http\Controllers\Admin\AdminSubscribersController;
use App\Http\Controllers\Admin\AdminContactsController;

// VENDOR CONTROLLERS
use App\Http\Controllers\Vendor\VendorAccountVerificationsController;
use App\Http\Controllers\Vendor\VendorCustomMessageController;

use App\Http\Controllers\Vendor\VendorDashboardController;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Controllers\Vendor\VendorProductsController;
use App\Http\Controllers\Vendor\VendorOrdersController;
use App\Http\Controllers\Vendor\VendorNotificationsController;
use App\Http\Controllers\Vendor\VendorCouponsController;

use App\Http\Controllers\Vendor\VendorProductReviewsController;
use App\Http\Controllers\Vendor\VendorProductQuestionsController;

use App\Http\Controllers\Vendor\VendorCategoriesController;
use App\Http\Controllers\Vendor\VendorBrandsController;
use App\Http\Controllers\Vendor\VendorProductsVariantsController;


// SHIPPING-COMPANY CONTROLLERS
use App\Http\Controllers\Shipping\ShippingDeliverRequestsController;


// WEBSITE CONTROLLERS
use App\Http\Controllers\User\WebNavbarsController;
use App\Http\Controllers\User\WebHomepageController;
use App\Http\Controllers\User\WebFiltersController;
use App\Http\Controllers\User\ProductDetailPageController;

// MOBILE-APP CONTROLLERS
use App\Http\Controllers\User\AppHomeScreenController;
use App\Http\Controllers\User\AppFiltersController;
use App\Http\Controllers\User\AppProductsController;
use App\Http\Controllers\User\OrdersController;

// WEBSITE + MOBILE-APP
use App\Http\Controllers\User\ProfileInformationController;
use App\Http\Controllers\User\AddressesController;
use App\Http\Controllers\User\CartItemsController;
use App\Http\Controllers\User\WishlistItemsController;
use App\Http\Controllers\User\ProductQuestionsController;
use App\Http\Controllers\User\ProductReviewsController;
use App\Http\Controllers\User\LikesController;

use App\Http\Controllers\User\CategoriesController;
use App\Http\Controllers\User\CollectionController;
use App\Http\Controllers\User\CollectionProductController;
use App\Http\Controllers\User\DeliverySlotsController;
use App\Http\Controllers\User\UserStoreController;
use App\Http\Controllers\Vendor\StoreController;
use App\Http\Controllers\Vendor\UserManagementController;

/*
|=======================================================
| API Routes
|=======================================================
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/search/{key}', [SearchController::class, 'index']);
Route::get('/search', [SearchController::class, 'search']);
Route::get('/search/refine/{type}/{key}', [SearchController::class, 'refine']);

// guest api

Route::post('guest/orders', [OrdersController::class, 'placeGuestOrder']);

/*
|=========================================================
| JWT AUTH API ROUTES
|=========================================================
*/
Route::group(['middleware' => 'api',], function () {

    // Activity Log
    Route::resource('/activity-log', ActivityController::class);
    Route::get('/activity-log/by/{module}', [ActivityController::class, 'showByModule']);

    Route::post('login', [JwtAuthController::class, 'login']);
    Route::post('register', [JwtAuthController::class, 'register']);
    Route::post('validate-unique-email', [JwtAuthController::class, 'validateUniqueEmail']);
    Route::post('validate-unique-mobile', [JwtAuthController::class, 'validateUniqueMobile']);
    Route::post('/vendor/register', [JwtAuthController::class, 'vendorRegister']);
    Route::post('/vendor/register/social', [JwtAuthController::class, 'socialLogin']);
    Route::post('/social/login', [JwtAuthController::class, 'socialLogin']);

    // AUTH USER ROUTES
    Route::get('logout', [JwtAuthController::class, 'logout'])->middleware('jwt.verify');
    Route::post('account/delete', [JwtAuthController::class, 'accountDelete']);
    Route::post('refresh', [JwtAuthController::class, 'refresh'])->middleware('jwt.verify');
    Route::post('me', [JwtAuthController::class, 'me']);

    // VENDOR PROFILE VERIFICATIONS (EMAIL,MOBILE-NO)
    Route::post('verify/email', [VendorAccountVerificationsController::class, 'saveVerifyEmailCode'])->middleware('jwt.verify');
    Route::post('otp/send', [VendorAccountVerificationsController::class, 'sendOtp'])->middleware('jwt.verify');
    Route::post('otp/verify', [VendorAccountVerificationsController::class, 'verifyOtp'])->middleware('jwt.verify');
    Route::get('code-verify/{code}', [VendorAccountVerificationsController::class, 'matchEmailVerificationCode']);
    Route::post('verify/mobile', [VendorAccountVerificationsController::class, 'verifyMobile'])->middleware('jwt.verify');

    // RESET PASSWORD VIA MOBILE OTP
    Route::post('validate-phone', [VendorAccountVerificationsController::class, 'validateVendorMobile']);
    Route::post('reset-vendor-password', [VendorAccountVerificationsController::class, 'resetVendorPassword']);

    // RESET PASSWORD VIA Email Link
    Route::post('/password/reset/email/verify', [VendorAccountVerificationsController::class, 'validateVendorEmail']);
    Route::get('password/reset/email/confirm-email-code/{code}', [VendorAccountVerificationsController::class, 'matchEmailResetCode']);
    Route::post('password/reset/email/update-password', [VendorAccountVerificationsController::class, 'resetVendorPasswordViaEmail']);
//    Subscriber
    Route::post('subscribe',[SubscriberController::class,'subscribe']);
    Route::post('contact/us',[SubscriberController::class,'constantUs']);
});


/*
|=========================================================
| OTP ROUTES -- FORGET PASSWORD
|=========================================================
*/
Route::group(['prefix' => 'email', 'middleware' => []], function () {
    Route::post('otp/send', [OtpController::class, 'sendOtp']);
    Route::post('otp/verify', [OtpController::class, 'verifyOtp']);
    Route::post('password/reset', [OtpController::class, 'resetPassword'])->middleware('jwt.verify');
});

// CUSTOM-MESSAGE
Route::resource('custom-messages', VendorCustomMessageController::class);


/*
|=========================================================
| AJAX API ROUTES
|=========================================================
*/
Route::group(['prefix' => 'admin/ajax/', 'middleware' => []], function () {

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
Route::group(['prefix' => 'admin/', 'middleware' => ['isStorakAdmin']], function () {

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


    // PRODUCT RATINGS-AND-REVIEWS
    Route::get('products/{id}/reviews', [AdminProductReviewsController::class, 'index']);
    Route::post('products/reviews/filtered', [AdminProductReviewsController::class, 'filteredReviews']);
    Route::get('products/review/{id}/detail', [AdminProductReviewsController::class, 'reviewDetail']);
    Route::post('products/review/{id}/status', [AdminProductReviewsController::class, 'changeReviewStatus']);

    // all reviews

    Route::get('reviews', [AdminProductReviewsController::class, 'reviewsList']);



    // PRODUCT QUESTIONS
    Route::get('products/{pid}/questions', [AdminProductQuestionsController::class, 'index']);
    Route::get('products/{pid}/questions/{qid}/edit', [AdminProductQuestionsController::class, 'edit']);
    Route::put('products/{pid}/questions/{qid}', [AdminProductQuestionsController::class, 'update']);
    Route::delete('products/{pid}/questions/{qid}', [AdminProductQuestionsController::class, 'destroy']);

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

    Route::get('app/settings',[AdminAppSettingController::class,'index']);
    Route::get('app/settings/edit/{id}',[AdminAppSettingController::class,'edit']);
    Route::put('app/settings/update/{id}',[AdminAppSettingController::class,'update']);
    Route::post('app/settings/status/{id}',[AdminAppSettingController::class,'changeStatus']);
    Route::delete('app/settings/delete/{id}',[AdminAppSettingController::class,'destroy']);

    //subscribers

    Route::get('/subscribers', [AdminSubscribersController::class, 'index']);

    //contacts

    Route::get('/contacts', [AdminContactsController::class, 'index']);

});


/*
|=========================================================
| VENDOR API ROUTES
|=========================================================
*/
Route::group(['prefix' => 'vendor/', 'middleware' => ['jwt.verify', 'isVendor']], function () {

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
    Route::prefix('commissions')->group(function (){
        Route::get('structure',[VendorCommissionController::class,'commissionStructure']);
        Route::get('items',[VendorCommissionController::class,'itemsCommissions']);
    });
    Route::prefix('inside')->group(function (){
        Route::get('statistic',[VendorStatisticController::class,'index']);
    });
});


/*
|======================================================================
| ORDER-SHIPPING-COMPANY API ROUTES
|======================================================================
*/
Route::group(['prefix' => 'shipping/', 'middleware' => []], function () {

    Route::get('requests', [ShippingDeliverRequestsController::class, 'shippingRequests']);
    Route::get('update/status', [ShippingDeliverRequestsController::class, 'updateOrderStatus']);
});


/*
|======================================================================
| WEBSITE API ROUTES
|======================================================================
*/
Route::group(['prefix' => '/', 'middleware' => []], function () {

    // HEADER/NAVBAR
    Route::get('categories-with-subcategories', [WebNavbarsController::class, 'categoriesWithSubcategories']);
    Route::get('categories/featured', [WebNavbarsController::class, 'featuredCategories']);
    Route::get('categories/popular', [WebNavbarsController::class, 'popularCategories']);

    // HOME-PAGE
    Route::get('banners', [WebHomepageController::class, 'topBanners']);
    Route::get('categories', [WebHomepageController::class, 'categoriesOnly']);
    Route::get('products/recommended', [WebHomepageController::class, 'recommendedProducts']);
    Route::get('products/sale-of-day', [WebHomepageController::class, 'sodProducts']);
    Route::get('products/featured', [WebHomepageController::class, 'featuredProducts']);
    Route::get('products/mega-deals', [WebHomepageController::class, 'megaDealsProducts']);
    Route::get('products/top-selling', [WebHomepageController::class, 'topSellingProducts']);
    Route::get('sellers/featured', [WebHomepageController::class, 'featuredSellers']);
    Route::get('partners', [WebHomepageController::class, 'activePartners']);
    Route::get('user-stores/featured', [WebHomepageController::class, 'featuredUserStores']);

    // FILTERS
    Route::post('filters', [WebFiltersController::class, 'generalFilters']);
    Route::post('category/{id}/products', [WebFiltersController::class, 'filteredProducts']);
    Route::post('category/slug/products/search', [WebFiltersController::class, 'filteredProductsSlug']);

    // PRODUCT-DETAILS
    Route::get('product/{id}', [ProductDetailPageController::class, 'productDetails']);
    Route::get('product/detail/{slug}', [ProductDetailPageController::class, 'productDetail']);
//    arbic pending
    Route::get('product/{id}/reviews', [ProductDetailPageController::class, 'productReviews']);
    Route::get('product/{id}/reviews/images', [ProductDetailPageController::class, 'productReviewImages']);
    Route::get('product/{id}/questions', [ProductDetailPageController::class, 'productQuestions']);
    Route::get('product/{id}/likes/increase', [ProductDetailPageController::class, 'incrementProductLikes']);

//    add country city
    Route::get('profile/address/create', [AddressesController::class, 'create']);
//    brands list
    Route::get('brands', [AppHomeScreenController::class, 'brands']);
});


/*
|====================================================================
| MOBILE API ROUTES
|====================================================================
*/
Route::group(['prefix' => 'app/', 'middleware' => []], function () {

    // HOME-SCREEN
    Route::get('homescreen', [AppHomeScreenController::class, 'index']);
    Route::get('top-selling-products', [AppHomeScreenController::class, 'topSellingProducts']);
    Route::get('most-selling-products', [AppHomeScreenController::class, 'mostSellingProducts']);

    // CATEGORIES-SCREEN
    Route::get('categories', [AppHomeScreenController::class, 'categoriesWithSubcategories']);

    // FILTERS
    Route::post('filters/{id?}', [AppFiltersController::class, 'generalFilters']);
    Route::post('products/apply-filters', [AppFiltersController::class, 'filteredProducts']);
    Route::post('products/by/apply/filters', [AppFiltersController::class, 'productsByFiltered']);

    // PRODUCTS
    Route::get('product/{id}', [AppProductsController::class, 'productDetails']);
//    App settings



});


/*
|======================================================================
| MOBILE-APPLICATION + WEBSITE API ROUTES
|======================================================================
*/

Route::group(['prefix' => '/', 'middleware' => ['isBuyer']], function () {

    // PROFILE-MANAGEMENT
    Route::group(['prefix' => 'profile/'], function () {

        // USER PROFILE-INFORMATION
        Route::get('edit', [ProfileInformationController::class, 'editProfile']);
        Route::post('update', [ProfileInformationController::class, 'updateProfile']);
        Route::post('password/update', [ProfileInformationController::class, 'updatePassword']);

        // USER ADDRESSES
        Route::get('addresses', [AddressesController::class, 'index']);
        Route::post('address/create', [AddressesController::class, 'store']);
        Route::get('address/{id}/edit', [AddressesController::class, 'edit']);
        Route::put('address/{id}', [AddressesController::class, 'update']);
        Route::delete('address/{id}', [AddressesController::class, 'destroy']);
        Route::post('address/multiple', [AddressesController::class, 'deleteMultiple']);
        Route::post('address/delete/all', [AddressesController::class, 'deleteAll']);

        // USER RATINGS-AND-REVIEWS
        Route::get('reviews/past', [ProductReviewsController::class, 'pastReviews']);
        Route::get('/reviews/pending', [ProductReviewsController::class, 'pendingReviews']);
        Route::get('/pending/reviews', [ProductReviewsController::class, 'reviewsPending']);
        Route::post('review/submit', [ProductReviewsController::class, 'submitReview']);

        // USER QUESTIONS
        // Route::delete('address/{id}', [AddressesController::class, 'destroy']);
        Route::resource('/questions', ProductQuestionsController::class);
        Route::post('questions/delete/multiple', [ProductQuestionsController::class, 'deleteMultiple']);
        Route::delete('questions/delete/all', [ProductQuestionsController::class, 'deleteAll']);

        // USER LIKES

//        arbic pending
        Route::get('like/products', [LikesController::class, 'likedProducts']);
        Route::post('unlike/product/single', [LikesController::class, 'unlikeSingleProduct']);
        Route::post('unlike/products/multiple', [LikesController::class, 'unlikeMultipleProducts']);
        Route::get('like/reviews', [LikesController::class, 'likedReviews']);
        Route::get('unlike/{id}/review', [LikesController::class, 'unlikeReview']);

        // USER REPORTS
    });


    // USER ORDERS
    Route::post('orders', [OrdersController::class, 'placeOrder']);
    Route::get('my-orders', [OrdersController::class, 'myOrders']);
    Route::get('my-order/{id}/detail', [OrdersController::class, 'orderDetail']);

    // USER CART
    Route::post('cart-items/add-multiple', [CartItemsController::class, 'addMultipleItems']);
    Route::post('cart-items/add-multiple/app', [CartItemsController::class, 'addMultipleItemsApp']);
    Route::post('cart-items/remove-multiple', [CartItemsController::class, 'removeMultipleItems']);
    Route::post('cart-items/empty', [CartItemsController::class, 'emptyCart']);
    Route::resource('cart-items', CartItemsController::class);
    Route::post('cart-to-wishlist', [CartItemsController::class, 'cartToWishlist']);

    // USER WISHLIST
    Route::post('wishlist-items/remove-multiple', [WishlistItemsController::class, 'removeMultipleItems']);
    Route::get('wishlist-items/empty', [WishlistItemsController::class, 'emptyWishlist']);
    Route::resource('wishlist-items', WishlistItemsController::class);

    // USER-STORE (CUSTOMER STORE)
    Route::prefix('/user-store')->group(function () {

        Route::get('/', [UserStoreController::class, 'show']);
        Route::get('/name/{name}', [UserStoreController::class, 'nameExist']);
        Route::get('/social/links', [UserStoreController::class, 'socialLinks']);
        Route::post('/create', [UserStoreController::class, 'store']);
        Route::post('/update', [UserStoreController::class, 'update']);

        // STORE COLLECTIONS
        Route::prefix('/collection/{collection_id}/product')->group(function () {
            Route::post('/add', [CollectionProductController::class, 'AddProduct']);
            Route::post('/remove', [CollectionProductController::class, 'RemoveProduct']);
            Route::post('/remove-many', [CollectionProductController::class, 'RemoveManyProduct']);
            Route::get('/all', [CollectionProductController::class, 'AllProduct']);
            Route::get('/most-viewed', [CollectionProductController::class, 'MostViewed']);
        });
        Route::post('/collection/remove-many', [CollectionController::class, 'deleteMany']);
        Route::resource('/collection', CollectionController::class);

        Route::prefix('/{store_code}')->group(function () {

            // Like/Follow/Share Store
            Route::get('/like-dislike', [UserStoreController::class, 'likeStore']);
            Route::get('/follow-unfollow', [UserStoreController::class, 'followStore']);
            Route::get('/share', [UserStoreController::class, 'shareStore']);

            // Like/Follow/Share Collection
            Route::get('/collection/{collection_id}/like-dislike', [CollectionController::class, 'likeCollection']);
            Route::get('/collection/{collection_id}/follow-unfollow', [CollectionController::class, 'followCollection']);
            Route::get('/collection/{collection_id}/share', [CollectionController::class, 'shareCollection']);
        });

    });


});

//delivery slots

Route::get('delivery/slots', [DeliverySlotsController::class, 'index']);


//  USER-STORE PUBLIC VIEWS
Route::prefix('/user-store')->group(function () {

    Route::get('/all', [UserStoreController::class, 'allStores']);
    Route::get('/list', [UserStoreController::class, 'listStores']);
    Route::prefix('/{store_code}')->group(function () {
        Route::get('/', [UserStoreController::class, 'getByCode']);
        Route::get('/products/most-viewed', [UserStoreController::class, 'MostViewed']);
        Route::get('/collections', [UserStoreController::class, 'StoreCollections']);
        Route::get('/slug/collections', [UserStoreController::class, 'StoreCollectionsBySlug']);
        Route::get('/collections/{collection_id}/products', [UserStoreController::class, 'CollectionsProducts']);
        Route::get('/collections/slug/{collection_id}/products', [UserStoreController::class, 'CollectionsProductsBySlugs']);
    });

});


