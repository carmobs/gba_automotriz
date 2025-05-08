@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Servicios</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class = "btn btn-primary" href="{{url('/catalogos/servicios/agregar')}}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">DESCRIPCION</th>
        <th scope="col">TIEMPO</th>
        <th scope="col">COSTO</th>
        <th scope="col">ESTADO</th>
        <th scope="col">ACCIONES</th>
    </tr>
</thead>
<tbody>
@foreach($servicios as $servicio)
    <tr>
        <td class="text-center">{{$servicio->id_servicios}}</td>
        <td class="text-center">{{$servicio->nombre}}</td>
        <td class="text-center">{{$servicio->descripcion}}</td>
        <td class="text-center">{{ $servicio->tiempo }}</td>
        <td class="text-center">{{ $servicio->costo }}</td>
        <td class="text-center">{{ $servicio->estado }}</td>
        <td class="text-center">
            <a class="btn btn-primary" href="{{ url('/catalogos/servicios/actualizar/' . $servicio->id_servicios) }}">Actualizar</a>
            @component('components.delete-button', ['route' => 'servicios.destroy', 'id' => $servicio->id_servicios])
            @endcomponent
        </td>
    </tr>
@endforeach
</tbody>
</table>
@endsection