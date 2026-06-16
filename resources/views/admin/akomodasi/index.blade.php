@extends('layouts.admin')

@section('content')
<style>
    .management-header { display: flex; justify-content: space-between; align-items: center; gap: 20px; margin-bottom: 30px; flex-wrap: wrap; }
    .management-header h2 { font-size: 1.5rem; font-weight: 600; color: #1a1a1a; margin: 0; }
    .management-card { background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 25px; }
    .management-table thead th { background: linear-gradient(135deg, #f5f5f5, #efefef); border-bottom: 2px solid #e0e0e0; font-weight: 600; color: #1a1a1a; padding: 15px; }
    .management-table tbody tr:hover { background-color: #f9f9f9; }
    .btn-primary-custom { background: linear-gradient(135deg, #c6a43b, #a88a2f); border: none; color: white; padding: 10px 22px; border-radius: 8px; }
    .btn-primary-custom:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(198, 164, 59, 0.3); }
    .badge { padding: 6px 12px; border-radius: 6px; }
</style>
<div class="container-fluid">
    <div class="management-header">
        <h2><i class="fas fa-building me-2" style="color: #c6a43b;"></i> Akomodasi</h2>
        <a href="{{ route('admin.akomodasi.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i> Tambah Akomodasi
        </a>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert" style="background: #f0fdf4; border: 1px solid #86efac; color: #166534; border-radius: 8px; padding: 12px 16px; margin-bottom: 20px;">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="management-card management-table">
        <div class="table-responsive">
            <table class="table">
            <thead>
                <tr style="text-transform: uppercase; font-size: 0.85rem; letter-spacing: 0.5px;">
                    <th width="5%">#</th>
                    <th width="20%">Nama</th>
                    <th width="20%">Destinasi</th>
                    <th width="15%">Lokasi</th>
                    <th width="15%">Kontak</th>
                    <th width="10%">Status</th>
                    <th width="15%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $loop->iteration + ($items->currentPage() - 1) * $items->perPage() }}</td>
                        <td><strong>{{ $item->nama }}</strong></td>
                        <td>{{ $item->destinasi?->nama ?? '-' }}</td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->kontak }}</td>
                        <td>
                            @if($item->status)
                                <span class="badge bg-success">Aktif</span>
                            @else
                                <span class="badge bg-danger">Nonaktif</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('admin.akomodasi.show', $item->id) }}" class="btn btn-sm" style="border: 1.5px solid #3b82f6; color: #3b82f6; background: transparent; border-radius: 6px;">
                                    <i class="fas fa-eye"></i>
                                </a>
                                <a href="{{ route('admin.akomodasi.edit', $item->id) }}" class="btn btn-sm" style="border: 1.5px solid #f59e0b; color: #f59e0b; background: transparent; border-radius: 6px;">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.akomodasi.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm" style="border: 1.5px solid #ef4444; color: #ef4444; background: transparent; border-radius: 6px;" onclick="return confirm('Yakin ingin menghapus?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted">Tidak ada data akomodasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-3">
        {{ $items->links() }}
    </div>
</div>
@endsection
