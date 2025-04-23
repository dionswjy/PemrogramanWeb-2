<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\HomepageController;
// use App\Http\Controllers\ProductController;
// use App\Http\Controllers\CartController;
// use App\Http\Controllers\CheckoutController;


Route::get('/', [HomepageController::class, 'index']); 
Route::get('products', [HomepageController::class, 'products']); 
Route::get('product/{slug}', [HomepageController::class, 'product']); 
Route::get('categories',[HomepageController::class, 'categories']); 
Route::get('category/{slug}', [HomepageController::class, 'category']); 
Route::get('cart', [HomepageController::class, 'cart']); 
Route::get('checkout', [HomepageController::class, 'checkout']);

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')->name('settings.profile');
    Volt::route('settings/password', 'settings.password')->name('settings.password');
    Volt::route('settings/appearance', 'settings.appearance')->name('settings.appearance');
});




// // Route untuk halaman utama
// Route::get('/home', function () {
//     return view('welcome');
// });

// // Route untuk menampilkan semua produk
// Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// // Route untuk menampilkan detail produk
// Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// // Route untuk menambahkan produk ke keranjang
// Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// // Route untuk menampilkan keranjang belanja
// Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// // Route untuk menghapus item dari keranjang
// Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// // Route untuk menampilkan halaman checkout (GET)
// Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// // Route untuk proses checkout
// Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// // Route untuk menampilkan halaman thank you setelah checkout
// Route::get('/thank-you', function () {
//     return view('thank-you');
// })->name('thank-you');

require __DIR__.'/auth.php';
