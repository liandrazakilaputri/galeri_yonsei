@extends('user.layout')

@section('title', $agenda->judul . ' | Agenda')

@section('content')
<div class="container my-5">
    <h2 class="mb-4 fw-bold">{{ $agenda->judul }}</h2>

    <p class="text-muted">
        <i class="bi bi-clock"></i> {{ \Carbon\Carbon::parse($agenda->tanggal)->translatedFormat('d F Y') }}
    </p>

    @if($agenda->foto)
        <div class="mb-3">
            <img src="{{ asset('storage/agenda/' . $agenda->foto) }}" alt="Foto Agenda" class="img-fluid rounded">
        </div>
    @endif

    <p>{{ $agenda->deskripsi }}</p>

    <a href="{{ route('agenda.index') }}" class="btn btn-secondary mt-3">
        Kembali ke Agenda
    </a>
</div>
@endsection
