<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Minimarket & Restaurant')</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    @include('partials.header')

    <main class="container mt-4">
        @yield('content')
    </main>

    @include('partials.footer')


    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>


    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
