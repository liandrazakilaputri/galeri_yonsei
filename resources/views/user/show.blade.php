@extends('user.layout')

@section('title', $foto->judul)

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm insta-card">
                <div class="row g-0">
                    <!-- Foto (Kiri) -->
                    <div class="col-md-7 border-end">
                        <div class="insta-photo">
                            <img src="{{ asset('storage/' . $foto->gambar) }}" alt="{{ $foto->judul }}">
                        </div>
                    </div>

                    <!-- Detail & Komentar (Kanan) -->
                    <div class="col-md-5 d-flex flex-column">
                        <div class="p-3 flex-grow-1 d-flex flex-column">
                            <!-- Header -->
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-circle bg-secondary text-white d-flex align-items-center justify-content-center" style="width:40px; height:40px;">
                                    <i class="bi bi-person"></i>
                                </div>
                                <div class="ms-2">
                                    <strong>{{ $foto->judul }}</strong><br>
                                    <small class="text-muted">{{ $foto->kategori->nama ?? '-' }}</small>
                                </div>
                            </div>
                            <hr>

                            <!-- Deskripsi -->
                            <p class="mb-2">{{ $foto->deskripsi }}</p>
                            <small class="text-secondary d-block mb-3">
                                📅 {{ $foto->created_at->format('d M Y') }}
                            </small>

                            <!-- Rating -->
                            <p class="mb-2">⭐ Rata-rata rating: 
                                <strong>{{ number_format($foto->averageRating() ?? 0, 1) }}</strong>
                            </p>

                            <!-- Komentar list -->
                            <div class="comment-box flex-grow-1 mb-3">
                                @if($foto->comments && $foto->comments->count() > 0)
                                    @foreach($foto->comments as $komen)
                                        <div class="mb-2">
                                            <strong>{{ $komen->nama_user ?? 'Anonim' }}</strong> 
                                            <span>{{ $komen->komentar }}</span><br>
                                            <small class="text-secondary">{{ $komen->created_at->diffForHumans() }}</small>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-muted">Belum ada komentar.</p>
                                @endif
                            </div>

                            <!-- Form rating & komentar (publik) -->
                            <form action="{{ route('rating.store', $foto->id) }}" method="POST" class="mt-auto">
                                @csrf
                                <div class="mb-2">
                                    <textarea name="komentar" rows="2" class="form-control mb-2" placeholder="Tulis komentar..."></textarea>
                                </div>
                                <div class="mb-2">
                                    <select name="rating" class="form-select form-select-sm w-auto">
                                        <option value="1">1 ⭐</option>
                                        <option value="2">2 ⭐</option>
                                        <option value="3">3 ⭐</option>
                                        <option value="4">4 ⭐</option>
                                        <option value="5">5 ⭐</option>
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-sm btn-primary w-100">Kirim</button>
                            </form>

                            <!-- Tombol download -->
                            @if($foto->gambar)
                                <a href="{{ route('galeri.download', $foto->id) }}" class="btn btn-success btn-sm mt-3 w-100">
                                    ⬇️ Download Foto
                                </a>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Tombol kembali -->
            <div class="mt-3">
                <a href="{{ route('galeri') }}" class="btn btn-secondary btn-sm">← Kembali ke Galeri</a>
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.insta-card {
    border-radius: 10px;
    overflow: hidden;
}
.insta-photo {
    background: #000;
    display: flex;
    align-items: center;
    justify-content: center;
    height: 100%;
    max-height: 80vh;
}
.insta-photo img {
    width: 100%;
    height: auto;
    object-fit: contain;
}
.comment-box {
    flex-grow: 1;
    max-height: 300px;
    overflow-y: auto;
}
</style>
