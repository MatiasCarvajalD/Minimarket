@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Lista de Productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Crear Producto</a>
    <table class="table">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Categoría</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->nom_producto }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->categoria->categoria ?? 'Sin Categoría' }}</td>
                <td>{{ $producto->stock_actual }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
