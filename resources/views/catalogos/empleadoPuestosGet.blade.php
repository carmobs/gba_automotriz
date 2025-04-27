@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Puestos de {{ $empleado->nombre }}</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ route('empleados.puestos.create', $empleado->id_empleados) }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Puesto</th>
            <th scope="col">Fecha Inicio</th>
            <th scope="col">Fecha Fin</th>
        </tr>
    </thead>
    <tbody>
        @foreach($puestos as $puesto)
        <tr>
            <td class="text-center">{{ $puesto->id_detalle_puesto }}</td>
            <td class="text-center">{{ $puesto->nombre_puesto }}</td>
            <td class="text-center">{{ $puesto->fecha_inicio }}</td>
            <td class="text-center">{{ $puesto->fecha_fin ?? 'Actual' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
