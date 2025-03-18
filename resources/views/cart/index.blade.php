@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
    <div class="container">
        <h1>Keranjang Belanja</h1>
        @if (count($cartItems) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cartItems as $item)
                        <tr>
                            <td>{{ $item['name'] }}</td>
                            <td>Rp {{ number_format($item['price'], 0, ',', '.') }}</td>
                            <td>{{ $item['quantity'] }}</td>
                            <td>Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</td>
                            <td>
                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="text-end">
                <h4>Total Belanja: Rp {{ number_format($total, 0, ',', '.') }}</h4>
                <a href="{{ route('checkout.store') }}" class="btn btn-success">Checkout</a>
            </div>
        @else
            <p>Keranjang belanja Anda kosong.</p>
        @endif
    </div>
@endsection