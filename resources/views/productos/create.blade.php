@extends('layouts.app')

@section('content')
<h1>Crear Producto</h1>
<form action="{{ route('productos.store') }}" method="POST">
    @csrf
    <label for="nom_producto">Nombre del Producto:</label>
    <input type="text" name="nom_producto" id="nom_producto" required>

    <label for="precio">Precio:</label>
    <input type="number" name="precio" id="precio" required>

    <label for="id_categoria">Categoría:</label>
    <select name="id_categoria" id="id_categoria">
        @foreach ($categorias as $categoria)
            <option value="{{ $categoria->id_categoria }}">{{ $categoria->categoria }}</option>
        @endforeach
    </select>

    <button type="submit">Crear</button>
</form>
@endsection
