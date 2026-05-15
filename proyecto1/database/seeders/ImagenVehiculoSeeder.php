<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImagenVehiculoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('imagenes_vehiculo')->insert([
            [
                'id_vehiculo'  => 1,
                'url_imagen'   => 'images/toyota_corolla_1.jpg',
                'descripcion'  => 'Vista frontal',
                'orden'        => 1,
                'fecha_subida' => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_vehiculo'  => 1,
                'url_imagen'   => 'images/toyota_corolla_2.jpg',
                'descripcion'  => 'Vista lateral',
                'orden'        => 2,
                'fecha_subida' => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_vehiculo'  => 2,
                'url_imagen'   => 'images/honda_civic_1.jpg',
                'descripcion'  => 'Vista frontal',
                'orden'        => 1,
                'fecha_subida' => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_vehiculo'  => 3,
                'url_imagen'   => 'images/hyundai_tucson_1.jpg',
                'descripcion'  => 'Vista frontal',
                'orden'        => 1,
                'fecha_subida' => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
            [
                'id_vehiculo'  => 4,
                'url_imagen'   => 'images/kia_sportage_1.jpg',
                'descripcion'  => 'Vista frontal',
                'orden'        => 1,
                'fecha_subida' => now(),
                'created_at'   => now(),
                'updated_at'   => now(),
            ],
        ]);
    }
}
