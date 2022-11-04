<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CartController2;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\MerchantController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LandingPageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PurchaseOrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\AccountController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('admin/');
    }
    return redirect()->route('login');
    //return view('welcome');
});

//Route::get('/', [LandingPageController::class, 'index'])->name('landingPage');
//Route::post('/initialize_payment', [OrderController::class, 'confirm']);

Auth::routes();

Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'store'])->name('settings.store');
    Route::resource('products', ProductController::class);
    
    
    
    Route::get('/suppliers/active', [SupplierController::class, 'active_suppliers'])->name('suppliers.active');
    Route::get('/suppliers/inactive', [SupplierController::class, 'inactive_suppliers'])->name('suppliers.inactive');
    Route::get('/suppliers', [SupplierController::class, 'index'])->name('suppliers.index');
    Route::resource('suppliers', SupplierController::class);
    
    
    Route::get('/merchants/active', [MerchantController::class, 'active_merchants'])->name('merchants.active');
    Route::get('/merchants/inactive', [MerchantController::class, 'inactive_merchants'])->name('merchants.inactive');
    Route::get('/merchants', [MerchantController::class, 'index'])->name('merchants.index');
    Route::resource('merchants', MerchantController::class);
    
    Route::resource('purchases', PurchaseOrderController::class);
    Route::resource('orders', OrderController::class);

    Route::get('/supplier_contacts', [ContactController::class, 'suppliers'])->name('supplier.contacts');
    Route::get('/customer_contacts', [ContactController::class, 'customers'])->name('customer.contacts');
    Route::resource('contacts', ContactController::class);

    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::post('/cart/change-qty', [CartController::class, 'changeQty']);
    Route::delete('/cart/delete', [CartController::class, 'delete']);
    Route::delete('/cart/empty', [CartController::class, 'empty']);

    //For purchases
    Route::get('/cart2', [CartController2::class, 'index'])->name('cart2.index');
    Route::post('/cart2', [CartController2::class, 'store'])->name('cart2.store');
    Route::post('/cart2/change-qty', [CartController2::class, 'changeQty']);
    Route::delete('/cart2/delete', [CartController2::class, 'delete']);
    Route::delete('/cart2/empty', [CartController2::class, 'empty']);
});
