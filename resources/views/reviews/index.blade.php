@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Ulasan untuk {{ $product->name }}</h1>

        @if($reviews->isEmpty())
            <p class="text-center text-gray-500">Belum ada ulasan untuk produk ini.</p>
        @else
            <div class="space-y-4">
                @foreach($reviews as $review)
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <div class="flex items-center justify-between mb-2">
                            <h3 class="text-lg font-bold">{{ $review->user->name }}</h3>
                            <span class="text-sm text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
                        </div>
                        <div class="flex items-center mb-2">
                            <span class="text-yellow-500 text-sm">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-gray-300' }}"></i>
                                @endfor
                            </span>
                        </div>
                        <p class="text-gray-700">{{ $review->comment }}</p>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-6">
                {{ $reviews->links() }}
            </div>
        @endif

        <!-- Tambahkan Ulasan -->
        @auth
            <div class="mt-6">
                <h2 class="text-2xl font-semibold text-gray-800">Tambah Ulasan</h2>

                <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-4">
                        <label for="rating" class="block text-sm font-medium text-gray-700">Rating</label>
                        <select name="rating" id="rating" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            <option value="5">5 - Sangat Bagus</option>
                            <option value="4">4 - Bagus</option>
                            <option value="3">3 - Biasa</option>
                            <option value="2">2 - Kurang Bagus</option>
                            <option value="1">1 - Buruk</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label for="comment" class="block text-sm font-medium text-gray-700">Komentar</label>
                        <textarea name="comment" id="comment" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">{{ old('comment') }}</textarea>
                    </div>
                    <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700">Kirim Ulasan</button>
                </form>
            </div>
        @endauth
    </div>
@endsection
