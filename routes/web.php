<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\votantesController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('votantes')->group(function () {
    Route::get('/', [votantesController::class, 'listado'])->name('votantes.listado');    
    Route::get('/registrar', [votantesController::class, 'vistaGuardar'])->name('votantes.vistaGuardar');

    Route::post('/registrar', [votantesController::class, 'guardar'])->name('votantes.guardar');
});