@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <h2>Agregar Reparación</h2>
    <form method="POST" action="{{ url('/catalogos/reparacion/agregar') }}">
        @csrf
        <div class="mb-3">
            <label for="id_citas" class="form-label">Seleccionar Cita</label>
            <select class="form-control" id="id_citas" name="id_citas">
                <option value="">Sin cita previa</option>
                @foreach($citas as $cita)
                    <option value="{{ $cita->id_citas }}" 
                            data-vehiculo="{{ $cita->id_vehiculos }}">
                        {{ $cita->vehiculo->marca }} {{ $cita->vehiculo->modelo }} - 
                        {{ $cita->vehiculo->cliente->nombre }} - 
                        {{ date('d/m/Y', strtotime($cita->fecha_cita)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_vehiculos" class="form-label">Vehículo</label>
            <select class="form-control" id="id_vehiculos" name="id_vehiculos" required>
                @foreach($citas as $cita)
                    <option value="{{ $cita->vehiculo->id_vehiculos }}">
                        {{ $cita->vehiculo->marca }} {{ $cita->vehiculo->modelo }} - 
                        {{ $cita->vehiculo->cliente->nombre }}
                    </option>
                @endforeach
            </select>
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

<script>
document.getElementById('id_citas').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const vehiculoId = selectedOption.getAttribute('data-vehiculo');
    const vehiculoSelect = document.getElementById('id_vehiculos');
    
    if(vehiculoId) {
        vehiculoSelect.value = vehiculoId;
    }
});
</script>
@endsection