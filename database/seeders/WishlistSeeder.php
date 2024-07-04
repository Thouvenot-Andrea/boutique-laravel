<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Database\Seeder;

class WishlistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = Product::inRandomOrder()->limit(3)->get();
        Wishlist::factory(1)->hasAttached($products)->create();
    }
}
