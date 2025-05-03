@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => ['Inicio' => url('/'), 'Reportes' => url('/catalogos/reportes'), 'Reparaciones' => url('/catalogos/reportes/reparaciones')]])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Reporte de Reparaciones</h1>
    </div>
</div>

<form action="{{ route('reportes.reparaciones') }}" method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-10">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha" name="fecha" value="{{ request('fecha') }}" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </div>
</form>

@if(isset($reparaciones))
    <table class="table" id="maintable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">Mecánico</th>
                <th scope="col">Fecha</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reparaciones as $reparacion)
            <tr>
                <td class="text-center">{{ $reparacion->id_reparacion }}</td>
                <td class="text-center">{{ $reparacion->cliente_nombre }}</td>
                <td class="text-center">{{ $reparacion->mecanico_nombre }}</td>
                <td class="text-center">{{ $reparacion->fecha_reparacion }}</td>
                <td class="text-center">{{ $reparacion->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
