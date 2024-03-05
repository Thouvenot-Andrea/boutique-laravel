<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::factory(3)->create();
        Wishlist::factory(1)->hasAttached($products)->create();
    }
}
