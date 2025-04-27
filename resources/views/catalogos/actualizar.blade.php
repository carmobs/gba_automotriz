@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar {{ ucfirst($category) }}</h1>
    </div>
</div>

<form action="{{ route('catalogos.actualizar.post', ['category' => $category, 'id' => $record->id ?? $record->id_clientes ?? $record->id_servicios ?? $record->id_empleados ?? $record->id_vehiculos ?? $record->id_reparacion ?? $record->id_pagos]) }}" method="POST">
    @csrf
    @method('POST')

    @foreach($record->getAttributes() as $field => $value)
        @if($field !== 'id') <!-- Excluir el campo ID -->
        <div class="mb-3">
            <label for="{{ $field }}" class="form-label">{{ ucfirst($field) }}</label>
            <input type="text" class="form-control" id="{{ $field }}" name="fields[{{ $field }}]" value="{{ $value }}">
        </div>
        @endif
    @endforeach

    <button type="submit" class="btn btn-primary">Actualizar</button>
</form>
@endsection
