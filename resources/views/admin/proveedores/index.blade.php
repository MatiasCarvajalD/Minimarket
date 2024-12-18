@extends('layouts.admin')
@include('partials.alerts')

@section('content')
<div class="container mt-4">
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>RUT</th>
                <th>Nombre</th>
                <th>Teléfono</th>
                <th>Estado</th>
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
                    <td>
                        @if ($proveedor->deleted_at)
                            <span class="text-danger">Eliminado</span>
                        @else
                            <span class="text-success">Activo</span>
                        @endif
                    </td>
                    <td>
                        @if ($proveedor->deleted_at)
                            {{-- Botón para restaurar --}}
                            <form action="{{ route('admin.proveedores.restore', $proveedor->id_proveedor) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn btn-success btn-sm">Restaurar</button>
                            </form>
                        @else
                            {{-- Botón para editar --}}
                            <a href="{{ route('admin.proveedores.edit', $proveedor->id_proveedor) }}" class="btn btn-primary btn-sm">
                                Editar
                            </a>
    
                            {{-- Botón para eliminar (SoftDelete) --}}
                            <form action="{{ route('admin.proveedores.destroy', $proveedor->id_proveedor) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    

@endsection
