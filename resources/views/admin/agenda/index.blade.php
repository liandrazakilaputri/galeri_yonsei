@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h2 class="mb-4">Daftar Agenda</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.agenda.create') }}" class="btn btn-primary mb-3">+ Tambah Agenda</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($agendas as $agenda)
            <tr>
                <td>{{ $agenda->judul }}</td>
                <td>{{ $agenda->tanggal->format('d-m-Y') }}</td>
                <td>
                    <a href="{{ route('admin.agenda.edit', $agenda->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.agenda.destroy', $agenda->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm"
                            onclick="return confirm('Yakin ingin dihapus?')">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
