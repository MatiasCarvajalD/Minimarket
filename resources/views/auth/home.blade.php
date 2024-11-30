@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="jumbotron">
    <h1>Bienvenido a Minimarket & Restaurant</h1>
    <p>Compra productos y disfruta de nuestras ofertas especiales.</p>
    <a href="{{ route('productos.index') }}" class="btn btn-primary">Ver Productos</a>
</div>
@endsection
