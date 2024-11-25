@extends('layouts.app')

@section('title', 'Productos')

@section('content')
    <h2 class="text-center">Lista de Productos</h2>
    <table class="table table-striped mt-4">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($productos as $producto)
                <tr>
                    <td>{{ $producto->nom_producto }}</td>
                    <td>{{ $producto->precio }}</td>
                    <td>{{ $producto->stock_actual }}</td>
                    <td>
                        <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-warning btn-sm">Editar</a>
                        <form method="POST" action="{{ route('productos.destroy', $producto->id) }}" style="display: inline-block;">
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
