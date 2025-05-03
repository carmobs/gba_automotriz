@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <h1 class="my-4">Agregar Orden de Reparación</h1>

    <form method="POST" action="{{ route('orden_reparacion.store') }}">
        @csrf
        <input type="hidden" name="id_reparacion" value="{{ $id_reparacion }}">

        <div class="mb-3">
            <label for="id_servicios" class="form-label">Servicio</label>
            <select class="form-select" id="id_servicios" name="id_servicios" required>
                <option value="">Seleccione un servicio</option>
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id_servicios }}" data-costo="{{ $servicio->costo }}">{{ $servicio->nombre }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="costo_unitario_servicio" class="form-label">Costo Unitario</label>
            <input type="number" step="0.01" class="form-control" id="costo_unitario_servicio" name="costo_unitario_servicio" readonly required>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ route('orden_reparacion.get', ['id_reparacion' => $id_reparacion]) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>

<script>
    const servicioSelect = document.getElementById('id_servicios');
    const costoUnitarioInput = document.getElementById('costo_unitario_servicio');

    servicioSelect.addEventListener('change', function () {
        const selectedOption = servicioSelect.options[servicioSelect.selectedIndex];
        const costo = parseFloat(selectedOption.getAttribute('data-costo')) || 0;
        costoUnitarioInput.value = costo.toFixed(2);
    });
</script>
@endsection