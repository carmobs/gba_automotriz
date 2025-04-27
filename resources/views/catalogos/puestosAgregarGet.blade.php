@extends("components.layout")
@section("content")
@component("components.breadcrumbs", ["breadcrumbs" => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Agregar Puesto</h1>
    </div>
</div>

<form method="POST" action="{{ route('puestos.store') }}">
    @csrf
    <div class="form-group">
        <label for="nombre_puesto">Nombre del Puesto</label>
        <input type="text" class="form-control" id="nombre_puesto" name="nombre_puesto" required>
    </div>
    <div class="form-group">
        <label for="descripcion">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
    </div>
    <div class="form-group">
        <label for="sueldo">Sueldo</label>
        <input type="number" step="0.01" class="form-control" id="sueldo" name="sueldo" required>
    </div>
    <button type="submit" class="btn btn-primary">Guardar</button>
    <a href="{{ route('puestos.get') }}" class="btn btn-secondary">Cancelar</a>
</form>
@endsection
