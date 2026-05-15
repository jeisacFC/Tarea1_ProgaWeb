<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('usuarios')->insert([
            [
                'nombre'         => 'Admin Sistema',
                'email'          => 'admin@vehiculos.com',
                'password'       => Hash::make('password123'),
                'telefono'       => '88001100',
                'fecha_registro' => now(),
                'tipo_usuario'   => 'admin',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Carlos Vendedor',
                'email'          => 'carlos@vehiculos.com',
                'password'       => Hash::make('password123'),
                'telefono'       => '88112233',
                'fecha_registro' => now(),
                'tipo_usuario'   => 'vendedor',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'María Compradora',
                'email'          => 'maria@vehiculos.com',
                'password'       => Hash::make('password123'),
                'telefono'       => '87654321',
                'fecha_registro' => now(),
                'tipo_usuario'   => 'cliente',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Luis Pérez',
                'email'          => 'luis@vehiculos.com',
                'password'       => Hash::make('password123'),
                'telefono'       => '86543210',
                'fecha_registro' => now(),
                'tipo_usuario'   => 'cliente',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
            [
                'nombre'         => 'Ana Vendedora',
                'email'          => 'ana@vehiculos.com',
                'password'       => Hash::make('password123'),
                'telefono'       => '85432109',
                'fecha_registro' => now(),
                'tipo_usuario'   => 'vendedor',
                'created_at'     => now(),
                'updated_at'     => now(),
            ],
        ]);
    }
}