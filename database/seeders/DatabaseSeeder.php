<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            AddressSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            DeliveryFeeSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            OrderLineSeeder::class,
            CommentSeeder::class,
            DiscountSeeder::class,
            WishlistSeeder::class,
            RecommendationSeeder::class,
        ]);
    }
}
