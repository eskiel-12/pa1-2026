@extends('layouts.admin')

@section('title', 'Edit Destinasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Destinasi: {{ $destinasi->nama }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <form action="{{ route('admin.destinasi.update', $destinasi->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label for="nama">Nama Destinasi *</label>
                                    <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $destinasi->nama) }}" required>
                                    @error('nama')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="deskripsi">Deskripsi *</label>
                                    <textarea class="form-control @error('deskripsi') is-invalid @enderror" id="deskripsi" name="deskripsi" rows="5" required>{{ old('deskripsi', $destinasi->deskripsi) }}</textarea>
                                    @error('deskripsi')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi *</label>
                                            <input type="text" class="form-control @error('lokasi') is-invalid @enderror" id="lokasi" name="lokasi" value="{{ old('lokasi', $destinasi->lokasi) }}" required>
                                            @error('lokasi')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kategori">Kategori *</label>
                                            <select class="form-control @error('kategori') is-invalid @enderror" id="kategori" name="kategori" required>
                                                <option value="">Pilih Kategori</option>
                                                <option value="Alam" {{ old('kategori', $destinasi->kategori) == 'Alam' ? 'selected' : '' }}>Alam</option>
                                                <option value="Budaya" {{ old('kategori', $destinasi->kategori) == 'Budaya' ? 'selected' : '' }}>Budaya</option>
                                                <option value="Buatan" {{ old('kategori', $destinasi->kategori) == 'Buatan' ? 'selected' : '' }}>Buatan</option>
                                                <option value="Religi" {{ old('kategori', $destinasi->kategori) == 'Religi' ? 'selected' : '' }}>Religi</option>
                                            </select>
                                            @error('kategori')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tags">Tags (pisahkan dengan koma)</label>
                                    <input type="text" class="form-control @error('tags') is-invalid @enderror" id="tags" name="tags" value="{{ old('tags', $destinasi->tags ? implode(', ', json_decode($destinasi->tags, true)) : '') }}" placeholder="contoh: wisata, alam, danau">
                                    @error('tags')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="maps">Link Google Maps</label>
                                    <input type="url" class="form-control @error('maps') is-invalid @enderror" id="maps" name="maps" value="{{ old('maps', $destinasi->maps) }}" placeholder="https://maps.google.com/...">
                                    @error('maps')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="gambar">Gambar Destinasi</label>
                                    <input type="file" class="form-control @error('gambar') is-invalid @enderror" id="gambar" name="gambar" accept="image/*">
                                    <small class="form-text text-muted">Format: JPG, PNG, GIF, SVG. Maksimal 5MB. Biarkan kosong jika tidak ingin mengubah gambar.</small>
                                    @error('gambar')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-switch">
                                        <input type="checkbox" class="custom-control-input" id="status" name="status" value="1" {{ old('status', $destinasi->status) ? 'checked' : '' }}>
                                        <label class="custom-control-label" for="status">Status Aktif</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Gambar Saat Ini</label>
                                    <div class="text-center">
                                        @if($destinasi->gambar)
                                            <img src="{{ asset($destinasi->gambar) }}" alt="{{ $destinasi->nama }}" class="img-fluid" style="max-height: 200px;">
                                        @else
                                            <div class="text-muted">Tidak ada gambar</div>
                                        @endif
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label>Preview Gambar Baru</label>
                                    <div id="image-preview" class="text-center">
                                        <img id="preview-img" src="#" alt="Preview" class="img-fluid d-none" style="max-height: 200px;">
                                        <div id="no-preview" class="text-muted">Belum ada gambar baru dipilih</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update Destinasi
                        </button>
                        <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('gambar').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const previewImg = document.getElementById('preview-img');
    const noPreview = document.getElementById('no-preview');

    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewImg.classList.remove('d-none');
            noPreview.classList.add('d-none');
        };
        reader.readAsDataURL(file);
    } else {
        previewImg.classList.add('d-none');
        noPreview.classList.remove('d-none');
    }
});
</script>
@endpush
@endsection