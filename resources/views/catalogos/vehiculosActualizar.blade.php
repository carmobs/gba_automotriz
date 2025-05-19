@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="container">
    <h2>Actualizar Vehículo</h2>
    <form method="POST" action="{{ url('/catalogos/vehiculos/actualizar/'.$vehiculo->id_vehiculos) }}">
        @csrf
        <div class="mb-3">
            <label for="id_clientes" class="form-label">Cliente</label>
            <select class="form-control" id="id_clientes" name="id_clientes" required>
                @foreach($clientes as $cliente)
                    @if($cliente->estado || $vehiculo->id_clientes == $cliente->id_clientes)
                        <option value="{{ $cliente->id_clientes }}" {{ $vehiculo->id_clientes == $cliente->id_clientes ? 'selected' : '' }}>
                            {{ $cliente->nombre }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" value="{{ $vehiculo->marca }}" required maxlength="50">
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ $vehiculo->modelo }}" required maxlength="50">
        </div>
        <div class="mb-3">
            <label for="anio_field" class="form-label">Año</label>
            <input type="number" class="form-control" id="anio_field" name="anio_field" value="{{ $vehiculo->año }}" required min="1900" max="{{ date('Y')+2 }}">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="1" {{ $vehiculo->estado ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$vehiculo->estado ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ url('/catalogos/vehiculos') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection