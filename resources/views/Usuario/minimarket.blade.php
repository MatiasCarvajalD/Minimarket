@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Productos - Minimarket</h1>
        @if($productos->isEmpty())
            <p>No hay productos disponibles en esta categoría.</p>
        @else
            <div class="row">
                @foreach($productos as $producto)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">{{ $producto->nom_producto }}</h5>
                                <p class="card-text">{{ $producto->descripcion }}</p>
                                <p><strong>Precio:</strong> ${{ $producto->precio }}</p>
                                <a href="{{ route('productos.detalle', $producto->cod_producto) }}" class="btn btn-primary">Ver Detalles</a>
                                <a href="{{ route('carrito.add', $producto->cod_producto) }}" class="btn btn-success">Agregar al Carrito</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
