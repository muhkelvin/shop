@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Wishlist Anda</h1>

        @if($wishlistItems->isEmpty())
            <p class="text-center text-gray-500">Wishlist Anda kosong.</p>
        @else
            <!-- Grid Wishlist Items -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @foreach($wishlistItems as $wishlistItem)
                    <div class="bg-white shadow-md rounded-lg overflow-hidden transition-transform transform hover:scale-105 duration-300 ease-in-out">
                        <a href="{{ route('products.show', $wishlistItem->product->id) }}">
                            <img src="{{ asset('storage/' . $wishlistItem->product->image) }}" alt="{{ $wishlistItem->product->name }}" class="w-full h-48 object-cover transition-opacity duration-300 ease-in-out hover:opacity-90">
                        </a>
                        <div class="p-4">
                            <h3 class="text-lg font-semibold text-gray-800 hover:text-indigo-600 transition-colors duration-300 ease-in-out">
                                <a href="{{ route('products.show', $wishlistItem->product->id) }}">{{ $wishlistItem->product->name }}</a>
                            </h3>
                            <div class="mt-2">
                                <span class="text-gray-900 font-bold">{{ number_format($wishlistItem->product->price, 0, ',', '.') }} IDR</span>
                            </div>
                            <div class="mt-4 flex justify-between items-center">
                                <!-- Form Tambah ke Keranjang -->
                                <form action="{{ route('cart.add', $wishlistItem->product->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="bg-indigo-600 text-white py-2 px-4 rounded hover:bg-indigo-700 transition-colors duration-300 ease-in-out">Tambahkan ke Keranjang</button>
                                </form>

                                <!-- Form Hapus Wishlist -->
                                <form action="{{ route('wishlist.remove', $wishlistItem->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-red-600 text-white py-2 px-4 rounded hover:bg-red-700 transition-colors duration-300 ease-in-out">Hapus</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        @endif
    </div>
@endsection
