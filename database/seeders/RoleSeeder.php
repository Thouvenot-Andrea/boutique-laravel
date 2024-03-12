<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
//        $permissions = Permission::inRandomOrder()->limit(random_int(1,10))->get();
//        Role::factory(2)->hasAttached($permissions)->create();

        $role = Role::factory()->create(['name' => 'admin']);
        $role->permissions()->attach(Permission::all());

        $role = Role::factory()->create(['name' => 'user']);
        $role->permissions()->attach(Permission::all());
    }
}
