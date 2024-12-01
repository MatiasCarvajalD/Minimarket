@extends('layouts.app')

@section('title', 'Restaurant')

@section('content')
<h1 class="mb-4">Productos del Restaurant</h1>
<div class="row">
    @foreach($productos as $producto)
        @if($producto->tipo_producto == 'restaurant')
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nom_producto }}</h5>
                    <p class="card-text">{{ $producto->descripcion }}</p>
                    <p class="card-text"><strong>${{ number_format($producto->precio, 0, ',', '.') }}</strong></p>
                    <a href="{{ route('productos.show', $producto->cod_producto) }}" class="btn btn-primary">Ver Detalle</a>
                    <form action="{{ route('carrito.add', $producto->cod_producto) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn btn-success">Agregar al Carrito</button>
                    </form>
                </div>
            </div>
        </div>
        @endif
    @endforeach
</div>
@endsection
