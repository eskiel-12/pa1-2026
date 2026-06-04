@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Banner Home</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.banner.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Banner
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Gambar</th>
                                    <th width="25%">Judul</th>
                                    <th width="15%">Status</th>
                                    <th width="10%">Urutan</th>
                                    <th width="25%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($banners as $index => $banner)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            <img src="{{ $banner->gambar_url }}" alt="{{ $banner->judul }}" class="img-thumbnail" width="100">
                                        </td>
                                        <td>
                                            <strong>{{ $banner->judul }}</strong>
                                            @if($banner->deskripsi)
                                                <br><small class="text-muted">{{ Str::limit($banner->deskripsi, 50) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($banner->status)
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-secondary">Tidak Aktif</span>
                                            @endif
                                        </td>
                                        <td>{{ $banner->urutan }}</td>
                                        <td>
                                            <a href="{{ route('admin.banner.edit', $banner) }}" class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('admin.banner.destroy', $banner) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus banner ini?')">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Belum ada banner</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection