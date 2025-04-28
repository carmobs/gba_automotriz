@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar Orden de Reparación</h1>
    </div>
</div>

<form action="{{ route('orden_reparacion.update.post', $orden->id_detalle_reparacion) }}" method="POST">
    @csrf
    @method('POST') <!-- Asegúrate de que el método sea POST -->

    <div class="mb-3">
        <label for="id_servicios" class="form-label">Servicio</label>
        <select class="form-control" id="id_servicios" name="id_servicios">
            @foreach($servicios as $servicio)
                <option value="{{ $servicio->id_servicios }}" {{ $orden->id_servicios == $servicio->id_servicios ? 'selected' : '' }}>
                    {{ $servicio->nombre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label for="costo_unitario_servicio" class="form-label">Costo Unitario</label>
        <input type="number" class="form-control" id="costo_unitario_servicio" name="costo_unitario_servicio" value="{{ $orden->costo_unitario_servicio }}">
    </div>

    <div class="mb-3">
        <label for="cantidad" class="form-label">Cantidad</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" value="{{ $orden->cantidad }}">
    </div>

    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-control" id="estado" name="estado">
            <option value="1" {{ $orden->estado == 1 ? 'selected' : '' }}>Activo</option>
            <option value="0" {{ $orden->estado == 0 ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
