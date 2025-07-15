<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\OrderController;

// ====================
// ROUTE UNTUK USER (FRONTEND)
// ====================

Route::get('/api-data', [ApiController::class, 'getApiData'])->name('api.data');

Route::get('/', [HomepageController::class, 'index'])->name('home');
Route::get('products', [HomepageController::class, 'products'])->name('products');
Route::get('product/{slug}', [HomepageController::class, 'product'])->name('product.show');
Route::get('categories', [HomepageController::class, 'categories'])->name('categories.index');
Route::get('category/{slug}', [HomepageController::class, 'category'])->name('categories.show');

Route::get('cart', [HomepageController::class, 'cart'])->name('cart.index');
Route::get('checkout', [HomepageController::class, 'checkout'])->name('checkout.index');

Route::middleware(['auth:customer'])->group(function () {

    Route::post('/checkout/process', [CheckoutController::class, 'process'])
        ->name('checkout.process');

    Route::get('/order/success/{order}', [PaymentController::class, 'success'])
        ->name('order.success');

    Route::get('/order/{order}/confirm-payment', [PaymentController::class, 'showConfirmationForm'])
        ->name('payment.confirmation');

    Route::post('/order/{order}/confirm-payment', [PaymentController::class, 'confirmPayment'])
        ->name('payment.submit_confirmation');
});


// Endpoint untuk payment gateway notification     
Route::post('/api/payment-notification', [PaymentController::class, 'handleNotification']);

Route::group(['middleware' => ['is_customer_login']], function () {
    Route::controller(CartController::class)->group(function () {
        Route::post('cart/add', 'add')->name('cart.add');
        Route::delete('cart/remove/{id}', 'remove')->name('cart.remove');
        Route::patch('cart/update/{id}', 'update')->name('cart.update');
    });
});


// Toggle status produk (PATCH)
Route::patch('/products/{id}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggleStatus');

// ====================
// ROUTE DASHBOARD
// ====================

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Produk & Kategori di dashboard
Route::prefix('dashboard')->middleware(['auth'])->name('dashboard.')->group(function () {
    Route::resource('categories', ProductCategoryController::class);
    Route::resource('products', ProductController::class);
    Route::resource('order', OrderController::class);
    Route::post('products/sync/{id}', [ProductController::class, 'sync'])->name('products.sync');
    Route::post('category/sync/{id}', [ProductCategoryController::class, 'sync'])->name('category.sync');
});

Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');

Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::get('/orders', [OrderController::class, 'index'])->name('dashboard.orders.index');
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('dashboard.orders.show');
    Route::patch('/orders/{order}/status', [OrderController::class, 'updateStatus'])->name('dashboard.orders.update-status');
    Route::post('/orders/{order}/ship', [OrderController::class, 'markAsShipped'])->name('dashboard.orders.ship');
});

// Produk di luar dashboard tapi tetap dengan middleware auth
Route::prefix('admin')->group(function () {
    Route::resource('products', ProductController::class)->middleware(['auth']);
});

// ====================
// ROUTE CUSTOMER AUTH
// ====================

Route::prefix('customer')->name('customer.')->group(function () {
    Route::controller(CustomerAuthController::class)->group(function () {
        // Tampilkan halaman login
        Route::get('login', 'login')->name('login');
        // Aksi login
        Route::post('login', 'store_login')->name('store_login');
        // Tampilkan halaman register
        Route::get('register', 'register')->name('register');
        // Aksi register
        Route::post('register', 'store_register')->name('store_register');
        // Aksi logout
        Route::post('logout', 'logout')->name('logout');
    });
});

// ====================
// ROUTE SETTINGS (LIVEWIRE VOLT)
// ====================

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');
    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});



require __DIR__ . '/auth.php';