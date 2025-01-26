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
Route::get('tshirt-designer', [App\Http\Controllers\Frontend\TshirtDesignerController::class, 'index'])->name('custom-design.index');




Route::prefix('admin')->name('admin.')->group(function () {

    // login
    Route::get('/login', [App\Http\Controllers\Backend\Auth\LoginController::class, 'login'])->name('login');

    Route::middleware(['web', 'admin'])->group(function () {
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


        // tshirt category
        Route::get('/tshirt-categories', [App\Http\Controllers\Backend\Tshirt\CategoryController::class, 'index'])->name('tshirt.category.index');

        // design
        Route::get('/designs', [App\Http\Controllers\Backend\Tshirt\DesignController::class, 'index'])->name('design.index');

        // tshirt
        Route::get('/tshirts', [App\Http\Controllers\Backend\Tshirt\TshirtController::class, 'index'])->name('tshirt.index');
    });
});
