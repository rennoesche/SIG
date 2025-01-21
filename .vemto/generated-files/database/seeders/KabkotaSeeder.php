<?php

namespace Database\Seeders;

use App\Models\Kabkota;
use Illuminate\Database\Seeder;

class KabkotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Kabkota::factory()
            ->count(5)
            ->create();
    }
}
