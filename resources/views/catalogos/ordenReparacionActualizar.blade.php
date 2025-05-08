@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <h1 class="my-4">Actualizar Orden de Reparación</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ route('orden_reparacion.update.post', $orden->id_detalle_reparacion) }}">
        @csrf
        <div class="mb-3">
            <label for="id_servicios" class="form-label">Servicio</label>
            <select class="form-control @error('id_servicios') is-invalid @enderror" id="id_servicios" name="id_servicios" required>
                <option value="">Seleccione un servicio...</option>
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id_servicios }}" 
                            {{ old('id_servicios', $orden->id_servicios) == $servicio->id_servicios ? 'selected' : '' }}
                            data-costo="{{ $servicio->costo }}">
                        {{ $servicio->nombre }} - ${{ number_format($servicio->costo, 2) }}
                    </option>
                @endforeach
            </select>
            @error('id_servicios')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control @error('cantidad') is-invalid @enderror" 
                   id="cantidad" name="cantidad" value="{{ old('cantidad', $orden->cantidad) }}" 
                   min="1" required>
            @error('cantidad')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="costo_unitario_servicio" class="form-label">Costo Unitario</label>
            <input type="number" step="0.01" class="form-control @error('costo_unitario_servicio') is-invalid @enderror" 
                   id="costo_unitario_servicio" name="costo_unitario_servicio" 
                   value="{{ old('costo_unitario_servicio', $orden->costo_unitario_servicio) }}" required>
            @error('costo_unitario_servicio')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control @error('estado') is-invalid @enderror" id="estado" name="estado" required>
                <option value="0" {{ old('estado', $orden->estado) == 0 ? 'selected' : '' }}>Pendiente</option>
                <option value="1" {{ old('estado', $orden->estado) == 1 ? 'selected' : '' }}>Completado</option>
            </select>
            @error('estado')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary me-md-2">Actualizar</button>
            <a href="{{ route('orden_reparacion.get', ['id_reparacion' => $orden->id_reparacion]) }}" 
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
