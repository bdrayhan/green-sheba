<?php

use App\Http\Controllers\Backend\FeatureCategoryController;
use App\Http\Controllers\Backend\SupportMessageController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Backend\BlogCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CityController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\CourierCityController;
use App\Http\Controllers\Backend\CourierController;
use App\Http\Controllers\Backend\CourierZoneController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\InvoiceController;
use App\Http\Controllers\Backend\MediaController;
use App\Http\Controllers\Backend\MenuBarController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\OrderStatusController;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\PartnerController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\PostController;
use App\Http\Controllers\Backend\ProductCategoryController;
use App\Http\Controllers\Backend\ProductColorController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductSizeController;
use App\Http\Controllers\Backend\ProductSubCategoryController;
use App\Http\Controllers\Backend\RecycleBinController;
use App\Http\Controllers\Backend\ReportController;
use App\Http\Controllers\Backend\ReturnOrderController;
use App\Http\Controllers\Backend\ServiceAdsController;
use App\Http\Controllers\Backend\StaticBannerController;
use App\Http\Controllers\Backend\StockController;
use App\Http\Controllers\Backend\SupplierController;
use App\Http\Controllers\Backend\TagController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\Frontend\ElectricianController;
use Illuminate\Support\Facades\Route;



Route::prefix('admin')->middleware(['auth', 'role:Super Admin|Admin|Manager'])->group(function () {

    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
    Route::get('/clear-cache', [AdminController::class, 'clearCache'])->name('admin.clear.cache');
    Route::get('/optimize', [AdminController::class, 'Optimize'])->name('admin.optimize');
    Route::get('/profile', [AdminController::class, 'userProfile'])->name('admin.user.profile');

    // Sent Message Testing Route
    Route::post('/sent-message', [AdminController::class, 'sentOrderInfo'])->name('admin.sent.message');
    // <-- --------------- SETTING ROUTE LIST ---------------- -->
    Route::controller(SettingController::class)->middleware(['role:Super Admin|Admin'])->prefix('setting')->group(function () {
        // General Setting Route
        Route::get('/general', 'generalSetting')->name('admin.setting.general');
        Route::post('/general', 'settingUpdate')->name('admin.setting.general.update');
        // Thanks Note Route
        Route::get('/thanks-node', 'thanksNote')->name('admin.setting.thanks.note');
        Route::post('/thanks-node', 'thanksNoteUpdate')->name('admin.setting.thanks.note.update');
        // Social Media Setting Route
        Route::get('/social', 'socialSetting')->name('admin.setting.social');
        Route::post('/social', 'socialUpdate')->name('admin.setting.social.update');
        // Contact Info Setting Route
        Route::get('/contact-info', 'contactInfoSetting')->name('admin.contact.info');
        Route::post('/contact-info', 'contactInfoUpdate')->name('admin.contact.info.update');
        // Analytics Setting Route
        Route::get('/analytic', 'analyticSetting')->name('admin.analytic');
        Route::post('/analytic', 'analyticUpdate')->name('admin.analytic.update');

        // SMS Setting Route
        Route::get('/sms', 'smsSetting')->name('admin.sms');
        Route::post('/sms', 'smsUpdate')->name('admin.sms.update');
    });

    // <-- --------------- MENU-BAR ROUTE LIST ---------------- -->
    Route::controller(MenuBarController::class)->middleware(['role:Super Admin|Admin'])->prefix('menubar')->group(function () {
        Route::get('/', 'allMenu')->name('admin.menu.index');
        Route::post('/', 'menuStore')->name('admin.menu.store');
        Route::put('/{id}', 'menuUpdate')->name('admin.menu.update');
    });

    // <-- --------------- COUPON ROUTE LIST ---------------- --> WORKING
    Route::controller(CouponController::class)->middleware(['role:Super Admin|Admin'])->prefix('coupon')->group(function () {
        Route::get('/', 'index')->name('admin.coupon.index');
        Route::post('/', 'insert')->name('admin.coupon.insert');
        Route::put('/{slug}', 'update')->name('admin.coupon.update');
        Route::get('/{slug}', 'delete')->name('admin.coupon.delete');
        // Coupon Status Update
        Route::get('/active/{slug}', 'active')->name('admin.coupon.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.coupon.deactive');
        Route::post('/multi-delete', 'mulipleDelete')->name('admin.coupon.multi.delete');
    });

    // <-- --------------- USER ROUTE LIST ---------------- -->
    Route::controller(UserController::class)->middleware(['role:Super Admin|Admin'])->prefix('user')->group(function () {
        Route::get('/', 'index')->name('admin.user.index')->middleware('permission:user list');
        Route::post('/', 'store')->name('admin.user.store')->middleware('permission:user create');
        Route::get('/{id}/edit', 'edit')->name('admin.user.edit')->middleware('permission:user edit');
        Route::put('/{id}', 'update')->name('admin.user.update')->middleware('permission:user edit');
        Route::get('/{slug}', 'destroy')->name('admin.user.destroy')->middleware('permission:user delete');
        // User Status Update
        Route::get('/active/{slug}', 'active')->name('admin.user.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.user.deactive');
        // User Online Status Update
        Route::get('/online/active/{slug}', 'onlineActive')->name('admin.user.onilne.active');
        Route::get('/online/deactive/{slug}', 'onlineDeactive')->name('admin.user.onilne.deactive');
    });

    // <-- --------------- CUSTOMER ROUTE LIST ---------------- -->
    Route::controller(CustomerController::class)->middleware(['role:Super Admin|Admin'])->prefix('customer')->group(function () {
        Route::get('/', 'index')->name('admin.customer.index')->middleware('permission:user list');
        Route::post('/', 'store')->name('admin.customer.store')->middleware('permission:user create');
        Route::put('/{slug}', 'update')->name('admin.customer.update')->middleware('permission:user edit');
        Route::get('/{slug}', 'destroy')->name('admin.customer.destroy')->middleware('permission:user delete');
        // Customer Status Update
        Route::get('/active/{slug}', 'active')->name('admin.customer.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.customer.deactive');
        Route::post('/multi-delete', 'mulipleDelete')->name('admin.customer.multi.delete');
    });

    // <-- --------------- PERMISSION ROUTE LIST ---------------- -->
    Route::controller(PermissionController::class)->middleware(['role:Super Admin'])->prefix('permission')->group(function () {
        Route::get('/', 'index')->name('admin.permission.index');
        Route::post('/', 'store')->name('admin.permission.store');
        Route::get('/show/{id}', 'show')->name('admin.permission.show');
        Route::get('/edit/{id}', 'edit')->name('admin.permission.edit');
        Route::put('/{id}', 'update')->name('admin.permission.update');
        Route::get('/{id}', 'destroy')->name('admin.permission.destroy');
    });

    // <-- --------------- PRODUCT ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(ProductController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('product')->group(function () {
        Route::get('/', 'index')->name('admin.product.index');
        Route::get('/create', 'create')->name('admin.product.create');
        Route::post('/', 'insert')->name('admin.product.insert');
        Route::get('/edit/{slug}', 'edit')->name('admin.product.edit');
        Route::put('/{slug}', 'update')->name('admin.product.update');
        Route::get('/delete/{slug}', 'delete')->name('admin.product.delete');
        // Product Status Update
        Route::get('/status/{slug}', 'status')->name('admin.product.status');
        // Gallery Image Remove
        Route::get('/gallery/{slug}', 'galleryRemove')->name('admin.product.gallery.remove');
        Route::post('/multi-delete', 'multipleDelete')->name('admin.product.multi.delete');
    });

    // <-- --------------- PRODUCT CATEGORY ROUTE LIST ---------------- -->  COMPLECTED
    Route::controller(ProductCategoryController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('product-category')->group(function () {
        Route::get('/', 'index')->name('admin.product.category.index');
        Route::post('/', 'insert')->name('admin.product.category.store');
        Route::get('/edit/{slug}', 'edit')->name('admin.product.category.edit');
        Route::put('/{slug}', 'update')->name('admin.product.category.update');
        Route::get('/delete/{slug}', 'delete')->name('admin.product.category.delete');
        // Category Status Update
        Route::get('/status/{slug}', 'status')->name('admin.product.category.status');
        // Category Feature Update
        Route::get('/feature/{slug}', 'featureStatus')->name('admin.product.category.feature');

        Route::post('/multi-delete', 'mulipleDelete')->name('admin.category.multi.delete');

//        Import Export Route
        Route::get('/import', 'import')->name('admin.product.category.import');
        Route::post('/import', 'importStore')->name('admin.product.category.import.store');
        Route::get('/export', 'export')->name('admin.product.category.export');

    });

    // <-- --------------- FEATURE CATEGORY ROUTE LIST ---------------- -->
    Route::controller(FeatureCategoryController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('feature-category')->group(function () {
        Route::get('/', 'index')->name('admin.feature.category.index');
        Route::post('/', 'store')->name('admin.feature.category.store');
        Route::get('/edit/{id}', 'edit')->name('admin.feature.category.edit');
        Route::put('/{id}', 'update')->name('admin.feature.category.update');
        Route::get('/delete/{id}', 'destroy')->name('admin.feature.category.destroy');
        Route::get('/status/{id}', 'status')->name('admin.feature.category.status');
    });

    // <-- --------------- PRODUCT SUB-CATEGORY ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(ProductSubCategoryController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('product-subCategory')->group(function () {
        Route::get('/', 'index')->name('admin.product.sub-category.index');
        Route::post('/', 'insert')->name('admin.product.sub-category.insert');
        Route::put('/{slug}', 'update')->name('admin.product.sub-category.update');
        Route::get('/soft-delete/{slug}', 'softdelete')->name('admin.product.sub-category.softdelete');
        Route::get('restore/{slug}', 'restore')->name('admin.product.sub-category.restore');
        Route::get('/delete/{slug}', 'delete')->name('admin.product.sub-category.delete');
        // Sub Category Status Update
        Route::get('/active/{slug}', 'active')->name('admin.product.sub-category.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.product.sub-category.deactive');
    });

    // <-- --------------- PRODUCT COLOR ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(ProductColorController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('product-color')->group(function () {
        Route::get('/', 'index')->name('admin.product.color.index');
        Route::post('/', 'insert')->name('admin.product.color.insert');
        Route::put('/{slug}', 'update')->name('admin.product.color.update');
        Route::get('/soft-delete/{slug}', 'softdelete')->name('admin.product.color.softdelete');
        Route::get('/restore/{slug}', 'restore')->name('admin.product.color.restore');
        Route::get('/delete/{slug}', 'delete')->name('admin.product.color.delete');
        // Color Status Update
        Route::get('/active/{slug}', 'active')->name('admin.product.color.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.product.color.deactive');

        Route::post('/multi-delete', 'mulipleDelete')->name('admin.color.multi.delete');
    });

    // <-- --------------- PRODUCT SIZE ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(ProductSizeController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('product-size')->group(function () {
        Route::get('/', 'index')->name('admin.product.size.index');
        Route::post('/', 'insert')->name('admin.product.size.insert');
        Route::put('/{slug}', 'update')->name('admin.product.size.update');
        Route::get('/soft-delete/{slug}', 'softdelete')->name('admin.product.size.softdelete');
        Route::get('/restore/{slug}', 'restore')->name('admin.product.size.restore');
        Route::get('/delete/{slug}', 'delete')->name('admin.product.size.delete');
        // Color Status Update
        Route::get('/active/{slug}', 'active')->name('admin.product.size.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.product.size.deactive');
        Route::post('/multi-delete', 'mulipleDelete')->name('admin.size.multi.delete');
    });

    // <-- --------------- BRAND ROUTE LIST ---------------- -->  COMPLECTED
    Route::controller(BrandController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('brand')->group(function () {
        Route::get('/', 'index')->name('admin.brand.index');
        Route::post('/', 'insert')->name('admin.brand.insert');
        Route::put('/{slug}', 'update')->name('admin.brand.update');
        Route::get('/soft-delete/{slug}', 'softdelete')->name('admin.brand.softdelete');
        Route::get('/restore/{slug}', 'restore')->name('admin.brand.restore');
        Route::get('/delete/{slug}', 'delete')->name('admin.brand.delete');
        // Brand Status Update
        Route::get('/active/{slug}', 'active')->name('admin.brand.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.brand.deactive');
        Route::post('/multi-delete', 'mulipleDelete')->name('admin.brand.multi.delete');
    });

    // <-- --------------- BANNER ROUTE LIST ---------------- -->
    Route::controller(BannerController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('banner')->group(function () {
        Route::get('/', 'index')->name('admin.banner.index');
        Route::post('/', 'store')->name('admin.banner.store');
        Route::put('/{slug}', 'update')->name('admin.banner.update');
        Route::get('/{slug}', 'destroy')->name('admin.banner.destroy');
        // Banner Status Update
        Route::get('/active/{slug}', 'active')->name('admin.banner.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.banner.deactive');

        Route::post('/multi-delete', 'mulipleDelete')->name('admin.banner.multi.delete');
    });

    // <-- --------------- PARTNER ROUTE LIST ---------------- -->
    Route::controller(PartnerController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('partner')->group(function () {
        //request partner
        Route::get('/request', 'request_partner')->name('admin.partner.request');
        Route::get('/request/profile/{slug}', 'request_profile')->name('admin.partner.request.profile');
        Route::get('/request/profile/edit/{slug}', 'request_edit')->name('admin.partner.request.edit');
        Route::get('/', 'index')->name('admin.partner.all');
        Route::get('/profile/{slug}', 'profile')->name('admin.partner.profile');
        Route::get('/edit/{slug}', 'edit')->name('admin.partner.edit');
        Route::post('/', 'store')->name('admin.partner.store');
        Route::put('/{slug}', 'update')->name('admin.partner.update');
        Route::get('/{slug}', 'destroy')->name('admin.partner.destroy');
        // Partner Status Update
        Route::get('/active/{slug}', 'active')->name('admin.partner.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.partner.deactive');
        Route::post('/multi-delete', 'mulipleDelete')->name('admin.partner.multi.delete');
    });

    // <-- --------------- CITY ROUTE LIST ---------------- -->
    Route::controller(CityController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('city')->group(function () {
        Route::get('/', 'index')->name('admin.city.index');
        Route::post('/', 'insert')->name('admin.city.insert');
        Route::put('/{slug}', 'update')->name('admin.city.update');
        Route::get('/soft-delete{slug}', 'softdelete')->name('admin.city.soft.delete');
        Route::get('restore/{slug}', 'restore')->name('admin.city.restore');
        Route::get('/{slug}', 'delete')->name('admin.city.delete');
        // City Status Update
        Route::get('/active/{slug}', 'active')->name('admin.city.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.city.deactive');

        Route::post('/multi-delete', 'mulipleDelete')->name('admin.city.multi.delete');
    });

    // <-- --------------- COURIER ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(CourierController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('courier')->group(function () {
        Route::get('/', 'index')->name('admin.courier.index');
        Route::post('/', 'insert')->name('admin.courier.insert');
        Route::put('/{slug}', 'update')->name('admin.courier.update');
        Route::get('/{slug}', 'delete')->name('admin.courier.delete');
        Route::get('/soft-delete/{slug}', 'softdelete')->name('admin.courier.soft.delete');
        Route::get('restore/{slug}', 'restore')->name('admin.courier.restore');
        // Courier Status Update
        Route::get('/active/{slug}', 'active')->name('admin.courier.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.courier.deactive');
    });

    // <-- --------------- COURIER CITY ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(CourierCityController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('courier-city')->group(function () {
        Route::get('/', 'index')->name('admin.courier.city.index');
        Route::post('/', 'insert')->name('admin.courier.city.insert');
        Route::put('/{slug}', 'update')->name('admin.courier.city.update');
        Route::get('/soft-delete/{slug}', 'softdelete')->name('admin.courier.city.soft.delete');
        Route::get('restore/{slug}', 'restore')->name('admin.courier.city.restore');
        Route::get('/delete/{slug}', 'delete')->name('admin.courier.city.delete');
        // Courier City Status Update
        Route::get('/active/{slug}', 'active')->name('admin.courier.city.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.courier.city.deactive');
    });

    // <-- --------------- COURIER ZONE ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(CourierZoneController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('courier-zone')->group(function () {
        Route::get('/', 'index')->name('admin.courier.zone.index');
        Route::post('/', 'insert')->name('admin.courier.zone.insert');
        Route::put('/{slug}', 'update')->name('admin.courier.zone.update');
        Route::get('/soft-delete/{slug}', 'softdelete')->name('admin.courier.zone.soft.delete');
        Route::get('restore/{slug}', 'restore')->name('admin.courier.zone.restore');
        Route::get('/delete/{slug}', 'delete')->name('admin.courier.zone.delete');
        // Courier Zone Status Update
        Route::get('/active/{slug}', 'active')->name('admin.courier.zone.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.courier.zone.deactive');
        // GET CITY AJAX ROUTE
        Route::get('/get-city/{id}', 'getCity')->name('admin.courier.city.get');
    });

    // <-- --------------- PAGE ROUTE LIST ---------------- -->
    Route::controller(PageController::class)->prefix('page')->middleware(['role:Super Admin|Admin|Manager'])->group(function () {
        Route::get('/', 'index')->name('admin.page.index');
        Route::post('/', 'store')->name('admin.page.store');
        Route::get('/edit/{slug}', 'edit')->name('admin.page.edit');
        Route::put('/{slug}', 'update')->name('admin.page.update');
        Route::get('/{slug}', 'destroy')->name('admin.page.destroy');
        // Page Status Update
        Route::get('/active/{slug}', 'active')->name('admin.page.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.page.deactive');
    });

    // <-- --------------- BLOG CATEGORY ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(BlogCategoryController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('blog-category')->group(function () {
        Route::get('/', 'index')->name('admin.blog.category.index');
        Route::post('/', 'store')->name('admin.blog.category.store');
        Route::put('/{slug}', 'update')->name('admin.blog.category.update');
        Route::get('/soft-delete/{slug}', 'softdelete')->name('admin.blog.category.soft.delete');
        Route::get('restore/{slug}', 'restore')->name('admin.blog.category.restore');
        Route::get('/delete/{slug}', 'delete')->name('admin.blog.category.delete');
        // Blog Category Status Update
        Route::get('/active/{slug}', 'active')->name('admin.blog.category.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.blog.category.deactive');

        Route::post('/multi-delete', 'mulipleDelete')->name('admin.blog.category.multi.delete');
    });

    // <-- --------------- BLOG ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(PostController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('blog')->group(function () {
        Route::get('/', 'index')->name('admin.blog.index');
        Route::post('/', 'insert')->name('admin.blog.insert');
        Route::get('/edit/{slug}', 'edit')->name('admin.blog.edit');
        Route::put('/{slug}', 'update')->name('admin.blog.update');
        Route::get('/soft-delete/{slug}', 'softdelete')->name('admin.blog.soft.delete');
        Route::get('restore/{slug}', 'restore')->name('admin.blog.restore');
        Route::get('/{slug}', 'delete')->name('admin.blog.delete');
        // Blog Status Update
        Route::get('/active/{slug}', 'active')->name('admin.blog.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.blog.deactive');

        Route::post('/multi-delete', 'mulipleDelete')->name('admin.blog.multi.delete');
    });

    // <-- --------------- TAG ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(TagController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('tag')->group(function () {
        Route::get('/', 'index')->name('admin.tag.index');
        Route::post('/', 'insert')->name('admin.tag.insert');
        Route::get('/edit/{slug}', 'edit')->name('admin.tag.edit');
        Route::put('/{slug}', 'update')->name('admin.tag.update');
        Route::get('/soft-delete/{slug}', 'softdelete')->name('admin.tag.soft.delete');
        Route::get('restore/{slug}', 'restore')->name('admin.tag.restore');
        Route::get('/{slug}', 'delete')->name('admin.tag.delete');
        // Tag Status Update
        Route::get('/active/{slug}', 'active')->name('admin.tag.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.tag.deactive');

        Route::post('/multi-delete', 'mulipleDelete')->name('admin.tag.multi.delete');
    });

    // <-- --------------- FILE-MANAGER ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(MediaController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('media')->group(function () {
        Route::get('/', 'index')->name('admin.media.index');
        Route::post('/', 'insert')->name('admin.media.insert');
        Route::get('/edit/{slug}', 'edit')->name('admin.media.edit');
        Route::put('/{slug}', 'update')->name('admin.media.update');
        Route::get('/{slug}', 'delete')->name('admin.media.delete');
        Route::post('/checkdelete', 'multiDelete')->name('admin.media.multi.delete');
        // File Manager Status Update
        Route::get('/active/{slug}', 'active')->name('admin.media.active');
        Route::get('/deactive/{slug}', 'deactive')->name('admin.media.deactive');
    });

    // <-- --------------- ORDER ROUTE LIST ---------------- -->
    Route::controller(OrderController::class)->middleware(['role:Super Admin|Admin|Manager|User'])->prefix('order')->group(function () {

        Route::get('/create', 'orderCreate')->name('admin.order.create');
        Route::post('/store', 'orderStore')->name('admin.order.store');
    //  Get Product By Ajax
        Route::get('/product', 'orderProduct')->name('admin.order.product');
        Route::get('courier/charge/{id}', 'orderCourier')->name('admin.order.courier.charge');


        Route::get('/order-manage', 'allOrder')->name('admin.order.all.page');
        Route::get('/pending-invoice-manage', 'pendingInvoicePage')->name('admin.order.pending.invoice.page');
        Route::get('/invoice-manage', 'invoicePage')->name('admin.order.invoice.page');
        Route::get('/delivery-manage', 'deliveryPage')->name('admin.order.delivery.page');
        Route::get('/{status_id}', 'getStatusOrder')->name('admin.status.order.list');

        Route::get('/edit/{slug}', 'edit')->name('admin.order.show');
        Route::get('/view/{slug}', 'view')->name('admin.order.view');
        Route::put('/update/{slug}', 'orderUpdate')->name('admin.order.update');
        Route::get('/delete/{slug}', 'orderDelete')->name('admin.order.delete');
        Route::get('/mark-delete', 'markOrderDelete')->name('admin.mark.order.delete');
        Route::get('/product-delete/{id}', 'productDelete')->name('admin.order.product.delete');
        Route::post('/product-quantity/update', 'productQuantityUpdate')->name('admin.order.product.quantity.update');

        // Order User Assign Route Ajax
        Route::get('/user/assign/to-order', 'userAssign')->name('admin.order.user.assign');

        // Assign Courier To Order
        Route::get('/courier/assign', 'courierAssign')->name('admin.order.courier.assign');
        Route::get('/status/assign', 'statusAssign')->name('admin.order.status.assign');

        // Add Item in Order
        Route::get('/add-order-item/{id}', 'getProductColorSize')->name('admin.product.color-size-get');
        Route::post('/add-order-item', 'addOrderItem')->name('admin.order.add.order.item');

        // <-- --------------- ORDER ROUTE LIST ---------------- --> COMPLECT
        Route::controller(InvoiceController::class)->prefix('invoice')->group(function () {
            Route::get('/', 'index')->name('admin.order.invoice.index');
            Route::get('/show/{slug}', 'show')->name('admin.order.invoice.show');
            Route::get('/print/{slug}', 'print')->name('admin.order.invoice.print');
        });

        // <-- --------------- ORDER RETURN ROUTE LIST ---------------- --> WORKING
        Route::controller(ReturnOrderController::class)->prefix('return')->group(function () {
            Route::get('/{id}', 'courierOrderReturn')->name('admin.courier.order.return');
            Route::get('/courier', 'allReturnOrder')->name('admin.courier.order.all');
            Route::get('/courier/{id}', 'allCourierOrder')->name('admin.courier.order.show');
            Route::get('/courier-order-return/{id}', 'returnCourierOrderShow')->name('admin.courier.order.return.show');
            Route::post('/courier-order-return', 'returnCourierOrder')->name('admin.courier.order.return');



        });
    });

    // <-- --------------- SUPPORT-CONTACT ROUTE LIST ---------------- --> COMPLECT
    Route::controller(SupportMessageController::class)->middleware(['role:Super Admin|Admin|Manager'])->prefix('support-message')->group(function () {
        Route::get('/', 'index')->name('admin.support.message.index');
        Route::get('/show/{slug}', 'show')->name('admin.support.message.show');
        Route::get('/delete/{slug}', 'delete')->name('admin.support.message.delete');
    });

    // <-- --------------- SUBSCRIBER ROUTE LIST ---------------- --> COMPLECT
    Route::get('/subscribes', [AdminController::class, 'allSubscriber'])->name('admin.subscriber.all');
    Route::get('/subscribes/{id}', [AdminController::class, 'subscriberDelete'])->name('admin.subscriber.delete');


    // <-- --------------- SUPPLIER ROUTE LIST ---------------- --> WORKING
    Route::controller(SupplierController::class)->middleware(['role:Super Admin|Admin'])->prefix('supplier')->group(function () {
        Route::get('/', 'index')->name('admin.supplier.index');
        Route::post('/', 'store')->name('admin.supplier.store');
        Route::PUT('/{slug}', 'update')->name('admin.supplier.update');
        Route::get('/delete/{slug}', 'destroy')->name('admin.supplier.destroy');

        Route::get('/search', 'searchFilter')->name('admin.supplier.search');
    });


    // <-- --------------- STOCK ROUTE LIST ---------------- --> COMPLETE
    Route::controller(StockController::class)->middleware(['role:Super Admin|Admin'])->prefix('stock')->group(function () {
        Route::get('/', 'allStock')->name('admin.stock.index');
        Route::get('/create', 'create')->name('admin.stock.create');
        Route::post('/{slug}', 'store')->name('admin.stock.store');
        // Purchase Route List
        Route::get('/purchase', 'allPurchase')->name('admin.stock.purchase');
        Route::get('/purchase/{slug}', 'deletePurchase')->name('admin.stock.purchase.delete');
    });

    // <-- --------------- SERVICE ADS ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(ServiceAdsController::class)->middleware(['role:Super Admin|Admin'])->prefix('service-ads')->group(function () {
        Route::get('/', 'index')->name('admin.service.ads.index');
        Route::post('/', 'store')->name('admin.service.ads.store');
        Route::put('/{slug}', 'update')->name('admin.service.ads.update');
        Route::get('/{slug}', 'delete')->name('admin.service.ads.delete');
    });

    // <-- --------------- STATIC BANNER ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(StaticBannerController::class)->middleware(['role:Super Admin|Admin'])->prefix('static-banner')->group(function () {
        Route::get('/', 'index')->name('admin.static.banner.index');
        Route::post('/', 'store')->name('admin.static.banner.store');
        Route::get('/edit/{slug}', 'edit')->name('admin.static.banner.edit');
        Route::put('/{slug}', 'update')->name('admin.static.banner.update');
        Route::get('/delete/{slug}', 'delete')->name('admin.static.banner.delete');
    });

    // <-- ---------------  ORDER STATUS ROUTE LIST ---------------- --> WORKING
    Route::name('admin.')->middleware(['role:Super Admin|Admin'])->group(function () {
        Route::resource('/order-status', OrderStatusController::class);
    });

    // <-- --------------- REPORT ROUTE LIST ---------------- --> COMPLECTED
    Route::controller(ReportController::class)->middleware(['role:Super Admin|Admin'])->group(function () {
        Route::get('/wish-report', 'wishListReport')->name('admin.wishlist.report');
        Route::post('/wish-report', 'categoryWisReport')->name('admin.category.wishlist.report');
        Route::get('/stock-report', 'stockReport')->name('admin.stock.report');
        Route::post('/stock-report', 'categoryStockReport')->name('admin.category.stock.report');

        Route::get('/courier-report', 'courierReport')->name('admin.courier.report');
        Route::post('/courier-report', 'courierReportDate')->name('admin.courier.report.date');

        Route::get('/user-report', 'userReport')->name('admin.user.report');
        Route::post('/user-report', 'userReportDate')->name('admin.user.report.date');
    });
    Route::controller(ElectricianController::class)->middleware(['role:Super Admin|Admin'])->group(function () {
        Route::prefix('/electrician')->group(function(){
            Route::get('', 'admin_electrician')->name('backend.electrician');
            Route::get('/profile/{slug}', 'admin_view')->name('admin.electrician.profile');
            Route::get('/category', 'category_index')->name('backend.electrician.category');
            Route::post('/category', 'category_insert')->name('backend.electrician.insert');

        });
    });

    // Route::controller(ElectricianController::class)->group(function () {
    //     Route::prefix('/electrician')->group(function(){
    //         Route::get('', 'admin_electrician')->name('backend.electrician');
    //         Route::get('/profile/{slug}', 'admin_view')->name('backend.electrician.profile');
    //     });
    // });

    


    // <-- --------------- RECYCLE BIN ROUTE LIST ---------------- -->
    Route::controller(RecycleBinController::class)->middleware(['role:Super Admin|Admin'])->prefix('recycle-bin')->group(function () {
        Route::get('/', 'all')->name('admin.recycle-bin.index');
        Route::get('/product-category', 'allProductCategory')->name('admin.recycle-bin.product.category.view');
        Route::get('/product-subcategory', 'allProSubCategory')->name('admin.recycle-bin.product.sub-category.view');
        Route::get('/product-color', 'allProductColor')->name('admin.recycle-bin.product.color.view');
        Route::get('/brand', 'allBrand')->name('admin.recycle-bin.brand.view');
        Route::get('/cities', 'allCity')->name('admin.recycle-bin.city.view');
        Route::get('/couriers', 'allCourier')->name('admin.recycle-bin.courier.view');
        Route::get('/couriers-city', 'allCourierCity')->name('admin.recycle-bin.courier.city.view');
        Route::get('/couriers-zone', 'allCourierZone')->name('admin.recycle-bin.courier.zone.view');
        Route::get('/blog-category', 'allBlogCategory')->name('admin.recycle-bin.blog.category.view');
        Route::get('/product', 'allProduct')->name('admin.recycle-bin.product.view');
    });
});
