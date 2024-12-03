<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
        ]);

        // Create seller
        User::factory()->create([
            'name' => 'Seller',
            'email' => 'seller@example.com',
            'password' => Hash::make('seller123'),
            'role' => 'seller',
        ]);

        // Create regular buyer
        User::factory()->create([
            'name' => 'Buyer',
            'email' => 'buyer@example.com',
            'password' => Hash::make('buyer123'),
            'role' => 'buyer',
        ]);

        // Create random users
        User::factory(2)->buyer()->create();
        User::factory(3)->seller()->create();
        User::factory(2)->admin()->create();
    }
}
