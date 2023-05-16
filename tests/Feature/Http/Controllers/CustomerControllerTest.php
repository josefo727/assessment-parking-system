<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Customer;
use Tests\TestCase;

class CustomerControllerTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create();
        $this->actingAs($user);
    }


    /** @test */
    public function should_get_customer_index(): void
    {
        $response = $this->get(route('customers.index'));

        $response->assertStatus(200);
        $response->assertViewIs('customers.index');
    }

    /** @test */
    public function should_show_create_customer_form(): void
    {
        $response = $this->get(route('customers.create'));

        $response->assertStatus(200);
        $response->assertViewIs('customers.create');
    }

    /** @test */
    public function should_store_new_customer(): void
    {
        $data = Customer::factory()->make()->toArray();

        $response = $this->post(route('customers.store'), $data);

        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseHas('customers', $data);
    }

    /** @test */
    public function should_show_customer_details(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->get(route('customers.show', $customer));

        $response->assertStatus(200);
        $response->assertViewIs('customers.show');
    }

    /** @test */
    public function should_show_edit_customer_form(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->get(route('customers.edit', $customer));

        $response->assertStatus(200);
        $response->assertViewIs('customers.edit');
    }

    /** @test */
    public function should_update_customer_information(): void
    {
        $customer = Customer::factory()->create();

        $data = Customer::factory()->make()->toArray();

        $response = $this->put(route('customers.update', $customer), $data);

        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseHas('customers', $data);
    }

    /** @test */
    public function should_delete_customer(): void
    {
        $customer = Customer::factory()->create();

        $response = $this->delete(route('customers.destroy', $customer));

        $response->assertRedirect(route('customers.index'));
        $this->assertDatabaseMissing('customers', ['id' => $customer->id]);
    }
}
