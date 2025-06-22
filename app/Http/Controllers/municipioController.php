<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class municipioController extends Controller
{
    //
    public function obtenerCorregimientos($municipioId)
    {        
        $corregimientos = Municipio::where('id', $municipioId)
            ->with('corregimientos.barrios.puestos.mesas')
            ->first()
            ->corregimientos;

        return response()->json($corregimientos);
    }
}
