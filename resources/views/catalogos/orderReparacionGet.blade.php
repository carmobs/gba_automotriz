@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Órdenes de Reparación</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/orden_reparacion/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">ID REPARACIÓN</th>
        <th scope="col">ID SERVICIO</th>
        <th scope="col">COSTO UNITARIO</th>
        <th scope="col">CANTIDAD</th>
        <th scope="col">ESTADO</th>
        <th scope="col">ACCIONES</th>
    </tr>
</thead>
<tbody>
@foreach($ordenes as $orden)
    <tr>
        <td class="text-center">{{ $orden->id_detalle_reparacion }}</td>
        <td class="text-center">{{ $orden->id_reparacion }}</td>
        <td class="text-center">{{ $orden->id_servicios }}</td>
        <td class="text-center">{{ $orden->costo_unitario_servicio }}</td>
        <td class="text-center">{{ $orden->cantidad }}</td>
        <td class="text-center">{{ $orden->estado }}</td>
        <td class="text-center">
            @if(!$isPagada)
                <a class="btn btn-primary" href="{{ route('orden_reparacion.update.get', $orden->id_detalle_reparacion) }}">Actualizar</a>
            @endif
        </td>
    </tr>
@endforeach
</tbody>
</table>

<script>

</script>
@endsection