@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Servicios</h1>
        <a href="{{ url('/catalogos/servicios/agregar') }}" class="btn btn-danger">Agregar</a>
    </div>
    
    <table class="table">
        <thead class="bg-light">
            <tr class="text-center">
                <th>ID</th>
                <th>NOMBRE</th>
                <th>DESCRIPCIÓN</th>
                <th>TIEMPO</th>
                <th>COSTO</th>
                <th>ESTADO</th>
                <th width="280px">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($servicios as $servicio)
            <tr class="text-center align-middle">
                <td>{{ $servicio->id_servicios }}</td>
                <td>{{ $servicio->nombre }}</td>
                <td>{{ $servicio->descripcion }}</td>
                <td>{{ $servicio->tiempo }} hrs</td>
                <td>${{ number_format($servicio->costo, 2) }}</td>
                <td>
                    <span class="badge {{ $servicio->estado ? 'bg-success' : 'bg-danger' }}">
                        {{ $servicio->estado ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ url('/catalogos/servicios/actualizar/'.$servicio->id_servicios) }}" class="btn btn-danger">
                            <i class="bi bi-pencil-fill"></i> Actualizar
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection