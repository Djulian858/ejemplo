<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PdfController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //ruta categorias
   
    //ruta productos
    Route::resource('/producto', ProductoController::class);

    // ruta pdf
    Route::get('/pdfProductos', [PdfController::class, 'pdfProductos'])->name('pdf.productos');
});
 Route::resource('/categoria', CategoriaController::class)-> parameters(['categoria' => 'categoria']);
require __DIR__.'/auth.php';