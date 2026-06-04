@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Banner</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.banner.update', $banner) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="judul">Judul Banner *</label>
                                    <input type="text" class="form-control @error('judul') is-invalid @enderror" id="judul" name="judul" value="{{ old('judul', $banner->judul) }}" required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="3">{{ old('deskripsi', $banner->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="link">Link (Opsional)</label>
                                    <input type="url" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link', $banner->link) }}" placeholder="https://example.com">
                                    @error('link')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Gambar Banner Saat Ini</label>
                                    <div class="mb-2">
                                        <img src="{{ $banner->gambar_url }}" alt="{{ $banner->judul }}" class="img-thumbnail" width="200">
                                    </div>
                                    <label for="gambar">Ganti Gambar (Opsional)</label>
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                                    <div class="mt-3">
                                        <img id="bannerPreview" src="#" alt="Preview Gambar Baru" class="img-fluid rounded d-none" style="max-width: 100%; max-height: 300px;" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="urutan">Urutan</label>
                                    <input type="number" class="form-control @error('urutan') is-invalid @enderror" id="urutan" name="urutan" value="{{ old('urutan', $banner->urutan) }}" min="0">
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Urutan tampilan banner (0 = pertama)</small>
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ old('status', $banner->status) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status">Status Aktif</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update Banner
                            </button>
                            <a href="{{ route('admin.banner.index') }}" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('gambar').addEventListener('change', function (e) {
        const preview = document.getElementById('bannerPreview');
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