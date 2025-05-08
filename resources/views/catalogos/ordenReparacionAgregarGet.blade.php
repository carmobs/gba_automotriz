@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <h1 class="my-4">Agregar Servicio a la Orden de Reparación</h1>

    <!-- Vehicle and Client Info Card -->
    <div class="card mb-4">
        <div class="card-header bg-danger text-white">
            <h5 class="mb-0">Información de la Reparación #{{ $id_reparacion }}</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="card-subtitle mb-2 text-muted">Información del Cliente</h6>
                    <p class="card-text"><strong>Cliente:</strong> {{ $infoBase->cliente_nombre }}</p>
                </div>
                <div class="col-md-6">
                    <h6 class="card-subtitle mb-2 text-muted">Información del Vehículo</h6>
                    <p class="card-text"><strong>Marca:</strong> {{ $infoBase->marca }}</p>
                    <p class="card-text"><strong>Modelo:</strong> {{ $infoBase->modelo }}</p>
                    <p class="card-text"><strong>Año:</strong> {{ $infoBase->año }}</p>
                    @if($infoBase->detalles_vehiculo)
                        <p class="card-text"><strong>Detalles:</strong> {{ $infoBase->detalles_vehiculo }}</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('orden_reparacion.store') }}">
        @csrf
        <input type="hidden" name="id_reparacion" value="{{ $id_reparacion }}">

        <div class="mb-3">
            <label for="id_servicios" class="form-label">Servicio *</label>
            <select class="form-control @error('id_servicios') is-invalid @enderror" 
                    id="id_servicios" name="id_servicios" required>
                <option value="">Seleccione un servicio...</option>
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id_servicios }}" 
                            data-costo="{{ $servicio->costo }}"
                            {{ old('id_servicios') == $servicio->id_servicios ? 'selected' : '' }}>
                        {{ $servicio->nombre }} - ${{ number_format($servicio->costo, 2) }}
                    </option>
                @endforeach
            </select>
            @error('id_servicios')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad *</label>
            <input type="number" class="form-control @error('cantidad') is-invalid @enderror" 
                   id="cantidad" name="cantidad" value="{{ old('cantidad', 1) }}" min="1" required>
            @error('cantidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="costo_unitario_servicio" class="form-label">Costo Unitario *</label>
            <input type="number" step="0.01" class="form-control @error('costo_unitario_servicio') is-invalid @enderror" 
                   id="costo_unitario_servicio" name="costo_unitario_servicio" 
                   value="{{ old('costo_unitario_servicio') }}" required>
            @error('costo_unitario_servicio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado *</label>
            <select class="form-control @error('estado') is-invalid @enderror" 
                    id="estado" name="estado" required>
                <option value="0" {{ old('estado') == '0' ? 'selected' : '' }}>Pendiente</option>
                <option value="1" {{ old('estado') == '1' ? 'selected' : '' }}>Completado</option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary me-md-2">Guardar</button>
            <a href="{{ route('orden_reparacion.get', ['id_reparacion' => $id_reparacion]) }}" 
               class="btn btn-secondary">Cancelar</a>
        </div>
    </form>
</div>

<script>
document.getElementById('id_servicios').addEventListener('change', function() {
    const selectedOption = this.options[this.selectedIndex];
    const costo = selectedOption.getAttribute('data-costo');
    document.getElementById('costo_unitario_servicio').value = costo || '';
});
</script>
@endsection