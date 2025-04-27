@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent
 
 <div class="row my-4">
     <div class="col">
         <h1>Órdenes de Reparación</h1>
     </div>
     <div class="col-auto titlebar-commands">
         <a class="btn btn-primary" href="{{ route('orden_reparacion.create', ['id_reparacion' => $id_reparacion]) }}">Agregar</a>
     </div>
 </div>
 
 <table class="table" id="maintable">
 <thead>
     <tr>
         <th scope="col">ID</th>
         <th scope="col">ID REPARACIÓN</th>
         <th scope="col">ID SERVICIO</th>
         <th scope="col">COSTO UNITARIO</th>
         <th scope="col">CANTIDAD</th>
         <th scope="col">TOTAL</th>
         <th scope="col">ESTADO</th>
         <th scope="col">ACCIONES</th>
     </tr>
 </thead>
 <tbody>
 @foreach($ordenes as $orden)
     <tr>
         <td class="text-center">{{ $orden->id_detalle_reparacion }}</td>
         <td class="text-center">{{ $orden->id_reparacion }}</td>
         <td class="text-center">{{ $orden->id_servicios }}</td>
         <td class="text-center">{{ $orden->costo_unitario_servicio }}</td>
         <td class="text-center">{{ $orden->cantidad }}</td>
         <td class="text-center">{{ $orden->total }}</td>
         <td class="text-center">{{ $orden->estado }}</td>
         <td class="text-center">
             <a class="btn btn-primary" href="{{ url('/catalogos/orden_reparacion/actualizar') }}">Actualizar</a>
             @component('components.delete-button', ['route' => 'orden_reparacion.destroy', 'id' => $orden->id_detalle_reparacion])
             @endcomponent
         </td>
     </tr>
 @endforeach
 </tbody>
 </table>
 
 <script>
 
 </script>
@endsection