<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Paket Rental</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow-sm p-4">
                <h3 class="fw-bold mb-3 border-bottom pb-2">Tambah Paket Rental</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('paket.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Jenis Paket</label>
                        <input type="text" class="form-control" name="jenis_paket" value="{{ old('jenis_paket') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Durasi</label>
                        <input type="number" class="form-control" name="durasi" value="{{ old('durasi') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Ketentuan</label>
                        <textarea class="form-control" name="ketentuan" rows="4" required>{{ old('ketentuan') }}</textarea>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('paket.index') }}" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
