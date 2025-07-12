<x-layouts.app :title="__('orders')">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-6">Daftar Order</h1>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="py-3 px-4 text-left text-black">Nomor Order</th>
                        <th class="py-3 px-4 text-left text-black">Tanggal</th>
                        <th class="py-3 px-4 text-left text-black">Total</th>
                        <th class="py-3 px-4 text-left text-black">Status</th>
                        <th class="py-3 px-4 text-left text-black">Nama Customer</th>
                        <th class="py-3 px-4 text-left text-black">Metode Pembayaran</th>
                        <th class="py-3 px-4 text-left text-black">Bukti Pembayaran</th>
                        <th class="py-3 px-4 text-left text-black">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($orders as $order)
                    <tr>
                        <td class="py-3 px-4 text-black">{{ $order->order_number }}</td>
                        <td class="py-3 px-4 text-black">{{ $order->created_at->format('d F Y') }}</td>
                        <td class="py-3 px-4 text-black">Rp {{ number_format($order->total, 0, ',', '.') }}</td>
                        <td class="py-3 px-4">
                            <span class="px-2 py-1 text-xs rounded-full @if($order->status === 'completed') bg-green-100 text-green-800 @elseif($order->status === 'pending') bg-yellow-100 text-black @elseif($order->status === 'cancelled') bg-red-100 text-red-800 @else bg-blue-100 text-blue-800 @endif">
                                {{ $order->status }}
                            </span>
                        </td>
                        <td class="py-3 px-4 text-black">{{ $order->user->name }}</td>
                        <td class="py-3 px-4 text-black">
                            @if($order->payment_confirmation)
                                {{ $order->payment_confirmation->bank_name }}
                            @else
                                <span class="text-gray-500">Belum dibayar</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-black">
                            @if($order->payment_confirmation && $order->payment_confirmation->payment_proof)
                                <a href="{{ Storage::url($order->payment_confirmation->payment_proof) }}" target="_blank" class="text-blue-600 hover:underline">
                                    Lihat Bukti
                                </a>
                            @else
                                <span class="text-gray-500">-</span>
                            @endif
                        </td>
                        <td class="py-3 px-4 text-black">
                            <a href="{{ route('dashboard.orders.show', $order->id) }}" class="text-blue-600 hover:underline">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layouts.app>