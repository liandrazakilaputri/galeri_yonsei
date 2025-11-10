@extends('user.layout')

@section('title', 'Tentang Yonsei')

@section('content')
<div class="container my-5">

    <!-- Hero Image -->
    <div class="mb-5 text-center">
        <img src="{{ asset('images/logo.jpg') }}" class="img-fluid rounded shadow" alt="Yonsei University" style="max-width: 300px;">
    </div>

    <!-- Header -->
    <div class="text-center mb-5">
        <h1 class="fw-bold">Yonsei University</h1>
        <p class="lead text-muted">Menjadi institusi pendidikan terkemuka yang mengembangkan kompetensi akademik, karakter, dan inovasi global</p>
    </div>

    <!-- Profil Yonsei -->
    <div class="row align-items-center mb-5">
        <div class="col-md-6">
            <img src="{{ asset('images/yonsei1.jpg') }}" class="img-fluid rounded shadow" alt="Yonsei Campus">
        </div>
        <div class="col-md-6">
            <h3 class="mb-3">Profil Yonsei University</h3>
            <p>
                Yonsei University adalah salah satu universitas tertua dan paling bergengsi di Korea Selatan, didirikan pada tahun 1885. 
                Universitas ini terkenal dengan kualitas akademik yang tinggi, penelitian inovatif, dan jaringan alumni global yang luas.
            </p>
            <p>
                Yonsei memiliki berbagai fakultas dan program studi unggulan yang mencakup ilmu sosial, teknologi, bisnis, dan kesehatan, memastikan lulusannya siap bersaing di tingkat internasional.
            </p>
        </div>
    </div>

    <!-- Nilai dan Visi -->
    <div class="row text-center mb-5">
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-primary">Visi</h4>
                    <p class="card-text text-muted">
                        Menjadi universitas terkemuka yang menghasilkan lulusan kreatif, kompeten, dan berkarakter global.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-primary">Misi</h4>
                    <p class="card-text text-muted">
                        Menyediakan pendidikan berkualitas, mendorong penelitian inovatif, dan memfasilitasi pengembangan kepemimpinan global.
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card h-100 shadow-sm border-0">
                <div class="card-body">
                    <h4 class="card-title text-primary">Nilai</h4>
                    <p class="card-text text-muted">
                        Integritas, Kreativitas, Profesionalisme, dan Global Citizenship menjadi dasar seluruh kegiatan akademik dan sosial.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Galeri Yonsei -->
    <div class="row mb-5">
        <h3 class="text-center mb-4">Galeri Yonsei University</h3>
        @foreach(['yonsei2.jpg','yonsei3.jpg','yonsei4.jpg'] as $foto)
            <div class="col-md-4 mb-3">
                <img src="{{ asset('images/'.$foto) }}" class="img-fluid rounded shadow" alt="Yonsei Campus">
            </div>
        @endforeach
    </div>

    <!-- Lokasi Yonsei di Peta -->
    <div class="my-5">
        <h3 class="text-center mb-4">Lokasi Yonsei University</h3>
        <div class="ratio ratio-16x9 shadow rounded">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3162.924709721485!2d126.9342973156515!3d37.55650317979995!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x357ca3f7a82e07f9%3A0xe4e2a0cf8e1f7b63!2sYonsei%20University!5e0!3m2!1sid!2skr!4v1693539312345!5m2!1sid!2skr" 
                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy">
            </iframe>
        </div>
    </div>

    <!-- CTA -->
    <div class="text-center mt-5">
        <a href="{{ route('galeri') }}" class="btn btn-primary btn-lg shadow">Lihat Galeri Yonsei</a>
    </div>

</div>
@endsection
