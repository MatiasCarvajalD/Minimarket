@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>Bienvenido, Invitado</h1>
    <p>Explora el Minimarket o el Restaurant haciendo clic en los botones a continuación.</p>

    <!-- Botón para Minimarket -->
    <a href="{{ route('minimarket.index') }}" class="btn btn-primary">Ir a Minimarket</a>

    <!-- Botón para Restaurant -->
    <a href="{{ route('restaurant.index') }}" class="btn btn-secondary">Ir al Restaurant</a>
</div>
@endsection
