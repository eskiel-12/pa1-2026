@extends('layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Kontak</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.kontak.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Kontak
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($kontak && $kontak->id)
                        <div class="card card-outline card-primary">
                            <div class="card-header">
                                <h5 class="card-title">Data Kontak</h5>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-sm">
                                            <tr>
                                                <td width="35%"><strong>Alamat</strong></td>
                                                <td>{{ $kontak->alamat ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Telepon 1</strong></td>
                                                <td>{{ $kontak->telepon_1 ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Telepon 2</strong></td>
                                                <td>{{ $kontak->telepon_2 ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Telepon 3</strong></td>
                                                <td>{{ $kontak->telepon_3 ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email 1</strong></td>
                                                <td>{{ $kontak->email_1 ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email 2</strong></td>
                                                <td>{{ $kontak->email_2 ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Email 3</strong></td>
                                                <td>{{ $kontak->email_3 ?? '-' }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                    <div class="col-md-6">
                                        <table class="table table-sm">
                                            <tr>
                                                <td width="35%"><strong>Jam Buka Kerja</strong></td>
                                                <td>{{ $kontak->jam_buka_kerja ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jam Tutup Kerja</strong></td>
                                                <td>{{ $kontak->jam_tutup_kerja ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jam Buka Weekend</strong></td>
                                                <td>{{ $kontak->jam_buka_weekend ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Jam Tutup Weekend</strong></td>
                                                <td>{{ $kontak->jam_tutup_weekend ?? '-' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>Facebook</strong></td>
                                                <td><a href="{{ $kontak->facebook }}" target="_blank">{{ Str::limit($kontak->facebook, 30) ?? '-' }}</a></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Instagram</strong></td>
                                                <td><a href="{{ $kontak->instagram }}" target="_blank">{{ Str::limit($kontak->instagram, 30) ?? '-' }}</a></td>
                                            </tr>
                                            <tr>
                                                <td><strong>Twitter</strong></td>
                                                <td><a href="{{ $kontak->twitter }}" target="_blank">{{ Str::limit($kontak->twitter, 30) ?? '-' }}</a></td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-6">
                                        <strong>YouTube:</strong> <a href="{{ $kontak->youtube }}" target="_blank">{{ Str::limit($kontak->youtube, 50) ?? '-' }}</a>
                                    </div>
                                    <div class="col-md-6">
                                        <strong>TikTok:</strong> <a href="{{ $kontak->tiktok }}" target="_blank">{{ Str::limit($kontak->tiktok, 50) ?? '-' }}</a>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12">
                                        <strong>Maps URL:</strong> <a href="{{ $kontak->maps_url }}" target="_blank">{{ Str::limit($kontak->maps_url, 60) ?? '-' }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mt-3">
                            <a href="{{ route('admin.kontak.edit', $kontak) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Edit Kontak
                            </a>
                            <form action="{{ route('admin.kontak.destroy', $kontak) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data kontak ini?')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="alert alert-info">
                            Belum ada data kontak. <a href="{{ route('admin.kontak.create') }}" class="alert-link">Tambah data kontak baru</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
