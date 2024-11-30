@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <div class="home-container">
        <h1>Bienvenido a Minimarket & Restaurante</h1>
        <div class="home-buttons">
            <a href="{{ route('minimarket') }}" class="btn">Ir al Minimarket</a>
            <a href="{{ route('restaurant') }}" class="btn">Ir al Restaurante</a>
        </div>
    </div>
@endsection
