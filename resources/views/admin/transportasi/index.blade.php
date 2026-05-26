@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Transportasi</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.transportasi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Transportasi
            </a>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ $message }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="table-responsive">
        <table class="table table-striped table-hover">
            <thead class="table-dark">
                <tr>
                    <th width="5%">#</th>
                    <th width="20%">Nama</th>
                    <th width="15%">Lokasi</th>
                    <th width="20%">Kontak</th>
                    <th width="10%">Status</th>
                    <th width="30%" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->nama }}</strong></td>
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
                            <a href="{{ route('admin.transportasi.show', $item->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('admin.transportasi.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.transportasi.destroy', $item->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin ingin menghapus?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted">Tidak ada data transportasi.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="d-flex justify-content-center">
        {{ $items->links() }}
    </div>
</div>
@endsection
