@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="container">
    <h2>Agregar Vehículo</h2>
    <form method="POST" action="{{ url('/catalogos/vehiculos/agregar') }}">
        @csrf
        <div class="mb-3">
            <label for="id_clientes" class="form-label">Cliente</label>
            <select class="form-control" id="id_clientes" name="id_clientes" required>
                <option value="">Seleccione un cliente</option>
                @foreach($clientes as $cliente)
                    @if($cliente->estado)
                        <option value="{{ $cliente->id_clientes }}">{{ $cliente->nombre }}</option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="marca" class="form-label">Marca</label>
            <input type="text" class="form-control" id="marca" name="marca" required maxlength="50">
        </div>
        <div class="mb-3">
            <label for="modelo" class="form-label">Modelo</label>
            <input type="text" class="form-control" id="modelo" name="modelo" required maxlength="50">
        </div>
        <div class="mb-3">
            <label for="anio_field" class="form-label">Año</label>
            <input type="number" class="form-control" id="anio_field" name="anio_field" required min="1900" max="{{ date('Y')+2 }}">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ url('/catalogos/vehiculos') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection