<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\BrandController;
use App\Http\Controllers\Dashboard\ProductController;
use App\Http\Controllers\Dashboard\OrderController;

Route::get('/test2', function () {
    return view('dashboard.users.index');
});


Route::group(['middleware' => ['auth', 'admin'], 'as' => 'admin.', 'prefix' => 'admin'], function() {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('brands', BrandController::class);
    Route::resource('products', ProductController::class);
    Route::resource('orders', OrderController::class);
});
