@extends('layouts.admin')

@section('title', 'Manajemen Berita')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <h5 class="mb-0"><i class="fas fa-newspaper me-2 text-primary"></i> Daftar Berita</h5>
    <a href="{{ route('admin.berita.create') }}" class="btn-primary-custom btn">
        <i class="fas fa-plus me-2"></i> Tambah Berita
    </a>
</div>

<div class="card-premium">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="table-responsive">
        <table class="table table-custom">
            <thead>
                <tr><th>#</th><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Tanggal</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($berita as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td><img src="{{ asset($item->gambar) }}" class="preview-img"></td>
                    <td><strong>{{ Str::limit($item->judul, 30) }}</strong></td>
                    <td><span class="badge-info badge">{{ $item->kategori->nama ?? '-' }}</span></td>
                    <td>{{ $item->tanggal_terbit->format('d/m/Y') }}</td>
                    <td>@if($item->status)<span class="badge-success badge">Publish</span>@else<span class="badge-danger badge">Draft</span>@endif</span></td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-outline-custom"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.berita.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-custom" style="border-color: #ef4444; color: #ef4444;" onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4">Belum ada data berita</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{ $berita->links() }}
</div>
@endsection