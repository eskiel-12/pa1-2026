@extends('layouts.admin')

@section('content')
<style>
    .management-header { display: flex; justify-content: space-between; align-items: center; gap: 20px; margin-bottom: 30px; flex-wrap: wrap; }
    .management-header h5 { font-size: 1.5rem; font-weight: 600; color: #1a1a1a; margin: 0; }
    .management-card { background: white; border-radius: 12px; box-shadow: 0 2px 12px rgba(0,0,0,0.08); padding: 25px; margin-bottom: 20px; }
    .btn-primary-custom { background: linear-gradient(135deg, #c6a43b, #a88a2f); border: none; color: white; padding: 10px 22px; border-radius: 8px; }
    .btn-primary-custom:hover { transform: translateY(-2px); box-shadow: 0 6px 16px rgba(198, 164, 59, 0.3); }
    .badge { padding: 6px 12px; border-radius: 6px; }
</style>
<div class="container-fluid">
    <div class="management-header">
        <h5><i class="fas fa-phone me-2" style="color: #c6a43b;"></i> Kelola Kontak</h5>
        <a href="{{ route('admin.kontak.create') }}" class="btn btn-primary-custom">
            <i class="fas fa-plus me-2"></i> Tambah Kontak
        </a>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="management-card">
                    @if(session('success'))
                        <div class="alert" style="background: #f0fdf4; border: 1px solid #86efac; color: #166534; border-radius: 8px; padding: 12px 16px; margin-bottom: 20px;">
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
@endsection
