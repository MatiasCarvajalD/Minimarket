@extends('layouts.app')

@section('title', $producto->nom_producto)

@section('content')
<div class="card">
    <div class="card-header">
        <h3>{{ $producto->nom_producto }}</h3>
    </div>
    <div class="card-body">
        <p><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
        <p><strong>Precio:</strong> ${{ number_format($producto->precio, 0, ',', '.') }}</p>
        <form action="{{ route('carrito.add', $producto->cod_producto) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Agregar al Carrito</button>
        </form>
        <a href="{{ route('minimarket.index') }}" class="btn btn-secondary mt-3">Volver</a>
    </div>
</div>
@endsection
