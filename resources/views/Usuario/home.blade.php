@extends('layouts.app')

@section('title', 'Inicio')

@section('content')
<div class="jumbotron text-center">
    <h1 class="display-4">Bienvenido a Minimarket & Restaurant</h1>
    <p class="lead">Compra lo que necesitas en nuestro minimarket o disfruta de comida casera en nuestro restaurant.</p>
    <hr class="my-4">
    <a class="btn btn-primary btn-lg" href="{{ route('minimarket.index') }}" role="button">Explorar Minimarket</a>
    <a class="btn btn-success btn-lg" href="{{ route('restaurant.index') }}" role="button">Explorar Restaurant</a>
</div>
@endsection
