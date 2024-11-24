@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Bienvenido a Minimarket</h1>
    <p>Elige una categoría o navega por nuestros productos.</p>
    <div class="row">
        <div class="col-md-4">
            <a href="{{ route('productos.index') }}" class="btn btn-outline-primary">Ver Productos</a>
        </div>
        <div class="col-md-4">
            <a href="{{ route('carrito.index') }}" class="btn btn-outline-secondary">Carrito</a>
        </div>
    </div>
</div>
@endsection
