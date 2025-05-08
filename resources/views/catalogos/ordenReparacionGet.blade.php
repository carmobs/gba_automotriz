@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Órdenes de Reparación</h1>
        <h5 class="text-muted mb-4">Cliente: {{ $infoBase->cliente_nombre ?? 'No disponible' }}</h5>
        
        <div class="card mb-3 shadow-sm">
            <div class="card-header bg-danger text-white">
                <h5 class="card-title mb-0">Información del Vehículo</h5>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Marca:</strong> {{ $infoBase->marca ?? 'No disponible' }}</p>
                        <p class="mb-2"><strong>Modelo:</strong> {{ $infoBase->modelo ?? 'No disponible' }}</p>
                        <p class="mb-2"><strong>Año:</strong> {{ $infoBase->año ?? 'No disponible' }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="mb-2"><strong>Detalles:</strong> {{ $infoBase->detalles_vehiculo ?? 'Sin detalles' }}</p>
                        <p class="mb-2"><strong>Estado de Pago:</strong> 
                            @if($isPagada)
                                <span class="badge bg-success">Pagada</span>
                            @else
                                <span class="badge bg-warning">Pendiente de Pago</span>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-auto">
        @if(!$isPagada)
            <a class="btn btn-primary" href="{{ route('orden_reparacion.create', ['id_reparacion' => $id_reparacion]) }}">Agregar Servicio</a>
        @endif
    </div>
</div>

<table class="table" id="maintable">
    <thead>
        <tr>
            <th class="text-center">ID</th>
            <th class="text-center">Servicio</th>
            <th class="text-center">Cantidad</th>
            <th class="text-center">Costo Unitario</th>
            <th class="text-center">Total</th>
            <th class="text-center">Estado</th>
            <th class="text-center">Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach($ordenes as $orden)
        <tr>
            <td class="text-center">{{ $orden->id_detalle_reparacion }}</td>
            <td class="text-center">{{ $orden->servicio->nombre }}</td>
            <td class="text-center">{{ $orden->cantidad }}</td>
            <td class="text-center">${{ number_format($orden->costo_unitario_servicio, 2) }}</td>
            <td class="text-center">${{ number_format($orden->total, 2) }}</td>
            <td class="text-center">
                @if($orden->estado == 1)
                    <span class="badge bg-success">Completado</span>
                @else
                    <span class="badge bg-warning">Pendiente</span>
                @endif
            </td>
            <td class="text-center">
                @if(!$isPagada)
                    <a class="btn btn-primary" href="{{ route('orden_reparacion.update.get', $orden->id_detalle_reparacion) }}">Actualizar</a>
                    <form action="{{ route('orden_reparacion.destroy', $orden->id_detalle_reparacion) }}" method="POST" style="display: inline" onsubmit="return confirm('¿Está seguro de que desea eliminar esta orden?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                    </form>
                @endif
            </td>
        </tr>
        @endforeach
        <tr>
            <td colspan="4" class="text-end"><strong>Total de la Deuda:</strong></td>
            <td class="text-center">
                <strong>${{ number_format($ordenes->sum('total'), 2) }}</strong>
            </td>
            <td colspan="2"></td>
        </tr>
    </tbody>
</table>

<div class="row mt-3">
    <div class="col">
        @if(!$isPagada && count($ordenes) > 0)
            <a href="{{ url('/catalogos/pagos/agregar?id_vehiculo=' . $infoBase->id_vehiculos . '&monto=' . $ordenes->sum('total')) }}" class="btn btn-success">Realizar Pago</a>
        @endif
        <a href="{{ url('/catalogos/reparacion') }}" class="btn btn-secondary">Volver a Reparaciones</a>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#maintable').DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Spanish.json"
            }
        });
    });
</script>
@endsection