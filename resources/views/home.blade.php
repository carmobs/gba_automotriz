@extends("components.layout")
@section("content")

<div class="home-container">
    <!-- Carrusel de imágenes -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/assets/reparacionCarruse1.jpg" class="d-block w-100" alt="Reparación de vehículos 1">
            </div>
            <div class="carousel-item">
                <img src="/assets/reparacionCarruse2.jpg" class="d-block w-100" alt="Reparación de vehículos 2">
            </div>
            <div class="carousel-item">
                <img src="/assets/reparacionCarruse3.jpg" class="d-block w-100" alt="Reparación de vehículos 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
        </button>
    </div>

    <!-- Descripción del negocio -->
    <div class="business-description">
        <h2>¿Quiénes somos?</h2>
        <p>
            En GBA Automotriz nos especializamos en la reparación y mantenimiento de vehículos. 
            Ofrecemos servicios de alta calidad para garantizar que tu automóvil esté en las mejores condiciones. 
            Nuestro equipo de expertos está comprometido con la satisfacción del cliente y la excelencia en cada trabajo.
        </p>
    </div>

    <!-- Botón de cerrar sesión -->
    <div class="d-flex justify-content-end mt-3 me-3">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Cerrar Sesión</button>
        </form>
    </div>
</div>

<style>
    .home-container {
        padding: 20px;
    }
    .carousel-inner img {
        height: 400px;
        object-fit: cover;
        border-radius: 10px;
    }
    .business-description {
        margin-top: 30px;
        text-align: center;
    }
    .business-description h2 {
        font-size: 24px;
        color: #fa3c3c;
        margin-bottom: 15px;
    }
    .business-description p {
        font-size: 16px;
        color: #333;
        line-height: 1.6;
    }
</style>
@endsection