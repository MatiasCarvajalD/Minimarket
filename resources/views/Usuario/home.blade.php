@extends('layouts.app')
@include('partials.alerts')

@section('content')
<div class="container py-4">
    <h1 class="mb-4">Bienvenido, {{ auth()->user()->nombre }}</h1>
    <p class="text-muted">
        Desde aquí puedes gestionar tu cuenta, ver tu historial de compras y explorar nuestros productos.
    </p>

    <div class="row">
        <!-- Acceso a Minimarket -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/images/minimarket.jpg') }}" class="card-img-top" alt="Minimarket"style="height: 300px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title">Minimarket</h5>
                    <p class="card-text">Explora nuestros productos básicos disponibles en el minimarket.</p>
                    <a href="{{ route('minimarket.index') }}" class="btn btn-primary">Ir al Minimarket</a>
                </div>
            </div>
        </div>

        <!-- Acceso a Restaurant -->
        <div class="col-md-6 mb-4">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/images/restaurant.jpg') }}" class="card-img-top" alt="Restaurant"style="height: 300px; object-fit: cover;">
                <div class="card-body text-center">
                    <h5 class="card-title">Restaurant</h5>
                    <p class="card-text">Descubre nuestra comida casera chilena y disfruta de deliciosos platillos.</p>
                    <a href="{{ route('restaurant.index') }}" class="btn btn-success">Ir al Restaurant</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <!-- Editar Perfil -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-user-edit fa-3x text-primary mb-3"></i>
                    <h5 class="card-title">Editar Perfil</h5>
                    <p class="card-text">Actualiza tu información personal y configuración de cuenta.</p>
                    <a href="{{ route('user.profile') }}" class="btn btn-primary">Editar Perfil</a>
                </div>
            </div>
        </div>

        <!-- Ver Carrito -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-shopping-cart fa-3x text-success mb-3"></i>
                    <h5 class="card-title">Ver Carrito</h5>
                    <p class="card-text">Revisa los productos que has agregado y realiza tu compra.</p>
                    <a href="{{ route('carrito.index') }}" class="btn btn-success">Ir al Carrito</a>
                </div>
            </div>
        </div>

        <!-- Historial de Compras -->
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm">
                <div class="card-body text-center">
                    <i class="fas fa-receipt fa-3x text-warning mb-3"></i>
                    <h5 class="card-title">Historial de Compras</h5>
                    <p class="card-text">Consulta el historial de tus pedidos y sus detalles.</p>
                    <a href="{{ route('user.historial_compras') }}" class="btn btn-warning">Ver Historial</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
