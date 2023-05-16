<?php

namespace Tests\Unit\Http\Requests;

use Tests\TestCase;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\VehicleType;
use Database\Seeders\VehicleTypeSeeder;
use App\Http\Requests\VehicleFormRequest;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehicleFormRequestTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(VehicleTypeSeeder::class);
    }

    /** @test */
    public function should_pass_the_validation_test(): void
    {
        $customer = Customer::factory()->create();
        $vehicleType = VehicleType::factory()->create();

        $data = [
            'customer_id' => $customer->id,
            'plate' => 'ABC-123',
            'vehicle_type_id' => $vehicleType->id,
        ];

        $request = new VehicleFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function should_validation_fail_if_customer_id_is_missing(): void
    {
        $data = [
            'plate' => 'ABC-123',
            'vehicle_type_id' => 1,
        ];

        $request = new VehicleFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('customer_id'));
    }

    /** @test */
    public function should_validation_fail_if_customer_id_is_not_exists(): void
    {
        $data = [
            'customer_id' => 999,
            'plate' => 'ABC-123',
            'vehicle_type_id' => 1,
        ];

        $request = new VehicleFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('customer_id'));
    }

    /** @test */
    public function should_validation_fail_if_plate_is_missing(): void
    {
        $data = [
            'customer_id' => 1,
            'vehicle_type_id' => 1,
        ];

        $request = new VehicleFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('plate'));
    }

    /** @test */
    public function should_validation_fail_if_plate_is_not_unique(): void
    {
        $customer = Customer::factory()->create();
        $existingVehicle = Vehicle::factory()->create([
            'plate' => 'ABC-123',
        ]);

        $data = [
            'customer_id' => $customer->id,
            'plate' => 'ABC-123',
            'vehicle_type_id' => 1,
        ];

        $request = new VehicleFormRequest();
        $request->setJson($data)
            ->query->set('vehicle', $existingVehicle->id);
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('plate'));
    }

    /** @test */
    public function should_validation_fail_if_vehicle_type_id_is_missing(): void
    {
        $data = [
            'customer_id' => 1,
            'plate' => 'ABC-123',
        ];

        $request = new VehicleFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('vehicle_type_id'));
    }

    /** @test */
    public function should_validation_fail_if_vehicle_type_id_is_not_exists(): void
    {
        $data = [
            'customer_id' => 1,
            'plate' => 'ABC-123',
            'vehicle_type_id' => 999,
        ];

        $request = new VehicleFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('vehicle_type_id'));
    }

    /** @test */
    public function should_validation_pass_if_all_fields_are_valid(): void
    {
        $customer = Customer::factory()->create();
        $vehicleType = VehicleType::factory()->create();

        $data = [
            'customer_id' => $customer->id,
            'plate' => 'ABC-123',
            'vehicle_type_id' => $vehicleType->id,
        ];

        $request = new VehicleFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }
}

