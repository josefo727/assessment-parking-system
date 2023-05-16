<?php

namespace Tests\Unit\Database\Migrations;

use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Schema;

class RecordsTableMigrationTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /** @test */
    public function should_have_expected_columns_in_records_table(): void
    {
        // Ejecutar la migración
        $this->artisan('migrate');

        // Verificar que la tabla "records" existe en la base de datos
        $this->assertTrue(Schema::hasTable('records'));

        // Verificar que los campos esperados existen en la tabla "records"
        $this->assertTrue(Schema::hasColumn('records', 'id'));
        $this->assertTrue(Schema::hasColumn('records', 'vehicle_id'));
        $this->assertTrue(Schema::hasColumn('records', 'entry_at'));
        $this->assertTrue(Schema::hasColumn('records', 'exit_at'));
        $this->assertTrue(Schema::hasColumn('records', 'created_at'));
        $this->assertTrue(Schema::hasColumn('records', 'updated_at'));
    }
}
