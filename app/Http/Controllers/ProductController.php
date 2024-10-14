<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Menampilkan semua produk
    public function index()
    {
        // Dapatkan semua produk dengan paginasi
        $products = Product::paginate(12);

        return view('products.index', compact('products'));  // Kirim data produk ke view
    }

    // Menampilkan detail produk berdasarkan model binding
    public function show(Product $product)
    {
        return view('products.show', compact('product'));  // Kirim data produk ke view
    }
}

