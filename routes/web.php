<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CouponController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\PublisherController;
use App\Http\Controllers\Admin\TaxController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\HomeBannerController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductReviewController;

use App\Http\Controllers\Front\HomeController;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');
Route::get('/redirect', [HomeController::class, 'redirect']);

Route::get('/', [HomeController::class, 'index']);
Route::get('/user_info', [HomeController::class, 'user_info']);
Route::get('product/{id}', [HomeController::class, 'product']);
Route::get('category/{id}', [HomeController::class, 'category']);
Route::post('add_to_cart', [HomeController::class, 'add_to_cart']);
Route::get('cart', [HomeController::class, 'cart']);
Route::get('search/{str}', [HomeController::class, 'search']);
Route::get('/checkout', [HomeController::class, 'checkout']);
Route::post('apply_coupon_code', [HomeController::class, 'apply_coupon_code']);
Route::post('remove_coupon_code', [HomeController::class, 'remove_coupon_code']);
Route::post('place_order', [HomeController::class, 'place_order']);
Route::get('/order_placed', [HomeController::class, 'order_placed']);
Route::post('product_review_process', [HomeController::class, 'product_review_process']);

Route::group(['middleware' => 'user_auth'], function () {
    Route::get('/order', [HomeController::class, 'order']);
    Route::get('/order_detail/{id}', [HomeController::class, 'order_detail']);
});

Route::group(['middleware' => 'admin_auth'], function () {
    Route::get('admin/info', [HomeController::class, 'info']);

    Route::get('admin/category', [CategoryController::class, 'index']);
    Route::get('admin/category/manage_category', [CategoryController::class, 'manage_category']);
    Route::get('admin/category/manage_category/{id}', [CategoryController::class, 'manage_category']);
    Route::post('admin/category/manage_category_process', [CategoryController::class, 'manage_category_process'])->name('category.manage_category_process');
    Route::get('admin/category/delete/{id}', [CategoryController::class, 'delete']);
    Route::get('admin/category/status/{status}/{id}', [CategoryController::class, 'status']);

    Route::get('admin/coupon', [CouponController::class, 'index']);
    Route::get('admin/coupon/manage_coupon', [CouponController::class, 'manage_coupon']);
    Route::get('admin/coupon/manage_coupon/{id}', [CouponController::class, 'manage_coupon']);
    Route::post('admin/coupon/manage_coupon_process', [CouponController::class, 'manage_coupon_process'])->name('coupon.manage_coupon_process');
    Route::get('admin/coupon/delete/{id}', [CouponController::class, 'delete']);
    Route::get('admin/coupon/status/{status}/{id}', [CouponController::class, 'status']);

    Route::get('admin/cover', [coverController::class, 'index']);
    Route::get('admin/cover/manage_cover', [coverController::class, 'manage_cover']);
    Route::get('admin/cover/manage_cover/{id}', [coverController::class, 'manage_cover']);
    Route::post('admin/cover/manage_cover_process', [coverController::class, 'manage_cover_process'])->name('cover.manage_cover_process');
    Route::get('admin/cover/delete/{id}', [coverController::class, 'delete']);
    Route::get('admin/cover/status/{status}/{id}', [coverController::class, 'status']);

    Route::get('admin/product', [ProductController::class, 'index']);
    Route::get('admin/product/manage_product', [ProductController::class, 'manage_product']);
    Route::get('admin/product/manage_product/{id}', [ProductController::class, 'manage_product']);
    Route::post('admin/product/manage_product_process', [ProductController::class, 'manage_product_process'])->name('product.manage_product_process');
    Route::get('admin/product/delete/{id}', [ProductController::class, 'delete']);
    Route::get('admin/product/status/{status}/{id}', [ProductController::class, 'status']);
    Route::get('admin/product/product_attr_delete/{paid}/{pid}', [ProductController::class, 'product_attr_delete']);
    Route::get('admin/product/product_images_delete/{paid}/{pid}', [ProductController::class, 'product_images_delete']);

    Route::get('admin/publisher', [PublisherController::class, 'index']);
    Route::get('admin/publisher/manage_publisher', [PublisherController::class, 'manage_publisher']);
    Route::get('admin/publisher/manage_publisher/{id}', [PublisherController::class, 'manage_publisher']);
    Route::post('admin/publisher/manage_publisher_process', [PublisherController::class, 'manage_publisher_process'])->name('publisher.manage_publisher_process');
    Route::get('admin/publisher/delete/{id}', [PublisherController::class, 'delete']);
    Route::get('admin/publisher/status/{status}/{id}', [PublisherController::class, 'status']);

    Route::get('admin/tax', [TaxController::class, 'index']);
    Route::get('admin/tax/manage_tax', [TaxController::class, 'manage_tax']);
    Route::get('admin/tax/manage_tax/{id}', [TaxController::class, 'manage_tax']);
    Route::post('admin/tax/manage_tax_process', [TaxController::class, 'manage_tax_process'])->name('tax.manage_tax_process');
    Route::get('admin/tax/delete/{id}', [TaxController::class, 'delete']);
    Route::get('admin/tax/status/{status}/{id}', [TaxController::class, 'status']);

    Route::get('admin/user', [UserController::class, 'index']);
    Route::get('admin/user/show/{id}', [UserController::class, 'show']);
    Route::get('admin/user/status/{status}/{id}', [UserController::class, 'status']);

    Route::get('admin/home_banner', [HomeBannerController::class, 'index']);
    Route::get('admin/home_banner/manage_home_banner', [HomeBannerController::class, 'manage_home_banner']);
    Route::get('admin/home_banner/manage_home_banner/{id}', [HomeBannerController::class, 'manage_home_banner']);
    Route::post('admin/home_banner/manage_home_banner_process', [HomeBannerController::class, 'manage_home_banner_process'])->name('home_banner.manage_home_banner_process');
    Route::get('admin/home_banner/delete/{id}', [HomeBannerController::class, 'delete']);
    Route::get('admin/home_banner/status/{status}/{id}', [HomeBannerController::class, 'status']);

    Route::get('admin/order', [OrderController::class, 'index']);
    Route::get('admin/order_detail/{id}', [OrderController::class, 'order_detail']);
    Route::post('admin/order_detail/{id}', [OrderController::class, 'update_track_detail']);
    Route::get('admin/update_payment_status/{status}/{id}', [OrderController::class, 'update_payment_status']);
    Route::get('admin/update_order_status/{status}/{id}', [OrderController::class, 'update_order_status']);

    Route::get('admin/product_review', [ProductReviewController::class, 'index']);
    Route::get('admin/update_product_review_status/{status}/{id}', [ProductReviewController::class, 'update_product_review_status']);
});
