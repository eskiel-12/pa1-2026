@extends('layouts.admin')

@section('title', 'Edit UMKM')

@section('content')
<div class="card-table">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Edit UMKM</h4>
        <a href="{{ route('admin.umkm.index') }}" class="action-btn"><i class="fas fa-arrow-left"></i> Kembali</a>
    </div>

    <form action="{{ route('admin.umkm.update', $umkm->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Nama UMKM</label>
            <input type="text" name="nama" class="form-control" value="{{ old('nama', $umkm->nama) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Deskripsi</label>
            <textarea name="deskripsi" class="form-control" rows="5" required>{{ old('deskripsi', $umkm->deskripsi) }}</textarea>
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="{{ old('lokasi', $umkm->lokasi) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kontak</label>
            <input type="text" name="kontak" class="form-control" value="{{ old('kontak', $umkm->kontak) }}" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Gambar UMKM</label>
            <input type="file" name="gambar" class="form-control">
            @if($umkm->gambar)
                <img src="{{ asset($umkm->gambar) }}" alt="{{ $umkm->nama }}" class="preview-img mt-2">
            @endif
        </div>
        <button class="btn btn-primary">Perbarui UMKM</button>
    </form>
</div>
@endsection
