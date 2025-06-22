<?php

use App\Http\Controllers\municipioController;
use App\Http\Controllers\usuariosController;
use App\Http\Middleware\validarVotantesCrear;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\votantesController;

Route::get('/login', [usuariosController::class, 'loginVista'])->name('usuarios.login.vista');

Route::prefix('votantes')->group(function () {
    Route::get('/', [votantesController::class, 'listado'])->name('votantes.listado');

    Route::post('/agregar', [votantesController::class, 'guardar'])->middleware(validarVotantesCrear::class)->name('votantes.agregar');
    Route::put('/{id}', [votantesController::class, 'modificar'])->name('votantes.editar');
    Route::delete('/{id}', [votantesController::class, 'borrar'])->name('votantes.borrar');
});

Route::prefix('municipios')->group(function () {
    Route::get('/corregimientos/{municipioId}', [municipioController::class, 'obtenerCorregimientos'])->middleware(['throttle:jsons'])->name('municipios.obtenerCorregimientos');
});

