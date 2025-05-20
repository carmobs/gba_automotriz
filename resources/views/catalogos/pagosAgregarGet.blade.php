@extends('components.layout')

@section('content')
@component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
@endcomponent

<div class="container">
    <h1 class="my-4">Registrar Pago</h1>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-md-6">
            <form method="POST" action="{{ url('/catalogos/pagos/agregar') }}" id="pagoForm">
                @csrf
                <div class="mb-3">
                    <label for="id_vehiculo" class="form-label">Vehículo del Cliente *</label>
                    <select class="form-select" id="id_vehiculo" name="id_vehiculo" required>
                        <option value="">Seleccione un vehículo</option>
                        @foreach($vehiculos as $vehiculo)
                            <option value="{{ $vehiculo->id_vehiculos }}" 
                                    data-reparacion="{{ $vehiculo->id_reparacion }}"
                                {{ (old('id_vehiculo', request('id_vehiculo')) == $vehiculo->id_vehiculos && 
                                   old('id_reparacion', request('id_reparacion')) == $vehiculo->id_reparacion) ? 'selected' : '' }}>
                                {{ $vehiculo->cliente_nombre }} - {{ $vehiculo->marca }} {{ $vehiculo->modelo }}
                                (Reparación #{{ $vehiculo->id_reparacion }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <input type="hidden" id="id_reparacion" name="id_reparacion" value="{{ request('id_reparacion') }}">

                <div id="infoReparacion" style="display: none;">
                    <div class="card mb-3">
                        <div class="card-header bg-danger text-white">
                            <h5 class="card-title mb-0">Información de la Reparación</h5>
                        </div>
                        <div class="card-body">
                            <div id="serviciosLista"></div>
                            <hr>
                            <div class="row">
                                <div class="col">
                                    <h5>Total a Pagar:</h5>
                                    <h3 id="totalPago" class="text-primary">$0.00</h3>
                                </div>
                                <div class="col">
                                    <div id="estadoServicios" class="alert" role="alert"></div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="fecha" class="form-label">Fecha *</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" 
                               value="{{ date('Y-m-d') }}" max="{{ date('Y-m-d') }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="monto" class="form-label">Monto *</label>
                        <input type="number" step="0.01" class="form-control" id="monto" name="monto" required>
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-danger" id="btnSubmit">Registrar Pago</button>
                        <a href="{{ url('/catalogos/pagos') }}" class="btn btn-secondary">Cancelar</a>
                    </div>
                </div>
                
            </form>
        </div>
    </div>
</div>

<script>
// Trigger change event on page load if vehicle is preselected
document.addEventListener('DOMContentLoaded', function() {
    const vehiculoSelect = document.getElementById('id_vehiculo');
    if (vehiculoSelect.value) {
        vehiculoSelect.dispatchEvent(new Event('change'));
    }
});

document.getElementById('id_vehiculo').addEventListener('change', function() {
    const vehiculoId = this.value;
    const reparacionId = this.options[this.selectedIndex].getAttribute('data-reparacion');
    document.getElementById('id_reparacion').value = reparacionId;
    
    const infoDiv = document.getElementById('infoReparacion');
    const btnSubmit = document.getElementById('btnSubmit');
    
    if (!vehiculoId) {
        infoDiv.style.display = 'none';
        return;
    }

    fetch(`/catalogos/pagos/getReparacionInfo/${vehiculoId}?id_reparacion=${reparacionId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                infoDiv.style.display = 'block';
                
                // Actualizar lista de servicios
                const serviciosHtml = data.reparacion.ordenes.map(orden => `
                    <div class="mb-2">
                        <strong>${orden.servicio.nombre}</strong><br>
                        Cantidad: ${orden.cantidad} × $${orden.costo_unitario_servicio} = 
                        $${(orden.cantidad * orden.costo_unitario_servicio).toFixed(2)}<br>
                        Estado: <span class="badge ${orden.estado == 1 ? 'bg-success' : 'bg-warning'}">
                            ${orden.estado == 1 ? 'Completado' : 'Pendiente'}
                        </span>
                    </div>
                `).join('');
                
                document.getElementById('serviciosLista').innerHTML = serviciosHtml;
                document.getElementById('totalPago').textContent = `$${data.total.toFixed(2)}`;
                document.getElementById('monto').value = data.total.toFixed(2);
                
                // Actualizar estado de servicios
                const estadoDiv = document.getElementById('estadoServicios');
                estadoDiv.className = `alert ${data.serviciosCompletados ? 'alert-success' : 'alert-warning'}`;
                estadoDiv.innerHTML = data.serviciosPendientes > 0 ? 
                    `Hay ${data.serviciosPendientes} servicios pendientes por completar` : 
                    'Todos los servicios están completados';
                
                btnSubmit.disabled = !data.puedeRealizarPago;

                // Mostrar estado de la reparación
                const estadoReparacionDiv = document.createElement('div');
                estadoReparacionDiv.className = 'mt-2 mb-3';
                estadoReparacionDiv.innerHTML = `
                    <strong>Estado de la Reparación:</strong> 
                    <span class="badge ${data.reparacion.estado === 'Completada' ? 'bg-success' : 'bg-warning'}">
                        ${data.reparacion.estado}
                    </span>
                `;
                document.getElementById('serviciosLista').insertAdjacentElement('afterbegin', estadoReparacionDiv);

                if (!data.puedeRealizarPago) {
                    document.getElementById('monto').disabled = true;
                }
            } else {
                infoDiv.style.display = 'none';
                alert(data.message);
            }
        });
});
</script>
@endsection