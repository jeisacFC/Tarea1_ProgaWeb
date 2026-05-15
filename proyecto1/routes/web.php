<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UbicacionController;
use App\Http\Controllers\VehiculoController;
use App\Http\Controllers\ImagenVehiculoController;
use App\Http\Controllers\CompraController;
use App\Http\Controllers\PagoController;
use App\Http\Controllers\FavoritoController;
use App\Http\Controllers\ResenaController;
use App\Http\Controllers\HistorialController;

// Route::get('/', function () {
//     return view('welcome');
// });

// Auth::routes();

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
// Página principal redirige al login
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de autenticación generadas por laravel/ui
Auth::routes();

// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {

    // Dashboard principal
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // CRUDs de las 8 tablas
    Route::resource('usuarios', UsuarioController::class);
    Route::resource('ubicaciones', UbicacionController::class);
    Route::resource('vehiculos', VehiculoController::class);
    Route::resource('imagenes', ImagenVehiculoController::class);
    Route::resource('compras', CompraController::class);
    Route::resource('pagos', PagoController::class);
    Route::resource('favoritos', FavoritoController::class);
    Route::resource('resenas', ResenaController::class);

    // Historial de transacciones
    Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');

    // Vista de Uso de Vue (autenticación tipo 2)
    Route::get('/vue-panel', function () {
        return view('vue.panel');
    })->name('vue.panel');
});