@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="container">
    <h2>Actualizar Reparación</h2>
    <form method="POST" action="{{ url('/catalogos/reparacion/actualizar/'.$reparacion->id_reparacion) }}">
        @csrf
        <div class="mb-3">
            <label for="id_vehiculos" class="form-label">Vehículo</label>
            <select class="form-control" id="id_vehiculos" name="id_vehiculos" required>
                @foreach($vehiculos as $vehiculo)
                    <option value="{{ $vehiculo->id_vehiculos }}" {{ $reparacion->id_vehiculos == $vehiculo->id_vehiculos ? 'selected' : '' }}>
                        {{ $vehiculo->marca }} {{ $vehiculo->modelo }} - {{ $vehiculo->cliente->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_empleados" class="form-label">Mecánico</label>
            <select class="form-control" id="id_empleados" name="id_empleados" required>
                @foreach($empleados as $empleado)
                    <option value="{{ $empleado->id_empleados }}" {{ $reparacion->id_empleados == $empleado->id_empleados ? 'selected' : '' }}>
                        {{ $empleado->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="id_citas" class="form-label">Cita</label>
            <select class="form-control" id="id_citas" name="id_citas">
                <option value="">Sin cita previa</option>
                @foreach($citas as $cita)
                    <option value="{{ $cita->id_citas }}" 
                            {{ $reparacion->id_citas == $cita->id_citas ? 'selected' : '' }}
                            data-vehiculo="{{ $cita->id_vehiculos }}">
                        Cita #{{ $cita->id_citas }} - 
                        {{ $cita->vehiculo->marca }} {{ $cita->vehiculo->modelo }} - 
                        {{ date('d/m/Y', strtotime($cita->fecha_cita)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="fecha_reparacion" class="form-label">Fecha de Reparación</label>
            <input type="date" class="form-control" id="fecha_reparacion" name="fecha_reparacion" 
                value="{{ date('Y-m-d', strtotime($reparacion->fecha_reparacion)) }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="En proceso" {{ $reparacion->estado == 'En proceso' ? 'selected' : '' }}>En proceso</option>
                <option value="Completada" {{ $reparacion->estado == 'Completada' ? 'selected' : '' }}>Completada</option>
                <option value="Cancelada" {{ $reparacion->estado == 'Cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ url('/catalogos/reparacion') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection