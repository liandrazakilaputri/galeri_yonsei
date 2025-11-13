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

<!-- 🧑‍💻 Tim Kreatif -->
<section class="my-5 text-center">
    <div class="container">
        <h2 class="fw-bold mb-4">
            <i class="bi bi-people text-primary"></i> Tim <span class="text-primary">Kreatif</span>
        </h2>
        <p class="text-muted mb-5">Orang-orang hebat di balik website galeri digital Yonsei.</p>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body">
                        <h5 class="fw-bold">Liandra Z. P.</h5>
                        <p class="text-muted">Web Developer</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- 🗓️ Agenda Terbaru -->
<section id="agenda" class="my-5 bg-light py-5">
    <div class="container">
        <h2 class="fw-bold text-center mb-4">
            <i class="bi bi-calendar-event text-primary"></i> Agenda <span class="text-primary">Terbaru</span>
        </h2>

        <div class="row g-4">
            @forelse($agendas as $agenda)
                <div class="col-md-4">
                    <div class="card border-0 shadow-sm h-100">
                        <div class="card-body">
                            <h5 class="fw-bold text-dark">{{ $agenda->judul }}</h5>
                            <p class="text-muted mb-1">
                                <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}
                            </p>
                            <p class="small text-secondary">{{ Str::limit($agenda->deskripsi, 80) }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="text-center text-muted">Belum ada agenda terbaru.</div>
            @endforelse
        </div>

        @if($agendas->count() > 0)
            <div class="text-center mt-4">
                <a href="{{ route('agenda.index') }}" class="btn btn-primary">
                    <i class="bi bi-calendar-week"></i> Lihat Semua Agenda
                </a>
            </div>
        @endif
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
    </div>
</section>

<!-- 💬 Komentar -->
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

<!-- 📊 Statistik Sekolah -->
<section class="py-5 text-center" style="background-color: #195087; color: white;">
    <div class="container">
        <h2 class="fw-bold mb-4">
            <i class="bi bi-bar-chart-line"></i> Statistik <span class="text-warning">Yonsei</span>
        </h2>
        <div class="row g-4 justify-content-center">
            <div class="col-md-3">
                <div class="p-4 bg-white bg-opacity-25 rounded-4 shadow-sm">
                    <h3 class="fw-bold text-warning mb-0">{{ $totalFoto }}</h3>
                    <p class="mb-0">Foto Tersimpan</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white bg-opacity-25 rounded-4 shadow-sm">
                    <h3 class="fw-bold text-warning mb-0">{{ $totalAgenda }}</h3>
                    <p class="mb-0">Agenda Sekolah</p>
                </div>
            </div>
            <div class="col-md-3">
                <div class="p-4 bg-white bg-opacity-25 rounded-4 shadow-sm">
                    <h3 class="fw-bold text-warning mb-0">{{ $totalKomentar }}</h3>
                    <p class="mb-0">Komentar Positif</p>
                </div>
            </div>
        </div>
        <p class="mt-4 fst-italic opacity-75 text-light">“Setiap angka adalah cerita dari perjalanan Yonsei yang terus berkembang.”</p>
    </div>
</section>

<!-- 🌟 CTA Penutup -->
<section class="py-5 text-center" style="color: #000;">
    <div class="container">
        <h2 class="fw-bold mb-3">Bergabunglah dengan Kami di <span style="color: #195087;">Yonsei</span>!</h2>
        <p class="fs-5 text-muted">Mari terus abadikan setiap momen berharga sekolah kita.</p>
        <a href="{{ route('galeri') }}" 
           class="btn btn-lg shadow-sm mt-2 fw-semibold"
           style="background-color: #195087; color: white; border: none;">
            <i class="bi bi-camera"></i> Lihat Semua Galeri
        </a>
    </div>
</section>
@endsection
