<?php

namespace Database\Factories;

use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Menu>
 */
class MenuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_restaurant' => Restaurant::factory(),
            'nama_menu' => $this->faker->words(3, true),
            'deskripsi_menu' => $this->faker->sentence,
            'harga' => $this->faker->numberBetween(10000, 100000),
            'status' => $this->faker->randomElement(['Available', 'Unavailable']),
            'kategori' => $this->faker->randomElement(['Main Course', 'Appetizer', 'Dessert', 'Beverage']),
            'stock' => $this->faker->numberBetween(0, 100),
            'image' => null,
        ];
    }
}
