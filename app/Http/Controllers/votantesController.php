<?php

namespace App\Http\Controllers;

use App\Models\Compromiso;
use App\Models\Genero;
use App\Models\Municipio;
use App\Models\Puesto;
use Illuminate\Http\Request;
use App\Models\Votante;

class votantesController extends Controller
{
    public function listado()
    {

        $generos = Genero::all();
        $municipios = Municipio::all();
        $compromisos = Compromiso::all();
        $puestos = Puesto::all();
        $votantes = Votante::with(['barrio.corregimiento.municipio', 'mesa.puesto', 'compromiso'])
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.votantes.listado', [
            "municipios" => $municipios,
            "compromisos" => $compromisos,
            "puestos" => $puestos,
            "votantes" => $votantes,
            "generos" => $generos
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
                "recomendacion" => $req->input('recomendacion'),
                "genero_id" => $req->input('genero'),
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
                "recomendacion" => $req->input('recomendacion'),
                "genero_id" => $req->input('genero'),
            ]);

            return redirect()->route('votantes.listado');
        } catch (\Throwable $th) {
            return response($th)->setStatusCode(500);
        }
    }

    public function filtro()
    {
        
    }
}