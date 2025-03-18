@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="container">
        <h1>Dashboard</h1>
        <p>Selamat datang di dashboard admin.</p>
        <a href="{{ route('products.index') }}" class="btn btn-primary">Kelola Produk</a>
    </div>
@endsection