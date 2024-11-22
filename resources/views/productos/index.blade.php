@extends('layouts.app')

@section('content')
<h1>Lista de Productos</h1>
<table>
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($productos as $producto)
        <tr>
            <td>{{ $producto->nom_producto }}</td>
            <td>{{ $producto->precio }}</td>
            <td>
                <a href="{{ route('productos.edit', $producto->cod_producto) }}">Editar</a>
                <form action="{{ route('productos.destroy', $producto->cod_producto) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Eliminar</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
