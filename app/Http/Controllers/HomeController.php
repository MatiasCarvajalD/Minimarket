<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{
    public function index()
    {
        return view('auth.home'); // Asegúrate de tener esta vista
    }
}
