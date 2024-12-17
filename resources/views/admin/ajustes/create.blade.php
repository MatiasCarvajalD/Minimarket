@extends('layouts.admin')
@include('partials.alerts')
@section('content')
<div class="container">
    <h1>Registrar Ajuste</h1>
    <form action="{{ route('admin.ajustes.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="cod_producto" class="form-label">Producto</label>
            <select name="cod_producto" id="cod_producto" class="form-select" required>
                <option value="">Selecciona un producto</option>
                @foreach ($productos as $producto)
                    <option value="{{ $producto->cod_producto }}">{{ $producto->nom_producto }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" name="cantidad" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="tipo_ajuste" class="form-label">Tipo de Ajuste</label>
            <select name="tipo_ajuste" class="form-select" required>
                <option value="regalo">Regalo</option>
                <option value="fiado">Fiado</option>
                <option value="mercaderia_recibida">Mercadería Recibida</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea name="descripcion" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Ajuste</button>
    </form>
</div>
@endsection
