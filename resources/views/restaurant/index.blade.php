@extends('layouts.app')

@section('title', 'Menú del Restaurante')

@section('content')
<div class="container">
    <h1>Menú del Restaurante</h1>
    @foreach ($categorias as $categoria)
        <h2>{{ $categoria->categoria }}</h2>
        <div class="row">
            @foreach ($categoria->productos as $producto)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <img src="{{ asset($producto->imagen) }}" alt="{{ $producto->imagen }}" style="height: 200px; object-fit: cover;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $producto->nom_producto }}</h5>
                            <p class="card-text">{{ $producto->descripcion }}</p>
                            <p class="card-text">Precio: ${{ number_format($producto->precio, 0, ',', '.') }}</p>
                            <form action="{{ route('carrito.add', $producto->cod_producto) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary">Agregar al Carrito</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endforeach
</div>
@endsection
