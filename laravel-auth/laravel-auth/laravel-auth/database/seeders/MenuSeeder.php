<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\Restaurant;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get all restaurants
        $restaurants = Restaurant::all();

        // Create 5 menus for each restaurant
        $restaurants->each(function ($restaurant) {
            Menu::factory()
                ->count(5)
                ->create([
                    'id_restaurant' => $restaurant->id
                ]);
        });
    }
}
