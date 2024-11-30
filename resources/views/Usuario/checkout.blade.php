@extends('layouts.app')

@section('title', 'Confirmar Pedido')

@section('content')
    <h1>Confirmar Pedido</h1>

    <div class="order-summary">
        <h3>Resumen del Pedido</h3>
        <ul>
            @foreach($carrito as $item)
                <li>
                    {{ $item->producto->nom_producto }} - {{ $item->cantidad }} x ${{ $item->producto->precio }} = ${{ $item->cantidad * $item->producto->precio }}
                </li>
            @endforeach
        </ul>
        <h3>Total: ${{ $carrito->sum(fn($item) => $item->producto->precio * $item->cantidad) }}</h3>
    </div>

    <form action="{{ route('pedido.confirmar') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="direccion">Dirección de Envío:</label>
            <input type="text" name="direccion" value="{{ auth()->user()->direccion }}" required>
        </div>
        <div class="form-group">
            <label for="metodo_pago">Método de Pago:</label>
            <select name="metodo_pago" required>
                <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                <option value="efectivo">Pago en Efectivo</option>
            </select>
        </div>
        <button type="submit" class="btn">Confirmar Pedido</button>
    </form>
@endsection
