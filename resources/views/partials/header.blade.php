<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minimarket y Restaurant')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>
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
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('productos.index') }}">Minimarket</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('restaurant.index') }}">Restaurante</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('carrito.index') }}">Carrito</a>
                        </li>
                    </ul>
                    @auth
                    <div class="dropdown">
                        <button class="btn btn-outline-light btn-sm dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            Hola, Usuario
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                            <li><a class="dropdown-item" href="/user/profile">Mi Perfil</a></li>
                            <li><a class="dropdown-item" href="/user/historial-compras">Historial de Compras</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form id="logout-form" action="/logout" method="POST">
                                    <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                    
                    @else
                        <a href="{{ route('login') }}" class="btn btn-primary btn-sm">Iniciar Sesión</a>
                    @endauth
                </div>
            </div>
        </nav>
        
    </header>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
