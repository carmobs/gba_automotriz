@extends('components.layout')
 
 @section('content')
 @component('components.breadcrumbs', ['breadcrumbs' => $breadcrumbs])
 @endcomponent
 
 @php
     $reparaciones = App\Models\Reparacion::all();
     $servicios = App\Models\Servicios::all();
 @endphp
 
 <div class="row my-4">
     <div class="col">
         <h1>Agregar Orden de Reparación</h1>
     </div>
 </div>
 
 <form method="POST" action="{{ route('orden_reparacion.store') }}">
     @csrf
     <div class="form-group">
         <p class="form-control-plaintext">Reparación: {{ $id_reparacion }}</p>
         <input type="hidden" id="id_reparacion" name="id_reparacion" value="{{ $id_reparacion }}">
     </div>
     <div class="form-group">
         <label for="id_servicios">Servicio</label>
         <select class="form-control" id="id_servicios" name="id_servicios" required>
             <option value="">Seleccione un servicio</option>
             @foreach($servicios as $servicio)
                 <option value="{{ $servicio->id_servicios }}" data-costo="{{ $servicio->costo }}">{{ $servicio->nombre }}</option>
             @endforeach
         </select>
     </div>
     <div class="form-group">
         <label for="costo_unitario_servicio">Costo Unitario</label>
         <input type="number" step="0.01" class="form-control" id="costo_unitario_servicio" name="costo_unitario_servicio" readonly required>
     </div>
     <div class="form-group">
         <label for="cantidad">Cantidad</label>
         <input type="number" class="form-control" id="cantidad" name="cantidad" required>
     </div>
     <div class="form-group">
         <label for="total">Total</label>
         <input type="text" class="form-control" id="total" name="total" readonly>
     </div>
     <div class="form-group">
         <label for="estado">Estado</label>
         <select class="form-control" id="estado" name="estado" required>
             <option value="1">Pendiente</option>
             <option value="0">Completado</option>
         </select>
     </div>
     <button type="submit" class="btn btn-primary">Guardar</button>
     <a href="{{ route('orden_reparacion.get', ['id_reparacion' => $id_reparacion]) }}" class="btn btn-secondary">Cancelar</a>
 </form>

 <script>
     const servicioSelect = document.getElementById('id_servicios');
     const costoUnitarioInput = document.getElementById('costo_unitario_servicio');
     const cantidadInput = document.getElementById('cantidad');
     const totalInput = document.getElementById('total');

     servicioSelect.addEventListener('change', function () {
         const selectedOption = servicioSelect.options[servicioSelect.selectedIndex];
         const costo = parseFloat(selectedOption.getAttribute('data-costo')) || 0;
         costoUnitarioInput.value = costo.toFixed(2);
         calculateTotal();
     });

     cantidadInput.addEventListener('input', calculateTotal);

     function calculateTotal() {
         const costoUnitario = parseFloat(costoUnitarioInput.value) || 0;
         const cantidad = parseInt(cantidadInput.value) || 0;
         const total = costoUnitario * cantidad;
         totalInput.value = total.toFixed(2);
     }
 </script>
 @endsection