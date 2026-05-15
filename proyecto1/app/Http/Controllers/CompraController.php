<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compra;
use App\Models\Usuario;
use App\Models\Vehiculo;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $compras = Compra::with(['usuario', 'vehiculo', 'pagos'])
                ->orderBy('id_compra', 'desc')
                ->get();
            return view('compras.index', compact('compras'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar compras: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = Usuario::where('tipo_usuario', 'cliente')->get();
        $vehiculos = Vehiculo::where('estado', 'disponible')->get();
        return view('compras.create', compact('usuarios', 'vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'id_vehiculo' => 'required|exists:vehiculos,id_vehiculo',
                'precio_final' => 'required|numeric|min:0',
                'estado' => 'required|in:pendiente,pagado,cancelado',
            ]);

            Compra::create([
                'id_usuario' => $request->id_usuario,
                'id_vehiculo' => $request->id_vehiculo,
                'precio_final' => $request->precio_final,
                'fecha_compra' => now(),
                'estado' => $request->estado,
            ]);

            // Si la compra se registra, marcar vehículo como vendido
            if ($request->estado === 'pagado') {
                Vehiculo::where('id_vehiculo', $request->id_vehiculo)
                    ->update(['estado' => 'vendido']);
            }

            return redirect()->route('compras.index')
                ->with('success', 'Compra registrada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar compra: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $compra = Compra::with(['usuario', 'vehiculo', 'pagos'])->findOrFail($id);
            return view('compras.show', compact('compra'));
        } catch (\Exception $e) {
            return redirect()->route('compras.index')
                ->with('error', 'Compra no encontrada.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $compra = Compra::findOrFail($id);
            $usuarios = Usuario::where('tipo_usuario', 'cliente')->get();
            $vehiculos = Vehiculo::all();
            return view('compras.edit', compact('compra', 'usuarios', 'vehiculos'));
        } catch (\Exception $e) {
            return redirect()->route('compras.index')
                ->with('error', 'Compra no encontrada.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $compra = Compra::findOrFail($id);

            $request->validate([
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'id_vehiculo' => 'required|exists:vehiculos,id_vehiculo',
                'precio_final' => 'required|numeric|min:0',
                'estado' => 'required|in:pendiente,pagado,cancelado',
            ]);

            $estadoAnterior = $compra->estado;
            $compra->update($request->all());

            // Actualizar estado del vehículo en cascada
            if ($request->estado === 'pagado' && $estadoAnterior !== 'pagado') {
                Vehiculo::where('id_vehiculo', $compra->id_vehiculo)
                    ->update(['estado' => 'vendido']);
            } elseif ($request->estado === 'cancelado') {
                Vehiculo::where('id_vehiculo', $compra->id_vehiculo)
                    ->update(['estado' => 'disponible']);
            }

            return redirect()->route('compras.index')
                ->with('success', 'Compra actualizada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al actualizar: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $compra = Compra::findOrFail($id);

            // Liberar el vehículo si se cancela la compra
            Vehiculo::where('id_vehiculo', $compra->id_vehiculo)
                ->update(['estado' => 'disponible']);

            $compra->delete();

            return redirect()->route('compras.index')
                ->with('success', 'Compra eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('compras.index')
                ->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}