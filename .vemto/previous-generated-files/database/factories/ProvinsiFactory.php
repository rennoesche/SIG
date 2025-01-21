<?php

namespace Database\Factories;

use App\Models\Provinsi;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProvinsiFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Provinsi::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'populasi' => fake()->word(),
            'latitude' => fake()->latitude(),
            'longitude' => fake()->longitude(),
            'geometry' => fake()->word(),
            'nama' => fake()->name(),
        ];
    }
}
