@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Editar Usuario</h1>
        <form action="{{ route('admin.usuarios.update', $usuario->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre</label>
                <input type="text" name="nombre_usuario" class="form-control" value="{{ $usuario->nombre_usuario }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
            </div>
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select name="rol" class="form-select" required>
                    <option value="admin" @if($usuario->rol == 'admin') selected @endif>Administrador</option>
                    <option value="usuario" @if($usuario->rol == 'usuario') selected @endif>Usuario</option>
                    <option value="invitado" @if($usuario->rol == 'invitado') selected @endif>Invitado</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('admin.usuarios.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
