<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minimarket y Restaurant')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('user.home') }}">Minimarket & Restaurant</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav">
                        <!-- Menú visible para todos -->
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos.index') }}">Productos</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('restaurant.index') }}">Restaurante</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('carrito.index') }}">Carrito</a>
                        </li>
                    </ul>
                    <!-- Opciones según el estado de autenticación -->
                    <div class="ms-auto">
                        @auth
                            @if(Auth::user()->role === 'admin')
                                <a href="{{ route('admin.usuarios.index') }}" class="btn btn-outline-light btn-sm">Administración</a>
                            @endif
                            <span class="text-light me-3">Hola, {{ Auth::user()->name }}</span>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                            
                            <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                Cerrar sesión
                            </a>                           
                            
                        @else
                            <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Iniciar Sesión</a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>
    </header>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
