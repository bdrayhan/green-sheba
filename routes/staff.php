<?php

use App\Http\Controllers\Staff\StaffController;
use App\Http\Controllers\Staff\StaffOrderController;
use App\Http\Controllers\Frontend\ElectricianController;
use Illuminate\Support\Facades\Route;



Route::controller(StaffController::class)->middleware(['auth', 'role:User'])->prefix('staff')->group(function () {
    Route::get('/', 'dashboard')->name('admin.staff.dashboard');
    Route::get('/logout',  'logout')->name('admin.staff.logout');
    Route::get('/clear-cache',  'clearCache')->name('admin.staff.clear.cache');
    Route::get('/profile',  'userProfile')->name('admin.staff.user.profile');

    // User Total Order
    Route::get('/total-orders',  'totalOrder')->name('admin.staff.user.total.orders');

    //electrician

    // Route::controller(ElectricianController::class)->group(function () {
    //     Route::prefix('/electrician')->group(function(){
    //         Route::get('', 'index')->name('web.electrician.home');
    //         Route::get('/registration', 'registration')->name('web.electrician.registration');
    //         Route::post('/registration', 'insert')->name('web.electrician.insert');
    //         Route::get('/search','search')->name('web.electrician.search');
    //         // Route::get('edit/{slug}','edit');
    //         // Route::post('softdelete', 'softdelete');
    //         // Route::post('restore', 'restore');
    //         // Route::post('delete/test', 'delete');
    //         // Route::post('/store-data','store')->name('store.data');
    //         Route::get('/profile/{slug}', 'profile')->name('electrician.profile');
    //     });
    // });

    // Staff Route List
    Route::controller(StaffOrderController::class)->prefix('order')->group(function () {
        Route::get('{status_id}', 'getStatusProduct')->name('admin.staff.status.order');
        Route::get('show/{order_slug}', 'showOrder')->name('admin.staff.order.show');
        Route::get('order/{order_slug}/edit', 'editOrder')->name('admin.staff.order.edit');
        Route::put('order/{order_slug}', 'updateOrder')->name('admin.staff.order.update');
        Route::get('/delete/{slug}', 'deleteOrder')->name('admin.staff.order.delete');
        Route::get('/print/{slug}', 'print')->name('admin.staff.order.invoice.print');



        // Order Create Route

        Route::get('new-order/create', 'createOrder')->name('admin.staff.order.create');

        // Order Create Route End


        Route::get('/order/product/{detail_id}', 'productDelete')->name('admin.staff.order.product.delete');
        Route::post('/product-quantity/update', 'productQuantityUpdate')->name('admin.staff.order.product.quantity.update');

        // Add Item in Order
        Route::get('/add-order-item/{id}', 'getProductColorSize')->name('admin.staff.product.color-size-get');
        Route::post('/add-order-item', 'addOrderItem')->name('admin.staff.order.add.order.item');

        // Assign Courier To Order
    Route::get('/courier/assign', 'courierAssign')->name('admin.staff.order.courier.assign');
    Route::get('/status/assign', 'statusAssign')->name('admin.staff.order.status.assign');
    });




});
