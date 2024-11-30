@extends('layouts.app')

@section('title', 'Carrito de Compras')

@section('content')
    <h1>Carrito de Compras</h1>

    @if($carrito->isEmpty())
        <p>Tu carrito está vacío. <a href="{{ route('minimarket') }}">Agrega productos aquí</a>.</p>
    @else
        <table class="cart-table">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio Unitario</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $item)
                    <tr>
                        <td>{{ $item->producto->nom_producto }}</td>
                        <td>
                            <form action="{{ route('carrito.update', $item->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input type="number" name="cantidad" value="{{ $item->cantidad }}" min="1">
                                <button type="submit" class="btn-small">Actualizar</button>
                            </form>
                        </td>
                        <td>${{ $item->producto->precio }}</td>
                        <td>${{ $item->producto->precio * $item->cantidad }}</td>
                        <td>
                            <form action="{{ route('carrito.remove', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-small btn-danger">Eliminar</button>
                           
