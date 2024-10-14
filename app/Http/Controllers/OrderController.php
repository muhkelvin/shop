<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    // Menampilkan halaman checkout
    public function create()
    {
        $cartItems = CartItem::where('user_id', Auth::id())->get();  // Ambil item keranjang untuk pengguna

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        return view('checkout.index', compact('cartItems'));  // Kirim item keranjang ke halaman checkout
    }

    // Memproses pesanan dan menyimpannya
    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|max:255',
            'payment_method' => 'required|string',
        ]);

        $cartItems = CartItem::where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang belanja Anda kosong.');
        }

        // Buat pesanan baru
        $order = Order::create([
            'user_id' => Auth::id(),
            'shipping_address' => $request->shipping_address,
            'payment_method' => $request->payment_method,
            'total_price' => $cartItems->sum(fn($item) => $item->product->price * $item->quantity),
        ]);

        // Tambahkan item dari keranjang ke pesanan
        foreach ($cartItems as $cartItem) {
            $order->orderItems()->create([
                'product_id' => $cartItem->product_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->product->price,
            ]);

            $cartItem->delete();  // Hapus item dari keranjang
        }

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat.');
    }


    // Menampilkan riwayat pesanan
    public function index()
    {
        $orders = Order::where('user_id', Auth::id())->get();  // Ambil pesanan pengguna yang login

        return view('orders.index', compact('orders'));  // Kirim data pesanan ke view
    }

    // Menampilkan detail pesanan
    public function show(Order $order)
    {
        // Pastikan pesanan milik pengguna yang login
        if ($order->user_id !== Auth::id()) {
            abort(403, 'Anda tidak diizinkan melihat pesanan ini.');
        }

        return view('orders.show', compact('order'));  // Kirim data pesanan ke view
    }
}
