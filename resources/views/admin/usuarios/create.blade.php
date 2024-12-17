@extends('layouts.admin')
@include('partials.alerts')

@section('content')
<div class="container">
    <h2>Crear Nuevo Usuario</h2>

    <form method="POST" action="{{ route('admin.usuarios.store') }}">
        @csrf

        <div class="mb-3">
            <label for="rut_usuario" class="form-label">RUT</label>
            <input type="text" class="form-control" id="rut_usuario" name="rut_usuario" value="{{ old('rut_usuario') }}" required>
        </div>

        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="{{ old('nombre_usuario') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono') }}">
        </div>

        <div class="mb-3">
            <label for="rol" class="form-label">Rol</label>
            <select class="form-control" id="rol" name="rol" required>
                <option value="usuario">Usuario</option>
                <option value="admin">Administrador</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Crear Usuario</button>
    </form>
</div>
@endsection
