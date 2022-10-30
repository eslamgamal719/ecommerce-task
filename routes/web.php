<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\ProductController;
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

Route::get('/test', function () {
    return view('frontend.home');
});

Auth::routes();

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/home', [HomeController::class, 'index']);

Route::get('/product-details/{product}', [ProductController::class, 'product_details'])->name('product.details');
Route::get('/shop', [ProductController::class, 'shop'])->name('product.shop');


Route::group(['middleware' => ['auth']], function() {
    Route::get('/cart',         [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart',        [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/delete', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::get('/checkout',     [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout',    [CheckoutController::class, 'place_order'])->name('place.order');

});
