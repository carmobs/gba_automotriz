@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="container">
    <h2>Agregar Cita</h2>
    <form method="POST" action="{{ url('/catalogos/citas/agregar') }}">
        @csrf
        <div class="mb-3">
            <label for="id_vehiculos" class="form-label">Vehículo</label>
            <select class="form-control" id="id_vehiculos" name="id_vehiculos" required>
                <option value="">Seleccione un vehículo</option>
                @foreach($vehiculos as $vehiculo)
                    @if($vehiculo->estado)
                        <option value="{{ $vehiculo->id_vehiculos }}">
                            {{ $vehiculo->marca }} {{ $vehiculo->modelo }} - {{ $vehiculo->cliente->nombre }}
                        </option>
                    @endif
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="fecha_cita" class="form-label">Fecha</label>
            <input type="date" class="form-control" id="fecha_cita" name="fecha_cita" required>
        </div>
        <div class="mb-3">
            <label for="hora_cita" class="form-label">Hora</label>
            <input type="time" class="form-control" id="hora_cita" name="hora_cita" required>
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="Pendiente">Pendiente</option>
                <option value="Confirmada">Confirmada</option>
                <option value="Cancelada">Cancelada</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="detalles_vehiculo" class="form-label">Detalles del Vehículo</label>
            <textarea class="form-control" id="detalles_vehiculo" name="detalles_vehiculo" maxlength="100"></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ url('/catalogos/citas') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
