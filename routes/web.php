<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\WishlistController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\OrderController as AdminOrderController;
use Illuminate\Support\Facades\Route;


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/',function () {
    return view('welcome');
});

// Produk dan Kategori untuk Customer
Route::get('/products', [ProductController::class, 'index'])->name('products.index');  // Menampilkan semua produk
Route::get('/products/{product}', [ProductController::class, 'show'])->name('products.show');  // Menampilkan detail produk menggunakan model binding

Route::get('/categories/{category}', [CategoryController::class, 'show'])->name('categories.show');  // Menampilkan produk berdasarkan kategori menggunakan model binding
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');  // Menampilkan produk berdasarkan kategori menggunakan model binding

// Keranjang Belanja untuk Customer
Route::middleware(['auth', 'role:customer'])->group(function () {


    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');  // Menampilkan keranjang belanja
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');  // Menambahkan produk ke keranjang
    Route::patch('/cart/update/{cartItem}', [CartController::class, 'update'])->name('cart.update');  // Mengubah jumlah item dalam keranjang
    Route::delete('/cart/remove/{cartItem}', [CartController::class, 'remove'])->name('cart.remove');  // Menghapus produk dari keranjang

    // Checkout untuk Customer
    Route::get('/checkout', [OrderController::class, 'create'])->name('checkout.index');  // Halaman checkout
    Route::post('/checkout', [OrderController::class, 'store'])->name('checkout.store');  // Proses checkout dan membuat pesanan

    // Pesanan untuk Customer
    Route::get('/orders', [OrderController::class, 'index'])->name('orders.index');  // Riwayat pesanan pengguna
    Route::get('/orders/{order}', [OrderController::class, 'show'])->name('orders.show');  // Detail pesanan menggunakan model binding

    // Review Produk untuk Customer
    Route::post('/products/{product}/review', [ReviewController::class, 'store'])->name('reviews.store');  // Tambah ulasan produk
    Route::get('/products/{product}/reviews', [ReviewController::class, 'index'])->name('reviews.index');  // Lihat semua ulasan untuk produk

    // Wishlist untuk Customer
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');  // Menampilkan wishlist
    Route::post('/wishlist/add/{product}', [WishlistController::class, 'add'])->name('wishlist.add');  // Tambah produk ke wishlist
    Route::delete('/wishlist/remove/{wishlist}', [WishlistController::class, 'remove'])->name('wishlist.remove');  // Hapus produk dari wishlist
    Route::get('/customer/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->name('customer.dashboard');  // Rute dashboard customer


});

// Grouping routes untuk admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {

    // Manajemen Produk untuk Admin
    Route::get('/products', [AdminProductController::class, 'index'])->name('admin.products.index');  // Menampilkan semua produk
    Route::get('/products/create', [AdminProductController::class, 'create'])->name('admin.products.create');  // Halaman buat produk baru
    Route::post('/products', [AdminProductController::class, 'store'])->name('admin.products.store');  // Simpan produk baru
    Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('admin.products.edit');  // Halaman edit produk
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('admin.products.update');  // Update produk
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('admin.products.destroy');  // Hapus produk

    // Manajemen Kategori untuk Admin
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('admin.categories.index');  // Menampilkan semua kategori
    Route::get('/categories/create', [AdminCategoryController::class, 'create'])->name('admin.categories.create');  // Halaman buat kategori baru
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('admin.categories.store');  // Simpan kategori baru
    Route::get('/categories/{category}/edit', [AdminCategoryController::class, 'edit'])->name('admin.categories.edit');  // Halaman edit kategori
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('admin.categories.update');  // Update kategori
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('admin.categories.destroy');  // Hapus kategori

    // Manajemen Pesanan untuk Admin
    Route::get('/orders', [AdminOrderController::class, 'index'])->name('admin.orders.index');  // Menampilkan semua pesanan
    Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('admin.orders.show');  // Menampilkan detail pesanan
    Route::put('/orders/{order}', [AdminOrderController::class, 'update'])->name('admin.orders.update');  // Update status pesanan
});

