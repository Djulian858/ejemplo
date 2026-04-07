<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/hola', function () {
    return 'hola';
});

Route::resource('/categoria',CategoriaController::class)->parameters(["categoria"=>"categoria"]);

Route::resource('/producto', ProductoController::class);

Route::get('hola/{nombre}/{apellido}', function ($nombre, $apellido) {
    return "hola $nombre $apellido";
});