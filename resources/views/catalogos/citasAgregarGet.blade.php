@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Agregar Cita</h1>
    </div>
</div>

<form method="POST" action="{{ route('citas.store') }}">
    @csrf
    <div class="form-group">
        <label for="id_vehiculos">Vehículo</label>
        <select class="form-control" id="id_vehiculos" name="id_vehiculos" required>
            <option value="">Seleccione un vehículo</option>
            @foreach($vehiculos as $vehiculo)
                <option value="{{ $vehiculo->id_vehiculos }}">{{ $vehiculo->marca }} {{ $vehiculo->modelo }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="fecha_cita">Fecha</label>
        <input type="date" class="form-control" id="fecha_cita" name="fecha_cita" required>
    </div>
    <div class="form-group">
        <label for="hora_cita">Hora</label>
        <input type="time" class="form-control" id="hora_cita" name="hora_cita" required>
    </div>
    <div class="form-group">
        <label for="estado">Estado</label>
        <select class="form-control" id="estado" name="estado" required>
            <option value="Pendiente">Pendiente</option>
            <option value="Completada">Completada</option>
            <option value="Cancelada">Cancelada</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('citas.get') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
