@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Ventas</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/reparacion/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">CLIENTE</th>
        <th scope="col">VEHÍCULO</th>
        <th scope="col">EMPLEADO</th>
        <th scope="col">FECHA</th>
        <th scope="col">ESTADO</th>
        <th scope="col">ACCIONES</th>
    </tr>
</thead>
<tbody>
@foreach($reparaciones as $reparacion)
    <tr>
        <td class="text-center">{{ $reparacion->id_reparacion }}</td>
        <td class="text-center">{{ $reparacion->cliente_nombre }}</td>
        <td class="text-center">{{ $reparacion->marca }} {{ $reparacion->modelo }}</td>
        <td class="text-center">{{ $reparacion->empleado_nombre }}</td>
        <td class="text-center">{{ $reparacion->fecha_reparacion }}</td>
        <td class="text-center">{{ $reparacion->estado }}</td>
        <td class="text-center">
            <a class="btn btn-primary" href="{{ url('/catalogos/reparacion/actualizar/' . $reparacion->id_reparacion) }}">Actualizar</a>
            @component('components.delete-button', ['route' => 'reparacion.destroy', 'id' => $reparacion->id_reparacion])
            @endcomponent
            <a class="btn btn-primary" href="{{ url('/catalogos/orden_reparacion/ordenReparacionGet', ['id_reparacion' => $reparacion->id_reparacion]) }}">Orden de Reparación</a>
        </td>
    </tr>
@endforeach
</tbody>
</table>

<script>

</script>
@endsection
