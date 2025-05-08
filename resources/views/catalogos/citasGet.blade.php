@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Listado de Citas</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a href="{{ route('citas.create') }}" class="btn btn-primary">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">VEHÍCULO</th>
            <th scope="col">FECHA</th>
            <th scope="col">HORA</th>
            <th scope="col">ESTADO</th>
            <th scope="col">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($citas as $cita)
        <tr>
            <td class="text-center">{{ $cita->id_citas }}</td>
            <td class="text-center">{{ $cita->vehiculo->marca }} {{ $cita->vehiculo->modelo }}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('d/m/Y') }}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($cita->hora_cita)->format('H:i') }}</td>
            <td class="text-center">{{ $cita->estado }}</td>
            <td class="text-center">
                <a class="btn btn-primary" href="{{ url('/catalogos/citas/actualizar/' . $cita->id_citas) }}">Actualizar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>
$(document).ready(function() {
    $('#maintable').DataTable();
});
</script>
@endsection
