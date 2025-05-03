@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Actualizar Pago</h1>
    </div>
</div>

@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="row">
    <div class="col-md-8">
        <form method="POST" action="{{ route('pagos.update.post', $pago->id_pagos) }}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="id_cliente" class="form-label">Cliente</label>
                    <select class="form-select" id="id_cliente" name="id_cliente" required>
                        @foreach($clientes as $cliente)
                            <option value="{{ $cliente->id_clientes }}" 
                                {{ $cliente_actual->id_clientes == $cliente->id_clientes ? 'selected' : '' }}>
                                {{ $cliente->nombre }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="id_reparacion" class="form-label">ID Reparación</label>
                    <input type="text" class="form-control" id="id_reparacion" 
                           value="{{ $pago->id_reparacion }}" readonly>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label for="fecha" class="form-label">Fecha de Pago</label>
                    <input type="date" class="form-control" id="fecha" name="fecha" 
                           value="{{ $pago->fecha }}" required>
                </div>

                <div class="col-md-6">
                    <label for="monto" class="form-label">Monto ($)</label>
                    <input type="number" class="form-control" id="monto" name="monto" 
                           step="0.01" min="0" value="{{ $pago->monto }}" required>
                </div>
            </div>

            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-4">
                <button type="submit" class="btn btn-primary me-md-2">Actualizar</button>
                <a href="{{ route('pagos.get') }}" class="btn btn-secondary">Cancelar</a>
            </div>
        </form>
    </div>
</div>
@endsection