@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Citas</h1>
        <a href="{{ url('/catalogos/citas/agregar') }}" class="btn btn-danger">Agregar</a>
    </div>
    
    <table class="table">
        <thead class="bg-light">
            <tr class="text-center">
                <th>ID</th>
                <th>VEHÍCULO</th>
                <th>FECHA</th>
                <th>HORA</th>
                <th>ESTADO</th>
                <th>DETALLES</th>
                <th width="280px">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($citas as $cita)
            <tr class="text-center align-middle">
                <td>{{ $cita->id_citas }}</td>
                <td>{{ $cita->vehiculo->marca }} {{ $cita->vehiculo->modelo }}</td>
                <td>{{ date('d/m/Y', strtotime($cita->fecha_cita)) }}</td>
                <td>{{ date('H:i', strtotime($cita->hora_cita)) }}</td>
                <td>
                    <span class="badge {{ $cita->estado == 'Confirmada' ? 'bg-success' : ($cita->estado == 'Cancelada' ? 'bg-danger' : 'bg-warning') }}">
                        {{ $cita->estado }}
                    </span>
                </td>
                <td>{{ $cita->detalles_vehiculo }}</td>
                <td>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ url('/catalogos/citas/actualizar/'.$cita->id_citas) }}" class="btn btn-danger d-flex align-items-center gap-1">
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
