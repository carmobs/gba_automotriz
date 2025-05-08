@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar Servicio</h1>
    </div>
</div>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="POST" action="{{ route('servicios.update.post', $servicio->id_servicios) }}">
    @csrf
    <div class="mb-3">
        <label for="nombre" class="form-label">Nombre</label>
        <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $servicio->nombre }}" required>
    </div>
    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3" required>{{ $servicio->descripcion }}</textarea>
    </div>
    <div class="mb-3">
        <label for="tiempo" class="form-label">Tiempo (horas)</label>
        <input type="number" class="form-control" id="tiempo" name="tiempo" value="{{ $servicio->tiempo }}" step="0.1" required>
    </div>
    <div class="mb-3">
        <label for="costo" class="form-label">Costo</label>
        <input type="number" class="form-control" id="costo" name="costo" value="{{ $servicio->costo }}" step="0.01" required>
    </div>
    <div class="mb-3">
        <label for="estado" class="form-label">Estado</label>
        <select class="form-control" id="estado" name="estado" required>
            <option value="activo" {{ $servicio->estado == 'activo' ? 'selected' : '' }}>Activo</option>
            <option value="inactivo" {{ $servicio->estado == 'inactivo' ? 'selected' : '' }}>Inactivo</option>
        </select>
    </div>
    <button type="submit" class="btn btn-primary">Actualizar</button>
    <a href="{{ route('servicios.get') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection