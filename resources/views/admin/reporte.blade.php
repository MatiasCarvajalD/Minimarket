@extends('layouts.app')

@section('title', 'Generar Reportes')

@section('content')
<h1>Generar Reporte</h1>
<form action="{{ route('admin.reporte') }}" method="GET">
    <div class="form-group">
        <label for="fecha_inicio">Fecha Inicio</label>
        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="fecha_fin">Fecha Fin</label>
        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Generar</button>
</form>
@endsection
