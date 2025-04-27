@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Citas</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ route('citas.create') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">Vehículo</th>
        <th scope="col">Fecha</th>
        <th scope="col">Hora</th>
        <th scope="col">Estado</th>
        <th scope="col">Acciones</th>
    </tr>
</thead>
<tbody>
@foreach($citas as $cita)
    <tr>
        <td class="text-center">{{ $cita->id_citas }}</td>
        <td class="text-center">{{ $cita->marca }} {{ $cita->modelo }}</td>
        <td class="text-center">{{ $cita->fecha_cita }}</td>
        <td class="text-center">{{ $cita->hora_cita }}</td>
        <td class="text-center">{{ $cita->estado }}</td>
        <td class="text-center">
            <a class="btn btn-primary" href="{{ route('citas.update.get', $cita->id_citas) }}">Actualizar</a>
            @component('components.delete-button', ['route' => 'citas.destroy', 'id' => $cita->id_citas])
            @endcomponent
        </td>
    </tr>
@endforeach
</tbody>
</table>
@endsection
