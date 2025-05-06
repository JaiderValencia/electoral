<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Votante;

class votantesController extends Controller
{
    public function listado()
    {
        return view('pages.votantes.listado');
    }

    public function vistaGuardar(Request $req)
    {
        return view('pages.votantes.guardar');
    }

    public function guardar(Request $req)
    {
        Votante::create([
            "nombre" => $req->input('nombre'),
            "cedula" => $req->input('cedula'),
            "telefono" => $req->input('telefono'),
            "municipio_id" => $req->input('municipio'),
            "corregimiento_id" => $req->input('corregimiento'),
            "barrio_id" => $req->input('barrio'),
            "mesa_id" => $req->input('mesa'),
        ]);

        return response()->json($req->input());
    }
}