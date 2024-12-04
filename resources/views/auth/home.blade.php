@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="container text-center">
    <h1>Bienvenido al Minimarket</h1>
    <p>Explora nuestros productos y disfruta de una experiencia de compra única.</p>
    <a href="{{ route('minimarket.index') }}" class="btn btn-primary">Ir al Minimarket</a>
    <a href="{{ route('restaurant.index') }}" class="btn btn-secondary">Explorar Restaurant</a>
</div>
@endsection
