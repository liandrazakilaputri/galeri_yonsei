@extends('admin.layout')

@section('content')
<h1>Tambah Kategori</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    </div>
@endif

<form action="{{ route('admin.kategori.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-success">Simpan</button>
</form>
@endsection
