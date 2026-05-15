<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class VehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vehiculos')->insert([
            [
                'marca'             => 'Toyota',
                'modelo'            => 'Corolla',
                'anio'              => 2020,
                'precio'            => 15000.00,
                'descripcion'       => 'Excelente estado, único dueño, aire acondicionado.',
                'id_vendedor'       => 2,
                'id_ubicacion'      => 1,
                'estado'            => 'disponible',
                'fecha_publicacion' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'marca'             => 'Honda',
                'modelo'            => 'Civic',
                'anio'              => 2019,
                'precio'            => 13500.00,
                'descripcion'       => 'Motor en perfectas condiciones, llantas nuevas.',
                'id_vendedor'       => 2,
                'id_ubicacion'      => 2,
                'estado'            => 'disponible',
                'fecha_publicacion' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'marca'             => 'Hyundai',
                'modelo'            => 'Tucson',
                'anio'              => 2021,
                'precio'            => 22000.00,
                'descripcion'       => 'SUV familiar, cámara de reversa, pantalla táctil.',
                'id_vendedor'       => 5,
                'id_ubicacion'      => 3,
                'estado'            => 'vendido',
                'fecha_publicacion' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'marca'             => 'Kia',
                'modelo'            => 'Sportage',
                'anio'              => 2022,
                'precio'            => 25000.00,
                'descripcion'       => 'Recién importado, garantía de fábrica vigente.',
                'id_vendedor'       => 5,
                'id_ubicacion'      => 4,
                'estado'            => 'disponible',
                'fecha_publicacion' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
            [
                'marca'             => 'Nissan',
                'modelo'            => 'Sentra',
                'anio'              => 2018,
                'precio'            => 10000.00,
                'descripcion'       => 'Económico, buena condición general.',
                'id_vendedor'       => 2,
                'id_ubicacion'      => 5,
                'estado'            => 'disponible',
                'fecha_publicacion' => now(),
                'created_at'        => now(),
                'updated_at'        => now(),
            ],
        ]);
    }
}