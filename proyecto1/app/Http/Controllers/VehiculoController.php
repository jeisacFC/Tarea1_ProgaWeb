<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vehiculo;
use App\Models\Usuario;
use App\Models\Ubicacion;

class VehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $vehiculos = Vehiculo::with(['vendedor', 'ubicacion'])
                ->orderBy('id_vehiculo', 'desc')
                ->get();
            return view('vehiculos.index', compact('vehiculos'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar vehículos: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vendedores = Usuario::where('tipo_usuario', '!=', 'cliente')->get();
        $ubicaciones = Ubicacion::all();
        return view('vehiculos.create', compact('vendedores', 'ubicaciones'));
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'marca' => 'required|string|max:50',
                'modelo' => 'required|string|max:50',
                'anio' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'precio' => 'required|numeric|min:0',
                'descripcion' => 'nullable|string',
                'id_vendedor' => 'required|exists:usuarios,id_usuario',
                'id_ubicacion' => 'nullable|exists:ubicaciones,id_ubicacion',
                'estado' => 'required|in:disponible,vendido',
            ]);

            Vehiculo::create([
                'marca' => $request->marca,
                'modelo' => $request->modelo,
                'anio' => $request->anio,
                'precio' => $request->precio,
                'descripcion' => $request->descripcion,
                'id_vendedor' => $request->id_vendedor,
                'id_ubicacion' => $request->id_ubicacion,
                'estado' => $request->estado,
                'fecha_publicacion' => now(),
            ]);

            return redirect()->route('vehiculos.index')
                ->with('success', 'Vehículo creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear vehículo: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $vehiculo = Vehiculo::with(['vendedor', 'ubicacion', 'imagenes', 'resenas.usuario'])
                ->findOrFail($id);
            return view('vehiculos.show', compact('vehiculo'));
        } catch (\Exception $e) {
            return redirect()->route('vehiculos.index')
                ->with('error', 'Vehículo no encontrado.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $vehiculo = Vehiculo::findOrFail($id);
            $vendedores = Usuario::where('tipo_usuario', '!=', 'cliente')->get();
            $ubicaciones = Ubicacion::all();
            return view('vehiculos.edit', compact('vehiculo', 'vendedores', 'ubicaciones'));
        } catch (\Exception $e) {
            return redirect()->route('vehiculos.index')
                ->with('error', 'Vehículo no encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $vehiculo = Vehiculo::findOrFail($id);

            $request->validate([
                'marca' => 'required|string|max:50',
                'modelo' => 'required|string|max:50',
                'anio' => 'required|integer|min:1900|max:' . (date('Y') + 1),
                'precio' => 'required|numeric|min:0',
                'descripcion' => 'nullable|string',
                'id_vendedor' => 'required|exists:usuarios,id_usuario',
                'id_ubicacion' => 'nullable|exists:ubicaciones,id_ubicacion',
                'estado' => 'required|in:disponible,vendido',
            ]);

            $vehiculo->update($request->all());

            return redirect()->route('vehiculos.index')
                ->with('success', 'Vehículo actualizado correctamente.');
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
            $vehiculo = Vehiculo::findOrFail($id);
            $vehiculo->delete();
            return redirect()->route('vehiculos.index')
                ->with('success', 'Vehículo eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('vehiculos.index')
                ->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}
