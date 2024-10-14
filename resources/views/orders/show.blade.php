@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Detail Pesanan #{{ $order->id }}</h1>

        <!-- Informasi Pesanan -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800 dark:text-gray-200">Informasi Pesanan</h2>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Tanggal Pesanan:</strong> {{ $order->created_at->format('d M Y') }}</p>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Alamat Pengiriman:</strong> {{ $order->address }}</p>
                </div>
                <div>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Metode Pembayaran:</strong> {{ $order->payment_method }}</p>
                    <p class="text-gray-600 dark:text-gray-300"><strong>Status:</strong>
                        <span class="inline-block px-3 py-1 rounded-full text-sm font-medium
                            {{ $order->status == 'Completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ $order->status }}
                        </span>
                    </p>
                </div>
            </div>

            <h3 class="text-lg font-semibold mt-6 text-gray-800 dark:text-gray-200">Item Pesanan:</h3>

            <!-- Daftar Item Pesanan -->
            <div class="overflow-x-auto mt-4">
                <table class="min-w-full bg-white dark:bg-gray-800 rounded-lg shadow-md">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Produk</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Jumlah</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Harga</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Total</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                    @foreach($order->orderItems as $item)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $item->product->name }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $item->quantity }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ number_format($item->price, 0, ',', '.') }} IDR</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ number_format($item->price * $item->quantity, 0, ',', '.') }} IDR</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Total Harga -->
            <div class="mt-6 text-lg font-semibold text-gray-800 dark:text-gray-200">
                Total: <span class="text-2xl">{{ number_format($order->total_price, 0, ',', '.') }} IDR</span>
            </div>
        </div>
    </div>
@endsection
