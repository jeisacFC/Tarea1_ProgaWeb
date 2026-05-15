<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Usuario;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $usuarios = Usuario::orderBy('id_usuario', 'desc')->get();
            return view('usuarios.index', compact('usuarios'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar usuarios: ' . $e->getMessage());
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuarios.create');
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nombre' => 'required|string|max:100',
                'email' => 'required|email|unique:usuarios,email',
                'password' => 'required|min:6',
                'telefono' => 'nullable|string|max:20',
                'tipo_usuario' => 'required|in:cliente,vendedor,admin',
            ]);

            Usuario::create([
                'nombre' => $request->nombre,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono,
                'fecha_registro' => now(),
                'tipo_usuario' => $request->tipo_usuario,
            ]);

            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario creado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al crear usuario: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $usuario = Usuario::with(['vehiculos', 'compras', 'favoritos', 'resenas'])
                ->findOrFail($id);
            return view('usuarios.show', compact('usuario'));
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')
                ->with('error', 'Usuario no encontrado.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);
            return view('usuarios.edit', compact('usuario'));
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')
                ->with('error', 'Usuario no encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $usuario = Usuario::findOrFail($id);

            $request->validate([
                'nombre' => 'required|string|max:100',
                'email' => 'required|email|unique:usuarios,email,' . $id . ',id_usuario',
                'telefono' => 'nullable|string|max:20',
                'tipo_usuario' => 'required|in:cliente,vendedor,admin',
            ]);

            $datos = [
                'nombre' => $request->nombre,
                'email' => $request->email,
                'telefono' => $request->telefono,
                'tipo_usuario' => $request->tipo_usuario,
            ];

            if ($request->filled('password')) {
                $datos['password'] = Hash::make($request->password);
            }

            $usuario->update($datos);

            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario actualizado correctamente.');
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
            $usuario = Usuario::findOrFail($id);
            $usuario->delete();
            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('usuarios.index')
                ->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}