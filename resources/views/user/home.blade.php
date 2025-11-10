@extends('user.layout')

@section('title', 'Home - Yonsei')

@section('content')
<!-- Hero Section -->
<div class="position-relative" style="height: 75vh; overflow: hidden; border-radius: 20px;">
    <video autoplay muted loop playsinline class="w-100 h-100" style="object-fit: cover;">
        <source src="{{ asset('videos/yonsei.mp4') }}" type="video/mp4">
        Browser Anda tidak mendukung video background.
    </video>
    <div class="position-absolute top-50 start-50 translate-middle text-center text-white" style="z-index: 2;">
        <h1 class="fw-bold display-4">Selamat Datang di <span class="text-warning">YONSEI</span></h1>
        <p class="lead">Galeri digital sekolah yang modern, elegan, dan responsif</p>
        <a href="#galeri" class="btn btn-warning btn-lg mt-3 shadow">
            <i class="bi bi-images"></i> Lihat Galeri
        </a>
    </div>
    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: rgba(0,0,0,0.4);"></div>
</div>

<!-- Tentang Section -->
<section class="my-5 text-center">
    <h2 class="fw-bold mb-4">Tentang <span class="text-primary">Yonsei</span></h2>
    <p class="fs-5 text-muted px-md-5">
        Yonsei adalah platform galeri digital sekolah yang dirancang untuk menampilkan karya, momen, 
        dan kenangan indah. Dengan tampilan modern serta fitur dark mode, pengalaman menjelajah 
        menjadi lebih menyenangkan.
    </p>
</section>

<!-- Fitur Cards -->
<section class="row text-center g-4 my-5 container mx-auto">
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <i class="bi bi-camera2 display-4 text-primary mb-3"></i>
                <h5 class="fw-bold">Galeri Modern</h5>
                <p class="text-muted">Nikmati pengalaman menjelajah foto dengan desain modern dan responsif.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <i class="bi bi-brush display-4 text-warning mb-3"></i>
                <h5 class="fw-bold">Tampilan Elegan</h5>
                <p class="text-muted">Dengan UI elegan dan fitur dark mode, mata tetap nyaman.</p>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card h-100 shadow-sm border-0">
            <div class="card-body">
                <i class="bi bi-share display-4 text-success mb-3"></i>
                <h5 class="fw-bold">Berbagi Mudah</h5>
                <p class="text-muted">Bagikan momen berharga dengan mudah melalui media sosial.</p>
            </div>
        </div>
    </div>
</section>

<!-- Galeri Preview -->
<section id="galeri" class="my-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">Galeri <span class="text-primary">Terbaru</span></h2>
        <div class="row g-3" id="galeri-container">
            @foreach($foto as $f)
                @include('user.partials.foto-card', ['f' => $f])
            @endforeach
        </div>

        @if($foto->count() >= 6)
        <div class="text-center mt-4">
            <a href="{{ route('galeri') }}" class="btn btn-outline-primary">
                <i class="bi bi-images"></i> Lihat Semua Galeri
            </a>
        </div>
        @endif
    </div>
</section>

<!-- Komentar -->
<section class="my-5">
    <div class="container">
        <h3 class="fw-bold mb-3 text-center">💬 Tinggalkan Komentar</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="card shadow-sm mb-4">
            <div class="card-body">
                <form action="{{ route('home.komentar.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <input type="text" name="nama" class="form-control" placeholder="Nama Anda" required>
                    </div>
                    <div class="mb-2">
                        <textarea name="komentar" class="form-control" rows="3" placeholder="Tulis komentar..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>

        <div class="card shadow-sm">
            <div class="card-body">
                <h5 class="fw-bold">Komentar Terbaru</h5>
                <ul class="list-unstyled">
                    @forelse($komentar as $k)
                        <li class="mb-2">
                            <strong>{{ $k->nama }}</strong>: {{ $k->komentar }}
                            <br><small class="text-muted">{{ $k->created_at->diffForHumans() }}</small>
                        </li>
                    @empty
                        <li><em>Belum ada komentar.</em></li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</section>
@endsection

@push('styles')
<!-- GLightbox CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css" />
<style>
html { scroll-behavior: smooth; }
.gallery-card { transition: transform 0.3s ease, box-shadow 0.3s ease; }
.gallery-card:hover { transform: translateY(-5px); box-shadow: 0 6px 20px rgba(0,0,0,0.1); }
.gallery-img { transition: transform 0.5s ease; width:100%; height:100%; object-fit:cover; }
.gallery-card:hover .gallery-img { transform: scale(1.05); }
.star-btn { cursor:pointer; font-size:1rem; }
</style>
@endpush

@push('scripts')
<!-- GLightbox JS -->
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // GLightbox Init
    if(typeof GLightbox !== 'undefined'){
        GLightbox({ selector: '.glightbox' });
    }

    // Rating AJAX
    document.querySelectorAll('.rating').forEach(function(ratingEl){
        ratingEl.querySelectorAll('.star-btn').forEach(function(star){
            star.addEventListener('click', function(){
                let value = this.dataset.value;
                let fotoId = ratingEl.dataset.id;

                fetch(`/home/rating/${fotoId}`,{
                    method:'POST',
                    headers:{
                        'Content-Type':'application/json',
                        'X-CSRF-TOKEN':'{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ rating: value })
                })
                .then(res=>res.json())
                .then(data=>{
                    if(data.average){
                        let avg = data.average;
                        ratingEl.querySelector('.avg-rating').innerText = avg.toFixed(2);

                        ratingEl.querySelectorAll('.star-btn').forEach((s, idx)=>{
                            if(idx < Math.round(avg)){
                                s.classList.add('text-warning','bi-star-fill');
                                s.classList.remove('bi-star');
                            }else{
                                s.classList.remove('text-warning','bi-star-fill');
                                s.classList.add('bi-star');
                            }
                        });
                    }
                }).catch(err=>console.error(err));
            });
        });
    });

    // ✅ Load More AJAX + Scroll ke galeri
    let offset = {{ $foto->count() }};
    const loadBtn = document.getElementById('loadMoreBtn');
    if(loadBtn){
        loadBtn.addEventListener('click', function(){
            loadBtn.disabled = true;
            loadBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memuat...';

            fetch(`/home/load-more?offset=${offset}`)
            .then(res=>res.json())
            .then(data=>{
                if(data.html){
                    const container = document.getElementById('galeri-container');
                    container.insertAdjacentHTML('beforeend', data.html);
                    offset += data.count;

                    // 🔽 Scroll otomatis ke galeri (biar langsung kelihatan)
                    document.getElementById('galeri').scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });

                    if(data.count < 6){
                        loadBtn.style.display='none';
                    } else {
                        loadBtn.disabled = false;
                        loadBtn.innerHTML = '<i class="bi bi-arrow-down-circle"></i> Load More';
                    }
                }
            })
            .catch(err=>{
                console.error(err);
                loadBtn.disabled = false;
                loadBtn.innerHTML = '<i class="bi bi-arrow-down-circle"></i> Load More';
            });
        });
    }
});
</script>
@endpush
