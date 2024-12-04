@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Detalle del Producto</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $producto->nom_producto }}</h5>
                <p class="card-text"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                <p><strong>Marca:</strong> {{ $producto->marca }}</p>
                <p><strong>Precio:</strong> ${{ $producto->precio }}</p>
                <p><strong>Stock Actual:</strong> {{ $producto->stock_actual }}</p>
                <p><strong>Stock Crítico:</strong> {{ $producto->stock_critico }}</p>
                <p><strong>Categoría:</strong> {{ $producto->tipoProducto->categoria }}</p>
                <a href="{{ route('carrito.add', $producto->cod_producto) }}" class="btn btn-success">Agregar al Carrito</a>
                <a href="{{ url()->previous() }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
@endsection
