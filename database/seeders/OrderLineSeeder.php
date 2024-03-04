<?php

namespace Database\Seeders;

use App\Models\OrderLine;
use App\Models\Product;
use Illuminate\Database\Seeder;

class OrderLineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderLine::factory(10)->create();
    }
}
