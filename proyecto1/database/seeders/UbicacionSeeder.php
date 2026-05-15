<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UbicacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ubicaciones')->insert([
            [
                'ciudad'         => 'San José',
                'pais'           => 'Costa Rica',
                'direccion'      => 'Avenida Central 100',
                'latitud'        => 9.928069,
                'longitud'       => -84.090725,
                'codigo_postal'  => '10101',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'ciudad'         => 'Alajuela',
                'pais'           => 'Costa Rica',
                'direccion'      => 'Calle 5, Barrio El Carmen',
                'latitud'        => 10.015370,
                'longitud'       => -84.214553,
                'codigo_postal'  => '20101',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'ciudad'         => 'Heredia',
                'pais'           => 'Costa Rica',
                'direccion'      => 'Avenida 2, Centro',
                'latitud'        => 9.998600,
                'longitud'       => -84.116600,
                'codigo_postal'  => '40101',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'ciudad'         => 'Cartago',
                'pais'           => 'Costa Rica',
                'direccion'      => 'Calle 1, Barrio Asís',
                'latitud'        => 9.863600,
                'longitud'       => -83.919700,
                'codigo_postal'  => '30101',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'ciudad'         => 'Liberia',
                'pais'           => 'Costa Rica',
                'direccion'      => 'Avenida Central, Guanacaste',
                'latitud'        => 10.633600,
                'longitud'       => -85.440500,
                'codigo_postal'  => '50101',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}