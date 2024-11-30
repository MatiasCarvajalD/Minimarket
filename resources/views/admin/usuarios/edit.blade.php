@extends('layouts.app')

@section('title', 'Editar Usuario')

@section('content')
<h1>Editar Usuario</h1>
<form action="{{ route('usuarios.update', $usuario->rut_usuario) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="nombre_usuario">Nombre</label>
        <input type="text" name="nombre_usuario" id="nombre_usuario" class="form-control" value="{{ $usuario->nombre_usuario }}" required>
    </div>
    <div class="form-group">
        <label for="correo">Correo</label>
        <input type="email" name="correo" id="correo" class="form-control" value="{{ $usuario->correo }}" required>
    </div>
    <div class="form-group">
        <label for="rol">Rol</label>
        <select name="rol" id="rol" class="form-control">
            <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
            <option value="usuario" {{ $usuario->rol == 'usuario' ? 'selected' : '' }}>Usuario</option>
            <option value="invitado" {{ $usuario->rol == 'invitado' ? 'selected' : '' }}>Invitado</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
