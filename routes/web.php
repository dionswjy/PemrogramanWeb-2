<?php

use Illuminate\Support\Facades\Route;
use Livewire\Volt\Volt;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;

// Route untuk halaman utama
Route::get('/   ', function () {
    return view('welcome');
});

// Route untuk menampilkan semua produk
Route::get('/products', [ProductController::class, 'index'])->name('products.index');

// Route untuk menampilkan detail produk
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

// Route untuk menambahkan produk ke keranjang
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');

// Route untuk menampilkan keranjang belanja
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Route untuk menghapus item dari keranjang
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

// Route untuk menampilkan halaman checkout (GET)
Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');

// Route untuk proses checkout
Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');

// Route untuk menampilkan halaman thank you setelah checkout
Route::get('/thank-you', function () {
    return view('thank-you');
})->name('thank-you');

require __DIR__.'/auth.php';
