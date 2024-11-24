@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Usuarios</h1>
    <a href="{{ route('usuarios.create') }}" class="btn btn-primary mb-3">Crear Usuario</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->rol }}</td>
                <td>
                    <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
