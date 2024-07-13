<?php

use App\Http\Controllers\Frontend\WishlistController;
use App\Http\Controllers\Frontend\AccountController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\WebsiteController;
use App\Http\Controllers\Frontend\ElectricianController;
use App\Http\Controllers\Frontend\RegisterController;
use App\Http\Controllers\Backend\Partner\PartnerController;
use Illuminate\Support\Facades\Route;

// ---------------------------------------------------------------
// <<-===================== WEB ROUTE LIST ==================->>
// ---------------------------------------------------------------

Route::get('/', [WebsiteController::class, 'home'])->name('web.home');
Route::POST('/search', [WebsiteController::class, 'search'])->name('web.search');
Route::get('/category', [WebsiteController::class, 'allCategories'])->name('web.all.category');
Route::get('/category/{url}', [WebsiteController::class, 'singleCategory'])->name('web.single.category');
// Brand Route
Route::get('/brand/{url}', [WebsiteController::class, 'brandProducts'])->name('web.brand.products');
// Tag Route
Route::get('/tag/{url}', [WebsiteController::class, 'tagProducts'])->name('web.tag.products');
// SPECIAL OFFER ROUTE
Route::get('/offer', [WebsiteController::class, 'specialOffer'])->name('web.offer.all');
// Dynamic Page View
Route::get('/page/{page_url}', [WebsiteController::class, 'page'])->name('web.page.single');
// Subscriber User Store
Route::post('/subscriber', [WebsiteController::class, 'subscriber'])->name('web.subscriber.store');

Route::get('/contact-us', [WebsiteController::class, 'contactUs'])->name('web.contact.form');
Route::post('/contact-us', [WebsiteController::class, 'contactStore'])->name('web.contact.store');
// Post Route Blog
Route::get('/blog', [WebsiteController::class, 'allBlog'])->name('web.blog.all');
Route::get('/blog/{url}', [WebsiteController::class, 'singleBlog'])->name('web.blog.single');
Route::get('/blog/category/{url}', [WebsiteController::class, 'categoryBlog'])->name('web.blog.category.all');

// <-- --------------- WISHLIST ROUTE LIST ---------------- -->
Route::get('/wishlist', [WishlistController::class, 'index'])->name('web.wishlist.index')->middleware('auth');
// Ajax Route
Route::post('/wishlist', [WishlistController::class, 'insert']);
Route::get('/wishlist/{id}', [WishlistController::class, 'delete'])->name('web.wishlist.delete');

// <-- --------------- ACCOUNTS ROUTE LIST ---------------- -->
Route::controller(AccountController::class)->middleware('auth')->prefix('account')->group(function () {
    // General Setting Routes
    Route::get('/', 'userAccount')->name('web.user.account');
    Route::get('/order', 'userOrder')->name('web.user.order');
    Route::get('/order/invoice/{slug}', 'userOrderPdf')->name('web.user.order.pdf');
    Route::get('/order/cancel/{slug}', 'userOrderCancel')->name('web.user.order.cancel');
    Route::get('/address', 'userAddress')->name('web.user.address');
    Route::get('/details', 'userDetails')->name('web.user.details');
    // Account Update Route
    Route::post('/address', 'userAddressdate')->name('web.user.address.update');
    Route::post('/details', 'userDetailsUpdate')->name('web.user.details.update');
    Route::post('/password/changes', 'userPasswordChange')->name('web.user.password.change');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'index')->name('web.customer.account');
    Route::post('', 'insert')->name('web.customer.account.register');
});

// <-- --------------- PRODUCT ROUTE LIST ---------------- -->
Route::controller(WebsiteController::class)->group(function () {
    Route::get('product/{product_url}', 'productView')->name('web.product.view');
});

// Route::get('cart-test', [CartController::class, 'cartTest'])->name('web.cart.test');
// TEST ROUTE
// Route::post('cart-test', [CartController::class, 'cartTest'])->name('web.cart.test');
// <-- --------------- CART ROUTE LIST ---------------- -->
Route::post('addtocart', [CartController::class, 'productAddToCart'])->name('web.product.add.to.cart');
Route::post('updatetocart', [CartController::class, 'productUpdateToCart'])->name('web.product.update.to.cart');
Route::get('remove-to-cart/{id}', [CartController::class, 'removeToCart'])->name('web.remove.to.cart');
Route::get('all-remove-to-cart', [CartController::class, 'allRemoveToCart'])->name('web.all.remove.to.cart');

// <-- --------------- AJAX CART ROUTE LIST ---------------- -->
Route::get('add-to-cart/{product_id}', [CartController::class, 'addToCart'])->name('web.add.to.cart');

// <-- --------------- CHECKOUT ROUTE LIST ---------------- -->
Route::controller(CheckoutController::class)->prefix('checkout')->group(function () {
    Route::get('cart', 'checkoutCart')->name('web.checkout.cart');
    Route::get('/details', 'checkoutDetails')->name('web.checkout.details');

    // Couron Route
    Route::post('/add-coupon', 'addCoupon')->name('web.cart.add.coupon');
    Route::get('/remove-coupon', 'removeCoupon')->name('web.cart.remove.coupon');

    // Order Route
    Route::post('/quick-order', 'quickOrder')->name('web.checkout.quick.order');
    Route::post('/ordernow', 'orderNow')->name('web.checkout.order.now');


    //Pending Work
    // Route::get('/payment', 'checkoutPayment')->name('web.checkout.payment');
    // Route::get('/review', 'checkoutReview')->name('web.checkout.review');
    // Route::get('/complect', 'checkoutComplect')->name('web.checkout.complect');
});



Route::controller(ElectricianController::class)->group(function () {
    Route::prefix('/electrician')->group(function(){
        Route::get('', 'index')->name('web.electrician.home');
        Route::get('/registration', 'registration')->name('web.electrician.registration');
        Route::post('/registration', 'insert')->name('web.electrician.insert');
        Route::get('/search','search')->name('web.electrician.search');
        // Route::get('edit/{slug}','edit');
        // Route::post('softdelete', 'softdelete');
        // Route::post('restore', 'restore');
        // Route::post('delete/test', 'delete');
        // Route::post('/store-data','store')->name('store.data');
        Route::get('/profile/{slug}', 'profile')->name('electrician.profile');
    });
});

//partner route
Route::controller(PartnerController::class)->middleware(['role:Manager'])->group(function () {
    Route::prefix('/partner/product')->group(function(){
        Route::get('', 'index')->name('backend.partner.product');
        Route::get('/profile/{slug}', 'admin_view')->name('admin.electrician.profile');
        Route::get('/category', 'category_index')->name('backend.electrician.category');
        Route::post('/category', 'category_insert')->name('backend.electrician.insert');

    });
});
















// DATABASE RESET ROUTE
//Route::get('db-reset', function () {
//    Artisan::call('migrate:fresh --seed');
//    return redirect()->route('web.home');
//});
//
//Route::get('web-down', function () {
//    Artisan::call('down --secret="khayrul"');
//    return redirect()->route('web.home');
//});
//
//Route::get('web-up', function () {
//    Artisan::call('up');
//    return redirect()->route('web.home');
//});


require __DIR__ . '/auth.php';
require __DIR__ . '/admin.php';
require __DIR__ . '/staff.php';
