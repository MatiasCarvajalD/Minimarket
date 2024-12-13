@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Editar Producto</h1>
        <form action="{{ route('admin.productos.update', $producto->cod_producto) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="nom_producto" class="form-label">Nombre</label>
                <input type="text" name="nom_producto" class="form-control" value="{{ $producto->nom_producto }}" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea name="descripcion" class="form-control" rows="3" required>{{ $producto->descripcion }}</textarea>
            </div>
            <div class="mb-3">
                <label for="marca" class="form-label">Marca</label>
                <input type="text" name="marca" class="form-control" value="{{ $producto->marca }}" required>
            </div>
            <div class="mb-3">
                <label for="precio" class="form-label">Precio</label>
                <input type="number" name="precio" class="form-control" step="0.01" value="{{ $producto->precio }}" required>
            </div>
            <div class="mb-3">
                <label for="stock_actual" class="form-label">Stock Actual</label>
                <input type="number" name="stock_actual" class="form-control" value="{{ $producto->stock_actual }}" required>
            </div>
            <div class="mb-3">
                <label for="id_categoria" class="form-label">Categoría</label>
                <select name="id_categoria" class="form-select" required>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id_categoria }}" @if($producto->id_categoria == $categoria->id_categoria) selected @endif>{{ $categoria->categoria }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="btn btn-success">Actualizar</button>
            <a href="{{ route('admin.productos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
