@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Configuración de Cuenta</h1>
        <form action="{{ route('user.profile.update') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nombre_usuario" class="form-label">Nombre</label>
                <input type="text" name="nombre_usuario" class="form-control" value="{{ auth()->user()->nombre_usuario }}" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" name="email" class="form-control" value="{{ auth()->user()->email }}" required>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Teléfono</label>
                <input type="text" name="telefono" class="form-control" value="{{ auth()->user()->telefono }}">
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Dirección</label>
                <input type="text" name="direccion" class="form-control" value="{{ auth()->user()->direccion }}">
            </div>
            <button type="submit" class="btn btn-primary">Actualizar</button>
        </form>
    </div>
@endsection
