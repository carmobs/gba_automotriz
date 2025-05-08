@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Vehículos</h1>
        <a href="{{ url('/catalogos/vehiculos/agregar') }}" class="btn btn-danger">Agregar</a>
    </div>
    
    <table class="table">
        <thead class="bg-light">
            <tr class="text-center">
                <th>ID</th>
                <th>CLIENTE</th>
                <th>MARCA</th>
                <th>MODELO</th>
                <th>AÑO</th>
                <th>ESTADO</th>
                <th width="280px">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($vehiculos as $vehiculo)
            <tr class="text-center align-middle">
                <td>{{ $vehiculo->id_vehiculos }}</td>
                <td>{{ $vehiculo->cliente_nombre }}</td>
                <td>{{ $vehiculo->marca }}</td>
                <td>{{ $vehiculo->modelo }}</td>
                <td>{{ $vehiculo->año }}</td>
                <td>
                    <span class="badge {{ $vehiculo->estado ? 'bg-success' : 'bg-danger' }}">
                        {{ $vehiculo->estado ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ url('/catalogos/vehiculos/actualizar/'.$vehiculo->id_vehiculos) }}" class="btn btn-danger d-flex align-items-center gap-1">
                            <i class="bi bi-pencil-fill"></i>
                            <span>Actualizar</span>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection