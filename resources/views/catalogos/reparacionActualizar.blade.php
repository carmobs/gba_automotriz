@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <div class="row my-4">
        <div class="col">
            <h1>Actualizar Reparación</h1>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{{ route('reparacion.update.post', $reparacion->id_reparacion) }}">
                @csrf
                <div class="form-group mb-3">
                    <label for="id_vehiculos">Vehículo del Cliente</label>
                    <select class="form-control @error('id_vehiculos') is-invalid @enderror" 
                            id="id_vehiculos" 
                            name="id_vehiculos" 
                            required>
                        <option value="">Seleccione un vehículo...</option>
                        @foreach($vehiculos as $vehiculo)
                            <option value="{{ $vehiculo->id_vehiculos }}" 
                                {{ old('id_vehiculos', $reparacion->id_vehiculos) == $vehiculo->id_vehiculos ? 'selected' : '' }}>
                                {{ $vehiculo->cliente->nombre }} - {{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->año }})
                            </option>
                        @endforeach
                    </select>
                    @error('id_vehiculos')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="id_empleados">Mecánico</label>
                    <select class="form-control @error('id_empleados') is-invalid @enderror" 
                            id="id_empleados" 
                            name="id_empleados" 
                            required>
                        <option value="">Seleccione un mecánico...</option>
                        @foreach($empleados as $empleado)
                            <option value="{{ $empleado->id_empleados }}"
                                {{ old('id_empleados', $reparacion->id_empleados) == $empleado->id_empleados ? 'selected' : '' }}>
                                {{ $empleado->nombre }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_empleados')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="fecha_reparacion">Fecha de Reparación</label>
                    <input type="date" 
                           class="form-control @error('fecha_reparacion') is-invalid @enderror" 
                           id="fecha_reparacion" 
                           name="fecha_reparacion"
                           value="{{ old('fecha_reparacion', $reparacion->fecha_reparacion) }}" 
                           required>
                    @error('fecha_reparacion')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group mb-3">
                    <label for="estado">Estado</label>
                    <select class="form-control @error('estado') is-invalid @enderror" 
                            id="estado" 
                            name="estado" 
                            required>
                        <option value="En proceso" {{ old('estado', $reparacion->estado) == 'En proceso' ? 'selected' : '' }}>
                            En proceso
                        </option>
                        <option value="Completada" {{ old('estado', $reparacion->estado) == 'Completada' ? 'selected' : '' }}>
                            Completada
                        </option>
                        <option value="Cancelada" {{ old('estado', $reparacion->estado) == 'Cancelada' ? 'selected' : '' }}>
                            Cancelada
                        </option>
                    </select>
                    @error('estado')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                    <button type="submit" class="btn btn-primary me-md-2">Actualizar</button>
                    <a href="{{ route('reparacion.get') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection