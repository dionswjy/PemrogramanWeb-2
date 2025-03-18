@extends('layouts.app')

@section('title', 'Detail Produk')

@section('content')
    <div class="container">
        <h1>{{ $product['name'] }}</h1>
        <p>Harga: Rp {{ number_format($product['price'], 0, ',', '.') }}</p>
        <p>Deskripsi: {{ $product['description'] }}</p>
        <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali ke Daftar Produk</a>
        <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
            @csrf
            <input type="hidden" name="product_id" value="{{ $product['id'] }}">
            <button type="submit" class="btn btn-primary">Tambahkan ke Keranjang</button>
        </form>
    </div>
@endsection