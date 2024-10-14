@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Kategori: {{ $category->name }}</h1>

        <!-- Grid Produk Berdasarkan Kategori -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-white shadow-md rounded-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                    <a href="{{ route('products.show', $product->id) }}">
                        <!-- Cek apakah gambar produk ada, jika tidak gunakan gambar default dari Unsplash -->
                        @if($product->image)
                            <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-48 object-cover transition-opacity duration-300 hover:opacity-90">
                        @else
                            <img src="https://source.unsplash.com/1600x900/?product" alt="Default product image" class="w-full h-48 object-cover transition-opacity duration-300 hover:opacity-90">
                        @endif
                    </a>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800">
                            <a href="{{ route('products.show', $product->id) }}" class="hover:text-indigo-600 transition-colors duration-300">{{ $product->name }}</a>
                        </h3>
                        <p class="text-gray-600">{{ Str::limit($product->description, 100) }}</p>
                        <div class="mt-2">
                            <span class="text-gray-900 font-bold">{{ number_format($product->price, 0, ',', '.') }} IDR</span>
                        </div>
                        <a href="{{ route('products.show', $product->id) }}" class="mt-4 block text-indigo-600 hover:text-indigo-800 font-medium transition-colors duration-300">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-4">Tidak ada produk dalam kategori ini.</p>
            @endforelse
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $products->links('pagination::tailwind') }}
        </div>
    </div>
@endsection
