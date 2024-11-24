@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Carrito de Compras</h1>
    @if (session('carrito') && count(session('carrito')) > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach (session('carrito') as $item)
            <tr>
                <td>{{ $item['nombre'] }}</td>
                <td>{{ $item['cantidad'] }}</td>
                <td>{{ $item['precio'] }}</td>
                <td>{{ $item['precio'] * $item['cantidad'] }}</td>
                <td>
                    <form action="{{ route('carrito.remove', $item['id']) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @else
    <p>No hay productos en el carrito.</p>
    @endif
</div>
@endsection
