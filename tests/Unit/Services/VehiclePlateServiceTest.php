<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\VehiclePlateService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VehiclePlateServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_generate_plate_number(): void
    {
        $vehiclePlateService = new VehiclePlateService();
        $plateNumber = $vehiclePlateService->generatePlateNumber();

        $pattern = '/^[A-Z]{3}-\d{3,4}$/';
        $this->assertMatchesRegularExpression($pattern, $plateNumber);
    }

    /** @test */
    public function should_validate_plate_number(): void
    {
        $vehiclePlateService = new VehiclePlateService();

        $validPlateNumber = 'AAB-0123';
        $this->assertTrue($vehiclePlateService->validatePlateNumber($validPlateNumber));

        $invalidPlateNumber = 'EC-ABCD-1234';
        $this->assertFalse($vehiclePlateService->validatePlateNumber($invalidPlateNumber));
    }
}
