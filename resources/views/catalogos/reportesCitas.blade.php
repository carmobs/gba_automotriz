@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => ['Inicio' => url('/'), 'Reportes' => url('/catalogos/reportes'), 'Citas' => url('/catalogos/reportes/citas')]])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Reporte de Citas</h1>
    </div>
</div>

<form action="{{ route('reportes.citas') }}" method="GET" class="mb-4">
    <div class="row">
        <div class="col-md-5">
            <label for="fecha_inicio" class="form-label">Fecha Inicio</label>
            <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" value="{{ request('fecha_inicio') }}" required>
        </div>
        <div class="col-md-5">
            <label for="fecha_fin" class="form-label">Fecha Fin</label>
            <input type="date" class="form-control" id="fecha_fin" name="fecha_fin" value="{{ request('fecha_fin') }}" required>
        </div>
        <div class="col-md-2 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Filtrar</button>
        </div>
    </div>
</form>

@if(isset($citas))
    <table class="table" id="maintable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Vehículo</th>
                <th scope="col">Fecha</th>
                <th scope="col">Hora</th>
                <th scope="col">Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
            <tr>
                <td class="text-center">{{ $cita->id_citas }}</td>
                <td class="text-center">{{ $cita->marca }} {{ $cita->modelo }}</td>
                <td class="text-center">{{ $cita->fecha_cita }}</td>
                <td class="text-center">{{ $cita->hora_cita }}</td>
                <td class="text-center">{{ $cita->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
