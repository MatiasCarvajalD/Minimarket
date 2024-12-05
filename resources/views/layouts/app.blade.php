<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minimarket & Restaurant')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    @if (!request()->is('login'))
        @include('partials.header') {{-- Incluye la barra de navegación solo si no es la página de login --}}
    @endif
    <div class="container my-4">
        @yield('content')
    </div>

</body>
</html>
