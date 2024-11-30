@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<h1>Dashboard</h1>
<div class="row">
    <div class="col-md-4">
        <div class="card text-white bg-primary mb-3">
            <div class="card-header">Usuarios</div>
            <div class="card-body">
                <h5 class="card-title">{{ $totalUsuarios }}</h5>
                <p class="card-text">Total de usuarios registrados.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success mb-3">
            <div class="card-header">Ventas</div>
            <div class="card-body">
                <h5 class="card-title">${{ number_format($totalVentas, 0, ',', '.') }}</h5>
                <p class="card-text">Ingresos totales.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-danger mb-3">
            <div class="card-header">Productos Críticos</div>
            <div class="card-body">
                <h5 class="card-title">{{ $productosCriticos }}</h5>
                <p class="card-text">Productos con stock bajo.</p>
            </div>
        </div>
    </div>
</div>
@endsection
