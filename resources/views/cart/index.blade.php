@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 dark:bg-gray-900">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <h1 class="text-4xl font-bold text-gray-900 dark:text-white mb-8">Your Shopping Cart</h1>

            @if($cartItems->isEmpty())
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg p-8 text-center">
                    <p class="text-xl text-gray-600 dark:text-gray-300 mb-6">Your shopping cart is empty.</p>
                    <a href="{{ route('products.index') }}" class="bg-indigo-600 text-white px-6 py-3 rounded-lg text-lg font-semibold hover:bg-indigo-700 transition-colors duration-300">
                        Continue Shopping
                    </a>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-lg overflow-hidden">
                    <table class="min-w-full">
                        <thead class="bg-gray-50 dark:bg-gray-700">
                        <tr>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Product</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Quantity</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Price</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Total</th>
                            <th class="px-6 py-3 text-left text-sm font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Actions</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 dark:divide-gray-700">
                        @foreach($cartItems as $cartItem)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <img class="h-16 w-16 rounded-lg object-cover mr-4" src="{{ asset('storage/' . $cartItem->product->image) }}" alt="{{ $cartItem->product->name }}">
                                        <a href="{{ route('products.show', $cartItem->product->id) }}" class="text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 transition-colors duration-300">
                                            {{ $cartItem->product->name }}
                                        </a>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('cart.update', $cartItem->id) }}" method="POST" class="flex items-center">
                                        @csrf
                                        @method('PUT')
                                        <input type="number" name="quantity" value="{{ $cartItem->quantity }}" min="1" class="border dark:border-gray-600 rounded px-2 py-1 w-16 dark:bg-gray-700 dark:text-white">
                                        <button type="submit" class="ml-2 text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 dark:hover:text-indigo-200 transition-colors duration-300">Update</button>
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">
                                    {{ number_format($cartItem->product->price, 0, ',', '.') }} IDR
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-gray-700 dark:text-gray-300">
                                    {{ number_format($cartItem->product->price * $cartItem->quantity, 0, ',', '.') }} IDR
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('cart.remove', $cartItem->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 dark:text-red-400 hover:text-red-800 dark:hover:text-red-200 transition-colors duration-300">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="mt-8 bg-white dark:bg-gray-800 rounded-lg shadow-lg p-6">
                    <div class="flex justify-between items-center mb-6">
                        <span class="text-2xl font-bold text-gray-900 dark:text-white">Cart Total:</span>
                        <span class="text-2xl font-bold text-indigo-600 dark:text-indigo-400">
                        {{ number_format($cartItems->sum(fn($item) => $item->product->price * $item->quantity), 0, ',', '.') }} IDR
                    </span>
                    </div>
                    <a href="{{ route('checkout.index') }}" class="block w-full bg-indigo-600 text-white text-center px-6 py-3 rounded-lg text-lg font-semibold hover:bg-indigo-700 transition-colors duration-300">
                        Proceed to Checkout
                    </a>
                </div>
            @endif
        </div>
    </div>
@endsection
