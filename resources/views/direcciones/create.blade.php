@extends('layouts.app')

@section('title', 'Agregar Dirección')

@section('content')
<div class="container">
    <h1>Agregar Nueva Dirección</h1>

    <form action="{{ route('user.direccion.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="calle" class="form-label">Calle</label>
            <input type="text" name="calle" id="calle" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="ciudad" class="form-label">Ciudad</label>
            <input type="text" name="ciudad" id="ciudad" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="region" class="form-label">Región</label>
            <input type="text" name="region" id="region" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Dirección</button>
    </form>
</div>
@endsection
