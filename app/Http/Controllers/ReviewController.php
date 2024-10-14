<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    // Menyimpan ulasan produk
    public function store(Product $product, Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return redirect()->route('products.show', $product)->with('success', 'Ulasan berhasil ditambahkan.');
    }

    // Menampilkan ulasan produk
    public function index(Product $product)
    {
        $reviews = $product->reviews()->latest()->paginate(10);  // Ambil ulasan produk

        return view('reviews.index', compact('reviews', 'product'));  // Kirim ulasan ke view
    }
}
