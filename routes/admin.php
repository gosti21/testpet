<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CoverController;
use App\Http\Controllers\Admin\DriverController;
use App\Http\Controllers\Admin\FamilyController;
use App\Http\Controllers\Admin\OptionController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ShipmentController;
use App\Http\Controllers\Admin\SubcategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.dashboard');
})
    ->name('dashboard');
/*->middleware('can:access dashboard')*/
Route::get('/options', [OptionController::class, 'index'])->name('options.index');

Route::resource('families', controller: FamilyController::class);
Route::resource('categories', controller: CategoryController::class);
Route::resource('subcategories', controller: SubcategoryController::class);
Route::resource('products', controller: ProductController::class);
Route::resource('covers', CoverController::class);

Route::get('products/{product}/variants/{variant}', [ProductController::class, 'variants'])
    ->name('products.variants')
    ->scopeBindings();


Route::put('products/{product}/variants/{variant}', [ProductController::class, 'variantsUpdate'])
    ->name('products.variantsUpdate')
    ->scopeBindings();

Route::resource('covers', CoverController::class);

Route::resource('drivers', DriverController::class);

Route::get('shipments', [ShipmentController::class, 'index'])
    ->name('shipments.index');

Route::get('orders', [OrderController::class, 'index'])
    ->name('orders.index');
