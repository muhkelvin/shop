@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-8">Our Products</h1>

            <!-- Product Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                @forelse($products as $product)
                    <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                        <a href="{{ route('products.show', $product->id) }}" class="block relative h-48 overflow-hidden">
                            <!-- Check if product image exists, otherwise use Unsplash -->
                            @if($product->image)
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">

                            @else
                                <img src="https://source.unsplash.com/500x400/?product" alt="Default product image" class="w-full h-full object-cover transition-transform duration-300 hover:scale-110">
                            @endif
                            <!-- Stock label if out of stock -->
                            @if($product->stock <= 0)
                                <span class="absolute top-0 right-0 bg-red-500 text-white px-2 py-1 text-xs font-bold">Out of Stock</span>
                            @endif
                        </a>
                        <div class="p-6">
                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white mb-2">
                                <a href="{{ route('products.show', $product->id) }}" class="hover:text-indigo-600 dark:hover:text-indigo-400 transition-colors duration-300">{{ $product->name }}</a>
                            </h3>
                            <p class="text-gray-600 dark:text-gray-300 mb-4">{{ Str::limit($product->description, 100) }}</p>
                            <div class="flex justify-between items-center">
                                <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">{{ number_format($product->price, 0, ',', '.') }} IDR</span>
                                <a href="{{ route('products.show', $product->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 font-medium transition-colors duration-300">
                                    View Details
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full">
                        <p class="text-center text-gray-500 dark:text-gray-400 text-xl">No products available at the moment.</p>
                    </div>
                @endforelse
            </div>


            <!-- Pagination -->
            <div class="mt-12">
                {{ $products->links() }}
            </div>
        </div>
    </div>
@endsection
