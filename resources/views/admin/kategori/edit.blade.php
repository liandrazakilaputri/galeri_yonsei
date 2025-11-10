@extends('admin.layout')

@section('content')
<h1>Edit Kategori</h1>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>@foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach</ul>
    </div>
@endif

<form action="{{ route('admin.kategori.update', $kategori->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label>Nama Kategori</label>
        <input type="text" name="nama" class="form-control" value="{{ $kategori->nama }}" required>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection
