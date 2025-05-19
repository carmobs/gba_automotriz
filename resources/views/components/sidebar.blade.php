<nav class="sidebar nav">
    <a href="{{ url('/') }}">
        <img src="{{ URL::asset('assets/logo GBA.png') }}" alt="logo de gba" class="img-fluid logo-gba">
    </a>
    <a href="{{url('/catalogos/clientes')}}" class="nav-link">
        <i class="fas fa-users"></i> Clientes
    </a>
    <a href="{{url('/catalogos/vehiculos')}}" class="nav-link">
        <i class="fas fa-car"></i> Vehículos
    </a>
    <a href="{{ url('/catalogos/citas') }}" class="nav-link">
        <i class="fas fa-calendar-alt"></i> Citas
    </a>
    <a href="{{url('/catalogos/reparacion')}}" class="nav-link">
        <i class="fas fa-wrench"></i> Ventas
    </a>
    <a href="{{url('/catalogos/pagos')}}" class="nav-link">
        <i class="fas fa-credit-card"></i> Pagos
    </a>
    <a href="{{ url('/catalogos/puestos') }}" class="nav-link">
        <i class="fas fa-briefcase"></i> Puestos
    </a>
    <a href="{{url('/catalogos/empleados')}}" class="nav-link">
        <i class="fas fa-user-tie"></i> Empleados
    </a>
    <a href="{{url('/catalogos/servicios')}}" class="nav-link">
        <i class="fas fa-tools"></i> Servicios
    </a>
    <a href="{{ url('/catalogos/reportes') }}" class="nav-link">
        <i class="fas fa-chart-bar"></i> Reportes
    </a>
</nav>