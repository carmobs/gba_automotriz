@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent


<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Ventas</h1>
        <a href="{{ url('/catalogos/reparacion/agregar') }}" class="btn btn-danger">Agregar</a>
    </div>
    
    <table class="table">
        <thead class="bg-light">
            <tr class="text-center">
                <th>ID</th>
                <th>CLIENTE</th>
                <th>VEHÍCULO</th>
                <th>MECÁNICO</th>
                <th>FECHA</th>
                <th>CITA</th>
                <th>ESTADO</th>
                <th width="280px">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($reparaciones as $reparacion)
            <tr class="text-center align-middle">
                <td>{{ $reparacion->id_reparacion }}</td>
                <td>{{ $reparacion->cliente_nombre }}</td>
                <td>{{ $reparacion->marca }} {{ $reparacion->modelo }}</td>
                <td>{{ $reparacion->empleado_nombre }}</td>
                <td>{{ date('d/m/Y', strtotime($reparacion->fecha_reparacion)) }}</td>
                <td>
                    @if($reparacion->id_citas)
                        Cita #{{ $reparacion->id_citas }}
                    @else
                        Sin cita previa
                    @endif
                </td>
                <td>
                    <span class="badge {{ $reparacion->estado == 'Completada' ? 'bg-success' : ($reparacion->estado == 'Cancelada' ? 'bg-danger' : 'bg-warning') }}">
                        {{ $reparacion->estado }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ url('/catalogos/reparacion/actualizar/'.$reparacion->id_reparacion) }}" class="btn btn-danger d-flex align-items-center gap-1">
                            <i class="bi bi-pencil-fill"></i>
                            <span>Actualizar</span>
                        </a>
                        <a href="{{ url('/catalogos/orden_reparacion/ordenReparacionGet/'.$reparacion->id_reparacion) }}" class="btn btn-danger d-flex align-items-center gap-1">
                            <i class="bi bi-tools"></i>
                            <span>Orden</span>
                        </a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
