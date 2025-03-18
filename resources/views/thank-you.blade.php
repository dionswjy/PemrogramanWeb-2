@extends('layouts.app')

@section('title', 'Terima Kasih')

@section('content')
    <div class="container">
        <h1>Terima Kasih!</h1>
        <p>Pesanan Anda telah berhasil diproses.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Kembali ke Daftar Produk</a>
    </div>
@endsection