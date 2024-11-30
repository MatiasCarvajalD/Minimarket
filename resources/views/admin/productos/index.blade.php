@extends('layouts.app')

@section('title', 'Gestión de Productos')

@section('content')
<h1>Gestión de Productos</h1>
<a href="{{ route('productos.create') }}" class="btn btn-primary mb-3">Crear Producto</a>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Stock</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productos as $producto)
            <tr>
                <td>{{ $producto->cod_producto }}</td>
                <td>{{ $producto->nom_producto }}</td>
                <td>${{ number_format($producto->precio, 0, ',', '.') }}</td>
                <td>{{ $producto->stock_actual }}</td>
                <td>
                    <a href="{{ route('productos.edit', $producto->cod_producto) }}" class="btn btn-warning btn-sm">Editar</a>
                    <form action="{{ route('productos.destroy', $producto->cod_producto) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
@endsection
