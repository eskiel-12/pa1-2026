@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Detail Akomodasi</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.akomodasi.edit', $item->id) }}" class="btn btn-warning">
                <i class="fas fa-edit"></i> Edit
            </a>
            <a href="{{ route('admin.akomodasi.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div class="row">
                <div class="col-md-4">
                    @if($item->gambar)
                        <img src="{{ $item->gambar_url }}" alt="{{ $item->nama }}" class="img-fluid rounded" style="max-width:100%;">
                    @else
                        <div class="bg-light p-5 text-center rounded">
                            <i class="fas fa-image fa-3x text-muted"></i>
                            <p class="text-muted mt-2">Tidak ada gambar</p>
                        </div>
                    @endif
                </div>
                <div class="col-md-8">
                    <h3>{{ $item->nama }}</h3>
                    
                    <div class="mb-3">
                        <strong>Status:</strong>
                        @if($item->status)
                            <span class="badge bg-success">Aktif</span>
                        @else
                            <span class="badge bg-danger">Nonaktif</span>
                        @endif
                    </div>

                    <div class="mb-3">
                        <strong>Lokasi:</strong><br>
                        {{ $item->lokasi ?? '-' }}
                    </div>

                    <div class="mb-3">
                        <strong>Kontak:</strong><br>
                        {{ $item->kontak ?? '-' }}
                    </div>

                    <div class="mb-3">
                        <strong>Dibuat:</strong><br>
                        {{ $item->created_at->format('d/m/Y H:i') }}
                    </div>

                    <div class="mb-3">
                        <strong>Diperbarui:</strong><br>
                        {{ $item->updated_at->format('d/m/Y H:i') }}
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <a href="{{ route('admin.akomodasi.edit', $item->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <form action="{{ route('admin.akomodasi.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                <p>{{ $item->deskripsi ?? '-' }}</p>
            </div>
        </div>
    </div>
</div>
@endsection
