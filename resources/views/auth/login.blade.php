@extends('components.layout')

@section('content')
    <div class="row my-4">
        <h1>Iniciar Sesión</h1>
    </div>

    <div class="row my-4">
        <div class="col-md-6 offset-md-3">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">Correo Electrónico</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Iniciar Sesión</button>
                        <a href="{{ url('/') }}" class="btn btn-secondary">Regresar</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row my-2">
        <div class="col text-center">
            <p>¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate aquí</a></p>
        </div>
    </div>
@endsection
