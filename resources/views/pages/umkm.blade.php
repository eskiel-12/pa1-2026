@extends('layouts.app')

@section('title', 'UMKM - Geosite Danau Toba')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-5">UMKM Lokal Danau Toba</h1>
            <p class="lead">Dukung produk unggulan lokal dan ekonomi kreatif masyarakat Danau Toba.</p>
        </div>

        <div class="row gy-4">
            @forelse($umkms as $umkm)
                <div class="col-md-6 col-lg-4">
                    <div class="card p-3 shadow-sm h-100">
                        @if($umkm->gambar)
                            <img src="{{ asset($umkm->gambar) }}" alt="{{ $umkm->nama }}" class="card-img-top rounded mb-3" style="height: 240px; object-fit: cover;">
                        @endif
                        <div class="card-body p-0">
                            <h3 class="h5">{{ $umkm->nama }}</h3>
                            <p>{{ Str::limit($umkm->deskripsi, 150) }}</p>
                            <p class="mb-1"><strong>Lokasi:</strong> {{ $umkm->lokasi }}</p>
                            <p class="mb-0"><strong>Kontak:</strong> {{ $umkm->kontak }}</p>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <div class="alert alert-info">Belum ada data UMKM. Silakan tambahkan melalui dashboard admin.</div>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection