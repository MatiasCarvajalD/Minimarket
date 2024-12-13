@extends('layouts.app')

@section('title', 'Catálogo Minimarket')
@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif


@section('content')
<div class="container py-4">
    <h1 class="text-center mb-5">Catálogo Minimarket</h1>
    
    @foreach ($categorias as $categoria)
    <h2 class="text-primary">{{ $categoria->categoria }}</h2>
    <hr>
    <div class="row">
        @forelse ($categoria->productos as $producto)
            <div class="col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card h-100 shadow-sm">
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nom_producto }}" style="height: 200px; object-fit: cover;">
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $producto->nom_producto }}</h5>
                        <p class="card-text text-muted mb-1">{{ Str::limit($producto->descripcion, 50) }}</p>
                        <p class="card-text fw-bold mb-3">$ {{ number_format($producto->precio, 0, ',', '.') }}</p>
                        <form action="{{ route('carrito.add', $producto->cod_producto) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-primary w-100">Agregar al Carrito</button>
                        </form>
                        
                        
                    </div>
                </div>
            </div>
        @empty
            <p class="text-muted">No hay productos disponibles en esta categoría.</p>
        @endforelse
    </div>
@endforeach

</div>
@endsection
