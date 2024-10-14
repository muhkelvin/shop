@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                <!-- Product Image -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                </div>

                <!-- Product Details -->
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8">
                    <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-4">{{ $product->name }}</h1>
                    <p class="text-gray-600 dark:text-gray-300 text-lg mb-6">{{ $product->description }}</p>
                    <div class="mb-6">
                        <span class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">{{ number_format($product->price, 0, ',', '.') }} IDR</span>
                    </div>

                    <!-- Stock Information -->
                    <div class="mb-6">
                        @if($product->stock > 0)
                            <span class="inline-block bg-green-100 text-green-800 dark:bg-green-800 dark:text-green-100 px-3 py-1 rounded-full text-sm font-semibold">
                                In Stock: {{ $product->stock }}
                            </span>
                        @else
                            <span class="inline-block bg-red-100 text-red-800 dark:bg-red-800 dark:text-red-100 px-3 py-1 rounded-full text-sm font-semibold">
                                Out of Stock
                            </span>
                        @endif
                    </div>

                    <!-- Action Buttons -->
                    <div class="flex flex-col sm:flex-row space-y-4 sm:space-y-0 sm:space-x-4">
                        <form action="{{ route('cart.add', $product->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition-colors duration-300 {{ $product->stock <= 0 ? 'opacity-50 cursor-not-allowed' : '' }}" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                Add to Cart
                            </button>
                        </form>

                        <!-- Wishlist Form -->
                        <form action="{{ route('wishlist.add', $product->id) }}" method="POST" class="flex-1">
                            @csrf
                            <button type="submit" class="w-full bg-gray-200 dark:bg-gray-700 text-gray-800 dark:text-gray-200 px-6 py-3 rounded-lg text-lg font-semibold text-center hover:bg-gray-300 dark:hover:bg-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 transition-colors duration-300">
                                Add to Wishlist
                            </button>
                        </form>
                    </div>

                    <!-- Additional Information -->
                    <div class="mt-12">
                        <h2 class="text-2xl font-semibold text-gray-900 dark:text-white mb-4">Product Details</h2>
                        <ul class="list-disc list-inside text-gray-600 dark:text-gray-300 space-y-2">
                            <li>Category: {{ $product->category->name }}</li>
                            <li>SKU: {{ $product->sku }}</li>
                            <!-- Add more details as needed -->
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
