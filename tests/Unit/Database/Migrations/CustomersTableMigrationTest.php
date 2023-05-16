<?php

namespace Tests\Unit\Database\Migrations;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class CustomersTableMigrationTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function should_have_expected_columns_in_customers_table(): void
    {
        // Ejecutar la migración
        $this->artisan('migrate');

        // Verificar que la tabla "customers" existe en la base de datos
        $this->assertTrue(Schema::hasTable('customers'));

        // Verificar que los campos esperados existen en la tabla "customers"
        $this->assertTrue(Schema::hasColumn('customers', 'id'));
        $this->assertTrue(Schema::hasColumn('customers', 'name'));
        $this->assertTrue(Schema::hasColumn('customers', 'email'));
        $this->assertTrue(Schema::hasColumn('customers', 'mobile'));
        $this->assertTrue(Schema::hasColumn('vehicle_types', 'created_at'));
        $this->assertTrue(Schema::hasColumn('vehicle_types', 'updated_at'));
    }
}

