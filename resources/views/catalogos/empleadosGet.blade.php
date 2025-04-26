@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Empleados</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class = "btn btn-primary" href="{{url('/catalogos/empleados/agregar')}}">Agregar</a>
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
        <td class="text-center">{{$empleado->id_empleados}}</td>
        <td class="text-center">{{$empleado->nombre}}</td>
        <td class="text-center">{{$empleado->fecha_ingreso}}</td>
        <td class="text-center">{{$empleado->estado}}</td>
        <td class="text-center">
            <a class="btn btn-primary" href="{{ url('/catalogos/empleados/actualizar/' . $empleado->id_empleados) }}">Actualizar</a>
            @component('components.delete-button', ['route' => 'empleados.destroy', 'id' => $empleado->id_empleados])
            @endcomponent
        </td>
    </tr>
@endforeach
</tbody>
</table>
<script>

</script>
@endsection