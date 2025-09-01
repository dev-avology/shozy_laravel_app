<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController as AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AttributeController;
use App\Http\Controllers\Admin\VendorController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\TechnicianController;
use App\Http\Controllers\Admin\DeliveryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ShippingController;
use App\Http\Controllers\Admin\CouponController;
use Illuminate\Support\Facades\Auth;

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

Route::get('/', function () {
    return redirect()->route('admin.login');
});

// Admin routes
Route::prefix('admin')->group(function () {
    // Guest routes
    Route::middleware('guest.admin')->group(function () {
        Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
        Route::post('/login', [AdminAuthController::class, 'login']);
    });

    // Protected admin routes
    Route::middleware('auth:admin')->group(function () {
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
        
        // User management routes
        Route::resource('users', UserController::class, ['as' => 'admin']);
        Route::get('/users/{id}/toggle-status', [UserController::class, 'toggleStatus'])->name('admin.users.toggle-status');
        
        // Product Management
        Route::resource('products', ProductController::class, ['as' => 'admin']);
        Route::post('/products/bulk-action', [ProductController::class, 'bulkAction'])->name('admin.products.bulk-action');
        Route::get('/products/export', [ProductController::class, 'export'])->name('admin.products.export');
        Route::get('/vendors/{vendor}/products', [ProductController::class, 'vendorProducts'])->name('admin.products.vendor-products');
        
        // Category Management
        Route::resource('categories', CategoryController::class, ['as' => 'admin']);
        Route::get('/categories/{id}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('admin.categories.toggle-status');
        Route::get('/categories/{id}/toggle-featured', [CategoryController::class, 'toggleFeatured'])->name('admin.categories.toggle-featured');
        
        // Attribute Management
        Route::resource('attributes', AttributeController::class, ['as' => 'admin']);
        Route::get('/attributes/{id}/toggle-status', [AttributeController::class, 'toggleStatus'])->name('admin.attributes.toggle-status');
        
        // Vendor Management
        Route::resource('vendors', VendorController::class, ['as' => 'admin']);
        Route::get('/vendors/{id}/toggle-status', [VendorController::class, 'toggleStatus'])->name('admin.vendors.toggle-status');
        
            // Order Management
    Route::resource('orders', OrderController::class, ['as' => 'admin']);
    Route::patch('/orders/{id}/status', [OrderController::class, 'updateStatus'])->name('admin.orders.update-status');

    // Technician Management
    Route::resource('technicians', TechnicianController::class, ['as' => 'admin']);
    Route::patch('/technicians/{id}/status', [TechnicianController::class, 'updateStatus'])->name('admin.technicians.update-status');
    Route::patch('/technicians/{id}/payout/approve', [TechnicianController::class, 'approvePayout'])->name('admin.technicians.approve-payout');
    Route::patch('/technicians/{id}/payout/reject', [TechnicianController::class, 'rejectPayout'])->name('admin.technicians.reject-payout');
    Route::get('/technicians/{id}/jobs', [TechnicianController::class, 'jobs'])->name('admin.technicians.jobs');
         Route::get('/technicians/{id}/earnings', [TechnicianController::class, 'earnings'])->name('admin.technicians.earnings');
     
     // Delivery Management
     Route::resource('deliveries', DeliveryController::class, ['as' => 'admin']);
     Route::patch('/deliveries/{id}/status', [DeliveryController::class, 'updateStatus'])->name('admin.deliveries.update-status');
     Route::patch('/deliveries/{id}/assign-order', [DeliveryController::class, 'assignOrder'])->name('admin.deliveries.assign-order');
     Route::patch('/deliveries/{id}/delivery-status', [DeliveryController::class, 'updateDeliveryStatus'])->name('admin.deliveries.update-delivery-status');
     Route::get('/deliveries/{id}/tracking', [DeliveryController::class, 'tracking'])->name('admin.deliveries.tracking');
     Route::get('/deliveries/{id}/orders', [DeliveryController::class, 'orders'])->name('admin.deliveries.orders');
     
     // Customer Management
     Route::resource('customers', CustomerController::class, ['as' => 'admin']);
     Route::patch('/customers/{id}/status', [CustomerController::class, 'updateStatus'])->name('admin.customers.update-status');
     Route::patch('/customers/{id}/block', [CustomerController::class, 'blockCustomer'])->name('admin.customers.block');
     Route::patch('/customers/{id}/unblock', [CustomerController::class, 'unblockCustomer'])->name('admin.customers.unblock');
     Route::post('/customers/{id}/notes', [CustomerController::class, 'addNote'])->name('admin.customers.add-note');
           Route::get('/customers/{id}/orders', [CustomerController::class, 'orders'])->name('admin.customers.orders');
      
      // Shipping Management
      Route::resource('shipping', ShippingController::class, ['as' => 'admin']);
      Route::patch('/shipping/{id}/status', [ShippingController::class, 'updateStatus'])->name('admin.shipping.update-status');
      Route::get('/shipping/{id}/zones', [ShippingController::class, 'zones'])->name('admin.shipping.zones');
      Route::get('/shipping/{id}/tracking', [ShippingController::class, 'tracking'])->name('admin.shipping.tracking');
      Route::post('/shipping/{id}/zones', [ShippingController::class, 'createZone'])->name('admin.shipping.create-zone');
      
      // Coupon Management
      Route::resource('coupons', CouponController::class, ['as' => 'admin']);
      Route::patch('/coupons/{id}/status', [CouponController::class, 'updateStatus'])->name('admin.coupons.update-status');
      Route::get('/coupons/{id}/duplicate', [CouponController::class, 'duplicate'])->name('admin.coupons.duplicate');
      Route::get('/coupons/{id}/analytics', [CouponController::class, 'analytics'])->name('admin.coupons.analytics');
      
      Route::get('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    });
    
    // Debug route (remove in production)
    Route::get('/debug', function() {
        return [
            'admin_guard_check' => Auth::guard('admin')->check(),
            'web_guard_check' => Auth::guard('web')->check(),
            'current_guard' => Auth::getDefaultDriver(),
            'session_id' => session()->getId(),
            'admin_user' => Auth::guard('admin')->user(),
            'web_user' => Auth::guard('web')->user(),
        ];
    });
    
    // Color Showcase route
    Route::get('/color-showcase', function() {
        return view('admin.color-showcase');
    })->name('admin.color-showcase');
    
    // Test logout route (remove in production)
    Route::post('/test-logout', function() {
        return [
            'message' => 'Test logout route accessed',
            'method' => request()->method(),
            'csrf_token' => request()->has('_token'),
            'session_id' => session()->getId(),
        ];
    });
});
