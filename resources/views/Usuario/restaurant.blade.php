@extends('layouts.app')

@section('title', 'Restaurant')

@section('content')
<div class="container">
    <h1>Restaurant</h1>
    <div class="row">
        @foreach ($productos as $producto)
        <div class="col-md-4">
            <div class="card">
                <img src="{{ $producto->imagen_url }}" class="card-img-top" alt="{{ $producto->nombre }}">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nombre }}</h5>
                    <p class="card-text">Precio: ${{ number_format($producto->precio, 0, ',', '.') }}</p>
                    <a href="{{ route('carrito.add', $producto->id) }}" class="btn btn-primary">Agregar al Carrito</a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
