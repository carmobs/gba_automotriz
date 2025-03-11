@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Reparaciones</h1>
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
        <td class="text-center">{{ $reparacion->empleado_nombre }}</td>
        <td class="text-center">{{ $reparacion->fecha_reparacion }}</td>
        <td class="text-center">{{ $reparacion->estado }}</td>
        <td class="text-center">
            <a class="btn btn-primary" href="{{url('/catalogos/reparacion/actualizar')}}">Actualizar</a>
            <a class="btn btn-primary" href="{{url('/catalogos/reparacion/eliminar')}}">Eliminar</a>
            <a class="btn btn-primary" href="{{url('/catalogos/reparacion/orden_reparacion')}}">Orden de Reparacion</a>
        </td>
    </tr>
@endforeach
</tbody>
</table>

<script>

</script>
@endsection
