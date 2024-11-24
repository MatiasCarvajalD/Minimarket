@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Producto</h1>
    <form action="{{ route('productos.update', $producto->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre del Producto</label>
            <input type="text" class="form-control" id="nombre" name="nom_producto" value="{{ $producto->nom_producto }}" required>
        </div>
        <div class="mb-3">
            <label for="precio" class="form-label">Precio</label>
            <input type="number" class="form-control" id="precio" name="precio" value="{{ $producto->precio }}" required>
        </div>
        <div class="mb-3">
            <label for="categoria" class="form-label">Categoría</label>
            <select class="form-select" id="categoria" name="id_categoria" required>
                @foreach ($categorias as $categoria)
                <option value="{{ $categoria->id_categoria }}" {{ $producto->id_categoria == $categoria->id_categoria ? 'selected' : '' }}>
                    {{ $categoria->categoria }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock</label>
            <input type="number" class="form-control" id="stock" name="stock_actual" value="{{ $producto->stock_actual }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Producto</button>
    </form>
</div>
@endsection
