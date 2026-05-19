@extends('layouts.admin')

@section('title', 'Edit Berita')

@section('content')
<div class="card">
    <div class="card-header">
        <h5>Edit Berita</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.berita.update', $berita->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="mb-3">
                <label>Judul</label>
                <input type="text" name="judul" class="form-control" value="{{ $berita->judul }}" required>
            </div>
            
            <div class="mb-3">
                <label>Kategori</label>
                <select name="kategori_id" class="form-control" required>
                    @foreach($kategori as $item)
                    <option value="{{ $item->id }}" {{ $berita->kategori_id == $item->id ? 'selected' : '' }}>{{ $item->nama }}</option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-3">
                <label>Penulis</label>
                <input type="text" name="penulis" class="form-control" value="{{ $berita->penulis }}">
            </div>
            
            <div class="mb-3">
                <label>Tanggal Terbit</label>
                <input type="date" name="tanggal_terbit" class="form-control" value="{{ $berita->tanggal_terbit }}" required>
            </div>
            
            <div class="mb-3">
                <label>Konten</label>
                <textarea name="konten" class="form-control" rows="8" required>{{ $berita->konten }}</textarea>
            </div>
            
            <div class="mb-3">
                <label>Gambar Saat Ini</label><br>
                <img src="{{ asset($berita->gambar) }}" width="100" class="mb-2">
                <input type="file" id="gambar" name="gambar" class="form-control" accept="image/*">
                <div class="mt-3">
                    <img id="beritaPreview" src="#" alt="Preview Gambar Baru" class="img-fluid rounded d-none" style="max-width: 100%; max-height: 300px;" />
                </div>
            </div>
            
            <div class="mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="status" value="1" {{ $berita->status ? 'checked' : '' }}>
                    <label>Publish</label>
                </div>
            </div>
            
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="{{ route('admin.berita.index') }}" class="btn btn-secondary">Batal</a>
        </form>
    </div>
</div>
<script>
    document.getElementById('gambar').addEventListener('change', function (e) {
        const preview = document.getElementById('beritaPreview');
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