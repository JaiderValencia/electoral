<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class usuariosController extends Controller
{
    //
    public function loginVista()
    {
        return view('pages.acceso.login');
    }
}
