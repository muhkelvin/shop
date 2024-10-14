@extends('layouts.app')

@section('content')

    @if (session('success'))
        <div class="bg-green-500 text-white p-4 rounded-lg mb-6">
            {{ session('success') }}
        </div>
    @elseif (session('error'))
        <div class="bg-red-500 text-white p-4 rounded-lg mb-6">
            {{ session('error') }}
        </div>
    @endif


    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-semibold text-gray-800 dark:text-gray-200 mb-6">Riwayat Pesanan</h1>

        @if($orders->isEmpty())
            <p class="text-center text-gray-500 dark:text-gray-400">Anda belum melakukan pesanan.</p>
        @else
            <!-- Daftar Pesanan -->
            <div class="overflow-x-auto">
                <table class="min-w-full bg-white dark:bg-gray-800 shadow-md rounded-lg overflow-hidden">
                    <thead class="bg-gray-50 dark:bg-gray-700">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">ID Pesanan</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Tanggal</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Total</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Status</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-gray-600 dark:text-gray-300">Aksi</th>
                    </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                    @foreach($orders as $order)
                        <tr class="hover:bg-gray-100 dark:hover:bg-gray-700">
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $order->id }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ $order->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-gray-900 dark:text-gray-100">{{ number_format($order->total_price, 0, ',', '.') }} IDR</td>
                            <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium
                                        {{ $order->status == 'Completed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                        {{ $order->status }}
                                    </span>
                            </td>
                            <td class="px-6 py-4">
                                <a href="{{ route('orders.show', $order->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-300 flex items-center space-x-1">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m4-8H9m0 4H9m4 4H9"></path>
                                    </svg>
                                    <span>Lihat Detail</span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
@endsection
