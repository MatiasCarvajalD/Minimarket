@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Lista de Compras</h2>
        <!-- Botón para agregar una nueva compra -->
        <a href="{{ route('admin.compras.crear') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Agregar Compra
        </a>
    </div>

    <!-- Tabla de compras -->
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Código</th>
                <th>Proveedor</th>
                <th>Fecha</th>
                <th>Detalle General</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($compras as $compra)
                <tr>
                    <td>{{ $compra->cod_compra }}</td>
                    <td>{{ $compra->proveedor->nom_proveedor }}</td>
                    <td>{{ \Carbon\Carbon::parse($compra->fecha)->format('d-m-Y') }}</td>
                    <td>{{ $compra->detalle_general }}</td>
                    <td>
                        <!-- Botón para ver detalles de la compra -->
                        <a href="{{ route('admin.compras.show', $compra->cod_compra) }}" class="btn btn-sm btn-info">
                            Ver Detalle
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
