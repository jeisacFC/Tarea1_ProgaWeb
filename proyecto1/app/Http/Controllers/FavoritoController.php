<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorito;
use App\Models\Usuario;
use App\Models\Vehiculo;

class FavoritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $favoritos = Favorito::with(['usuario', 'vehiculo'])
                                 ->orderBy('id_favorito', 'desc')
                                 ->get();
            return view('favoritos.index', compact('favoritos'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar favoritos: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios  = Usuario::all();
        $vehiculos = Vehiculo::where('estado', 'disponible')->get();
        return view('favoritos.create', compact('usuarios', 'vehiculos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_usuario'  => 'required|exists:usuarios,id_usuario',
                'id_vehiculo' => 'required|exists:vehiculos,id_vehiculo',
                'nota'        => 'nullable|string|max:255',
                'estado'      => 'required|boolean',
            ]);

            Favorito::create([
                'id_usuario'     => $request->id_usuario,
                'id_vehiculo'    => $request->id_vehiculo,
                'fecha_agregado' => now(),
                'estado'         => $request->estado,
                'nota'           => $request->nota,
            ]);

            return redirect()->route('favoritos.index')
                             ->with('success', 'Favorito agregado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                             ->with('error', 'Error al agregar favorito: ' . $e->getMessage())
                             ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $favorito = Favorito::with(['usuario', 'vehiculo'])->findOrFail($id);
            return view('favoritos.show', compact('favorito'));
        } catch (\Exception $e) {
            return redirect()->route('favoritos.index')
                             ->with('error', 'Favorito no encontrado.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $favorito  = Favorito::findOrFail($id);
            $usuarios  = Usuario::all();
            $vehiculos = Vehiculo::all();
            return view('favoritos.edit', compact('favorito', 'usuarios', 'vehiculos'));
        } catch (\Exception $e) {
            return redirect()->route('favoritos.index')
                             ->with('error', 'Favorito no encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
  {
        try {
            $favorito = Favorito::findOrFail($id);

            $request->validate([
                'id_usuario'  => 'required|exists:usuarios,id_usuario',
                'id_vehiculo' => 'required|exists:vehiculos,id_vehiculo',
                'nota'        => 'nullable|string|max:255',
                'estado'      => 'required|boolean',
            ]);

            $favorito->update($request->all());

            return redirect()->route('favoritos.index')
                             ->with('success', 'Favorito actualizado correctamente.');
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
            $favorito = Favorito::findOrFail($id);
            $favorito->delete();
            return redirect()->route('favoritos.index')
                             ->with('success', 'Favorito eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('favoritos.index')
                             ->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}
