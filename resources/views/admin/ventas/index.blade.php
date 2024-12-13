@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Gestión de Ventas</h1>
        @if($ventas->isEmpty())
            <p>No se han registrado ventas.</p>
        @else
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID Venta</th>
                        <th>Usuario</th>
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
                            <td>{{ $venta->usuario->nombre_usuario }}</td>
                            <td>{{ $venta->fecha }}</td>
                            <td>{{ $venta->tipo_entrega == 1 ? 'Retiro' : 'Delivery' }}</td>
                            <td>{{ $venta->entrega_completada ? 'Completada' : 'Pendiente' }}</td>
                            <td>
                                <a href="{{ route('admin.ventas.show', $venta->id_venta) }}" class="btn btn-primary btn-sm">Ver Detalle</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
