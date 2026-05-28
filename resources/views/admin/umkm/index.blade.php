@extends('layouts.admin')

@section('title', 'UMKM')

@section('content')
<div class="card-table">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>Daftar UMKM</h4>
        <a href="{{ route('admin.umkm.create') }}" class="action-btn"><i class="fas fa-plus-circle"></i> Tambah UMKM</a>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Lokasi</th>
                    <th>Kontak</th>
                    <th>Gambar</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($umkms as $umkm)
                    <tr>
                        <td>{{ $loop->iteration + ($umkms->currentPage() - 1) * $umkms->perPage() }}</td>
                        <td>{{ $umkm->nama }}</td>
                        <td>{{ $umkm->lokasi }}</td>
                        <td>{{ $umkm->kontak }}</td>
                                                <td>{{ $umkm->destinasi?->nama ?? '-' }}</td>
                        <td>
                            @if($umkm->gambar)
                                <img src="{{ asset($umkm->gambar) }}" alt="{{ $umkm->nama }}" class="preview-img">
                            @endif
                        <tr>
                            <th>#</th>
                            <th>Nama</th>
                            <th>Destinasi</th>
                            <th>Lokasi</th>
                            <th>Kontak</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">Belum ada UMKM. Tambahkan melalui tombol Tambah UMKM.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3">
        {{ $umkms->links() }}
    </div>
</div>
@endsection
