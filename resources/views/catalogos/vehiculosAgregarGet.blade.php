@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Agregar vehiculo</h1>
    </div>
    <div class="col"></div>
</div>
<form method="post" action="{{url('/catalogos/vehiculos/agregar')}}">
    @csrf
    <div class="row my-4">
        <div class="col">
            <div class="form-group">
                <label for="id_clientes">Cliente</label>
                <select class="form-control" id="id_clientes" name="id_clientes" required>
                    <option value="">Seleccione un cliente</option>
                    @foreach($clientes as $cliente)
                        <option value="{{ $cliente->id_clientes }}">{{ $cliente->nombre }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="marca">Marca</label>
                <input type="text" class="form-control" id="marca" name="marca" placeholder="Agregar marca" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="modelo">Modelo</label>
                <input type="text" class="form-control" id="modelo" name="modelo" placeholder="Agregar modelo" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="anio_field">Año del Vehículo</label>
                <input type="number" class="form-control" id="anio_field" name="anio_field"
                       min="1900" max="{{ date('Y')+2 }}" 
                       value="{{ old('anio_field') }}" required
                       oninvalid="this.setCustomValidity('Por favor ingrese un año válido entre 1900 y {{ date('Y')+2 }}')"
                       oninput="this.setCustomValidity('')">
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="detalles_vehiculo">Detalles del vehiculo</label>
                <input type="text" class="form-control" id="detalles_vehiculo" name="detalles_vehiculo" placeholder="Agregar detalles del vehiculo" required>
            </div>
        </div>
    </div>
    <div class="row my-4">
        <div class="col">
            <br>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
    </div>
</form>
@endsection