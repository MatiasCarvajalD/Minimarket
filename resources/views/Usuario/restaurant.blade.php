@extends('layouts.app')

@section('title', 'Restaurante')

@section('content')
    <h1>Restaurante</h1>
    <div class="categories">
        @foreach($categorias as $categoria)
            <h2>{{ $categoria->nombre_categoria }}</h2>
            <div class="dishes">
                @foreach($categoria->platos as $plato)
                    <div class="dish-card">
                        <img src="{{ asset('images/platos/' . $plato->imagen) }}" alt="{{ $plato->nombre_plato }}">
                        <h3>{{ $plato->nombre_plato }}</h3>
                        <p>{{ $plato->descripcion }}</p>
                        <p><strong>${{ $plato->precio }}</strong></p>
                        <a href="{{ route('carrito.add', $plato->id_plato) }}" class="btn">Ordenar</a>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
@endsection
