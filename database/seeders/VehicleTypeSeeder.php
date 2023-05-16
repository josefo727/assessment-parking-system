<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\VehicleType;

class VehicleTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        VehicleType::factory()
            ->count(5)
            ->sequence(
                [
                    'name' => 'Motocicleta',
                    'hourly_rate' => 0.25
                ],
                [
                    'name' => 'Automóvil',
                    'hourly_rate' => 0.50
                ],
                [
                    'name' => 'Camioneta',
                    'hourly_rate' => 1.00
                ],
                [
                    'name' => 'Camión',
                    'hourly_rate' => 1.50
                ],
                [
                    'name' => 'Autobús',
                    'hourly_rate' => 2.00
                ],
            )
            ->create();
    }
}
