@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Registrar Pago</h1>
    </div>
    <div class="col"></div>
</div>
<form method="POST" action="{{ route('pagos.store') }}">
    @csrf
    
    <div class="row mb-3">
        <div class="col-md-6">
                <label for="id_reparacion" class="form-label">Reparación</label>
                <select class="form-select" id="id_reparacion" name="id_reparacion" required>
                    <option value="">Seleccione una reparación</option>
                    @foreach($reparaciones as $reparacion)
                        <option value="{{ $reparacion->id_reparacion }}" 
                            {{ old('id_reparacion') == $reparacion->id_reparacion ? 'selected' : '' }}>
                            Reparación #{{ $reparacion->id_reparacion }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="col-md-6">
                <label for="fecha" class="form-label">Fecha de Pago</label>
                <input type="date" class="form-control" id="fecha" name="fecha" 
                       value="{{ old('fecha', date('Y-m-d')) }}" required>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <label for="monto" class="form-label">Monto ($)</label>
                <input type="number" class="form-control" id="monto" name="monto" 
                       step="0.01" min="0" value="{{ old('monto') }}" required>
            </div>
        </div>
        
        <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </form>
</div>
@endsection