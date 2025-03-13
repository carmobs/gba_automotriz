@extends("components.layout")
@section("content")
@component("components.breadcrumbs",["breadcrumbs"=>$breadcrumbs])
@endcomponent

<div class="row my-4">
    <div class="col">
        <h1>Agregar servicio</h1>
    </div>
    <div class="col"></div>
</div>
<form method="post" action="{{url('/catalogos/servicios/agregar')}}">
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
                <label for="descripcion">Descripcion</label>
                <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Agregar descripcion" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="tiempo">Tiempo</label>
                <input type="time" class="form-control" id="tiempo" name="tiempo" placeholder="Agregar tiempo" required>
            </div>
        </div>
        <div class="col">
            <div class="form-group">
                <label for="costo">Costo</label>
                <input type="text" class="form-control" id="costo" name="costo" placeholder="Agregar costo" required>
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