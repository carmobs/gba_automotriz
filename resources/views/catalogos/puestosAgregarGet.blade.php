@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="container">
    <h2>Agregar Puesto</h2>
    <form method="POST" action="{{ url('/catalogos/puestos/agregar') }}">
        @csrf
        <div class="mb-3">
            <label for="nombre_puesto" class="form-label">Nombre del Puesto</label>
            <input type="text" class="form-control" id="nombre_puesto" name="nombre_puesto" required maxlength="50">
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <textarea class="form-control" id="descripcion" name="descripcion"></textarea>
        </div>
        <div class="mb-3">
            <label for="sueldo" class="form-label">Sueldo</label>
            <input type="number" class="form-control" id="sueldo" name="sueldo" required step="0.01" min="0">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="1">Activo</option>
                <option value="0">Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ url('/catalogos/puestos') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection
