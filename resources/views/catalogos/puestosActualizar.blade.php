@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar Puesto</h1>
    </div>
</div>

<form action="{{ route('puestos.update.post', $puesto->id_puestos) }}" method="POST">
    @csrf
    @method('POST')

    <div class="mb-3">
        <label for="nombre_puesto" class="form-label">Nombre del Puesto</label>
        <input type="text" class="form-control" id="nombre_puesto" name="nombre_puesto" value="{{ $puesto->nombre_puesto }}" required>
    </div>

    <div class="mb-3">
        <label for="descripcion" class="form-label">Descripción</label>
        <textarea class="form-control" id="descripcion" name="descripcion" rows="3">{{ $puesto->descripcion }}</textarea>
    </div>

    <div class="mb-3">
        <label for="sueldo" class="form-label">Sueldo</label>
        <input type="number" class="form-control" id="sueldo" name="sueldo" value="{{ $puesto->sueldo }}" step="0.01" min="0" required>
    </div>

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
