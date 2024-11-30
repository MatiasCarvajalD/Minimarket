@extends('layouts.app')

@section('title', 'Minimarket')

@section('content')
    <h1>Minimarket</h1>
    <div class="categories">
        @foreach($categorias as $categoria)
            <h2>{{ $categoria->categoria }}</h2>
            <div class="products">
                @foreach($categoria->productos as $producto)
                    <div class="product-card">
                        <img src="{{ asset('images/productos/' . $producto->imagen) }}" alt="{{ $producto->nom_producto }}">
                        <h3>{{ $producto->nom_producto }}</h3>
                        <p>{{ $producto->descripcion }}</p>
                        <p><strong>${{ $producto->precio }}</strong></p>
                        <a href="{{ route('carrito.add', $producto->cod_producto) }}" class="btn">Agregar al Carrito</a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
