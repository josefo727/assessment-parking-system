<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VehicleControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();

        Customer::factory(10)->create();

        VehicleType::factory(10)->create();

        $this->actingAs($user);
    }

    /** @test */
    public function should_get_vehicle_index(): void
    {
        $response = $this->get(route('vehicles.index'));

        $response->assertStatus(200);
        $response->assertViewIs('vehicles.index');
    }

    /** @test */
    public function should_show_create_vehicle_form(): void
    {
        $response = $this->get(route('vehicles.create'));

        $response->assertStatus(200);
        $response->assertViewIs('vehicles.create');
    }

    /** @test */
    public function should_store_new_vehicle(): void
    {
        $customer = Customer::factory()->create();
        $vehicleType = VehicleType::factory()->create();
        $data = Vehicle::factory()->make([
            'customer_id' => $customer->id,
            'vehicle_type_id' => $vehicleType->id,
        ])->toArray();

        $response = $this->post(route('vehicles.store'), $data);

        $response->assertRedirect(route('vehicles.index'));
        $this->assertDatabaseHas('vehicles', $data);
    }

    /** @test */
    public function should_show_vehicle_details(): void
    {
        $vehicle = Vehicle::factory()->create();

        $response = $this->get(route('vehicles.show', $vehicle));

        $response->assertStatus(200);
        $response->assertViewIs('vehicles.show');
    }

    /** @test */
    public function should_show_edit_vehicle_form(): void
    {
        $vehicle = Vehicle::factory()->create();

        $response = $this->get(route('vehicles.edit', $vehicle));

        $response->assertStatus(200);
        $response->assertViewIs('vehicles.edit');
    }

    /** @test */
    public function should_update_vehicle_information(): void
    {
        $vehicle = Vehicle::factory()->create();
        $customer = Customer::factory()->create();
        $vehicleType = VehicleType::factory()->create();
        $data = Vehicle::factory()->make([
            'customer_id' => $customer->id,
            'vehicle_type_id' => $vehicleType->id,
        ])->toArray();

        $response = $this->put(route('vehicles.update', $vehicle), $data);

        $response->assertRedirect(route('vehicles.index'));
        $this->assertDatabaseHas('vehicles', $data);
    }

    /** @test */
    public function should_delete_vehicle(): void
    {
        $vehicle = Vehicle::factory()->create();

        $response = $this->delete(route('vehicles.destroy', $vehicle));

        $response->assertRedirect(route('vehicles.index'));
        $this->assertDatabaseMissing('vehicles', ['id' => $vehicle->id]);
    }
}
