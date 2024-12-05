@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h1>Tu Carrito</h1>

    @if ($carrito->isEmpty())
        <div class="alert alert-warning">Tu carrito está vacío.</div>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                @php $total = 0; @endphp
                @foreach ($carrito as $item)
                    @php
                        $subtotal = $item->cantidad * $item->producto->precio;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->producto->nom_producto }}</td>
                        <td>{{ $item->cantidad }}</td>
                        <td>${{ number_format($item->producto->precio, 0, ',', '.') }}</td>
                        <td>${{ number_format($subtotal, 0, ',', '.') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3 class="text-end">Total: ${{ number_format($total, 0, ',', '.') }}</h3>

        <a href="{{ route('carrito.checkout') }}" class="btn btn-primary">Proceder al Checkout</a>

    @endif
</div>
@endsection
