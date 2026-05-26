@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Detail Galeri</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.galeri.edit', $galeri->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.galeri.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($galeri->gambar)
                        <img src="{{ $galeri->gambar_url }}" alt="{{ $galeri->judul }}" class="img-fluid rounded" style="max-width:100%;">
                    @else
                        <div class="bg-light p-5 text-center rounded">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="text-muted mt-2">Tidak ada gambar</p>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h3>{{ $galeri->judul }}</h3>
                    
                    <div class="mb-3">
                        <strong>Status:</strong>
                        @if($galeri->status)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <strong>Kategori:</strong><br>
                        {{ $galeri->kategori ?? '-' }}
                    </div>

                    <div class="mb-3">
                        <strong>Lokasi:</strong><br>
                        {{ $galeri->lokasi ?? '-' }}
                    </div>

                    <div class="mb-3">
                        <strong>Tanggal Foto:</strong><br>
                        {{ $galeri->tanggal_foto ? $galeri->tanggal_foto->format('d/m/Y') : '-' }}
                    </div>

                    <div class="mb-3">
                        <strong>Jumlah Views:</strong><br>
                        {{ $galeri->views ?? 0 }}
                    </div>

                    <div class="mb-3">
                        <strong>Dibuat:</strong><br>
                        {{ $galeri->created_at->format('d/m/Y H:i') }}
                    </div>

                    <div class="mb-3">
                        <strong>Diperbarui:</strong><br>
                        {{ $galeri->updated_at->format('d/m/Y H:i') }}
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('admin.galeri.edit', $galeri->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.galeri.destroy', $galeri->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                <i class="fas fa-trash"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <hr>

            <div class="mt-3">
                <strong>Deskripsi:</strong>
                <p>{{ $galeri->deskripsi ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
