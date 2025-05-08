@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <h1 class="my-4">Nueva Reparación</h1>
    
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ url('/catalogos/reparacion/agregar') }}">
        @csrf
        @if(session('debug'))
            <div class="alert alert-info">
                Debug Info: {{ session('debug') }}
            </div>
        @endif

        <!-- Selección de Vehículo -->
        <div class="mb-3">
            <label for="id_vehiculos" class="form-label">Vehículo del Cliente *</label>
            <select class="form-select" id="id_vehiculos" name="id_vehiculos" required>
                <option value="">Seleccione un vehículo</option>
                @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id_vehiculos }}" 
                        {{ old('id_vehiculos') == $vehiculo->id_vehiculos ? 'selected' : '' }}>
                        {{ $vehiculo->cliente->nombre }} - {{ $vehiculo->marca }} {{ $vehiculo->modelo }} ({{ $vehiculo->año }})
                    </option>
                @endforeach
            </select>
            @error('id_vehiculos')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Selección de Empleado -->
        <div class="mb-3">
            <label for="id_empleados" class="form-label">Empleado Responsable *</label>
            <select class="form-select" id="id_empleados" name="id_empleados" required>
                <option value="">Seleccione un empleado</option>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id_empleados }}" 
                        {{ old('id_empleados') == $empleado->id_empleados ? 'selected' : '' }}>
                        {{ $empleado->nombre }}
                    </option>
                @endforeach
            </select>
            @error('id_empleados')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <!-- Fecha y Estado -->
        <div class="row mb-3">
            <div class="col-md-6">
                <label for="fecha_reparacion" class="form-label">Fecha *</label>
                <input type="date" class="form-control" id="fecha_reparacion" 
                       name="fecha_reparacion" max="{{ date('Y-m-d') }}"
                       value="{{ old('fecha_reparacion', date('Y-m-d')) }}" required>
            </div>
            <div class="col-md-6">
                <label for="estado" class="form-label">Estado *</label>
                <select class="form-select" id="estado" name="estado" required>
                    <option value="En proceso" {{ old('estado') == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                    <option value="Completada" {{ old('estado') == 'Completada' ? 'selected' : '' }}>Completada</option>
                    <option value="Cancelada" {{ old('estado') == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
                </select>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Guardar Reparación</button>
    </form>
</div>
@endsection