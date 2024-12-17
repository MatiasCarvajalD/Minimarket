@extends('layouts.admin')
@include('partials.alerts')
@section('content')
    <div class="container">
        <h1>Agregar Producto</h1>
        <form action="{{ route('admin.productos.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="nom_producto" class="form-label">Nombre</label>
                <input type="text" name="nom_producto" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3" required></textarea>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="stock_actual" class="form-label">Stock Actual</label>
                <input type="number" name="stock_actual" class="form-control" required>
            </div>
            <div class="mb-3">
                <label for="stock_critico" class="form-label">Stock Crítico</label>
                <input type="number" name="stock_critico" class="form-control" required>
            </div>            
            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoría</label>
                <select name="id_categoria" class="form-select" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}">{{ $categoria->categoria }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <input type="text" name="nom_producto" placeholder="Imagen Del Producto" required>
                <input type="file" name="imagen" accept="image/*" required>
            </div>            
            <button type="submit" class="btn btn-success">Guardar</button>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
