<?php

namespace Database\Seeders;

use App\Models\User_Role;
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
            UserSeeder::class,
            DeliveryFeeSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            OrderSeeder::class,
            OrderLineSeeder::class,
            CommentSeeder::class,
            User_RoleSeeder::class,
            Role_PermissionSeeder::class,
            DiscountSeeder::class
        ]);
    }
}
