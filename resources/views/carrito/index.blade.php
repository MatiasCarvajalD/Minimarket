@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Carrito de Compras</h1>
        @if($carrito->isEmpty())
            <p>No hay productos en el carrito.</p>
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
                    @php $total = 0; @endphp
                    @foreach($carrito as $item)
                        @php $subtotal = $item->cantidad * $item->producto->precio; @endphp
                        @php $total += $subtotal; @endphp
                        <tr>
                            <td>{{ $item->producto->nom_producto }}</td>
                            <td>{{ $item->cantidad }}</td>
                            <td>${{ $item->producto->precio }}</td>
                            <td>${{ $subtotal }}</td>
                            <td>
                                <form action="{{ route('carrito.remove', $item->id_carrito) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <h3>Total: ${{ $total }}</h3>
            <a href="{{ route('carrito.checkout') }}" class="btn btn-success">Finalizar Compra</a>
        @endif
    </div>
@endsection
