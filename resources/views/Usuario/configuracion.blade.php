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
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
    </form>

    <h2>Direcciones</h2>
    <ul>
        @foreach ($direcciones as $direccion)
        <li>
            {{ $direccion->calle }}, {{ $direccion->ciudad }}, {{ $direccion->region }}
            <a href="{{ route('user.direccion.edit', $direccion->id) }}" class="btn btn-secondary">Editar</a>
            <form action="{{ route('user.direccion.update', $direccion->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('PUT')
            </form>
        </li>
    @endforeach
    </ul>
    <a href="{{ route('user.direccion.create') }}" class="btn btn-primary">Agregar Dirección</a>
</div>
@endsection

