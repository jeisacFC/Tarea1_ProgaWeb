<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PagoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('pagos')->insert([
            [
                'id_compra'   => 1,
                'metodo_pago' => 'transferencia',
                'monto'       => 22000.00,
                'fecha_pago'  => now(),
                'estado'      => 'completado',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'id_compra'   => 2,
                'metodo_pago' => 'efectivo',
                'monto'       => 5000.00,
                'fecha_pago'  => now(),
                'estado'      => 'parcial',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}