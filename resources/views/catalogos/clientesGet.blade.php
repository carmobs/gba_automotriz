@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="container mt-3">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Clientes</h1>
        <a href="{{ url('/catalogos/clientes/agregar') }}" class="btn btn-danger">Agregar</a>
    </div>
    
    <table class="table">
        <thead class="bg-light">
            <tr class="text-center">
                <th>ID</th>
                <th>NOMBRE</th>
                <th>TELÉFONO</th>
                <th>ESTADO</th>
                <th width="280px">ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            @foreach($clientes as $cliente)
            <tr class="text-center align-middle">
                <td>{{ $cliente->id_clientes }}</td>
                <td>{{ $cliente->nombre }}</td>
                <td>{{ $cliente->telefono }}</td>
                <td>
                    <span class="badge {{ $cliente->estado ? 'bg-success' : 'bg-danger' }}">
                        {{ $cliente->estado ? 'Activo' : 'Inactivo' }}
                    </span>
                </td>
                <td>
                    <div class="d-flex gap-2 justify-content-center">
                        <a href="{{ url('/catalogos/clientes/actualizar/'.$cliente->id_clientes) }}" class="btn btn-danger d-flex align-items-center gap-1">
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
