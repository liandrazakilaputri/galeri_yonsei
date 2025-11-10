@extends('admin.layout')

@section('content')
<div class="container">
    <h2 class="mb-4">💬 Komentar & Rating</h2>

    {{-- Komentar Home --}}
    <div class="card mb-4">
        <div class="card-header bg-primary text-white">Komentar di Halaman Home</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Komentar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($komentarHome as $k)
                        <tr>
                            <td>{{ $k->nama ?? 'Anonim' }}</td>
                            <td>{{ $k->komentar }}</td>
                            <td>{{ $k->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.komentar.destroyHome', $k->id) }}" method="POST" onsubmit="return confirm('Yakin hapus komentar ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="text-center">Belum ada komentar.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- Rating Foto --}}
    <div class="card">
        <div class="card-header bg-success text-white">Rating Foto</div>
        <div class="card-body">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Foto</th>
                        <th>Rating</th>
                        <th>Komentar</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($ratings as $r)
                        <tr>
                            <td>{{ $r->nama_user ?? 'Anonim' }}</td>
                            <td>{{ $r->foto->judul ?? '-' }}</td>
                            <td>⭐ {{ $r->rating }}</td>
                            <td>{{ $r->komentar }}</td>
                            <td>{{ $r->created_at->format('d M Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.komentar.destroyRating', $r->id) }}" method="POST" onsubmit="return confirm('Yakin hapus rating ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Hapus</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr><td colspan="6" class="text-center">Belum ada rating.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
