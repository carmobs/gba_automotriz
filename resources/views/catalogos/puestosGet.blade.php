@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Puestos</h1>
        <a href="{{ url('/catalogos/puestos/agregar') }}" class="btn btn-danger">Agregar</a>
    </div>
    
    <table class="table">
        <thead class="bg-light">
            <tr class="text-center">
                <th>ID</th>
                <th>NOMBRE DEL PUESTO</th>
                <th>DESCRIPCIÓN</th>
                <th>SUELDO</th>
                <th>ESTADO</th>
                <th width="280px">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($puestos as $puesto)
            <tr class="text-center align-middle">
                <td>{{ $puesto->id_puestos }}</td>
                <td>{{ $puesto->nombre_puesto }}</td>
                <td>{{ $puesto->descripcion }}</td>
                <td>${{ number_format($puesto->sueldo, 2) }}</td>
                <td>
                    <span class="badge {{ $puesto->estado ? 'bg-success' : 'bg-danger' }}">
                        {{ $puesto->estado ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ url('/catalogos/puestos/actualizar/'.$puesto->id_puestos) }}" class="btn btn-danger d-flex align-items-center gap-1">
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
