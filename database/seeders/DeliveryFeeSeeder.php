<?php

namespace Database\Seeders;

use App\Models\DeliveryFee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliveryFeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Use DeliveryFeeFactory
        DeliveryFee::factory(10)->create();
    }
}
