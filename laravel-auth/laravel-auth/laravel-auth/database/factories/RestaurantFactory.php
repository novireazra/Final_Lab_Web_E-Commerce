<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Restaurant>
 */
class RestaurantFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_seller' => User::factory()->create(['role' => 'seller'])->id,
            'nama_restaurant' => $this->faker->company,
            'deskripsi' => $this->faker->paragraph,
            'alamat' => $this->faker->address,
            'status_buka' => $this->faker->randomElement(['Open', 'Close']),
            'image' => null,
        ];
    }
}
