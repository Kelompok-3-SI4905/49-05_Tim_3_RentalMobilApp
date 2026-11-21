<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - Rental Mobil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark menu-atas">
        <div class="container">
            <span class="navbar-brand">Rental Mobil</span>
                        <div class="navbar-nav">
                <a class="nav-link" href="{{ url('/') }}">Daftar Paket</a>

                @can('tambah-paket')
                    <a class="nav-link" href="{{ route('paket.create') }}">Tambah Paket</a>
                @endcan

                @auth
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="nav-link">Logout ({{ Auth::user()->username }})</button>
                    </form>
                @else
                    <a class="nav-link" href="{{ url('/login') }}">Login</a>
                @endauth
            </div>
        </div>
    </nav>

    @if (session('success'))
        <div class="container mt-3">
            <div class="alert alert-success mb-0">{{ session('success') }}</div>
        </div>
    @endif

    @yield('content')
</body>
</html>