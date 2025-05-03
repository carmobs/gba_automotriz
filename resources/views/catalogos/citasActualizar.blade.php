@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar Cita</h1>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-6">
        <form action="{{ route('citas.update.post', $cita->id_citas) }}" method="POST">
            @csrf
            <div class="form-group mb-3">
                <label for="id_vehiculos" class="form-label">Vehículo</label>
                <select class="form-control" id="id_vehiculos" name="id_vehiculos" required>
                    @foreach($vehiculos as $vehiculo)
                        <option value="{{ $vehiculo->id_vehiculos }}" 
                            {{ $cita->id_vehiculos == $vehiculo->id_vehiculos ? 'selected' : '' }}>
                            {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group mb-3">
                <label for="fecha_cita" class="form-label">Fecha</label>
                <input type="date" class="form-control" id="fecha_cita" name="fecha_cita" 
                    value="{{ \Carbon\Carbon::parse($cita->fecha_cita)->format('Y-m-d') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="hora_cita" class="form-label">Hora</label>
                <input type="time" class="form-control" id="hora_cita" name="hora_cita" 
                    value="{{ \Carbon\Carbon::parse($cita->hora_cita)->format('H:i') }}" required>
            </div>

            <div class="form-group mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="Pendiente" {{ $cita->estado == 'Pendiente' ? 'selected' : '' }}>Pendiente</option>
                    <option value="Completada" {{ $cita->estado == 'Completada' ? 'selected' : '' }}>Completada</option>
                    <option value="Cancelada" {{ $cita->estado == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-primary me-md-2">Actualizar</button>
                <a href="{{ route('citas.get') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection
