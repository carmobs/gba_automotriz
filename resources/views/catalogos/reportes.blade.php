@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => ['Inicio' => url('/'), 'Reportes' => url('/catalogos/reportes')]])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Reportes</h1>
    </div>
</div>

<div class="list-group">
    <a href="{{ route('reportes.citas') }}" class="list-group-item list-group-item-action">
        Ver las citas en un rango de tiempo
    </a>
    <a href="{{ route('reportes.pagos') }}" class="list-group-item list-group-item-action">
        Ver los pagos en un periodo de tiempo
    </a>
    <a href="{{ route('reportes.reparaciones') }}" class="list-group-item list-group-item-action">
        Reparaciones realizadas por mecánicos en una fecha
    </a>
</div>
@endsection
