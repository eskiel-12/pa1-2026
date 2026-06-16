@extends('layouts.admin')

@section('title', 'Manajemen Informasi')

@section('content')
<style>
    .management-header { display: flex; justify-content: space-between; align-items: center; gap: 20px; margin-bottom: 30px; flex-wrap: wrap; }
    .management-header h5 { font-size: 1.5rem; font-weight: 600; color: #1a1a1a; margin: 0; }
    .management-card { background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 25px; }
    .management-table thead th { background: linear-gradient(135deg, #f5f5f5, #efefef); border-bottom: 2px solid #e0e0e0; font-weight: 600; color: #1a1a1a; padding: 15px; }
    .management-table tbody tr:hover { background-color: #f9f9f9; }
    .preview-img { height: 50px; width: auto; border-radius: 6px; }
    .btn-primary-custom { background: linear-gradient(135deg, #c6a43b, #a88a2f); border: none; color: white; padding: 10px 22px; border-radius: 8px; }
    .btn-primary-custom:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(198, 164, 59, 0.3); }
    .badge { padding: 6px 12px; border-radius: 6px; }
</style>
<div class="management-header">
    <h5><i class="fas fa-info-circle me-2" style="color: #c6a43b;"></i> Daftar Informasi</h5>
    <a href="{{ route('admin.informasi.create') }}" class="btn btn-primary-custom">
        <i class="fas fa-plus me-2"></i> Tambah Informasi
    </a>
</div>
<div class="management-card management-table">
    @if(session('success'))
        <div class="alert alert-success mb-3" style="background: #f0fdf4; border: 1px solid #86efac; color: #166534; border-radius: 8px;">{{ session('success') }}</div>
    @endif
    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr style="text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;"><th>#</th><th>Gambar</th><th>Judul</th><th>Kategori</th><th>Penulis</th><th>Status</th><th>Aksi</th></tr>
            </thead>
            <tbody>
                @forelse($informasi as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        @if($item->gambar)
                            <img src="{{ $item->gambar_url }}" class="preview-img" alt="Gambar Informasi">
                        @else
                            -
                        @endif
                    </td>
                    <td><strong>{{ Str::limit($item->judul, 40) }}</strong></td>
                    <td><span class="badge-info badge">{{ $item->kategori }}</span></td>
                    <td>{{ $item->penulis }}</td>
                    <td>@if($item->status)<span class="badge-success badge">Aktif</span>@else<span class="badge-danger badge">Tidak</span>@endif</td>
                    <td>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.informasi.edit', $item->id) }}" class="btn btn-sm" style="border: 1.5px solid #f59e0b; color: #f59e0b; background: transparent; border-radius: 6px;"><i class="fas fa-edit"></i></a>
                            <form action="{{ route('admin.informasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm" style="border: 1.5px solid #ef4444; color: #ef4444; background: transparent; border-radius: 6px;" onclick="return confirm('Yakin hapus?')">
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