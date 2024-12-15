@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Editar Usuario</h1>
        <form action="{{ route('admin.usuarios.actualizar', $usuario->rut_usuario) }}" method="POST">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre</label>
                <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="{{ $usuario->nombre_usuario }}" required>
            </div>
        
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" required>
            </div>
        
            <div class="mb-3">
                <label for="rol" class="form-label">Rol</label>
                <select class="form-select" id="rol" name="rol" required>
                    <option value="usuario" {{ $usuario->rol == 'usuario' ? 'selected' : '' }}>Usuario</option>
                    <option value="admin" {{ $usuario->rol == 'admin' ? 'selected' : '' }}>Administrador</option>
                </select>
            </div>
        
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </form>
        
    </div>
@endsection
