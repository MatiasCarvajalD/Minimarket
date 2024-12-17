<!-- Header de Admin -->
<header class="header-admin">
    <div class="container">
        <h1 class="text-center">Panel de Administración</h1>
    </div>
</header>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">Admin</a>

        <!-- Botón para dispositivos pequeños -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdmin" aria-controls="navbarAdmin" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Contenido del menú -->
        <div class="collapse navbar-collapse" id="navbarAdmin">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/usuarios*') ? 'active' : '' }}" href="{{ route('admin.usuarios.index') }}">Usuarios</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/productos*') ? 'active' : '' }}" href="{{ route('admin.productos.index') }}">Productos</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/ventas*') ? 'active' : '' }}" href="{{ route('admin.ventas.index') }}">Ventas</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/proveedores*') ? 'active' : '' }}" href="{{ route('admin.proveedores.index') }}">Proveedores</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/compras*') ? 'active' : '' }}" href="{{ route('admin.compras.index') }}">Compras</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ Request::is('admin/ajustes*') ? 'active' : '' }}" href="{{ route('admin.ajustes.index') }}">Ajustes</a>
                </li>
            </ul>

            <!-- Botón de Cerrar Sesión -->
            <form action="{{ route('logout') }}" method="POST" class="d-flex">
                @csrf
                <button type="submit" class="btn btn-danger">Cerrar sesión</button>
            </form>
        </div>
    </div>
</nav>
