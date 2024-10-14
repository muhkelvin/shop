<?php

namespace Database\Seeders;

use App\Models\CartItem;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Membuat 10 pengguna
        User::factory()->count(10)->create();

        // Membuat 5 kategori
        Category::factory()->count(5)->create();

        // Membuat 20 produk
        Product::factory()->count(20)->create();

        // Membuat 5 pesanan
        Order::factory()->count(5)->create();

        // Membuat 15 item di keranjang
        CartItem::factory()->count(15)->create();
    }
}
