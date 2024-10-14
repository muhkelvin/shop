<!-- Hero Section -->
@extends('layouts.app')

@section('content')


<div class="bg-indigo-700 text-white">
    <div class="max-w-7xl mx-auto py-16 px-4 sm:py-24 sm:px-6 lg:px-8">
        <h1 class="text-4xl font-extrabold tracking-tight sm:text-5xl lg:text-6xl">Welcome to Laravel Store</h1>
        <p class="mt-6 text-xl max-w-3xl">Discover amazing products and shop with confidence. We offer a wide range of high-quality items to suit your needs.</p>
        <div class="mt-10">
            <a href="{{ route('products.index') }}" class="bg-white text-indigo-600 hover:bg-indigo-50 px-6 py-3 rounded-md text-lg font-medium inline-block">
                Shop Now
            </a>
        </div>
    </div>
</div>
@endsection
