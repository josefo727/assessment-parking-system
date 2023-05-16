<?php

namespace Tests\Unit\Database\Migrations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class VehiclesTableMigrationTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function should_have_expected_columns_in_vehicles_table(): void
    {
        // Ejecutar la migración
        $this->artisan('migrate');

        // Verificar que la tabla "vehicles" existe en la base de datos
        $this->assertTrue(Schema::hasTable('vehicles'));

        // Verificar que los campos esperados existen en la tabla "vehicles"
        $this->assertTrue(Schema::hasColumn('vehicles', 'id'));
        $this->assertTrue(Schema::hasColumn('vehicles', 'customer_id'));
        $this->assertTrue(Schema::hasColumn('vehicles', 'plate'));
        $this->assertTrue(Schema::hasColumn('vehicles', 'vehicle_type_id'));
        $this->assertTrue(Schema::hasColumn('vehicles', 'created_at'));
        $this->assertTrue(Schema::hasColumn('vehicles', 'updated_at'));
    }
}
