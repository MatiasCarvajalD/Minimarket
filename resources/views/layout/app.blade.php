<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minimarket')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <header>
        <h1>Minimarket</h1>
        <nav>
            <ul>
                <li><a href="{{ route('productos.index') }}">Productos</a></li>
                <li><a href="{{ route('ventas.index') }}">Ventas</a></li>
            </ul>
        </nav>
    </header>
    <main>
        @yield('content')
    </main>
    <footer>
        <p>&copy; {{ date('Y') }} Minimarket</p>
    </footer>
</body>
</html>
