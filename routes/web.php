<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomepageController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\CartController;


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


Route::group(['middleware'=>['is_customer_login']], function(){
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
});

// Produk di luar dashboard tapi tetap dengan middleware auth
Route::resource('products', ProductController::class)->middleware(['auth']);

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



require __DIR__.'/auth.php';