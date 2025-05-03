@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <div class="row my-4">
        <div class="col">
            <h1>Historial de Puestos - {{ $empleado->nombre }}</h1>
        </div>
    </div>
    
    <div class="row mb-3">
        <div class="col">
            <a href="{{ route('empleados.puestos.create', $empleado->id_empleados) }}" class="btn btn-primary">
                Agregar Puesto
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Puesto</th>
                        <th>Fecha Inicio</th>
                        <th>Fecha Fin</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($puestos as $puesto)
                    <tr>
                        <td>{{ $puesto->nombre_puesto }}</td>
                        <td>{{ \Carbon\Carbon::parse($puesto->fecha_inicio)->format('d/m/Y') }}</td>
                        <td>
                            @if($puesto->fecha_fin)
                                {{ \Carbon\Carbon::parse($puesto->fecha_fin)->format('d/m/Y') }}
                            @else
                                Actual
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
