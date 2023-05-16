<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\PhoneNumberService;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PhoneNumberServiceTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_generate_phone_number(): void
    {
        $phoneNumberService = new PhoneNumberService();
        $phoneNumber = $phoneNumberService->generatePhoneNumber();

        $this->assertMatchesRegularExpression('/^\+593(96|99|98|97|95)\d{7}$/', $phoneNumber);
    }

    /** @test */
    public function should_validate_phone_number(): void
    {
        $phoneNumberService = new PhoneNumberService();

        $validPhoneNumber = '+593981234567';
        $this->assertTrue($phoneNumberService->validatePhoneNumber($validPhoneNumber));

        $invalidPhoneNumber = '123456789';
        $this->assertFalse($phoneNumberService->validatePhoneNumber($invalidPhoneNumber));
    }
}
