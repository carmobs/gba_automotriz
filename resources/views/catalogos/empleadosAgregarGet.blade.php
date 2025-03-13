@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Agregar empleado</h1>
    </div>
    <div class="col"></div>
</div>
<form method="post" action="{{url('/catalogos/empleados/agregar')}}">
    @csrf
    <div class="row my-4">
        <div class="col">
            <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Agregar nombre" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="fecha">Fecha Ingreso</label>
                <input type="date" class="form-control" id="fecha" name="fecha" placeholder="Agregar fecha" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="estado">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" placeholder="Agregar estado" required>
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