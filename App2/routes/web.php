<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('contact');
});

Route::post('/', function (Request $request) {
    $data = $request->only(['name', 'phone', 'address', 'email', 'marital_status']);
    return view('contact_info', ['data' => $data]);
});
