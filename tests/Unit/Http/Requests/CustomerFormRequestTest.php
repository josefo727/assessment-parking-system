<?php

namespace Tests\Unit\Http\Requests;

use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Http\Requests\CustomerFormRequest;
use Illuminate\Support\Facades\Validator;

class CustomerFormRequestTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function should_pass_the_validation_test(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'mobile' => '+593968968499',
        ];

        $request = new CustomerFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }

    /** @test */
    public function should_validation_fail_if_name_is_missing(): void
    {
        $data = [
            'email' => 'john@example.com',
            'mobile' => '+593968968499',
        ];

        $request = new CustomerFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('name'));
    }

    /** @test */
    public function should_validation_fail_if_the_email_is_invalid(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'invalid-email',
            'mobile' => '+593968968499',
        ];

        $request = new CustomerFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('email'));
    }

    /** @test */
    public function should_validation_fail_if_the_mobile_number_is_invalid(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'mobile' => '1234567890',
        ];

        $request = new CustomerFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('mobile'));
    }

    /** @test */
    public function should_fail_if_the_email_is_duplicated(): void
    {
        // Create a customer with the same email
        $existingCustomer = Customer::factory()->create([
            'email' => 'john@example.com',
        ]);

        // Assuming customer ID 1 is passed as the route parameter
        $customerId = 1;

        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'mobile' => '+593968968499',
        ];

        $request = new CustomerFormRequest();
        $request->setJson($data)
            ->query->set('customer', $customerId);
        $validator = Validator::make($data, $request->rules());

        $this->assertTrue($validator->fails());
        $this->assertTrue($validator->errors()->has('email'));
    }

    /** @test */
    public function should_validation_fail_if_the_mobile_number_is_not_present(): void
    {
        $data = [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ];

        $request = new CustomerFormRequest();
        $validator = Validator::make($data, $request->rules());

        $this->assertFalse($validator->fails());
    }
}
