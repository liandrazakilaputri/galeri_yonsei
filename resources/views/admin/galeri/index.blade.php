@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Galeri Foto</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary mb-3">+ Tambah Foto</a>

    <table class="table table-bordered table-striped align-middle">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th>Gambar</th>
                <th>Tanggal Upload</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($galeri as $g)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $g->judul }}</td>
                    <td>{{ $g->kategori->nama ?? '-' }}</td>
                    <td>
                        @if($g->gambar)
                            <img src="{{ asset('storage/'.$g->gambar) }}" alt="Foto" width="120" class="rounded">
                        @else
                            <span class="text-muted">Tidak ada gambar</span>
                        @endif
                    </td>
                    <td>{{ $g->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('admin.galeri.edit', $g->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('admin.galeri.destroy', $g->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus foto ini?')">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center text-muted">Belum ada data galeri</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
