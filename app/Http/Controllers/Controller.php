<?php

namespace App\Http\Controllers;

abstract class Controller
{
    //
}
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan daftar produk
    public function index()
    {
        // Contoh data produk (biasanya diambil dari database)
        $products = [
            ['id' => 1, 'name' => 'Erigo T-Shirt', 'price' => 150000],
            ['id' => 2, 'name' => 'Erigo Celana', 'price' => 175000],
            ['id' => 3, 'name' => 'Erigo Hoodie', 'price' => 300000],
            ['id' => 4, 'name' => 'Erigo Jacket', 'price' => 500000],
        ];

        // Mengirim data produk ke view
        return view('products.index', ['products' => $products]);
    }

    // Menampilkan detail produk
    public function show($id)
    {
        // Contoh data produk (biasanya diambil dari database)
        $products = [
            ['id' => 1, 'name' => 'Erigo T-Shirt', 'price' => 150000, 'description' => 'Kaos Erigo dengan bahan nyaman.'],
            ['id' => 2, 'name' => 'Erigo Celana', 'price' => 175000, 'description' => 'Celana Erigo dengan bahan Cotton Twill.'],
            ['id' => 3, 'name' => 'Erigo Hoodie', 'price' => 300000, 'description' => 'Hoodie Erigo dengan desain trendy.'],
            ['id' => 4, 'name' => 'Erigo Jacket', 'price' => 500000, 'description' => 'Jaket Erigo dengan bahan waterproof.'],
        ];

        // Mencari produk berdasarkan ID
        $product = collect($products)->firstWhere('id', $id);

        // Jika produk tidak ditemukan, redirect ke halaman 404
        if (!$product) {
            abort(404);
        }

        // Mengirim data produk ke view
        return view('products.show', ['product' => $product]);
    }
}



namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CartController extends Controller
{
    // Menampilkan keranjang belanja
    public function index()
    {
        // Ambil data keranjang dari session
        $cartItems = session('cart', []);

        // Hitung total belanja
        $total = 0;
        foreach ($cartItems as $item) {
            $total += $item['price'] * $item['quantity'];
        }

        // Kirim data ke view
        return view('cart.index', [
            'cartItems' => $cartItems,
            'total' => $total,
        ]);
    }

    // Menambahkan produk ke keranjang
    public function add(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity', 1);

        // Ambil data produk dari database (contoh sederhana)
        $products = [
            1 => ['id' => 1, 'name' => 'Erigo T-Shirt', 'price' => 150000],
            2 => ['id' => 2, 'name' => 'Erigo Celana', 'price' => 175000],
            3 => ['id' => 3, 'name' => 'Erigo Hoodie', 'price' => 300000],
            4 => ['id' => 4, 'name' => 'Erigo Jacket', 'price' => 500000],
        ];

        // Cek apakah produk ada
        if (!isset($products[$productId])) {
            return redirect()->back()->with('error', 'Produk tidak ditemukan.');
        }

        $product = $products[$productId];

        // Ambil data keranjang dari session
        $cart = session('cart', []);

        // Tambahkan produk ke keranjang
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'id' => $productId,
                'name' => $product['name'],
                'price' => $product['price'],
                'quantity' => $quantity,
            ];
        }

        // Simpan data keranjang ke session
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang');
    }

    // Menghapus produk dari keranjang
    public function remove($id)
    {
        // Ambil data keranjang dari session
        $cart = session('cart', []);

        // Hapus produk dari keranjang
        if (isset($cart[$id])) {
            unset($cart[$id]);
        }

        // Simpan data keranjang ke session
        session(['cart' => $cart]);

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang');
    }
}
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    // Menampilkan halaman checkout
    public function index()
    {
        return view('checkout');
    }

    // Menyimpan data checkout
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Logic untuk menyimpan data checkout
        // Contoh: Simpan ke database

        // Redirect ke halaman thank you
        return redirect()->route('thank-you');
    }
}

