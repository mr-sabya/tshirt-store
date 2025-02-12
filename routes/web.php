<?php

use Illuminate\Support\Facades\App;
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

Route::get('/', [\App\Http\Controllers\Frontend\HomeController::class, 'index'])->name('home');
Route::get('tshirt-designer', [\App\Http\Controllers\Frontend\TshirtDesignerController::class, 'index'])->name('custom-design.index');

Route::get('shop', [\App\Http\Controllers\Frontend\ShopController::class, 'index'])->name('shop.index');

Route::get('categories', [\App\Http\Controllers\Frontend\CategoryController::class, 'index'])->name('category.index');

Route::get('offers', [\App\Http\Controllers\Frontend\OfferController::class, 'index'])->name('offer.index');

Route::get('product/{slug}', [\App\Http\Controllers\Frontend\ProductController::class, 'show'])->name('product.show');

Route::get('login', [\App\Http\Controllers\Frontend\Auth\LoginController::class, 'index'])->name('login');

Route::get('register', [\App\Http\Controllers\Frontend\Auth\RegisterController::class, 'index'])->name('register');


// pages
Route::get('about-us', [\App\Http\Controllers\Frontend\PageController::class, 'aboutPage'])->name('page.about');

Route::get('contact-us', [\App\Http\Controllers\Frontend\PageController::class, 'contactPage'])->name('page.contact');

Route::get('faq', [\App\Http\Controllers\Frontend\PageController::class, 'faqPage'])->name('page.faq');

Route::get('terms-conditions', [\App\Http\Controllers\Frontend\PageController::class, 'termsPage'])->name('page.terms');

Route::get('privacy-policy', [\App\Http\Controllers\Frontend\PageController::class, 'privacyPage'])->name('page.privacy');

Route::get('reund-policy', [\App\Http\Controllers\Frontend\PageController::class, 'refundPage'])->name('page.refund');


Route::middleware(['web'])->group(function () {
    Route::get('profile', [\App\Http\Controllers\Frontend\User\ProfileController::class, 'index'])->name('user.profile');

    // history
    Route::get('history', [\App\Http\Controllers\Frontend\User\HistoryController::class, 'index'])->name('history.index');
    
    Route::get('history', [\App\Http\Controllers\Frontend\User\HistoryController::class, 'index'])->name('history.index');

    // cart
    Route::get('cart', [\App\Http\Controllers\Frontend\CartController::class, 'index'])->name('user.cart');

    // checkout
    Route::get('checkout', [\App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('user.checkout');

    // order confirmation
    Route::get('order/confirmation/{orderId}', [\App\Http\Controllers\Frontend\OrderConfirmationController::class, 'show'])->name('order.confirmation');

    Route::get('order/track/{orderId}', [\App\Http\Controllers\Frontend\User\OrderController::class, 'track'])->name('order.track');
});



Route::prefix('admin')->name('admin.')->group(function () {

    // login
    Route::get('/login', [\App\Http\Controllers\Backend\Auth\LoginController::class, 'login'])->name('login');

    Route::middleware(['web', 'admin'])->group(function () {
        Route::get('/', [\App\Http\Controllers\Backend\HomeController::class, 'index'])->name('home');

        // category
        Route::get('/categories', [\App\Http\Controllers\Backend\CategoryController::class, 'index'])->name('category.index');

        // size
        Route::get('/sizes', [\App\Http\Controllers\Backend\SizeController::class, 'index'])->name('size.index');

        // color
        Route::get('/colors', [\App\Http\Controllers\Backend\ColorController::class, 'index'])->name('color.index');


        // product
        Route::get('/products', [\App\Http\Controllers\Backend\ProductController::class, 'index'])->name('product.index');
        Route::get('/products/create', [\App\Http\Controllers\Backend\ProductController::class, 'create'])->name('product.create');
        Route::get('/products/{id}/edit', [\App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('product.edit');


        // tshirt category
        Route::get('/tshirt-categories', [\App\Http\Controllers\Backend\Tshirt\CategoryController::class, 'index'])->name('tshirt.category.index');

        // design
        Route::get('/designs', [\App\Http\Controllers\Backend\Tshirt\DesignController::class, 'index'])->name('design.index');

        // tshirt
        Route::get('/tshirts', [\App\Http\Controllers\Backend\Tshirt\TshirtController::class, 'index'])->name('tshirt.index');

        // banners
        Route::get('/banners', [\App\Http\Controllers\Backend\BannerController::class, 'index'])->name('banner.index');

        // orders
        Route::get('/orders', [\App\Http\Controllers\Backend\OrderController::class, 'index'])->name('order.index');
        Route::get('/orders/{orderId}', [\App\Http\Controllers\Backend\OrderController::class, 'show'])->name('order.show');

        // suppliers
        Route::get('/suppliers', [\App\Http\Controllers\Backend\SupplierController::class, 'index'])->name('supplier.index');

        // expense category
        Route::get('/expense-categories', [\App\Http\Controllers\Backend\ExpenseCategoryController::class, 'index'])->name('expense.category.index');

        // expenses
        Route::get('/expenses', [\App\Http\Controllers\Backend\ExpenseController::class, 'index'])->name('expense.index');

        // leads
        Route::get('/leads', [\App\Http\Controllers\Backend\LeadController::class, 'index'])->name('lead.index');
    });
});
