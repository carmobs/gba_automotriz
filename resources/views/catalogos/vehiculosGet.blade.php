@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Vehiculos</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class = "btn btn-primary" href="{{url('/catalogos/vehiculos/agregar')}}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">CLIENTE</th>
        <th scope="col">MARCA</th>
        <th scope="col">MODELO</th>
        <th scope="col">AÑO</th>
        <th scope="col">DETALLE DEL VEHICULO</th>
        <th scope="col">ACCIONES</th>
    </tr>
</thead>
<tbody>
@foreach($vehiculos as $vehiculo)
    <tr>
        <td class="text-center">{{$vehiculo->id_vehiculos}}</td>
        <td class="text-center">{{$vehiculo->cliente_nombre}}</td>
        <td class="text-center">{{$vehiculo->marca}}</td>
        <td class="text-center">{{$vehiculo->modelo}}</td>
        <td class="text-center">{{$vehiculo->año}}</td>
        <td class="text-center">{{$vehiculo->detalles_vehiculo}}</td>
        <td class="text-center">
            <a class="btn btn-primary" href="{{url('/catalogos/vehiculos/actualizar')}}">Actualizar</a>
            <a class="btn btn-primary" href="{{url('/catalogos/vehiculos/eliminar')}}">Eliminar</a>
        </td>
    </tr>
@endforeach
</tbody>
</table>
<script>

</script>
@endsection