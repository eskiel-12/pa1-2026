@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row mb-4">
        <div class="col-md-6">
            <h2>Akomodasi</h2>
        </div>
        <div class="col-md-6 text-end">
            <a href="{{ route('admin.akomodasi.create') }}" class="btn btn-primary">
                <i class="fas fa-plus"></i> Tambah Akomodasi
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
                        <thead class="table-dark">
                            <tr>
                                <th width="3%">#</th>
                                <th width="15%">Nama</th>
                                <th width="15%">Destinasi</th>
                                <th width="15%">Lokasi</th>
                                <th width="15%">Kontak</th>
                                <th width="8%">Status</th>
                                <th width="29%" class="text-center">Aksi</th>
                            </tr>
                        </thead>
            <tbody>
                @forelse($items as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $item->nama }}</strong></td>
                        <td>{{ $item->lokasi }}</td>
                        <td>{{ $item->kontak }}</td>
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
                            <a href="{{ route('admin.akomodasi.show', $item->id) }}" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                            <a href="{{ route('admin.akomodasi.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('admin.akomodasi.destroy', $item->id) }}" method="POST" style="display:inline;">
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
                        <td colspan="6" class="text-center text-muted">Tidak ada data akomodasi.</td>
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
