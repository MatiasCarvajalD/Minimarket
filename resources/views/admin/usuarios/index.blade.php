@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gestión de Usuarios</h1>
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
            @foreach($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->nombre }}</td>
                <td>{{ $usuario->email }}</td>
                <td>{{ $usuario->rol }}</td>
                <td>
                    <a href="{{ route('admin.usuarios.edit', $usuario->id) }}" class="btn btn-warning">Editar</a>
                    <form action="{{ route('admin.usuarios.destroy', $usuario->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
