@extends('layouts.admin')

@section('title', 'Edit Informasi')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Informasi</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.informasi.update', $informasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $informasi->judul }}" required>
            </div>
            
            <div class="mb-3">
                <label>Kategori</label>
                <select name="kategori" class="form-control" required>
                    <option value="Geologi" {{ $informasi->kategori == 'Geologi' ? 'selected' : '' }}>Geologi</option>
                    <option value="Budaya" {{ $informasi->kategori == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                    <option value="Wisata" {{ $informasi->kategori == 'Wisata' ? 'selected' : '' }}>Wisata</option>
                    <option value="Transportasi" {{ $informasi->kategori == 'Transportasi' ? 'selected' : '' }}>Transportasi</option>
                </select>
            </div>
            
            <div class="mb-3">
                <label>Penulis</label>
                <input type="text" name="penulis" class="form-control" value="{{ $informasi->penulis }}">
            </div>
            
            <div class="mb-3">
                <label>Konten</label>
                <textarea name="konten" class="form-control" rows="8" required>{{ $informasi->konten }}</textarea>
            </div>
            
            <div class="mb-3">
                <label>Gambar Saat Ini</label>
                @if($informasi->gambar)
                    <br><img src="{{ asset($informasi->gambar) }}" width="100" class="mb-2">
                @endif
                <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
                <div class="mt-3">
                    <img id="informasiPreview" src="#" alt="Preview Gambar Baru" class="img-fluid rounded d-none" style="max-width: 100%; max-height: 300px;" />
                </div>
            </div>
            
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1" {{ $informasi->status ? 'checked' : '' }}>
                    <label>Aktifkan</label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.informasi.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<script>
    document.getElementById('gambar').addEventListener('change', function (e) {
        const preview = document.getElementById('informasiPreview');
        const file = e.target.files[0];
        if (file) {
            preview.src = URL.createObjectURL(file);
            preview.classList.remove('d-none');
        } else {
            preview.classList.add('d-none');
        }
    });
</script>
@endsection