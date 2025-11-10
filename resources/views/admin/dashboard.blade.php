@extends('admin.layout')

@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard Admin YONSEI</h2>

    {{-- Statistik --}}
    <div class="row">
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>🖼️ Total Foto</h5>
                    <h3>{{ $totalFoto }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>📂 Total Kategori</h5>
                    <h3>{{ $totalKategori }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>👤 Total Admin</h5>
                    <h3>{{ $totalAdmin }}</h3>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card text-center shadow-sm">
                <div class="card-body">
                    <h5>💬 Total Komentar</h5>
                    <h3>{{ $totalKomentar }}</h3>
                </div>
            </div>
        </div>
    </div>

    {{-- Semua Foto --}}
    <div class="card my-4 shadow-sm">
        <div class="card-header">
            Galeri Foto
        </div>
        <div class="card-body">
            <div class="row">
                @forelse ($allFotos as $foto)
                    <div class="col-md-3 mb-3">
                        <div class="card h-100 shadow-sm">
                            @php
                                $imgPath = $foto->gambar && file_exists(storage_path('app/public/'.$foto->gambar)) 
                                           ? asset('storage/'.$foto->gambar) 
                                           : asset('images/default.jpg');
                            @endphp
                            <a href="{{ $imgPath }}" target="_blank">
                                <img src="{{ $imgPath }}" 
                                     class="card-img-top galeri-img" 
                                     alt="{{ $foto->judul }}">
                            </a>
                            <div class="card-body text-center">
                                <h6 class="card-title mb-1">{{ $foto->judul }}</h6>
                                <small class="text-muted">
                                    {{ $foto->kategori->nama ?? '-' }}
                                </small>
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-muted">Belum ada foto di galeri.</p>
                @endforelse
            </div>
        </div>
    </div>

    {{-- Komentar Terbaru --}}
    <div class="card my-4 shadow-sm">
        <div class="card-header">
            Komentar Terbaru
        </div>
        <div class="card-body">
            <ul class="list-group">
                @forelse($recentComments as $komentar)
                    <li class="list-group-item">
                        <strong>{{ $komentar->nama }}</strong><br>
                        <span>{{ $komentar->komentar }}</span>
                        <div class="text-muted small">
                            {{ $komentar->created_at->diffForHumans() }}
                        </div>
                    </li>
                @empty
                    <li class="list-group-item text-muted text-center">
                        Belum ada komentar terbaru.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>

    {{-- Quick Actions --}}
<div class="card my-4 shadow-sm">
    <div class="card-header">
        Quick Actions
    </div>
    <div class="card-body">
        <a href="{{ route('admin.galeri.create') }}" class="btn btn-primary">+ Tambah Foto</a>
        <a href="{{ route('admin.kategori.create') }}" class="btn btn-warning">+ Tambah Kategori</a>
    </div>
</div>

@endsection

@push('styles')
<style>
    .galeri-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
        transition: transform 0.2s ease-in-out;
    }
    .galeri-img:hover {
        transform: scale(1.05);
    }
    .card-title {
        font-size: 1rem;
        font-weight: bold;
    }
</style>
@endpush
