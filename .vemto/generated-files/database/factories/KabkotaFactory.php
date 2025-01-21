<?php

namespace Database\Factories;

use App\Models\Kabkota;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class KabkotaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Kabkota::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'populasi' => fake()->word(),
            'geometry' => fake()->word(),
            'kodepos' => fake()->word(),
            'kecamatan' => fake()->word(),
            'desa' => fake()->word(),
            'islam' => fake()->word(),
            'kristen' => fake()->word(),
            'katolik' => fake()->word(),
            'hindu' => fake()->word(),
            'pk_petani' => fake()->word(),
            'pk_nelayan' => fake()->word(),
            'pk_pedagang' => fake()->word(),
            'pk_asn' => fake()->word(),
            'nama' => fake()->name(),
            'provinsi_id' => \App\Models\Provinsi::factory(),
        ];
    }
}
