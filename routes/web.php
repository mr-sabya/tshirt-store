<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');


Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('home');

    // category
    Route::get('/categories', [App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('category.index');

    // size
    Route::get('/sizes', [App\Http\Controllers\Backend\SizeController::class, 'index'])->name('size.index');

    // color
    Route::get('/colors', [App\Http\Controllers\Backend\ColorController::class, 'index'])->name('color.index');


    // product
    Route::get('/products', [App\Http\Controllers\Backend\ProductController::class, 'index'])->name('product.index');
    Route::get('/products/create', [App\Http\Controllers\Backend\ProductController::class, 'create'])->name('product.create');
    Route::get('/products/{id}/edit', [App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('product.edit');
});
