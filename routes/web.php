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

Route::get('refund-policy', [\App\Http\Controllers\Frontend\PageController::class, 'refundPage'])->name('page.refund');

// checkout
Route::get('checkout/guest', [\App\Http\Controllers\Frontend\CheckoutController::class, 'guestCheckout'])->name('guest.checkout');

// order confirmation
Route::get('order/confirmation/{orderId}/guest', [\App\Http\Controllers\Frontend\OrderConfirmationController::class, 'show'])->name('guest.order.confirmation');

// compare
Route::get('compare', [\App\Http\Controllers\Frontend\CompareController::class, 'index'])->name('compare.index');

// blog
Route::get('blog', [\App\Http\Controllers\Frontend\BlogController::class, 'index'])->name('blog.index');
Route::get('blog/{slug}', [\App\Http\Controllers\Frontend\BlogController::class, 'show'])->name('blog.show');


// custom order
Route::get('custom-order/{name}', [\App\Http\Controllers\Frontend\CustomOrderController::class, 'index'])->name('custom-order.index');


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('profile', [\App\Http\Controllers\Frontend\User\ProfileController::class, 'index'])->name('user.profile');

    // history
    Route::get('history', [\App\Http\Controllers\Frontend\User\HistoryController::class, 'index'])->name('history.index');

    Route::get('history', [\App\Http\Controllers\Frontend\User\HistoryController::class, 'index'])->name('history.index');

    // cart
    Route::get('cart', [\App\Http\Controllers\Frontend\CartController::class, 'index'])->name('user.cart');


    // wishlist
    Route::get('wishlist', [\App\Http\Controllers\Frontend\WishlistController::class, 'index'])->name('user.wishlist');


    // checkout
    Route::get('checkout', [\App\Http\Controllers\Frontend\CheckoutController::class, 'index'])->name('user.checkout');

    // order confirmation
    Route::get('order/confirmation/{orderId}', [\App\Http\Controllers\Frontend\OrderConfirmationController::class, 'show'])->name('order.confirmation');

    Route::get('order/track/{orderId}', [\App\Http\Controllers\Frontend\User\OrderController::class, 'track'])->name('order.track');

    // desgin
    Route::get('designs', [\App\Http\Controllers\Frontend\User\DesignController::class, 'index'])->name('user.design.index');
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

        // design category
        Route::get('/design-categories', [\App\Http\Controllers\Backend\Tshirt\DesignCategoryController::class, 'index'])->name('design-category.index');

        // tshirt
        Route::get('/tshirts', [\App\Http\Controllers\Backend\Tshirt\TshirtController::class, 'index'])->name('tshirt.index');

        // banners
        Route::get('/banners', [\App\Http\Controllers\Backend\BannerController::class, 'index'])->name('banner.index');

        // image banners
        Route::get('/image-banners', [\App\Http\Controllers\Backend\BannerController::class, 'imageBanner'])->name('banner.image-banner');

        // orders
        Route::get('/orders', [\App\Http\Controllers\Backend\OrderController::class, 'index'])->name('order.index');
        Route::get('/orders/{orderId}', [\App\Http\Controllers\Backend\OrderController::class, 'show'])->name('order.show');

        // shipping label
        Route::get('/shipping-label/{orderId}', [\App\Http\Controllers\Backend\ShippingLabelController::class, 'generateLabel'])->name('shipping.label');

        // suppliers
        Route::get('/suppliers', [\App\Http\Controllers\Backend\SupplierController::class, 'index'])->name('supplier.index');

        // expense category
        Route::get('/expense-categories', [\App\Http\Controllers\Backend\ExpenseCategoryController::class, 'index'])->name('expense.category.index');

        // expenses
        Route::get('/expenses', [\App\Http\Controllers\Backend\ExpenseController::class, 'index'])->name('expense.index');

        // leads
        Route::get('/leads', [\App\Http\Controllers\Backend\LeadController::class, 'index'])->name('lead.index');

        // call history
        Route::get('/call-history/{leadId}', [\App\Http\Controllers\Backend\CallHistoryController::class, 'index'])->name('call-history.index');

        // purchase orders
        Route::get('/purchase-orders', [\App\Http\Controllers\Backend\PurchaseController::class, 'index'])->name('purchase.index');

        // notifications
        Route::get('/notifications/{id}', [\App\Http\Controllers\Backend\NotificationController::class, 'show'])->name('notification.show');

        // users
        Route::get('/users', [\App\Http\Controllers\Backend\UserController::class, 'index'])->name('user.index');
        Route::get('/users/{userId}', [\App\Http\Controllers\Backend\UserController::class, 'show'])->name('user.show');

        // barcodes
        Route::get('/barcodes', [\App\Http\Controllers\Backend\BarCodeController::class, 'index'])->name('barcode.index');

        // services
        Route::get('/services', [\App\Http\Controllers\Backend\ServiceController::class, 'index'])->name('service.index');

        // faq
        Route::get('/faq', [\App\Http\Controllers\Backend\FaqController::class, 'index'])->name('faq.index');

        // pages
        Route::get('/pages', [\App\Http\Controllers\Backend\PageController::class, 'index'])->name('page.index');
        //edit page
        Route::get('/pages/{id}/edit', [\App\Http\Controllers\Backend\PageController::class, 'edit'])->name('page.edit');


        // setting
        Route::get('/settings', [\App\Http\Controllers\Backend\SettingController::class, 'index'])->name('setting.index');

        // payment methods
        Route::get('/payment-methods', [\App\Http\Controllers\Backend\PaymentMethodController::class, 'index'])->name('payment-method.index');

        // delivery charges
        Route::get('/delivery-charges', [\App\Http\Controllers\Backend\DeliveryChargeController::class, 'index'])->name('delivery-charge.index');

        // hot offers
        Route::get('/hot-offers', [\App\Http\Controllers\Backend\HotOfferController::class, 'index'])->name('hot-offer.index');

        // testimonials
        Route::get('/testimonials', [\App\Http\Controllers\Backend\TestimonialController::class, 'index'])->name('testimonials.index');

        // site map
        Route::get('/generate-sitemap', [\App\Http\Controllers\Backend\SitemapController::class, 'index'])->name('sitemap.index');

        // promotion
        Route::get('/promotion', [\App\Http\Controllers\Backend\PromotionController::class, 'index'])->name('promotion.index');

        // blog
        Route::get('/blog', [\App\Http\Controllers\Backend\BlogController::class, 'index'])->name('blog.index');
        Route::get('/blog/create', [\App\Http\Controllers\Backend\BlogController::class, 'create'])->name('blog.create');
        Route::get('/blog/{id}/edit', [\App\Http\Controllers\Backend\BlogController::class, 'edit'])->name('blog.edit');

        // comments 
        Route::get('blog/comments/{id}', [\App\Http\Controllers\Backend\BlogController::class, 'comments'])->name('blog.comments');

        // customization categories
        Route::get('/customization-categories', [\App\Http\Controllers\Backend\CustomizationCategoryController::class, 'index'])->name('customization-category.index');
    });
});
