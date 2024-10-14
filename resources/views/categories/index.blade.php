@extends('layouts.app')

@section('content')
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-6">
        <h1 class="text-3xl font-semibold text-gray-800 mb-6">Semua Kategori</h1>

        <!-- Grid Daftar Kategori -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($categories as $category)
                <div class="bg-white shadow-md rounded-lg overflow-hidden transition-transform duration-300 hover:scale-105">
                    <a href="{{ route('categories.show', $category->id) }}" class="block relative h-48 bg-indigo-600 flex items-center justify-center">
                        <span class="text-white text-xl font-semibold">{{ $category->name }}</span>
                    </a>
                </div>
            @empty
                <p class="text-center text-gray-500 col-span-4">Tidak ada kategori yang tersedia.</p>
            @endforelse
        </div>
    </div>
@endsection
