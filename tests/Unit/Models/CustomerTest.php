<?php

namespace Tests\Unit\Models;

use App\Models\Customer;
use App\Models\Record;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_checks_if_customer_registered_from_all_categories_last_month(): void
    {
        $customer = Customer::factory()->create();
        $vehicleTypes = VehicleType::factory()->count(3)->create();

        $vehicleTypeIds = $vehicleTypes->pluck('id')->toArray();
        $vehicles = Vehicle::factory()->count(3)->create(['customer_id' => $customer->id]);

        // Create records for each vehicle type
        foreach ($vehicles as $index => $vehicle) {
            Record::factory()->create([
                'vehicle_id' => $vehicle->id,
                'entry_at' => now()->subMonth()->subHours(random_int(2,8))->subMinutes(random_int(1, 59)),
                'exit_at' => now()->subMonth(),
            ]);

            // Assign a unique vehicle type to each vehicle
            $vehicle->update(['vehicle_type_id' => $vehicleTypeIds[$index]]);
        }

        // Create an extra record for a vehicle type that is not owned by the customer
        Record::factory()->create([
            'vehicle_id' => Vehicle::factory()->create(['vehicle_type_id' => $vehicleTypeIds[2]])->id,
            'exit_at' => now()->subMonth(),
        ]);

        $this->assertTrue($customer->registeredFromAllCategoriesLastMonth());

        // Delete one record, which makes the customer not registered from all categories
        Record::query()->first()->delete();

        $this->assertFalse($customer->registeredFromAllCategoriesLastMonth());
    }

    /** @test */
    public function should_checks_if_customer_is_the_first_entry_of_the_month(): void
    {
        VehicleType::factory()->count(3)->create();
        $customer = Customer::factory()->create();
        $vehicle = Vehicle::factory()->create(['customer_id' => $customer->id]);

        // Create records for each vehicle
        Record::factory()->create([
            'vehicle_id' => $vehicle->id,
            'entry_at' => now(),
            'exit_at' => null,
        ]);

        // Create an extra record for another customer
        $customer2 = Customer::factory()->create();
        $vehicle2 = Vehicle::factory()->create(['customer_id' => $customer2->id]);

        Record::factory()->create([
            'vehicle_id' => $vehicle2->id,
            'entry_at' => now(),
            'exit_at' => null
        ]);

        $this->assertTrue($customer->isTheFirstEntryOfTheMonth());

        // Create another record for the customer, which makes them not the first entry
        $vehicle3 = Vehicle::factory()->create(['customer_id' => $customer->id]);
        Record::factory()->create([
            'vehicle_id' => $vehicle3->id,
            'entry_at' => now(),
        ]);

        $this->assertFalse($customer->isTheFirstEntryOfTheMonth());
    }
}
