@extends('layouts.app')

@section('title', 'Crear Producto')

@section('content')
<h1>Crear Nuevo Producto</h1>
<form action="{{ route('productos.store') }}" method="POST">
    @csrf
    <div class="form-group">
        <label for="nom_producto">Nombre</label>
        <input type="text" name="nom_producto" id="nom_producto" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea name="descripcion" id="descripcion" class="form-control" required></textarea>
    </div>
    <div class="form-group">
        <label for="marca">Marca</label>
        <input type="text" name="marca" id="marca" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="precio">Precio</label>
        <input type="number" name="precio" id="precio" class="form-control" min="0" required>
    </div>
    <div class="form-group">
        <label for="stock_actual">Stock Actual</label>
        <input type="number" name="stock_actual" id="stock_actual" class="form-control" min="0" required>
    </div>
    <div class="form-group">
        <label for="stock_critico">Stock Crítico</label>
        <input type="number" name="stock_critico" id="stock_critico" class="form-control" min="0" required>
    </div>
    <div class="form-group">
        <label for="id_categoria">Categoría</label>
        <select name="id_categoria" id="id_categoria" class="form-control">
            @foreach($categorias as $categoria)
                <option value="{{ $categoria->id_categoria }}">{{ $categoria->nombre_categoria }}</option>
            @endforeach
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Crear</button>
</form>
@endsection
