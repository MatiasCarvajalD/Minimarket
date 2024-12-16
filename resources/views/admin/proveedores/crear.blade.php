@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <h2>Agregar Nuevo Proveedor</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulario de Proveedor -->
    <form action="{{ route('admin.proveedores.guardar') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="rut_proveedor" class="form-label">RUT del Proveedor</label>
            <input type="text" class="form-control" id="rut_proveedor" name="rut_proveedor" placeholder="Ingrese el RUT" required>
        </div>

        <div class="mb-3">
            <label for="nom_proveedor" class="form-label">Nombre del Proveedor</label>
            <input type="text" class="form-control" id="nom_proveedor" name="nom_proveedor" placeholder="Ingrese el nombre" required>
        </div>

        <div class="mb-3">
            <label for="telefono_proveedor" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono_proveedor" name="telefono_proveedor" placeholder="Ingrese el teléfono">
        </div>

        <div class="mb-3">
            <label for="direccion_proveedor" class="form-label">Dirección</label>
            <input type="text" class="form-control" id="direccion_proveedor" name="direccion_proveedor" placeholder="Ingrese la dirección">
        </div>

        <div class="mb-3">
            <label for="correo_proveedor" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="correo_proveedor" name="correo_proveedor" placeholder="Ingrese el correo">
        </div>

        <button type="submit" class="btn btn-primary">Guardar Proveedor</button>
        <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
