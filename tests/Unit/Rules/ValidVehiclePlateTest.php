<?php

namespace Tests\Unit\Rules;

use App\Rules\ValidVehiclePlate;
use Tests\TestCase;

class ValidVehiclePlateTest extends TestCase
{
    /** @test */
    public function should_pass_validation_with_valid_plate_number(): void
    {
        $rule = new ValidVehiclePlate();

        $this->assertTrue($rule->passes('plate', 'ABC-123'));
        $this->assertTrue($rule->passes('plate', 'ABC-1234'));
    }

    /** @test */
    public function should_fail_validation_with_invalid_plate_number(): void
    {
        $rule = new ValidVehiclePlate();

        $this->assertFalse($rule->passes('plate', 'ABCD-123'));
        $this->assertFalse($rule->passes('plate', 'ABC-12'));
        $this->assertFalse($rule->passes('plate', 'ABC-12345'));
    }

    /** @test */
    public function should_return_correct_error_message(): void
    {
        $rule = new ValidVehiclePlate();

        $this->assertEquals('El número de placa no es válido.', $rule->message());
    }
}
