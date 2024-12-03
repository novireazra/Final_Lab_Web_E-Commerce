<?php

namespace Database\Seeders;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RestaurantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create 5 sellers with restaurants
        User::factory()
            ->count(5)
            ->state(['role' => 'seller'])
            ->has(
                Restaurant::factory()
                    ->state(function (array $attributes, User $user) {
                        return ['id_seller' => $user->id];
                    })
            )
            ->create();
    }
}
