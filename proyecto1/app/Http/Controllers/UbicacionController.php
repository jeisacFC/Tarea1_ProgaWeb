<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Ubicacion;

class UbicacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $ubicaciones = Ubicacion::orderBy('id_ubicacion', 'desc')->get();
            return view('ubicaciones.index', compact('ubicaciones'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar ubicaciones: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('ubicaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'ciudad' => 'required|string|max:100',
                'pais' => 'required|string|max:100',
                'direccion' => 'nullable|string|max:255',
                'latitud' => 'nullable|numeric',
                'longitud' => 'nullable|numeric',
                'codigo_postal' => 'nullable|string|max:20',
            ]);

            Ubicacion::create($request->all());

            return redirect()->route('ubicaciones.index')
                ->with('success', 'Ubicación creada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear ubicación: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $ubicacion = Ubicacion::with('vehiculos')->findOrFail($id);
            return view('ubicaciones.show', compact('ubicacion'));
        } catch (\Exception $e) {
            return redirect()->route('ubicaciones.index')
                ->with('error', 'Ubicación no encontrada.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $ubicacion = Ubicacion::findOrFail($id);
            return view('ubicaciones.edit', compact('ubicacion'));
        } catch (\Exception $e) {
            return redirect()->route('ubicaciones.index')
                ->with('error', 'Ubicación no encontrada.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $ubicacion = Ubicacion::findOrFail($id);

            $request->validate([
                'ciudad' => 'required|string|max:100',
                'pais' => 'required|string|max:100',
                'direccion' => 'nullable|string|max:255',
                'latitud' => 'nullable|numeric',
                'longitud' => 'nullable|numeric',
                'codigo_postal' => 'nullable|string|max:20',
            ]);

            $ubicacion->update($request->all());

            return redirect()->route('ubicaciones.index')
                ->with('success', 'Ubicación actualizada correctamente.');
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
            $ubicacion = Ubicacion::findOrFail($id);
            $ubicacion->delete();
            return redirect()->route('ubicaciones.index')
                ->with('success', 'Ubicación eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('ubicaciones.index')
                ->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}
