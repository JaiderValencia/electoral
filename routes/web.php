<?php

use App\Http\Controllers\municipioController;
use App\Http\Controllers\usuariosController;
use App\Http\Middleware\validarVotantesCrear;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\votantesController;

Route::get('/login', [usuariosController::class, 'loginVista'])->name('usuarios.login.vista');

Route::prefix('votantes')->group(function () {
    Route::get('/', [votantesController::class, 'listado'])->name('votantes.listado');
    Route::get('/registrar', [votantesController::class, 'vistaGuardar'])->name('votantes.vistaGuardar');

    Route::post('/registrar', [votantesController::class, 'guardar'])->middleware(validarVotantesCrear::class)->name('votantes.guardar');
});

Route::prefix('municipios')->group(function () {
    Route::get('/corregimientos/{municipioId}', [municipioController::class, 'obtenerCorregimientos'])->middleware(['throttle:jsons'])->name('municipios.obtenerCorregimientos');
});

