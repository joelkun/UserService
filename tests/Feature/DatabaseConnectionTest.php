<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\DB;
use Tests\TestCase; // Extiende TestCase de Laravel

class DatabaseConnectionTest extends TestCase
{
    /** @test */
    public function testDatabaseConnection()
    {
        // Verifica que la conexión a la base de datos no sea nula
        $this->assertNotNull(DB::connection()->getPdo(), 'No se pudo establecer una conexión con la base de datos.');
    }
}
