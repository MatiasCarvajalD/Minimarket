@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Carrito de Compras</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(count($carrito) > 0)
        <table class="table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Subtotal</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $id => $item)
                    <tr>
                        <td>{{ $item['nombre'] }}</td>
                        <td>{{ number_format($item['precio'], 2) }} CLP</td>
                        <td>{{ $item['cantidad'] }}</td>
                        <td>{{ number_format($item['precio'] * $item['cantidad'], 2) }} CLP</td>
                        <td>
                            <form method="POST" action="{{ route('carrito.remove', $id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3>Total: {{ number_format($total, 2) }} CLP</h3>
        <form method="POST" action="{{ route('carrito.clear') }}">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-warning">Vaciar Carrito</button>
        </form>
    @else
        <p>No hay productos en el carrito.</p>
    @endif
</div>
@endsection
