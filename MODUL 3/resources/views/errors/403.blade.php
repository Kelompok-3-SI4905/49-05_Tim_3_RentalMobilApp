@extends('layouts.app')

@section('title', '403')

@section('content')
<div class="container konten text-center">
    <h1 class="display-4">403</h1>
    <p>{{ $exception->getMessage() ?: 'Anda tidak memiliki hak akses.' }}</p>
    <a href="{{ url('/') }}" class="btn btn-primary">Kembali</a>
</div>
@endsection