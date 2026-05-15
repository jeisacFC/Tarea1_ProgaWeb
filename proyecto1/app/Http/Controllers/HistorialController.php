<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class HistorialController extends Controller
{
    public function index()
    {
        try {
            $historial = DB::table('compras')
                ->join('usuarios', 'compras.id_usuario', '=', 'usuarios.id_usuario')
                ->join('vehiculos', 'compras.id_vehiculo', '=', 'vehiculos.id_vehiculo')
                ->join('pagos', 'pagos.id_compra', '=', 'compras.id_compra')
                ->join('resenas', 'resenas.id_vehiculo', '=', 'vehiculos.id_vehiculo')
                ->join('favoritos', 'favoritos.id_vehiculo', '=', 'vehiculos.id_vehiculo')
                ->join('ubicaciones', 'ubicaciones.id_ubicacion', '=', 'vehiculos.id_ubicacion')
                ->select(
                    'compras.id_compra',
                    'usuarios.nombre        as nombre_usuario',
                    'vehiculos.marca',
                    'vehiculos.modelo',
                    'compras.precio_final',
                    'compras.estado         as estado_compra',
                    'pagos.metodo_pago',
                    'pagos.monto            as monto_pago',
                    'resenas.calificacion',
                    'ubicaciones.ciudad',
                    'compras.fecha_compra'
                )
                ->orderBy('compras.fecha_compra', 'desc')
                ->get();

            return view('historial.index', compact('historial'));
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al cargar historial: ' . $e->getMessage());
        }
    }
}