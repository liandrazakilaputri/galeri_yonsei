@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Edit Komentar Home</h2>

    <form action="{{ route('admin.komentar.updateHome', $komentar->id) }}" method="POST">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Nama</label>
            <input type="text" name="nama" class="form-control" value="{{ $komentar->nama }}">
        </div>
        <div class="mb-3">
            <label>Komentar</label>
            <textarea name="komentar" class="form-control" rows="3">{{ $komentar->komentar }}</textarea>
        </div>
        <button class="btn btn-primary">Update</button>
        <a href="{{ route('admin.komentar.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
