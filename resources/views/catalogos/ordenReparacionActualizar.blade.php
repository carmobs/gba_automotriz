@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <h1 class="my-4">Actualizar Orden de Reparación</h1>

    <form method="POST" action="{{ route('orden_reparacion.update.post', $orden->id_detalle_reparacion) }}">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="id_servicios" class="form-label">Servicio</label>
            <select class="form-select" id="id_servicios" name="id_servicios" required>
                @foreach($servicios as $servicio)
                    <option value="{{ $servicio->id_servicios }}" {{ $orden->id_servicios == $servicio->id_servicios ? 'selected' : '' }}>
                        {{ $servicio->nombre }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="costo_unitario_servicio" class="form-label">Costo Unitario</label>
            <input type="number" step="0.01" class="form-control" id="costo_unitario_servicio" name="costo_unitario_servicio" value="{{ $orden->costo_unitario_servicio }}" required>
        </div>

        <div class="mb-3">
            <label for="cantidad" class="form-label">Cantidad</label>
            <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $orden->cantidad }}" required>
        </div>

        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-select" id="estado" name="estado" required>
                <option value="1" {{ $orden->estado == 1 ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ $orden->estado == 0 ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('orden_reparacion.get', ['id_reparacion' => $orden->id_reparacion]) }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
