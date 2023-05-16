<?php

namespace Tests\Unit\Http\Requests;

use App\Http\Requests\VehicleTypeFormRequest;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Validator;
use App\Models\VehicleType;
use Tests\TestCase;

class VehicleTypeFormRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_pass_the_validation_test(): void
    {
        $data = [
            'name' => 'Sedan',
            'hourly_rate' => 5.50,
        ];

        $request = new VehicleTypeFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function should_validation_fail_if_name_is_missing(): void
    {
        $data = [
            'hourly_rate' => 5.50,
        ];

        $request = new VehicleTypeFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('name'));
    }

    /** @test */
    public function should_validation_fail_if_name_is_not_unique(): void
    {
        // Create a vehicle type with the same name
        $existingVehicleType = VehicleType::factory()->create([
            'name' => 'Sedan',
        ]);

        $data = [
            'name' => 'Sedan',
            'hourly_rate' => 5.50,
        ];

        $request = new VehicleTypeFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('name'));
    }

    /** @test */
    public function should_validation_fail_if_hourly_rate_is_missing(): void
    {
        $data = [
            'name' => 'Sedan',
        ];

        $request = new VehicleTypeFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('hourly_rate'));
    }

    /** @test */
    public function should_validation_fail_if_hourly_rate_is_not_numeric(): void
    {
        $data = [
            'name' => 'Sedan',
            'hourly_rate' => 'invalid',
        ];

        $request = new VehicleTypeFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('hourly_rate'));
    }

    /** @test */
    public function should_validation_fail_if_hourly_rate_is_less_than_0_01(): void
    {
        $data = [
            'name' => 'Sedan',
            'hourly_rate' => 0.005,
        ];

        $request = new VehicleTypeFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('hourly_rate'));
    }

    /** @test */
    public function should_validation_fail_if_hourly_rate_is_greater_than_100_00(): void
    {
        $data = [
            'name' => 'Sedan',
            'hourly_rate' => 150.00,
        ];

        $request = new VehicleTypeFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('hourly_rate'));
    }

    /** @test */
    public function should_validation_pass_if_hourly_rate_is_0_01(): void
    {
        $data = [
            'name' => 'Sedan',
            'hourly_rate' => 0.01,
        ];

        $request = new VehicleTypeFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function should_validation_pass_if_hourly_rate_is_100_00(): void
    {
        $data = [
            'name' => 'Sedan',
            'hourly_rate' => 100.00,
        ];

        $request = new VehicleTypeFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }
}
