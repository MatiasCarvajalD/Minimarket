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
                    @foreach ($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id_venta }}</td>
                        <td>{{ $venta->rut_usuario }}</td>
                        <td>{{ $venta->tipo_entrega }}</td>
                        <td>{{ $venta->metodo_pago }}</td>
                        <td>
                            {{ $venta->entrega_completada ? 'Completada' : 'Pendiente' }}
                        </td>
                        <td>
                            <form action="{{ route('admin.ventas.cambiarEstado', $venta->id_venta) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <select name="entrega_completada" onchange="this.form.submit()">
                                    <option value="0" {{ !$venta->entrega_completada ? 'selected' : '' }}>Pendiente</option>
                                    <option value="1" {{ $venta->entrega_completada ? 'selected' : '' }}>Completada</option>
                                </select>
                            </form>
                        </td>
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