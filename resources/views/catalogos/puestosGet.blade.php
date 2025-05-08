@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Puestos</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{ route('puestos.create') }}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripción</th>
            <th scope="col">Sueldo</th>
            <th scope="col">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($puestos as $puesto)
        <tr>
            <td class="text-center">{{ $puesto->id_puestos }}</td>
            <td class="text-center">{{ $puesto->nombre_puesto }}</td>
            <td class="text-center">{{ $puesto->descripcion }}</td>
            <td class="text-center">{{ $puesto->sueldo }}</td>
            <td class="text-center">
                <a class="btn btn-primary" href="{{ url('/catalogos/puestos/actualizar/' . $puesto->id_puestos) }}">Actualizar</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
