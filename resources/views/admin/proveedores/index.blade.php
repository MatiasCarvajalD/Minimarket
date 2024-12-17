@extends('layouts.admin')
@include('partials.alerts')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center">
        <h2>Gestión de Proveedores</h2>
        <a href="{{ route('admin.proveedores.crear') }}" class="btn btn-success">Agregar Proveedor</a>
    </div>

    <!-- Tabla de Proveedores -->
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>RUT</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Dirección</th>
                <th>Correo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($proveedores as $proveedor)
            <tr>
                <td>{{ $proveedor->id_proveedor }}</td>
                <td>{{ $proveedor->rut_proveedor }}</td>
                <td>{{ $proveedor->nom_proveedor }}</td>
                <td>{{ $proveedor->telefono_proveedor }}</td>
                <td>{{ $proveedor->direccion_proveedor }}</td>
                <td>{{ $proveedor->correo_proveedor }}</td>
                <td>
                    <a href="#" class="btn btn-warning btn-sm">Editar</a>
                    <a href="#" class="btn btn-danger btn-sm">Eliminar</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
