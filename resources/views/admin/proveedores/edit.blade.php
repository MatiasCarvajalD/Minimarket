@extends('layouts.admin')
@include('partials.alerts')
@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Editar Proveedor</h1>


    <form action="{{ route('admin.proveedores.update', $proveedor->id_proveedor) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="rut_proveedor">RUT Proveedor</label>
            <input type="text" name="rut_proveedor" id="rut_proveedor" class="form-control" 
                   value="{{ old('rut_proveedor', $proveedor->rut_proveedor) }}" required>
        </div>

        {{-- Nombre Proveedor --}}
        <div class="form-group mb-3">
            <label for="nom_proveedor">Nombre del Proveedor</label>
            <input type="text" name="nom_proveedor" id="nom_proveedor" class="form-control" 
                   value="{{ old('nom_proveedor', $proveedor->nom_proveedor) }}" required>
        </div>

        {{-- Teléfono Proveedor --}}
        <div class="form-group mb-3">
            <label for="telefono_proveedor">Teléfono</label>
            <input type="text" name="telefono_proveedor" id="telefono_proveedor" class="form-control" 
                   value="{{ old('telefono_proveedor', $proveedor->telefono_proveedor) }}">
        </div>

        {{-- Dirección Proveedor --}}
        <div class="form-group mb-3">
            <label for="direccion_proveedor">Dirección</label>
            <input type="text" name="direccion_proveedor" id="direccion_proveedor" class="form-control" 
                   value="{{ old('direccion_proveedor', $proveedor->direccion_proveedor) }}">
        </div>

        {{-- Correo Proveedor --}}
        <div class="form-group mb-3">
            <label for="correo_proveedor">Correo Electrónico</label>
            <input type="email" name="correo_proveedor" id="correo_proveedor" class="form-control" 
                   value="{{ old('correo_proveedor', $proveedor->correo_proveedor) }}">
        </div>

        {{-- Botones --}}
        <button type="submit" class="btn btn-primary">Actualizar Proveedor</button>
        <a href="{{ route('admin.proveedores.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
