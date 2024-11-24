@extends('layouts.app')

@section('title', 'Mis Ventas')

@section('content')
<div class="container">
    <h1>Mis Ventas</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($ventas->isEmpty())
        <p>No has realizado ninguna venta.</p>
    @else
        <table class="table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Fecha</th>
                    <th>Total</th>
                    <th>Detalles</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ventas as $venta)
                    <tr>
                        <td>{{ $venta->id }}</td>
                        <td>{{ $venta->created_at->format('d-m-Y H:i') }}</td>
                        <td>{{ number_format($venta->total, 2) }} CLP</td>
                        <td>
                            <a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-primary btn-sm">Ver Detalles</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
