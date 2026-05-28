@extends('layouts.admin')

@section('title', 'Detail Destinasi')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Detail Destinasi: {{ $destinasi->nama }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.destinasi.edit', $destinasi->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                        <a href="{{ route('admin.destinasi.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Nama Destinasi</th>
                                    <td>{{ $destinasi->nama }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $destinasi->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Lokasi</th>
                                    <td>{{ $destinasi->lokasi }}</td>
                                </tr>
                                <tr>
                                    <th>Kategori</th>
                                    <td>
                                        <span class="badge badge-info">{{ $destinasi->kategori }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Tags</th>
                                    <td>
                                        @if($destinasi->tags)
                                            @foreach(json_decode($destinasi->tags, true) as $tag)
                                                <span class="badge badge-secondary">{{ $tag }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted">Tidak ada tags</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Status</th>
                                    <td>
                                        @if($destinasi->status)
                                            <span class="badge badge-success">Aktif</span>
                                        @else
                                            <span class="badge badge-danger">Tidak Aktif</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Views</th>
                                    <td>{{ $destinasi->views }}</td>
                                </tr>
                                <tr>
                                    <th>Google Maps</th>
                                    <td>
                                        @if($destinasi->maps)
                                            <a href="{{ $destinasi->maps }}" target="_blank" class="btn btn-sm btn-info">
                                                <i class="fas fa-map-marker-alt"></i> Lihat di Maps
                                            </a>
                                        @else
                                            <span class="text-muted">Tidak ada link maps</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Dibuat</th>
                                    <td>{{ $destinasi->created_at->format('d M Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Diupdate</th>
                                    <td>{{ $destinasi->updated_at->format('d M Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Gambar Destinasi</label>
                                <div class="text-center">
                                    @if($destinasi->gambar)
                                        <img src="{{ asset($destinasi->gambar) }}" alt="{{ $destinasi->nama }}" class="img-fluid rounded" style="max-height: 300px;">
                                    @else
                                        <div class="text-muted border rounded p-4">
                                            <i class="fas fa-image fa-3x"></i>
                                            <br>
                                            Tidak ada gambar
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-12">
                            <h5>Deskripsi Lengkap</h5>
                            <div class="border rounded p-3 bg-light">
                                {!! nl2br(e($destinasi->deskripsi)) !!}
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Akomodasi</h5>
                                    <a href="{{ route('admin.akomodasi.create', ['destinasi_id' => $destinasi->id]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus"></i> Tambah
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    @if($destinasi->akomodasis->count())
                                        <div class="list-group list-group-flush">
                                            @foreach($destinasi->akomodasis as $akomodasi)
                                                <div class="list-group-item py-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <strong>{{ $akomodasi->nama }}</strong><br>
                                                            <small class="text-muted">{{ $akomodasi->lokasi ?? '-' }}</small>
                                                        </div>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a href="{{ route('admin.akomodasi.edit', $akomodasi->id) }}" class="btn btn-outline-secondary">Edit</a>
                                                            <a href="{{ route('admin.akomodasi.show', $akomodasi->id) }}" class="btn btn-outline-info">Lihat</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">Belum ada akomodasi untuk destinasi ini.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 mb-4">
                            <div class="card h-100">
                                <div class="card-header d-flex justify-content-between align-items-center">
                                    <h5 class="mb-0">Transportasi</h5>
                                    <a href="{{ route('admin.transportasi.create', ['destinasi_id' => $destinasi->id]) }}" class="btn btn-sm btn-primary">
                                        <i class="fas fa-plus"></i> Tambah
                                    </a>
                                </div>
                                <div class="card-body p-3">
                                    @if($destinasi->transportasis->count())
                                        <div class="list-group list-group-flush">
                                            @foreach($destinasi->transportasis as $transportasi)
                                                <div class="list-group-item py-2">
                                                    <div class="d-flex justify-content-between align-items-center">
                                                        <div>
                                                            <strong>{{ $transportasi->nama }}</strong><br>
                                                            <small class="text-muted">{{ $transportasi->lokasi ?? '-' }}</small>
                                                        </div>
                                                        <div class="btn-group btn-group-sm" role="group">
                                                            <a href="{{ route('admin.transportasi.edit', $transportasi->id) }}" class="btn btn-outline-secondary">Edit</a>
                                                            <a href="{{ route('admin.transportasi.show', $transportasi->id) }}" class="btn btn-outline-info">Lihat</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @else
                                        <p class="text-muted mb-0">Belum ada transportasi untuk destinasi ini.</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <a href="{{ route('admin.destinasi.edit', $destinasi->id) }}" class="btn btn-warning">
                        <i class="fas fa-edit"></i> Edit Destinasi
                    </a>
                    <form action="{{ route('admin.destinasi.destroy', $destinasi->id) }}" method="POST" class="d-inline ml-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah Anda yakin ingin menghapus destinasi ini?')">
                            <i class="fas fa-trash"></i> Hapus Destinasi
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection