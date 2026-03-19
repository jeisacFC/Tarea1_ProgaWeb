<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('contact');
});

Route::get('contacto', function () {
    return view('contact');
});

Route::post('contacto', function (Request $request) {
    $data = $request->only(['name', 'phone', 'address', 'email', 'marital_status']);
    return view('contact_info', ['data' => $data]);
});
