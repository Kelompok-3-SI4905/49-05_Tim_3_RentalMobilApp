@extends('layouts.app')

@section('title', 'Tambah Paket Rental')

@section('content')
<div class="container konten">
    <h1>Tambah Paket Rental</h1>

    @if ($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('paket.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="jenis_paket" class="form-label">Jenis Paket</label>
            <select class="form-select" id="jenis_paket" name="jenis_paket" required>
                <option value="Lepas Kunci" @selected(old('jenis_paket') == 'Lepas Kunci')>Lepas Kunci</option>
                <option value="All-in" @selected(old('jenis_paket') == 'All-in')>All-in</option>
                <option value="Luar Kota" @selected(old('jenis_paket') == 'Luar Kota')>Luar Kota</option>
            </select>
        </div>

        <div class="mb-3">
            <label for="durasi" class="form-label">Durasi (hari)</label>
            <input type="number" class="form-control" id="durasi" name="durasi" value="{{ old('durasi') }}" required>
        </div>

        <div class="mb-3">
            <label for="ketentuan" class="form-label">Ketentuan</label>
            <textarea class="form-control" id="ketentuan" name="ketentuan" required>{{ old('ketentuan') }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
@endsection