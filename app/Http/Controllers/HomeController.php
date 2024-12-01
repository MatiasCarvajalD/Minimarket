<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth'); // Protege el controlador completo
    }

    public function index()
    {
        return view('Usuario.home'); // Verifica que la vista exista.
    }
}
