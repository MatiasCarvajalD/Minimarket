@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
    <h1 class="text-center">Bienvenido a Minimarket</h1>
    <div class="text-center mt-4">
        <a href="{{ route('productos.index') }}" class="btn btn-primary">Explorar Productos</a>
    </div>
@endsection
