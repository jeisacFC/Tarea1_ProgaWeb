<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pago;
use App\Models\Compra;

class PagoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $pagos = Pago::with(['compra.usuario', 'compra.vehiculo'])
                ->orderBy('id_pago', 'desc')
                ->get();
            return view('pagos.index', compact('pagos'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Error al cargar pagos: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $compras = Compra::with(['usuario', 'vehiculo'])
            ->where('estado', '!=', 'cancelado')
            ->get();
        return view('pagos.create', compact('compras'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_compra' => 'required|exists:compras,id_compra',
                'metodo_pago' => 'required|string|max:50',
                'monto' => 'required|numeric|min:0',
                'estado' => 'required|string|max:50',
            ]);

            Pago::create([
                'id_compra' => $request->id_compra,
                'metodo_pago' => $request->metodo_pago,
                'monto' => $request->monto,
                'fecha_pago' => now(),
                'estado' => $request->estado,
            ]);

            // Si el pago está completado, actualizar la compra
            if ($request->estado === 'completado') {
                Compra::where('id_compra', $request->id_compra)
                    ->update(['estado' => 'pagado']);
            }

            return redirect()->route('pagos.index')
                ->with('success', 'Pago registrado correctamente.');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al registrar pago: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $pago = Pago::with(['compra.usuario', 'compra.vehiculo'])->findOrFail($id);
            return view('pagos.show', compact('pago'));
        } catch (\Exception $e) {
            return redirect()->route('pagos.index')
                ->with('error', 'Pago no encontrado.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $pago = Pago::findOrFail($id);
            $compras = Compra::with(['usuario', 'vehiculo'])->get();
            return view('pagos.edit', compact('pago', 'compras'));
        } catch (\Exception $e) {
            return redirect()->route('pagos.index')
                ->with('error', 'Pago no encontrado.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $pago = Pago::findOrFail($id);

            $request->validate([
                'id_compra' => 'required|exists:compras,id_compra',
                'metodo_pago' => 'required|string|max:50',
                'monto' => 'required|numeric|min:0',
                'estado' => 'required|string|max:50',
            ]);

            $pago->update($request->all());

            return redirect()->route('pagos.index')
                ->with('success', 'Pago actualizado correctamente.');
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
            $pago = Pago::findOrFail($id);
            $pago->delete();
            return redirect()->route('pagos.index')
                ->with('success', 'Pago eliminado correctamente.');
        } catch (\Exception $e) {
            return redirect()->route('pagos.index')
                ->with('error', 'Error al eliminar: ' . $e->getMessage());
        }
    }
}
