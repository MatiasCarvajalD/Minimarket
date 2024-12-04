@extends('layouts.app')

@section('title', 'Reporte')

@section('content')
<div class="container">
    <h1>Reporte de Ventas</h1>
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Producto</th>
                <th>Cantidad Vendida</th>
                <th>Ingresos</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($reporte as $item)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $item->producto->nombre }}</td>
                <td>{{ $item->cantidad }}</td>
                <td>${{ number_format($item->ingresos, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
