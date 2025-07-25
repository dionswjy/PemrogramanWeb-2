<x-layouts.app :title="__('Products')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl">Products</flux:heading>
        <flux:subheading size="lg" class="mb-6">Manage data Products</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <div class="flex justify-between items-center mb-4">
        <div>
            <form action="{{ route('dashboard.products.index') }}" method="get">
                @csrf
                <flux:input icon="magnifying-glass" name="q" value="{{ $q ?? '' }}" placeholder="Search Products" />
            </form>
        </div>
        <div>
            <flux:button icon="plus">
                <flux:link href="{{ route('dashboard.products.create') }}" variant="subtle">Add New Product</flux:link>
            </flux:button>
        </div>
    </div>
    @if(session()->has('successMessage'))
        <flux:badge color="lime" class="mb-3 w-full">{{ session()->get('successMessage') }}</flux:badge>
    @endif
    <div class="overflow-x-auto">
        <table class="min-w-full leading-normal">
            <thead>
                <tr>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        ID </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Image </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Name </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Slug </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        SKU </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Harga (Rp) </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Stock </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Status </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Created At </th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        on/off</th>
                    <th
                        class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                        Actions </th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $key => $product)
                    <tr>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $key + 1 }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                @if($product->image_url)
                                    <img src="{{ $product->image_url ? asset('storage/' . ltrim($product->image_url, '/')) : 'https://via.placeholder.com/350x200?text=No+Image' }}"
                                        class="card-img-top" alt="{{ $product->name }}">
                                @else
                                    <div class="h-10 w-10 bg-gray-200 flex items-center justify-center rounded">
                                        <span class="text-gray-500 text-sm">N/A</span>
                                    </div>
                                @endif
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $product->name }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $product->slug }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $product->sku }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                Rp{{ number_format($product->price, 2, ',', '.') }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $product->stock }}
                            </p>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            @php
                                $isActive = $product->is_active;
                                $statusClass = $isActive ? 'bg-green-200 text-green-900' : 'bg-red-200 text-red-900';
                                $statusText = $isActive ? 'Tersedia' : 'Tidak Aktif';
                                $buttonText = $isActive ? 'Nonaktifkan' : 'Aktifkan';
                                $isStockZero = $product->stock == 0;
                            @endphp

                            <span
                                class="inline-block min-w-[80px] text-center px-3 py-1 rounded-full text-sm font-medium shadow-sm {{ $statusClass }}">
                                {{ $statusText }}
                            </span>

                            {{-- Tombol toggle status --}}
                            @if ($isStockZero && !$isActive)
                                {{-- Stok 0 & tidak aktif, tombol hanya tampil disabled --}}
                                <button type="button"
                                    class="bg-gray-100 text-gray-500 font-semibold py-1 px-3 rounded cursor-not-allowed mt-2"
                                    disabled>
                                    {{ $buttonText }}
                                </button>
                            @else
                                <form action="{{ route('products.toggleStatus', $product->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit"
                                        class="bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-1 px-3 rounded">
                                        {{ $buttonText }}
                                    </button>
                                </form>
                            @endif
                        </td>

                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <p class="text-gray-900 whitespace-no-wrap">
                                {{ $product->created_at }}
                            </p>
                        </td>
                        <td>
                            <form id="sync-product-{{ $product->id }}"
                                action="{{ route('dashboard.products.sync', $product->id) }}" method="POST">
                                @csrf
                                <input type="hidden" name="is_active"
                                    value="@if($product->hub_product_id) 1 @else 0 @endif">
                                @if($product->hub_product_id)
                                    <flux:switch checked
                                        onchange="document.getElementById('sync-product-{{ $product->id }}').submit()" />
                                @else
                                    <flux:switch
                                        onchange="document.getElementById('sync-product-{{ $product->id }}').submit()" />
                                @endif
                            </form>
                        </td>
                        <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down">Actions</flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="pencil"
                                        href="{{ route('dashboard.products.edit', $product->id) }}">Edit</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger"
                                        onclick="event.preventDefault(); if(confirm('Are you sure you want to delete this product?')) document.getElementById('delete-form-{{ $product->id }}').submit();">
                                        Delete</flux:menu.item>
                                    <form id="delete-form-{{ $product->id }}"
                                        action="{{ route('dashboard.products.destroy', $product->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="mt-3">
            {{ $products->links() }}
        </div>
    </div>
</x-layouts.app>