<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CompraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('compras')->insert([
            [
                'id_usuario' => 3,
                'id_vehiculo' => 3,
                'precio_final' => 22000.00,
                'fecha_compra' => now(),
                'estado' => 'pagado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => 4,
                'id_vehiculo' => 1,
                'precio_final' => 14500.00,
                'fecha_compra' => now(),
                'estado' => 'pendiente',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id_usuario' => 3,
                'id_vehiculo' => 5,
                'precio_final' => 9800.00,
                'fecha_compra' => now(),
                'estado' => 'cancelado',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
