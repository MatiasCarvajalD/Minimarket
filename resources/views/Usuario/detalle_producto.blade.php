@extends('layouts.app')

@section('title', $producto->nom_producto)

@section('content')
    <div class="product-detail">
        <div class="product-image">
            <img src="{{ asset('images/productos/' . $producto->imagen) }}" alt="{{ $producto->nom_producto }}">
        </div>
        <div class="product-info">
            <h1>{{ $producto->nom_producto }}</h1>
            <p><strong>Marca:</strong> {{ $producto->marca }}</p>
            <p>{{ $producto->descripcion }}</p>
            <p><strong>Precio:</strong> ${{ $producto->precio }}</p>
            <form action="{{ route('carrito.add', $producto->cod_producto) }}" method="POST">
                @csrf
                <label for="cantidad">Cantidad:</label>
                <input type="number" name="cantidad" value="1" min="1">
                <button type="submit" class="btn">Agregar al Carrito</button>
            </form>
        </div>
    </div>
@endsection
