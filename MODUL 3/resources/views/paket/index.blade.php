@extends('layouts.app')

@section ('title', 'Daftar Paket Rental')

@section('content')
<div class="container konten">
    <h1>Daftar Paket Rental</h1>

    @can('tambah-paket')
        <a href="{{ route('paket.create') }}" class="btn btn-primary mb-3">Tambah Paket</a>
    @endcan

    <table class="table table-bordered table-striped">
        <tr>
            <th>Jenis Paket</th>
            <th>Durasi</th>
            <th>Ketentuan</th>
            @auth
            <th>Aksi</th>
            @endauth
        </tr>
        @foreach ($paket as $item)
        <tr>
            <td>{{ $item->jenis_paket }}</td>
            <td>{{ $item->durasi }} hari</td>
            <td>{{ $item->ketentuan }}</td>
            @auth
            <td>
                @can('update', $item)
                    <a href="{{ route('paket.edit', $item) }}" class="btn btn-sm btn-warning">Edit</a>
                @endcan

                @can('delete', $item)
                    <form action="{{ route('paket.destroy', $item) }}" method="POST" class="d-inline"
                          onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                    </form>
                @endcan
            </td>
            @endauth
        </tr>
        @endforeach

        @if ($paket->isEmpty())
        <tr>
            <td colspan="4" class="text-center text-muted">Belum ada paket rental.</td>
        </tr>
        @endif
    </table>
</div>
@endsection