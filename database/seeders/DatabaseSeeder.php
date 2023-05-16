<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        \App\Models\User::factory()->create([
            'name' => 'José R. Gutierrez',
            'email' => 'josefo727@gmail.com'
        ]);

        $this->call(CustomerSeeder::class);
        $this->call(VehicleTypeSeeder::class);
        $this->call(VehicleSeeder::class);
    }
}
