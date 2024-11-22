<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('inicio'); // Página protegida para usuarios autenticados
    }

    public function invitado()
    {
        return view('invitado'); // Página para invitados
    }
}
