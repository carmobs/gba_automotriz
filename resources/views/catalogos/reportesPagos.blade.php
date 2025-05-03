@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => ['Inicio' => url('/'), 'Reportes' => url('/catalogos/reportes'), 'Pagos' => url('/catalogos/reportes/pagos')]])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Reporte de Pagos</h1>
    </div>
</div>

<form action="{{ route('reportes.pagos') }}" method="GET" class="mb-4">
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

@if(isset($pagos))
    <table class="table" id="maintable">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Cliente</th>
                <th scope="col">Reparación</th>
                <th scope="col">Fecha</th>
                <th scope="col">Monto</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pagos as $pago)
            <tr>
                <td class="text-center">{{ $pago->id_pagos }}</td>
                <td class="text-center">{{ $pago->cliente_nombre }}</td>
                <td class="text-center">{{ $pago->id_reparacion }}</td>
                <td class="text-center">{{ $pago->fecha }}</td>
                <td class="text-center">${{ number_format($pago->monto, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
@endif
@endsection
