@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Empleados</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/empleados/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">FECHA INGRESO</th>
        <th scope="col">ESTADO</th>
        <th scope="col">ACCIONES</th>
    </tr>
</thead>
<tbody>
@foreach($empleados as $empleado)
    <tr>
        <td class="text-center">{{ $empleado->id_empleados }}</td>
        <td class="text-center">{{ $empleado->nombre }}</td>
        <td class="text-center">{{ \Carbon\Carbon::parse($empleado->fecha_ingreso)->format('d/m/Y') }}</td>
        <td class="text-center">
            <span class="badge {{ $empleado->estado ? 'bg-success' : 'bg-danger' }}">
                {{ $empleado->estado ? 'Activo' : 'Inactivo' }}
            </span>
        </td>
        <td>
            <div class="d-flex gap-2 justify-content-center">
                <a href="{{ url('/catalogos/empleados/actualizar/'.$empleado->id_empleados) }}" class="btn btn-danger d-flex align-items-center gap-1">
                    <i class="bi bi-pencil-fill"></i>
                    <span>Actualizar</span>
                </a>
                <a href="{{ url('/catalogos/empleados/'.$empleado->id_empleados.'/puestos') }}" class="btn btn-danger d-flex align-items-center gap-1">
                    <i class="bi bi-briefcase-fill"></i>
                    <span>Puestos</span>
                </a>
            </div>
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