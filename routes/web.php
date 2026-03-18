<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    return 'hola';
});

Route::resource('/categoria',CategoriaController::class);

Route::get('hola/{nombre}/{apellido}', function ($nombre, $apellido) {
    return "hola $nombre $apellido";
});