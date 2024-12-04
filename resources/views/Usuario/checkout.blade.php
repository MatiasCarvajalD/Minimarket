@extends('layouts.app')

@section('title', 'Finalizar Compra')

@section('content')
<div class="container">
    <h1>Finalizar Compra</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio Unitario</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($carrito as $item)
            <tr>
                <td>{{ $item->producto->nombre }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>${{ number_format($item->producto->precio, 0, ',', '.') }}</td>
                <td>${{ number_format($item->total, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="text-right">
        <h4>Total a pagar: ${{ number_format($total, 0, ',', '.') }}</h4>
    </div>
    <form method="POST" action="{{ route('carrito.checkout') }}">
        @csrf
        <button type="submit" class="btn btn-success">Confirmar Compra</button>
    </form>
</div>
@endsection
