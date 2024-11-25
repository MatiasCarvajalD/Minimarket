@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Carrito de Compras</h1>

    @if(session()->has('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($carrito) || count($carrito) === 0)
        <p>No hay productos en el carrito.</p>
    @else
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Producto</th>
                    <th>Precio</th>
                    <th>Cantidad</th>
                    <th>Total</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($carrito as $id => $producto)
                    <tr>
                        <td>{{ $producto['nombre'] }}</td>
                        <td>${{ number_format($producto['precio'], 0, ',', '.') }}</td>
                        <td>{{ $producto['cantidad'] }}</td>
                        <td>${{ number_format($producto['precio'] * $producto['cantidad'], 0, ',', '.') }}</td>
                        <td>
                            <form action="{{ route('carrito.remove', $id) }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-danger btn-sm">
                                    <i class="fas fa-trash"></i> Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <h4 class="mt-4">Total: ${{ number_format($total, 0, ',', '.') }}</h4>

        <form action="{{ route('carrito.clear') }}" method="POST" class="mt-3">
            @csrf
            <button type="submit" class="btn btn-warning">
                <i class="fas fa-trash-alt"></i> Vaciar Carrito
            </button>
        </form>
    @endif
</div>
@endsection
