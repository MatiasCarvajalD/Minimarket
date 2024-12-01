@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
<h1 class="mb-4">Tu Carrito</h1>

@if($carrito->isEmpty())
    <div class="alert alert-warning">
        Tu carrito está vacío. <a href="{{ route('minimarket.index') }}">Empieza a comprar aquí</a>.
    </div>
@else
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($carrito as $detalle)
                <tr>
                    <td>{{ $detalle->producto->nom_producto }}</td>
                    <td>{{ $detalle->cantidad }}</td>
                    <td>${{ number_format($detalle->producto->precio, 0, ',', '.') }}</td>
                    <td>${{ number_format($detalle->producto->precio * $detalle->cantidad, 0, ',', '.') }}</td>
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

    <div class="d-flex justify-content-between">
        <a href="{{ route('minimarket.index') }}" class="btn btn-secondary">Seguir Comprando</a>
        <a href="{{ route('checkout.index') }}" class="btn btn-primary">Ir al Checkout</a>
    </div>
@endif
@endsection
