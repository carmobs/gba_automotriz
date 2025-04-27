@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Agregar Puesto a {{ $empleado->nombre }}</h1>
    </div>
</div>

<form method="POST" action="{{ route('empleados.puestos.store', $empleado->id_empleados) }}">
    @csrf
    <div class="form-group">
        <label for="id_puestos">Puesto</label>
        <select class="form-control" id="id_puestos" name="id_puestos" required>
            <option value="">Seleccione un puesto</option>
            @foreach($puestosDisponibles as $puesto)
                <option value="{{ $puesto->id_puestos }}">{{ $puesto->nombre_puesto }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="fecha_inicio">Fecha Inicio</label>
        <input type="date" class="form-control" id="fecha_inicio" name="fecha_inicio" required>
    </div>
    <div class="form-group">
        <label for="fecha_fin">Fecha Fin</label>
        <input type="date" class="form-control" id="fecha_fin" name="fecha_fin">
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('empleados.puestos.get', $empleado->id_empleados) }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
