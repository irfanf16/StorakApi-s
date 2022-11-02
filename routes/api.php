<?php


use App\Http\Controllers\User\SubscriberController;

use Illuminate\Support\Facades\Route;

// JWT CONTROLLER
use App\Http\Controllers\JwtAuthController;

// OTP CONTROLLER
use App\Http\Controllers\OtpController;

// ACTIVITY CONTROLLER
use App\Http\Controllers\ActivityController;


//  ADMIN CONTROLLERS

use App\Http\Controllers\SearchController;


// VENDOR CONTROLLERS
use App\Http\Controllers\Vendor\VendorAccountVerificationsController;
use App\Http\Controllers\Vendor\VendorCustomMessageController;

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
Route::group([], function () {

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
    Route::post('subscribe', [SubscriberController::class, 'subscribe']);
    Route::post('contact/us', [SubscriberController::class, 'constantUs']);
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
    Route::get('featured/child/categories', [WebNavbarsController::class, 'featuredChildCategories']);
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
    Route::post('order/cancel', [OrdersController::class, 'orderCancel']);
    Route::post('order/package/cancel', [OrdersController::class, 'orderPackageCancel']);

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


//  product apis for data update local to live

Route::get('product-lists', [\App\Http\Controllers\DataManagementController::class, 'productsList']);
Route::get('product-detail-images', [\App\Http\Controllers\DataManagementController::class, 'productsDetailImages']);


