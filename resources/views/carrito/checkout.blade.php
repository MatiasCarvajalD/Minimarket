@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Checkout</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carrito as $item)
                @php
                    $producto = $productos->firstWhere('cod_producto', $item->cod_producto);
                @endphp
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $item->cantidad }}</td>
                    <td>${{ $producto->precio }}</td>
                    <td>${{ $producto->precio * $item->cantidad }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <a href="#" class="btn btn-success">Finalizar Compra</a>
</div>
@endsection
