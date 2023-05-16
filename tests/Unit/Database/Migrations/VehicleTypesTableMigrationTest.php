<?php

namespace Tests\Unit\Database\Migrations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class VehicleTypesTableMigrationTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function should_have_expected_columns_in_vehicle_types_table(): void
    {
        // Ejecutar la migración
        $this->artisan('migrate');

        // Verificar que la tabla "vehicle_types" existe en la base de datos
        $this->assertTrue(Schema::hasTable('vehicle_types'));

        // Verificar que los campos esperados existen en la tabla "vehicle_types"
        $this->assertTrue(Schema::hasColumn('vehicle_types', 'id'));
        $this->assertTrue(Schema::hasColumn('vehicle_types', 'name'));
        $this->assertTrue(Schema::hasColumn('vehicle_types', 'hourly_rate'));
        $this->assertTrue(Schema::hasColumn('vehicle_types', 'created_at'));
        $this->assertTrue(Schema::hasColumn('vehicle_types', 'updated_at'));
    }
}
