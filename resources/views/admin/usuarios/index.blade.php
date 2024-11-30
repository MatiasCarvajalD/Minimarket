@extends('layouts.app')

@section('title', 'Usuarios')

@section('content')
<h1>Gestión de Usuarios</h1>
<a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">Crear Usuario</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>RUT</th>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->rut_usuario }}</td>
                <td>{{ $usuario->nombre_usuario }}</td>
                <td>{{ $usuario->correo }}</td>
                <td>{{ ucfirst($usuario->rol) }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario->rut_usuario) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('usuarios.destroy', $usuario->rut_usuario) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
