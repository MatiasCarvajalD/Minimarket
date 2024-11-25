@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $producto->nom_producto }}</h1>
    <p>Marca: {{ $producto->marca }}</p>
    <p>Precio: {{ $producto->precio }} CLP</p>
    <p>Stock: {{ $producto->stock_actual }}</p>
    <p>{{ $producto->descripcion }}</p>
    <form action="{{ route('carrito.add') }}" method="POST">
        @csrf
        <input type="hidden" name="producto_id" value="{{ $producto->cod_producto }}">
        <input type="number" name="cantidad" min="1" max="{{ $producto->stock_actual }}" value="1">
        <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
    </form>
</div>
@endsection
