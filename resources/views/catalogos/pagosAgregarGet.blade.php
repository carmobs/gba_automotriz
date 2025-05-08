@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <h1 class="my-4">Registrar Pago</h1>

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form method="POST" action="{{ url('/catalogos/pagos/agregar') }}">
        @csrf
        <div class="mb-3">
            <label for="id_vehiculo" class="form-label">Vehículo del Cliente *</label>
            <select class="form-select" id="id_vehiculo" name="id_vehiculo" required>
                <option value="">Seleccione un vehículo</option>
                @foreach($clientes as $cliente)
                    <option value="{{ $cliente->id_vehiculos }}" 
                        {{ (old('id_vehiculo', request('id_vehiculo')) == $cliente->id_vehiculos) ? 'selected' : '' }}>
                        {{ $cliente->cliente_nombre }} - {{ $cliente->marca }} {{ $cliente->modelo }}
                    </option>
                @endforeach
            </select>
            @error('id_vehiculo')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha *</label>
            <input type="date" class="form-control" id="fecha" name="fecha" 
                   value="{{ old('fecha', date('Y-m-d')) }}" required>
            @error('fecha')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="monto" class="form-label">Monto *</label>
            <input type="number" step="0.01" class="form-control" id="monto" name="monto" 
                   value="{{ old('monto', request('monto')) }}" required>
            @error('monto')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Registrar Pago</button>
        <a href="{{ url('/catalogos/pagos') }}" class="btn btn-secondary">Cancelar</a>
    </form>
</div>
@endsection