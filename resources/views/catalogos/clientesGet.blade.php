@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Clientes</h1>
    </div>
    <div class="col-auto titlebar-commands">
        <a class="btn btn-primary" href="{{url('/catalogos/clientes/agregar')}}">Agregar</a>
    </div>
</div>

<table class="table" id="maintable">
<thead>
    <tr>
        <th scope="col">ID</th>
        <th scope="col">NOMBRE</th>
        <th scope="col">TELEFONO</th>
        <th scope="col">ESTADO</th>
        <th scope="col">ACCIONES</th>
    </tr>
</thead>
<tbody>
@foreach($clientes as $cliente)
    <tr>
        <td class="text-center">{{$cliente->id_clientes}}</td>
        <td class="text-center">{{$cliente->nombre}}</td>
        <td class="text-center">{{$cliente->telefono}}</td>
        <td class="text-center">{{$cliente->estado}}</td>
        <td class="text-center">
            <a class="btn btn-primary" href="{{ url('/catalogos/clientes/actualizar/' . $cliente->id_clientes) }}">Actualizar</a>
            @component('components.delete-button', ['route' => 'clientes.destroy', 'id' => $cliente->id_clientes])
            @endcomponent
        </td>
    </tr>
@endforeach
</tbody>
</table>
<script>

</script>
@endsection
