<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    // Menampilkan produk-produk di wishlist
    public function index()
    {
        // Ambil semua item wishlist dari pengguna yang sedang login
        $wishlistItems = Wishlist::where('user_id', Auth::id())->with('product')->get();

        return view('wishlist.index', compact('wishlistItems'));  // Kirim data wishlist ke view
    }

    // Menambahkan produk ke wishlist
    public function add(Product $product)
    {
        // Cek apakah produk sudah ada di wishlist pengguna
        $existingWishlistItem = Wishlist::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->first();

        if ($existingWishlistItem) {
            return redirect()->back()->with('info', 'Produk ini sudah ada di wishlist Anda.');
        }

        // Tambahkan produk ke wishlist
        Wishlist::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
        ]);

        return redirect()->route('wishlist.index')->with('success', 'Produk berhasil ditambahkan ke wishlist.');
    }

    // Menghapus produk dari wishlist
    public function remove(Wishlist $wishlist)
    {
        // Pastikan item wishlist yang akan dihapus milik pengguna yang sedang login
        if ($wishlist->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan menghapus item ini dari wishlist.');
        }

        // Hapus item wishlist
        $wishlist->delete();

        return redirect()->route('wishlist.index')->with('success', 'Produk berhasil dihapus dari wishlist.');
    }
}
