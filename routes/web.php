<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BrandProductController;
use App\Http\Controllers\Admin\CategoryProductController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\EventDetailController;
use App\Http\Controllers\Admin\GalleryProductController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LikeProductController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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

//----------- Front end View -------------//
Route::get('/', [HomeController::class, 'index']);

Route::get('/trang-chu', [HomeController::class, 'index']);

Route::match(['get', 'post'], '/tim-kiem', [HomeController::class, 'search']);

// Danh muc san pham
Route::get('/danh-muc-san-pham/{id}', [HomeController::class, 'show_category_home']);

// Thuong hieu san pham
Route::get('/thuong-hieu-san-pham/{id}', [HomeController::class, 'show_brand_home']);

// Chi tiet san pham
Route::get('/chi-tiet-san-pham/{id}', [HomeController::class, 'show_details_home']);

// Event san pham
Route::get('/event-san-pham/{id}', [HomeController::class, 'show_event_home']);

// Comment San pham
Route::post('comment-san-pham', [CommentController::class, 'comment_product']);

// Load more san pham
Route::post('/load-more-product', [HomeController::class, 'load_more_product']);

// --------- Admin ---------- //
Route::middleware(['AdminMiddleware'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'admin_dashboard']);

    Route::resource('category', CategoryProductController::class);
    Route::resource('brand', BrandProductController::class);
    Route::resource('product', ProductController::class);

    Route::get('add-gallery/{id}', [GalleryProductController::class, 'add_gallery']);
    Route::post('select-gallery', [GalleryProductController::class, 'select_gallery']);
    Route::post('insert-gallery/{id}', [GalleryProductController::class, 'insert_gallery']);
    Route::post('update-gallery-name', [GalleryProductController::class, 'update_gallery_name']);
    Route::post('delete-gallery', [GalleryProductController::class, 'delete_gallery']);
    Route::post('update-gallery', [GalleryProductController::class, 'update_gallery']);

    Route::post('/select-brand', [ProductController::class, 'select_brand']);
    Route::post('/select-event-detail', [ProductController::class, 'select_event_detail']);

    Route::post('/select-brand-event', [EventDetailController::class, 'select_brand_event']);

    Route::resource('coupon', CouponController::class);
    Route::resource('delivery', DeliveryController::class);
    Route::resource('event', EventController::class);
    Route::resource('event_detail', EventDetailController::class);
    Route::get('event_details/{id}', [EventDetailController::class, 'index_event_detail']);
    Route::get('create_event_details/{id}', [EventDetailController::class, 'create_event_detail']);

    // Order
    Route::get('/manage-order', [OrderController::class, 'manage_order']);
    Route::get('/view-order/{id}', [OrderController::class, 'view_order']);
    Route::delete('/delete-order/{id}', [OrderController::class, 'delete_order']);

    // Route Log Out
    Route::get('/logout', [AdminController::class, 'logout']);
});

Route::post('/select-delivery', [DeliveryController::class, 'select_delivery']);

Route::middleware(['guest'])->group(function () {
    Route::post('/dashboard', [AdminController::class, 'dashboard']);
    Route::get('admin-login', [AdminController::class, 'index']);
});

// ---------- User --------- //

// --------- Cart ---------//
Route::get('/show-cart', [CartController::class, 'show_cart']);
Route::post('/add-cart', [CartController::class, 'add_cart']);
Route::post('/update-cart', [CartController::class, 'update_cart']);
Route::delete('/delete-cart/{session_id}', [CartController::class, 'delete_cart']);

// Check Coupon
Route::post('/check-coupon', [CartController::class, 'check_coupon']);

// Check Delivery
Route::post('/check-delivery', [CartController::class, 'check_delivery']);

// ------------Checkout---------- //
Route::middleware(['guest'])->group(function () {
    Route::get('/login-checkout', [CheckoutController::class, 'login_checkout']);
    Route::post('/login-user', [CheckoutController::class, 'login_user']);
});

Route::get('/register-checkout', [CheckoutController::class, 'register_checkout']);
Route::post('/register-user', [CheckoutController::class, 'register_user']);

// Check if authentication then doing
Route::middleware(['AuthMiddleware'])->group(function () {
    // Add shipping check out cart
    Route::get('/shipping-cart', [CartController::class, 'shipping_cart']);
    Route::post('/add-shipping-cart', [CartController::class, 'add_shipping_cart']);

    // Check out
    Route::get('/checkout', [CheckoutController::class, 'checkout']);
    Route::post('/save-checkout', [CheckoutController::class, 'save_checkout']);

    // Route Log Out
    Route::get('/logout-checkout', [CheckoutController::class, 'logout_checkout']);

    // Profile
    Route::get('/profile', [UserController::class, 'profile']);
    Route::put('update-profile/{id}', [UserController::class, 'update_profile']);

    // Purchase
    Route::get('/purchase', [UserController::class, 'purchase']);

    // Like Product
    Route::post('like-product/{id}', [LikeProductController::class, 'like_product']);
    Route::delete('delete-like-product/{id}', [LikeProductController::class, 'delete_like_product']);
    Route::get('show-like-product', [LikeProductController::class, 'show_like_product']);
});


// Encoded Forward Slashes
Route::get('/{search?}', function () {
    return redirect('/');
})->where('search', '.*');
