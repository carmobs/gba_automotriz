@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
<div class="container">
    <h2>Actualizar Cliente</h2>
    <form method="POST" action="{{ url('/catalogos/clientes/actualizar/'.$cliente->id_clientes) }}">
        @csrf
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="{{ $cliente->nombre }}" required maxlength="50">
        </div>
        <div class="mb-3">
            <label for="telefono" class="form-label">Teléfono</label>
            <input type="text" class="form-control" id="telefono" name="telefono" value="{{ $cliente->telefono }}" required pattern="[0-9]{10}">
        </div>
        <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <select class="form-control" id="estado" name="estado" required>
                <option value="1" {{ $cliente->estado ? 'selected' : '' }}>Activo</option>
                <option value="0" {{ !$cliente->estado ? 'selected' : '' }}>Inactivo</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Guardar</button>
        <a href="{{ url('/catalogos/clientes') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection