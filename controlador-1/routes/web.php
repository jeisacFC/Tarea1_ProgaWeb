<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;

Route::get('/services', [ServiceController::class, 'index'])->name('services');

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');       
    Route::view('correo1', 'correo1')->name('correo1');
    Route::view('correo2', 'correo2')->name('correo2');
    Route::view('correo3', 'correo3')->name('correo3');
    Route::view('correo4', 'correo4')->name('correo4');

}); 

require __DIR__.'/settings.php';
