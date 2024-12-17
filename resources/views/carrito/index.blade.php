@extends('layouts.app')
@include('partials.alerts')
@section('title', 'Carrito de Compras')

@section('content')
<div class="container">
    <h1>Carrito de Compras</h1>
    @if ($carrito->isEmpty())
        <div class="alert alert-info">
            Tu carrito está vacío. <a href="{{ route('minimarket.index') }}">Explora productos aquí</a>.
        </div>
    @else
        <table class="table">
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
                @php $total = 0; @endphp
                @foreach ($carrito as $item)
                    @php
                        $subtotal = $item->cantidad * $item->producto->precio;
                        $total += $subtotal;
                    @endphp
                    <tr>
                        <td>{{ $item->producto->nom_producto }}</td>
                        <td>
                            <form action="{{ route('carrito.updateQuantity', $item->id_carrito) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1" max="{{ $item->producto->stock_actual }}" class="form-control form-control-sm" style="width: 80px; display: inline-block;">
                                <button type="submit" class="btn btn-sm btn-primary">Actualizar</button>
                            </form>
                        </td>
                        
                        <td>${{ number_format($item->producto->precio, 0, ',', '.') }}</td>
                        <td>${{ number_format($subtotal, 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('carrito.remove', $item->id_carrito) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="3" class="text-end fw-bold">Total:</td>
                    <td colspan="2">${{ number_format($total, 0, ',', '.') }}</td>
                </tr>
            </tfoot>
        </table>

        <div class="text-end">
            <a href="{{ route('carrito.checkout') }}" class="btn btn-success">Finalizar Compra</a>
        </div>
    @endif
</div>
@endsection
