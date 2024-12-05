@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Historial de Compras</h1>
        @if($ventas->isEmpty())
            <p>No has realizado compras aún.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Fecha</th>
                        <th>Tipo de Entrega</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($ventas as $venta)
                        <tr>
                            <td>{{ $venta->id_venta }}</td>
                            <td>{{ $venta->fecha }}</td>
                            <td>
                                @if($venta->tipo_entrega === 'retiro')
                                    Retiro en Tienda
                                @elseif($venta->tipo_entrega === 'delivery')
                                    Delivery a Domicilio
                                @else
                                    No especificado
                                @endif
                            </td>
                            <td>{{ $venta->entrega_completada ? 'Completada' : 'Pendiente' }}</td>
                            <td>
                                <a href="{{ route('user.detalle_compra', $venta->id_venta) }}" class="btn btn-primary btn-sm">Ver Detalle</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
