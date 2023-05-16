<?php

namespace Tests\Unit\Rules;

use Tests\TestCase;
use App\Rules\ValidPhoneNumber;

class ValidPhoneNumberTest extends TestCase
{
    /** @test */
    public function should_validate_a_correct_phone_number(): void
    {
        $rule = new ValidPhoneNumber();
        $this->assertTrue($rule->passes('phone', '+593968968499'));
    }

    /** @test */
    public function should_not_validate_an_incorrect_phone_number(): void
    {
        $rule = new ValidPhoneNumber();
        $this->assertFalse($rule->passes('phone', 'abc123'));
    }

    /** @test */
    public function should_return_the_appropriate_error_message(): void
    {
        $rule = new ValidPhoneNumber();
        $this->assertEquals('El número de teléfono móvil no es válido.', $rule->message());
    }
}
