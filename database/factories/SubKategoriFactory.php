<?php

namespace Database\Factories;

use App\Models\Kategori;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubKategori>
 */
class SubKategoriFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' =>fake()->name(),
            'slug' =>fake()->name(),
            'description' =>fake()->sentence(),
            'id_kategori'=> function() {
                return Kategori::inRandomOrder()->first()->id;
            },
            'status' =>rand(0,1)
        ];
    }
}
