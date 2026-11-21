<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>403 - Akses Ditolak</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="bg-light d-flex align-items-center justify-content-center min-vh-100">
    <div class="text-center p-4">
        <div class="kartu mx-auto p-5" style="max-width: 500px;">
            <h1 class="display-1 fw-bold text-danger">403</h1>
            <h3 class="fw-bold mb-3">Akses Ditolak</h3>
            <p class="text-muted mb-4">
                {{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses untuk halaman atau aksi ini.' }}
            </p>
            <a href="{{ route('kendaraan.daftar') }}" class="btn btn-primary px-4">Kembali ke Daftar Kendaraan</a>
        </div>
    </div>
</body>
</html>

