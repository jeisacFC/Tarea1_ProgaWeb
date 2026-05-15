<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Resena;
use App\Models\Usuario;
use App\Models\Vehiculo;

class ResenaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $resenas = Resena::with(['usuario', 'vehiculo'])
                ->orderBy('id_resena', 'desc')
                ->get();
            return view('resenas.index', compact('resenas'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar reseñas: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = Usuario::all();
        $vehiculos = Vehiculo::all();
        return view('resenas.create', compact('usuarios', 'vehiculos'));
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
                'calificacion' => 'required|integer|min:1|max:5',
                'comentario' => 'nullable|string',
            ]);

            Resena::create([
                'id_usuario' => $request->id_usuario,
                'id_vehiculo' => $request->id_vehiculo,
                'calificacion' => $request->calificacion,
                'comentario' => $request->comentario,
                'fecha' => now(),
            ]);

            return redirect()->route('resenas.index')
                ->with('success', 'Reseña creada correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear reseña: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $resena = Resena::with(['usuario', 'vehiculo'])->findOrFail($id);
            return view('resenas.show', compact('resena'));
        } catch (\Exception $e) {
            return redirect()->route('resenas.index')
                ->with('error', 'Reseña no encontrada.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $resena = Resena::findOrFail($id);
            $usuarios = Usuario::all();
            $vehiculos = Vehiculo::all();
            return view('resenas.edit', compact('resena', 'usuarios', 'vehiculos'));
        } catch (\Exception $e) {
            return redirect()->route('resenas.index')
                ->with('error', 'Reseña no encontrada.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $resena = Resena::findOrFail($id);

            $request->validate([
                'id_usuario' => 'required|exists:usuarios,id_usuario',
                'id_vehiculo' => 'required|exists:vehiculos,id_vehiculo',
                'calificacion' => 'required|integer|min:1|max:5',
                'comentario' => 'nullable|string',
            ]);

            $resena->update($request->all());

            return redirect()->route('resenas.index')
                ->with('success', 'Reseña actualizada correctamente.');
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
            $resena = Resena::findOrFail($id);
            $resena->delete();
            return redirect()->route('resenas.index')
                ->with('success', 'Reseña eliminada correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('resenas.index')
                ->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}
