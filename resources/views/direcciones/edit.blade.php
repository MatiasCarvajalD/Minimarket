@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Dirección</h1>
    <form action="{{ route('user.direccion.update', $direccion->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="calle" class="form-label">Calle</label>
            <input type="text" name="calle" class="form-control" value="{{ $direccion->calle }}" required>
        </div>
        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" name="ciudad" class="form-control" value="{{ $direccion->ciudad }}" required>
        </div>
        <div class="mb-3">
            <label for="region" class="form-label">Región</label>
            <input type="text" name="region" class="form-control" value="{{ $direccion->region }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        <form action="{{ route('user.direccion.destroy', $direccion->id) }}" method="POST" style="display: inline-block;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de que deseas eliminar esta dirección?')">Eliminar Dirección</button>
        </form>
        
    </form>
</div>
@endsection
