@extends('layouts.admin')

@section('title', 'Manajemen Informasi')

@section('content')
<div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
    <h5 class="mb-0"><i class="fas fa-info-circle me-2 text-primary"></i> Daftar Informasi</h5>
    <a href="{{ route('admin.informasi.create') }}" class="btn-primary-custom btn">
        <i class="fas fa-plus me-2"></i> Tambah Informasi
    </a>
</div>

<div class="card-premium">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <div class="table-responsive">
        <table class="table table-custom">
            <thead>
                <tr><th>#</th><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Penulis</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($informasi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($item->gambar)
                            <img src="{{ asset($item->gambar) }}" class="preview-img" alt="Gambar Informasi">
                        @else
                            -
                        @endif
                    </td>
                    <td><strong>{{ Str::limit($item->judul, 40) }}</strong></td>
                    <td><span class="badge-info badge">{{ $item->kategori }}</span></td>
                    <td>{{ $item->penulis }}</td>
                    <td>@if($item->status)<span class="badge-success badge">Aktif</span>@else<span class="badge-danger badge">Tidak</span>@endif</td>
                    <td>
                        <div class="d-flex gap-1">
                            <a href="{{ route('admin.informasi.edit', $item->id) }}" class="btn btn-outline-custom"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.informasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-outline-custom" style="border-color: #ef4444; color: #ef4444;" onclick="return confirm('Yakin hapus?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center py-4">Belum ada data informasi</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    
    {{ $informasi->links() }}
</div>
@endsection