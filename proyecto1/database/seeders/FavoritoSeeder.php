<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoritoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('favoritos')->insert([
            [
                'id_usuario'     => 3,
                'id_vehiculo'    => 1,
                'fecha_agregado' => now(),
                'estado'         => true,
                'nota'           => 'Me interesa mucho este Toyota',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id_usuario'     => 3,
                'id_vehiculo'    => 4,
                'fecha_agregado' => now(),
                'estado'         => true,
                'nota'           => 'Buen precio el Kia',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'id_usuario'     => 4,
                'id_vehiculo'    => 2,
                'fecha_agregado' => now(),
                'estado'         => true,
                'nota'           => 'Honda en buen estado',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}
