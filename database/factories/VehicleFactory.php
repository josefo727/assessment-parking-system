<?php

namespace Database\Factories;

use App\Models\Customer;
use App\Models\VehicleType;
use App\Services\VehiclePlateService;
use Illuminate\Database\Eloquent\Factories\Factory;

class VehicleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'customer_id' => Customer::query()->inRandomOrder()->first()->id,
            'plate' => app(VehiclePlateService::class)->generatePlateNumber(),
            'vehicle_type_id' => VehicleType::query()->inRandomOrder()->first()->id,
        ];
    }
}
