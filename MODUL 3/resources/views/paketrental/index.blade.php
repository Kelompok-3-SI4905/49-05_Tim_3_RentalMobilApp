<div class="d-flex justify-content-between align-items-center mb-3">
    <h1 class="h3 fw-bold">Daftar Paket Rental</h1>
    <div class="d-flex gap-2">
        @auth
            <a href="{{ route('paket.create') }}" class="btn btn-primary">+ Tambah Paket</a>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-secondary">Logout ({{ Auth::user()->username }})</button>
            </form>
        @else
            <a href="{{ route('login') }}" class="btn btn-outline-primary">Login</a>
        @endauth
    </div>
</div>