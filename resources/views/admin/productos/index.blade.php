@extends('layouts.admin')
@include('partials.alerts')

@section('content')
    <div class="container">
        <h1>Gestión de Productos</h1>
        <a href="{{ route('admin.productos.create') }}" class="btn btn-primary mb-3">Agregar Producto</a>
        <a href="{{ route('admin.download.csv') }}" class="btn btn-primary mb-3">Download CSV</a>
        
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Marca</th>
                    <th>Precio</th>
                    <th>Stock</th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse($productos as $producto)
                    <tr>
                        <td>{{ $producto->cod_producto }}</td>
                        <td>{{ $producto->nom_producto }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->marca }}</td>
                        <td>${{ number_format($producto->precio, 2) }}</td>
                        <td>{{ $producto->stock_actual }}</td>
                        <td>{{ $producto->tipoProducto->categoria }}</td>
                        <td>
                            @if($producto->deleted_at)
                                <span class="text-danger">Eliminado</span>
                            @elseif($producto->stock_actual <= $producto->stock_critico)
                                <span class="text-danger">Crítico</span>
                            @else
                                <span class="text-success">Ok</span>
                            @endif
                        </td>
                        <td>
                            @if($producto->deleted_at)
                                {{-- Botón para Restaurar --}}
                                <form action="{{ route('admin.productos.restore', $producto->cod_producto) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('PATCH')
                                    <button type="submit" class="btn btn-success btn-sm">Restaurar</button>
                                </form>
                                
                                {{-- Botón para Eliminar Permanentemente --}}
                                <form action="{{ route('admin.productos.forceDelete', $producto->cod_producto) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar Permanentemente</button>
                                </form>
                            @else
                                {{-- Botón para Editar --}}
                                <a href="{{ route('admin.productos.edit', $producto->cod_producto) }}" class="btn btn-warning btn-sm">Editar</a>

                                {{-- Botón para Eliminar (SoftDelete) --}}
                                <form action="{{ route('admin.productos.destroy', $producto->cod_producto) }}" method="POST" style="display:inline-block;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="9" class="text-center">No hay productos disponibles.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
