<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ImagenVehiculo;
use App\Models\Vehiculo;

class ImagenVehiculoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $imagenes = ImagenVehiculo::with('vehiculo')
                ->orderBy('id_imagen', 'desc')
                ->get();
            return view('imagenes.index', compact('imagenes'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar imágenes: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $vehiculos = Vehiculo::all();
        return view('imagenes.create', compact('vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_vehiculo' => 'required|exists:vehiculos,id_vehiculo',
                'url_imagen' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'orden' => 'nullable|integer|min:1',
            ]);

            ImagenVehiculo::create([
                'id_vehiculo' => $request->id_vehiculo,
                'url_imagen' => $request->url_imagen,
                'descripcion' => $request->descripcion,
                'orden' => $request->orden ?? 1,
                'fecha_subida' => now(),
            ]);

            return redirect()->route('imagenes.index')
                ->with('success', 'Imagen agregada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al agregar imagen: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $imagen = ImagenVehiculo::with('vehiculo')->findOrFail($id);
            return view('imagenes.show', compact('imagen'));
        } catch (\Exception $e) {
            return redirect()->route('imagenes.index')
                ->with('error', 'Imagen no encontrada.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $imagen = ImagenVehiculo::findOrFail($id);
            $vehiculos = Vehiculo::all();
            return view('imagenes.edit', compact('imagen', 'vehiculos'));
        } catch (\Exception $e) {
            return redirect()->route('imagenes.index')
                ->with('error', 'Imagen no encontrada.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $imagen = ImagenVehiculo::findOrFail($id);

            $request->validate([
                'id_vehiculo' => 'required|exists:vehiculos,id_vehiculo',
                'url_imagen' => 'required|string|max:255',
                'descripcion' => 'nullable|string|max:255',
                'orden' => 'nullable|integer|min:1',
            ]);

            $imagen->update($request->all());

            return redirect()->route('imagenes.index')
                ->with('success', 'Imagen actualizada correctamente.');
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
            $imagen = ImagenVehiculo::findOrFail($id);
            $imagen->delete();
            return redirect()->route('imagenes.index')
                ->with('success', 'Imagen eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('imagenes.index')
                ->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}