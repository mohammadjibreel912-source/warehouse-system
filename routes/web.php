<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\LeaseController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

use App\Http\Middleware\AdminMiddleware;
// Dashboard Home
// Warehouses
Route::resource('warehouses', WarehouseController::class)->middleware('auth');

// Leases
Route::resource('leases', LeaseController::class)->middleware('auth');

// Products
Route::resource('products', ProductController::class)->middleware('auth');

// Suppliers
Route::resource('suppliers', SupplierController::class)->middleware('auth');

// Customers
Route::resource('customers', CustomerController::class)->middleware('auth');

// Purchases
Route::resource('purchases', PurchaseController::class)->middleware('auth');

// Sales
Route::resource('sales', SaleController::class)->middleware('auth');

// Notifications (عرض وقراءة فقط)
Route::get('notifications', [NotificationController::class,'index'])->name('notifications.index')->middleware('auth');
Route::post('notifications/{notification}/read', [NotificationController::class,'markAsRead'])->name('notifications.read')->middleware('auth');
Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', AdminMiddleware::class])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::resource('users', UserController::class);
        Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');



});

