@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<h1 class="mb-4">Tu Carrito</h1>
@if($carrito->isEmpty())
    <div class="alert alert-warning">
        No tienes productos en tu carrito.
    </div>
@else
    <table class="table table-striped">
        <thead class="table-dark">
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrito as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nom_producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->producto->precio, 0, ',', '.') }}</td>
                    <td>${{ number_format($detalle->cantidad * $detalle->producto->precio, 0, ',', '.') }}</td>
                    <td>
                        <form action="{{ route('carrito.remove', ['id_carrito' => $detalle->id_carrito]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="{{ route('productos.index') }}" class="btn btn-primary">Seguir Comprando</a>
@endif
@endsection
