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
use App\Http\Controllers\InventoryMovementController;
use App\Http\Middleware\RoleMiddleware;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\InvoiceController;

// Public route
Route::get('/', function () {
    return view('welcome');
});

// Auth routes
Auth::routes();

// Routes accessible by any authenticated user
Route::middleware(['auth'])->group(function () {

    // Warehouses
    Route::resource('warehouses', WarehouseController::class);

    // Leases
    Route::resource('leases', LeaseController::class);

    // Products
    Route::resource('products', ProductController::class);

    // Suppliers
    Route::resource('suppliers', SupplierController::class);

    // Customers
    Route::resource('customers', CustomerController::class);

    // Purchases
    Route::resource('purchases', PurchaseController::class);

    // Sales
    Route::resource('sales', SaleController::class);

    // Notifications (view & mark as read)
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
});

// Admin-only routes
Route::middleware(['auth', RoleMiddleware::class . ':admin'])->prefix('admin')->group(function () {

    // Dashboard
    Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    // Users management
    Route::resource('users', UserController::class);

    // Inventory movements
    Route::resource('inventory_movements', InventoryMovementController::class);

    // Admin notifications
    Route::get('notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('notifications/{notification}/read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');
});


Route::middleware(['auth'])->group(function () {
    Route::resource('invoices', InvoiceController::class);
    Route::resource('invoice_items', InvoiceItemController::class);
    Route::resource('payments', PaymentController::class);
});
