@extends('user.layout')

@section('title', 'Galeri Foto')

@section('content')
<style>
    /* Grid ala Instagram */
    .galeri-card {
        position: relative;
        overflow: hidden;
        border-radius: 10px;
    }

    .galeri-img {
        width: 100%;
        aspect-ratio: 1 / 1;
        object-fit: cover;
        transition: transform 0.3s ease-in-out;
        border-radius: 10px;
    }

    .galeri-card:hover .galeri-img {
        transform: scale(1.05);
    }

    /* Overlay untuk teks */
    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        background: rgba(0,0,0,0.65);
        color: #fff;
        padding: 10px;
        font-size: 0.85rem;
    }

    .overlay h5 {
        font-size: 0.9rem;
        font-weight: bold;
        margin-bottom: 5px;
    }

    .overlay a {
        color: #fff;
        text-decoration: none;
    }

    .overlay a:hover {
        text-decoration: underline;
    }

    .overlay .caption {
        font-size: 0.8rem;
        color: #ddd;
    }

    .overlay .meta-info {
        font-size: 0.75rem;
        margin: 5px 0;
        color: #ccc;
    }

    .overlay .btn {
        font-size: 0.75rem;
        margin-bottom: 6px;
    }

    .komentar-list {
        font-size: 0.75rem;
        max-height: 60px;
        overflow-y: auto;
    }
</style>

<div class="container">
    <!-- Search Bar -->
    <form action="{{ route('galeri') }}" method="GET" class="mb-4">
        <div class="input-group">
            <input type="text" name="search" value="{{ request('search') }}" 
                   class="form-control" placeholder="Cari foto berdasarkan judul atau deskripsi...">
            <button class="btn btn-primary" type="submit">
                <i class="bi bi-search"></i> Cari
            </button>
        </div>
    </form>

    <!-- Galeri Perkategori -->
    @forelse($groupedFotos as $kategori => $fotos)
        <h4 class="mt-4 mb-3">{{ $kategori }}</h4>
        <div class="row g-3">
            @foreach($fotos as $g)
                <div class="col-6 col-md-3">
                    <div class="galeri-card shadow-sm">
                        @if($g->gambar)
                            <!-- Foto dibungkus link ke detail -->
                            <a href="{{ route('galeri.show', $g->id) }}">
                                <img src="{{ asset('storage/'.$g->gambar) }}" 
                                     class="galeri-img" 
                                     alt="{{ $g->judul }}">
                            </a>
                        @endif
                        <div class="overlay">
                            <h5>
                                <a href="{{ route('galeri.show', $g->id) }}">{{ $g->judul }}</a>
                            </h5>
                            <p class="caption">{{ Str::limit($g->deskripsi, 40) }}</p>
                            <p class="meta-info">
                                📅 {{ $g->created_at->format('d M Y') }} <br>
                                ⭐ {{ $g->averageRating() ? number_format($g->averageRating(), 1) : 'Belum ada rating' }}
                            </p>

                            <!-- Tombol download (untuk semua user) -->
                            @if($g->gambar)
                                <a href="{{ route('galeri.download', $g->id) }}" 
                                   class="btn btn-sm btn-outline-light w-100">
                                   ⬇️ Download
                                </a>
                            @endif

                            <!-- Komentar list -->
                            <div class="komentar-list mt-2">
                                <strong>Komentar:</strong>
                                <ul class="list-unstyled mb-1">
                                    @forelse($g->comments->take(2) as $c)
                                        <li><strong>{{ $c->nama_user ?? 'Anonim' }}:</strong> {{ $c->komentar }}</li>
                                    @empty
                                        <li><em>Belum ada komentar.</em></li>
                                    @endforelse
                                </ul>

                                <!-- Link tambah komentar & rating tetap untuk semua -->
                                <a href="{{ route('galeri.show', $g->id) }}" class="text-info">
                                    ➕ Tambah komentar & rating
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @empty
        <div class="alert alert-warning text-center">
            Tidak ada foto ditemukan.
        </div>
    @endforelse
</div>
@endsection
