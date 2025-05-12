<x-layout>
@section('content')
    <h1>{{ $title }}</h1>

    <div class="grid grid-cols-3 gap-4">
        @foreach($products as $product)
            <div class="border p-4">
                <h2 class="font-bold">{{ $product->name }}</h2>
                <p>{{ $product->description }}</p>
                <p class="text-green-600 font-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                <p>Stock: {{ $product->stock }}</p>
            </div>
        @endforeach
    </div>
@endsection
</x-layout>