@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

@php
    $reparaciones = App\Models\Reparacion::all();
    $servicios = App\Models\Servicios::all();
@endphp

<div class="row my-4">
    <div class="col">
        <h1>Agregar Orden de Reparación</h1>
    </div>
</div>

<form method="POST" action="{{ url('/catalogos/orden_reparacion/agregar') }}">
    @csrf
    <div class="form-group">
        <p class="form-control-plaintext">Reparación: {{ request('id_reparacion') }}</p>
        <input type="hidden" id="id_reparacion" name="id_reparacion" value="{{ request('id_reparacion') }}">
    </div>
    <div class="form-group">
        <label for="id_servicios">Servicio</label>
        <select class="form-control" id="id_servicios" name="id_servicios" required>
            <option value="">Seleccione un servicio</option>
            @foreach($servicios as $servicio)
                <option value="{{ $servicio->id_servicios }}">{{ $servicio->nombre }}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="costo_unitario_servicio">Costo Unitario</label>
        <input type="number" step="0.01" class="form-control" id="costo_unitario_servicio" name="costo_unitario_servicio" required>
    </div>
    <div class="form-group">
        <label for="cantidad">Cantidad</label>
        <input type="number" class="form-control" id="cantidad" name="cantidad" required>
    </div>
    <div class="form-group">
        <label for="estado">Estado</label>
        <select class="form-control" id="estado" name="estado" required>
            <option value="1">Pendiente</option>
            <option value="0">Completado</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ url('/catalogos/orden_reparacion/ordenReparacionGet') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection