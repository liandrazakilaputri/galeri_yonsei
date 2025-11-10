@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2>Edit Foto Galeri</h2>

    <form action="{{ route('admin.galeri.update', $galeri->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Judul</label>
            <input type="text" name="judul" value="{{ $galeri->judul }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Kategori</label>
            <select name="kategori_id" class="form-control" required>
                @foreach($kategori as $k)
                    <option value="{{ $k->id }}" {{ $galeri->kategori_id == $k->id ? 'selected' : '' }}>
                        {{ $k->nama }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Gambar Saat Ini</label><br>
            @if($galeri->gambar)
                <img src="{{ asset('storage/'.$galeri->gambar) }}" alt="Foto" width="150" class="rounded">
            @else
                <span class="text-muted">Tidak ada gambar</span>
            @endif
        </div>

        <div class="mb-3">
            <label>Ganti Gambar</label>
            <input type="file" name="gambar" class="form-control">
        </div>

        <div class="mb-3">
            <label>Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="3">{{ $galeri->deskripsi }}</textarea>
        </div>

        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">Kembali</a>
    </form>
</div>
@endsection
