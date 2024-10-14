<?php

namespace App\Http\Controllers;

use App\Models\Category;

class CategoryController extends Controller
{
    // Menampilkan produk berdasarkan kategori
    public function index ()
    {
        // Dapatkan produk dari kategori tertentu dengan paginasi
        $categories = Category::all();


        return view('categories.index', compact('categories'));  // Kirim data kategori dan produk ke view
    }

    public function show(Category $category)
    {
        // Dapatkan semua produk dari kategori tertentu dengan paginasi
        $products = $category->products()->paginate(12);

        // Kirim data kategori dan produk ke view
        return view('categories.show', compact('category', 'products'));
    }
}
