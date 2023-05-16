<?php

namespace Tests\Feature\Http\Livewire;

use App\Http\Livewire\Register;
use App\Models\Record;
use App\Models\Vehicle;
use Database\Seeders\CustomerSeeder;
use Database\Seeders\VehicleTypeSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Carbon;
use Livewire\Livewire;
use Tests\TestCase;

class RegisterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        $this->seed(CustomerSeeder::class);
        $this->seed(VehicleTypeSeeder::class);
    }

    /** @test */
    public function should_renders_the_register_component(): void
    {
        Livewire::test(Register::class)
            ->assertViewIs('livewire.register');
    }

    /** @test */
    public function should_sets_vehicles_when_mounting_the_component(): void
    {
        Vehicle::factory()->count(3)->create();

        $expect = Vehicle::query()
            ->with(['customer', 'vehicleType'])
            ->orderBy('id', 'desc')
            ->get();

        Livewire::test(Register::class)
            ->assertSet('vehicles', $expect);
    }

    /** @test */
    public function should_sets_vehicles_based_on_search_input(): void
    {
        Vehicle::factory()->create(['plate' => 'ABC123']);
        Vehicle::factory()->create(['plate' => 'DEF456']);
        Vehicle::factory()->create(['plate' => 'GHI789']);

        $expect = Vehicle::query()
            ->with(['customer', 'vehicleType'])
            ->orderBy('id', 'desc')
            ->where('plate', 'LIKE', '%ABC%')
            ->get();

        Livewire::test(Register::class)
            ->set('search', 'ABC')
            ->assertSet('vehicles', $expect);
    }

    /** @test */
    public function should_selects_a_vehicle_and_sets_related_records(): void
    {
        $vehicle = Vehicle::factory()->create();
        Record::factory()->create([
            'vehicle_id' => $vehicle->id,
            'entry_at' => Carbon::yesterday(),
            'exit_at' => null,
        ]);
        Record::factory()->create([
            'vehicle_id' => $vehicle->id,
            'entry_at' => now(),
            'exit_at' => now(),
        ]);

        Livewire::test(Register::class)
            ->call('selectVehicle', $vehicle->id)
            ->assertSet('selectedVehicleId', $vehicle->id)
            ->assertSet('records', Record::query()->where('vehicle_id', $vehicle->id)->get())
            ->assertSet('canRecordIncome', false);
    }

    /** @test */
    public function should_records_income_for_a_selected_vehicle(): void
    {
        $vehicle = Vehicle::factory()->create();

        Livewire::test(Register::class)
            ->set('selectedVehicleId', $vehicle->id)
            ->call('recordIncome');

        $this->assertDatabaseHas('records', [
            'vehicle_id' => $vehicle->id,
            'entry_at' => Carbon::now(),
        ]);
    }

    /** @test */
    public function should_records_outflow_for_a_selected_vehicle_record(): void
    {
        Vehicle::factory()->create();

        $record = Record::factory()->create();

        Livewire::test(Register::class)
            ->set('selectedVehicleId', $record->vehicle_id)
            ->call('recordOutflow', $record->id);

        $this->assertDatabaseHas('records', [
            'id' => $record->id,
            'exit_at' => Carbon::now(),
        ]);
    }
}
