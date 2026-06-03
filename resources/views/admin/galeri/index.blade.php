@extends('layouts.admin')

@section('title', 'Manajemen Galeri')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <h5 class="mb-0"><i class="fas fa-images me-2 text-primary"></i> Daftar Galeri</h5>
    <a href="{{ route('admin.galeri.create') }}" class="btn-primary-custom btn">
        <i class="fas fa-plus me-2"></i> Tambah Galeri
    </a>
</div>

<div class="card-premium">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="table-responsive">
        <table class="table table-custom">
            <thead>
                <tr><th>#</th><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($galeri as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ $item->gambar_url }}" class="preview-img"></td>
                    <td><strong>{{ Str::limit($item->judul, 30) }}</strong></td>
                    <td><span class="badge-info badge">{{ $item->kategori }}</span></td>
                    <td>@if($item->status)<span class="badge-success badge">Aktif</span>@else<span class="badge-danger badge">Tidak</span>@endif</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.galeri.show', $item->id) }}" class="btn btn-outline-custom" title="Lihat"><i class="fas fa-eye"></i></a>
                            <a href="{{ route('admin.galeri.edit', $item->id) }}" class="btn btn-outline-custom"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.galeri.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-custom" style="border-color: #ef4444; color: #ef4444;" onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4">Belum ada data galeri</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    <div class="mt-3">
        {{ $galeri->links() }}
    </div>
</div>
@endsection