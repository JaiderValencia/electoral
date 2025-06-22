<?php

namespace App\Http\Controllers;

use App\Models\Compromiso;
use App\Models\Municipio;
use App\Models\Puesto;
use Illuminate\Http\Request;
use App\Models\Votante;

class votantesController extends Controller
{
    public function listado()
    {
        $municipios = Municipio::all();
        $compromisos = Compromiso::all();
        $puestos = Puesto::all();
        $votantes = Votante::with(['barrio.corregimiento.municipio', 'mesa.puesto', 'compromiso'])->paginate(1);

        return view('pages.votantes.listado', [
            "municipios" => $municipios,
            "compromisos" => $compromisos,
            "puestos" => $puestos,
            "votantes" => $votantes
        ]);
    }

    public function guardar(Request $req)
    {
        try {
            Votante::create([
                "cedula" => $req->input('cedula'),
                "nombre" => $req->input('nombre'),
                "telefono" => $req->input('telefono'),
                "corregimiento_id" => $req->input('corregimiento'),
                "barrio_id" => $req->input('barrio'),
                "mesa_id" => $req->input('mesa'),
                "compromiso_id" => $req->input('compromiso'),
                "recomendacion" => $req->input('recomendacion')
            ]);

            return redirect()->route('votantes.listado');
        } catch (\Throwable $th) {
            return response($th)->setStatusCode(500);
        }
    }

    public function borrar(int $id)
    {
        try {
            Votante::where('id', $id)->first()->delete();
            return redirect()->route('votantes.listado');
        } catch (\Throwable $th) {
            return response($th)->setStatusCode(500);
        }
    }

    public function modificar(int $id, Request $req)
    {
        try {
            Votante::where('id', $id)->first()->update([
                "cedula" => $req->input('cedula'),
                "nombre" => $req->input('nombre'),
                "telefono" => $req->input('telefono'),
                "corregimiento_id" => $req->input('corregimiento'),
                "barrio_id" => $req->input('barrio'),
                "mesa_id" => $req->input('mesa'),
                "compromiso_id" => $req->input('compromiso'),
                "recomendacion" => $req->input('recomendacion')
            ]);
        } catch (\Throwable $th) {
            return response($th)->setStatusCode(500);
        }
    }
}