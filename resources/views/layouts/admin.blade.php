<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" defer></script>
</head>
<body>
    <div class="container">
        <!-- Navbar -->
        @include('partials.navbar')

        <!-- Contenido principal -->
        <main>
            @yield('content')
        </main>
    </div>

    <!-- Incluir scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
