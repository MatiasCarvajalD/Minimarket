@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bienvenido, {{ auth()->user()->nombre_usuario }}</h1>
        <p>Desde aquí puedes gestionar tu cuenta, ver tu historial de compras y explorar nuestros productos.</p>
        <a href="{{ route('user.profile') }}" class="btn btn-primary">Editar Perfil</a>
        <a href="{{ route('carrito.index') }}" class="btn btn-secondary">Ver Carrito</a>
        <a href="{{ route('productos.index') }}">Ver productos</a>

    </div>
@endsection
