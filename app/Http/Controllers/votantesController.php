<?php

namespace App\Http\Controllers;

use Symfony\Component\Panther\Client;
use App\Models\Compromiso;
use App\Models\Genero;
use App\Models\Municipio;
use App\Models\Puesto;
use Illuminate\Http\Request;
use App\Models\Votante;

class votantesController extends Controller
{
    public function listado(Request $req)
    {
        $generos = Genero::all();
        $municipios = Municipio::all();
        $compromisos = Compromiso::all();
        $puestos = Puesto::all();

        if ($req->query('consulta')) {
            return $this->buscador(
                $req,
                $generos,
                $municipios,
                $compromisos,
                $puestos
            );
        }

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

            return redirect()->route('votantes.listado')->with('alerta', [
                "icon" => "success",
                "title" => "Se ha guardado correctamente",
                "text" => "",
                "confirmButtonText" => "cerrar"
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('votante.listado')->with('alerta', [
                "icon" => "error",
                "title" => "Error en el servidor",
                "text" => "Espera unos minutos e intenta nuevamente.",
                "confirmButtonText" => "aceptar"
            ]);
        }
    }

    public function borrar(int $id)
    {
        try {
            Votante::where('id', $id)->first()->delete();

            return redirect()->route('votantes.listado')->with('alerta', [
                "icon" => "success",
                "title" => "Se ha eliminado correctamente",
                "text" => "",
                "confirmButtonText" => "cerrar"
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('votante.listado')->with('alerta', [
                "icon" => "error",
                "title" => "Error en el servidor",
                "text" => "Espera unos minutos e intenta nuevamente.",
                "confirmButtonText" => "aceptar"
            ]);
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

            return back()->with('alerta', [
                "icon" => "success",
                "title" => "Se ha modificado correctamente al votante " + $req->input("nombre"),
                "text" => "",
                "confirmButtonText" => "cerrar"
            ]);
        } catch (\Throwable $th) {
            return redirect()->route('votante.listado')->with('alerta', [
                "icon" => "error",
                "title" => "Error en el servidor",
                "text" => "Espera unos minutos e intenta nuevamente.",
                "confirmButtonText" => "aceptar"
            ]);
        }
    }

    // public function buscador()
    // {
    //     $client = Client::createChromeClient();

    //     $client->request('GET', 'https://api-platform.com');       
    //     $client->clickLink('Getting started');
    // }

    public function buscador(Request $req, $generos, $municipios, $compromisos, $puestos)
    {
        $busqueda = Votante::where('cedula', 'like', '%' . $req->query('consulta') . '%')
            ->orWhere('nombre', 'like', '%' . $req->query('consulta') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);

        return view('pages.votantes.listado', [
            "municipios" => $municipios,
            "compromisos" => $compromisos,
            "puestos" => $puestos,
            "votantes" => $busqueda,
            "generos" => $generos,
            "consulta" => $req->query('consulta')
        ]);
    }
}