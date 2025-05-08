@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Pagos</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ url('/catalogos/pagos/agregar') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">CLIENTE</th>
        <th scope="col">ID REPARACIÓN</th>
        <th scope="col">FECHA</th>
        <th scope="col">MONTO</th>
        <th scope="col">ACCIONES</th>
    </tr>
</thead>
<tbody>
@foreach($pagos as $pago)
    <tr>
        <td class="text-center">{{ $pago->id_pagos}}</td>
        <td class="text-center">{{ $pago->cliente_nombre }}</td>
        <td class="text-center">{{ $pago->id_reparacion }}</td>
        <td class="text-center">{{ $pago->fecha }}</td>
        <td class="text-center">{{ $pago->monto }}</td>
        <td class="text-center">
            <a class="btn btn-primary" href="{{ url('/catalogos/pagos/actualizar/' . $pago->id_pagos) }}">Actualizar</a>
        </td>
    </tr>
@endforeach
</tbody>
</table>

<script>

</script>
@endsection
