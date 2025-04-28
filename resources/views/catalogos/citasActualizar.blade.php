@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar Cita</h1>
    </div>
</div>

<form action="{{ route('citas.update.post', $cita->id_citas) }}" method="POST">
    @csrf

    <div class="mb-3">
        <label for="id_vehiculos" class="form-label">Vehículo</label>
        <select class="form-control" id="id_vehiculos" name="id_vehiculos">
            @foreach($vehiculos as $vehiculo)
                <option value="{{ $vehiculo->id_vehiculos }}" {{ $cita->id_vehiculos == $vehiculo->id_vehiculos ? 'selected' : '' }}>
                    {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="fecha_cita" class="form-label">Fecha</label>
        <input type="date" class="form-control" id="fecha_cita" name="fecha_cita" value="{{ $cita->fecha_cita }}" required>
    </div>

    <div class="mb-3">
        <label for="hora_cita" class="form-label">Hora</label>
        <input type="time" class="form-control" id="hora_cita" name="hora_cita" value="{{ $cita->hora_cita }}" required>
    </div>

    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-control" id="estado" name="estado">
            <option value="En proceso" {{ $cita->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
            <option value="Completada" {{ $cita->estado == 'Completada' ? 'selected' : '' }}>Completada</option>
            <option value="Cancelada" {{ $cita->estado == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
