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
        <td class="text-center">{{ $empleado->estado == 1 ? 'Activo' : 'Inactivo' }}</td>
        <td class="text-center">
            <a class="btn btn-primary" href="{{ route('empleados.update.get', $empleado->id_empleados) }}">Actualizar</a>
            <a class="btn btn-primary" href="{{ route('empleados.puestos.get', $empleado->id_empleados) }}">Puestos</a>
            @component('components.delete-button', ['route' => 'empleados.destroy', 'id' => $empleado->id_empleados])
            @endcomponent
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