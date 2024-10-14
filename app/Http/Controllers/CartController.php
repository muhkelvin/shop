<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Menampilkan item di keranjang belanja pengguna
    public function index()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();  // Dapatkan item keranjang dari pengguna yang login

        return view('cart.index', compact('cartItems'));  // Kirim data item keranjang ke view
    }

    // Menambahkan produk ke keranjang
    public function add(Product $product)
    {
        // Cek apakah produk sudah ada di keranjang
        $cartItem = CartItem::where('product_id', $product->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($cartItem) {
            // Jika sudah ada, tambahkan jumlahnya
            $cartItem->increment('quantity');
        } else {
            // Jika belum ada, tambahkan ke keranjang
            CartItem::create([
                'user_id' => Auth::id(),
                'product_id' => $product->id,
                'quantity' => 1,
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Produk berhasil ditambahkan ke keranjang.');
    }

    // Mengupdate jumlah item di keranjang
    public function update(CartItem $cartItem, Request $request)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $cartItem->update(['quantity' => $request->quantity]);  // Update jumlah item

        return redirect()->route('cart.index')->with('success', 'Jumlah produk berhasil diperbarui.');
    }

    // Menghapus produk dari keranjang
    public function remove(CartItem $cartItem)
    {
        $cartItem->delete();  // Hapus item dari keranjang

        return redirect()->route('cart.index')->with('success', 'Produk berhasil dihapus dari keranjang.');
    }
}
