@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="row g-0">
            <div class="col-md-4">
                <img src="{{ $producto->imagen_url ?? asset('images/default.png') }}" class="img-fluid rounded-start" alt="{{ $producto->nom_producto }}">
            </div>
            <div class="col-md-8">
                <div class="card-body">
                    <h5 class="card-title">{{ $producto->nom_producto }}</h5>
                    <p class="card-text"><strong>Descripción:</strong> {{ $producto->descripcion }}</p>
                    <p class="card-text"><strong>Precio:</strong> ${{ number_format($producto->precio, 0, ',', '.') }}</p>
                    <form action="{{ route('carrito.add') }}" method="POST">
                        @csrf
                        <input type="hidden" name="producto_id" value="{{ $producto->cod_producto }}">
                        <div class="input-group mb-3">
                            <input type="number" name="cantidad" class="form-control" min="1" value="1" placeholder="Cantidad">
                            <button class="btn btn-primary" type="submit">Agregar al Carrito</button>
                        </div>
                    </form>
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary">Volver a la lista</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
