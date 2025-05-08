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

<table class="table">
    <thead class="bg-light">
        <tr class="text-center">
            <th>ID</th>
            <th>REPARACIÓN</th>
            <th>CLIENTE</th>
            <th>FECHA</th>
            <th>MONTO</th>
            <th width="280px">ACCIONES</th>
        </tr>
    </thead>
    <tbody>
        @foreach($pagos as $pago)
        <tr class="text-center align-middle">
            <td>{{ $pago->id_pagos }}</td>
            <td>{{ $pago->id_reparacion }}</td>
            <td>{{ $pago->cliente_nombre }}</td>
            <td>{{ date('d/m/Y', strtotime($pago->fecha)) }}</td>
            <td>${{ number_format($pago->monto, 2) }}</td>
            <td>
                <div class="d-flex gap-2 justify-content-center">
                    <a href="{{ url('/catalogos/pagos/actualizar/'.$pago->id_pagos) }}" class="btn btn-danger d-flex align-items-center gap-1">
                        <i class="bi bi-pencil-fill"></i>
                        <span>Actualizar</span>
                    </a>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script>

</script>
@endsection
