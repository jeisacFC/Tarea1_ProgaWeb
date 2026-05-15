<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ResenaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('resenas')->insert([
            [
                'id_usuario'  => 3,
                'id_vehiculo' => 3,
                'calificacion' => 5,
                'comentario'  => 'Excelente vehículo, muy bien cuidado. Lo recomiendo.',
                'fecha'       => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_usuario'  => 4,
                'id_vehiculo' => 1,
                'calificacion' => 4,
                'comentario'  => 'Buen estado general, el precio es justo.',
                'fecha'       => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_usuario'  => 3,
                'id_vehiculo' => 2,
                'calificacion' => 3,
                'comentario'  => 'Aceptable, pero necesita afinación.',
                'fecha'       => now(),
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
