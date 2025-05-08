@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="container">
    <h2>Actualizar Servicio</h2>
    <form method="POST" action="{{ url('/catalogos/servicios/actualizar/'.$servicio->id_servicios) }}">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $servicio->nombre }}" required maxlength="100">
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion" required>{{ $servicio->descripcion }}</textarea>
        </div>
        <div class="mb-3">
            <label for="tiempo" class="form-label">Tiempo (horas)</label>
            <input type="number" class="form-control" id="tiempo" name="tiempo" value="{{ $servicio->tiempo }}" required step="0.1" min="0" max="99.9">
        </div>
        <div class="mb-3">
            <label for="costo" class="form-label">Costo</label>
            <input type="number" class="form-control" id="costo" name="costo" value="{{ $servicio->costo }}" required step="0.01" min="0">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="1" {{ $servicio->estado ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$servicio->estado ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ url('/catalogos/servicios') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection