@extends('user.layout')

@section('title', 'Agenda Kegiatan | Yonsei')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 text-center fw-bold">
        <i class="bi bi-calendar-event"></i> Agenda Kegiatan
    </h2>

    @forelse($agendas as $agenda)
        <div class="card mb-3 shadow-sm border-0">
            <div class="card-body">
                <h5 class="card-title fw-semibold text-primary">{{ $agenda->judul }}</h5>
                <p class="text-muted mb-1">
                    <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}
                </p>
                <p>{{ Str::limit($agenda->deskripsi, 100) }}</p>
            </div>
        </div>
    @empty
        <div class="alert alert-info text-center">
            <i class="bi bi-exclamation-circle"></i> Belum ada agenda kegiatan.
        </div>
    @endforelse
</div>
@endsection
