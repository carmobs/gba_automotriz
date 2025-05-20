@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="container mt-4">
    <h1 class="mb-4">Reportes</h1>
    
    <div class="row g-4">
        <!-- Reporte de Citas -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-calendar-check text-danger" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">Reporte de Citas</h5>
                    <p class="card-text">Genera un reporte de todas las citas programadas en un rango de fechas.</p>
                    <a href="{{ url('/catalogos/reportes/citas') }}" class="btn btn-danger">
                        <i class="bi bi-file-earmark-text"></i> Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <!-- Reporte de Pagos -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-cash-stack text-danger" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">Reporte de Pagos</h5>
                    <p class="card-text">Genera un reporte de todos los pagos realizados en un rango de fechas.</p>
                    <a href="{{ url('/catalogos/reportes/pagos') }}" class="btn btn-danger">
                        <i class="bi bi-file-earmark-text"></i> Ver Reporte
                    </a>
                </div>
            </div>
        </div>

        <!-- Reporte de Reparaciones -->
        <div class="col-md-4">
            <div class="card h-100 shadow-sm">
                <div class="card-body text-center">
                    <i class="bi bi-tools text-danger" style="font-size: 3rem;"></i>
                    <h5 class="card-title mt-3">Reporte de Ventas</h5>
                    <p class="card-text">Genera un reporte de todas las ventas realizadas en una fecha específica.</p>
                    <a href="{{ url('/catalogos/reportes/reparaciones') }}" class="btn btn-danger">
                        <i class="bi bi-file-earmark-text"></i> Ver Reporte
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
