@extends('layouts.admin')

@section('title', 'Kelola Destinasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Destinasi</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.destinasi.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Destinasi
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>Gambar</th>
                                <th>Nama</th>
                                <th>Lokasi</th>
                                <th>Kategori</th>
                                <th>Status</th>
                                <th>Views</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($destinasi as $item)
                            <tr>
                                <td>
                                    @if($item->gambar)
                                        <img src="{{ asset($item->gambar) }}" alt="{{ $item->nama }}" class="img-thumbnail" style="width: 60px; height: 40px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">No Image</span>
                                    @endif
                                </td>
                                <td>{{ $item->nama }}</td>
                                <td>{{ $item->lokasi }}</td>
                                <td>
                                    <span class="badge badge-info">{{ $item->kategori }}</span>
                                </td>
                                <td>
                                    @if($item->status)
                                        <span class="badge badge-success">Aktif</span>
                                    @else
                                        <span class="badge badge-danger">Tidak Aktif</span>
                                    @endif
                                </td>
                                <td>{{ $item->views }}</td>
                                <td>
                                    <a href="{{ route('admin.destinasi.show', $item->id) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.destinasi.edit', $item->id) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.destinasi.destroy', $item->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="text-center">Belum ada destinasi</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($destinasi->hasPages())
                <div class="card-footer">
                    {{ $destinasi->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection