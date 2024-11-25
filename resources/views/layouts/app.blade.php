<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minimarket')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(to bottom, #ff9966, #ff5e62);
            min-height: 100vh;
            color: #fff;
        }
        nav {
            background: #4a4a8a;
        }
        .navbar-brand {
            color: #fff;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container">
            <a class="navbar-brand" href="{{ route('home') }}">Minimarket</a>
            <div>
                <ul class="navbar-nav">
                    @auth
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('carrito.index') }}">Carrito</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('logout') }}">Cerrar Sesión</a></li>
                    @else
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('login') }}">Iniciar Sesión</a></li>
                        <li class="nav-item"><a class="nav-link text-white" href="{{ route('register') }}">Registrarse</a></li>
                    @endauth
                </ul>
            </div>
        </div>
    </nav>
    <div class="container mt-4">
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
