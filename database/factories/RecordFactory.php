<?php

namespace Database\Factories;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecordFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'vehicle_id' => Vehicle::query()->inRandomOrder()->first()->id,
            'entry_at' => now()->subHour()->subMinutes(random_int(1, 59)),
            'exit_at' => now(),
            'total_amount' => random_int(1,5)
        ];
    }
}
