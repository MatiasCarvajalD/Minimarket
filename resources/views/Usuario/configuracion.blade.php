@extends('layouts.app')
@include('partials.alerts')

@section('content')
<div class="container">
    <h1>Configuración de Cuenta</h1>
    <form method="POST" action="{{ route('user.profile.update') }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nombre_usuario" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre_usuario" name="nombre_usuario" value="{{ old('nombre_usuario', auth()->user()->nombre_usuario) }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Correo Electrónico</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', auth()->user()->email) }}" required>
        </div>

        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ old('telefono', auth()->user()->telefono) }}">
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

