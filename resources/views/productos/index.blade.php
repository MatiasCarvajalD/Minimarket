@extends('layouts.app')

@section('title', 'Productos')

@section('content')
<h1 class="mb-4">Lista de Productos</h1>
<div class="row">
    @foreach($productos as $producto)
        <div class="col-md-4">
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nom_producto }}</h5>
                    <p class="card-text">{{ $producto->descripcion }}</p>
                    <p class="card-text"><strong>${{ number_format($producto->precio, 0, ',', '.') }}</strong></p>
                    <a href="{{ route('productos.show', $producto->cod_producto) }}" class="btn btn-primary">Ver Detalle</a>
                </div>
            </div>
        </div>
    @endforeach
</div>
@endsection
