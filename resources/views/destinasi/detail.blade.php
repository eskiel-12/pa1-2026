@extends('layouts.app')

@section('content')

<style>
.hero-detail {
    height: 75vh;
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7));
}

.hero-text {
    position: relative;
    z-index: 2;
    text-align: center;
    animation: fadeIn 1.5s ease-in-out;
}

@keyframes fadeIn {
    from {opacity: 0; transform: translateY(20px);}
    to {opacity: 1; transform: translateY(0);}
}

.gallery img {
    height: 220px;
    object-fit: cover;
    border-radius: 15px;
    transition: 0.4s;
    box-shadow: 0 4px 10px rgba(0,0,0,0.2);
}

.gallery img:hover {
    transform: scale(1.07);
}

.card-custom {
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
    padding: 25px;
    background: white;
    transition: 0.3s;
}

.card-custom:hover {
    transform: translateY(-5px);
}
</style>

<!-- HERO -->
<div class="hero-detail" style="background-image: url('{{ $destinasi->gambar_url }}')">
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <h1 class="display-3 fw-bold">{{ $destinasi->nama }}</h1>
        <p class="lead">Geosite Danau Toba</p>
    </div>
</div>

<!-- CONTENT -->
<div class="container py-5">

    <!-- DESKRIPSI -->
    <div class="card-custom mb-5">
        <h2 class="mb-3">Deskripsi</h2>
        <p>{{ $destinasi->deskripsi }}</p>
    </div>

    <!-- GALERI -->
    <div class="card-custom mb-5">
        <h2 class="mb-4">Galeri</h2>
        <div class="row gallery">
            @forelse($galeri as $img)
                <div class="col-md-4 mb-3">
                    <img src="{{ $img }}" class="w-100">
                </div>
            @empty
                <div class="col-12">
                    <p>Tidak ada galeri untuk destinasi ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- GOOGLE MAPS -->
    <div class="card-custom mb-5">
        <h2 class="mb-3">Lokasi</h2>

        <iframe 
            src="{{ $destinasi->embed_maps ?? $destinasi->maps }}"
            width="100%" 
            height="400" 
            style="border:none;">
        </iframe>
    </div>

    <!-- UMKM -->
    <div class="card-custom mb-5">
        <h2 class="mb-3">UMKM di Sekitar</h2>
        <div class="row">
            @forelse($umkms as $u)
                <div class="col-md-4 mb-3">
                    <div class="card p-3 h-100">
                        <img src="{{ $u->gambar ? \Illuminate\Support\Facades\Storage::url($u->gambar) : asset('images/no-image.png') }}" class="w-100 mb-2" style="height:150px;object-fit:cover;border-radius:8px;">
                        <h5>{{ $u->nama }}</h5>
                        <p class="mb-0">{{ \Illuminate\Support\Str::limit($u->deskripsi, 100) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12">Tidak ada UMKM terdaftar di lokasi ini.</div>
            @endforelse
        </div>
    </div>

    <!-- AKOMODASI -->
    <div class="card-custom mb-5">
        <h2 class="mb-3">Akomodasi</h2>
        <div class="row">
            @forelse($akomodasis as $a)
                <div class="col-md-4 mb-3">
                    <div class="card p-3 h-100">
                        <img src="{{ $a->gambar_url ?? asset('images/no-image.png') }}" class="w-100 mb-2" style="height:150px;object-fit:cover;border-radius:8px;">
                        <h5>{{ $a->nama }}</h5>
                        <p class="mb-0">{{ \Illuminate\Support\Str::limit($a->deskripsi, 100) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12">Tidak ada akomodasi terdaftar di lokasi ini.</div>
            @endforelse
        </div>
    </div>

    <!-- TRANSPORTASI -->
    <div class="card-custom mb-5">
        <h2 class="mb-3">Transportasi</h2>
        <div class="row">
            @forelse($transportasis as $t)
                <div class="col-md-4 mb-3">
                    <div class="card p-3 h-100">
                        <img src="{{ $t->gambar_url ?? asset('images/no-image.png') }}" class="w-100 mb-2" style="height:150px;object-fit:cover;border-radius:8px;">
                        <h5>{{ $t->nama }}</h5>
                        <p class="mb-0">{{ \Illuminate\Support\Str::limit($t->deskripsi, 100) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12">Tidak ada informasi transportasi untuk lokasi ini.</div>
            @endforelse
        </div>
    </div>

    <!-- BUTTON -->
    <a href="/" class="btn btn-primary rounded-pill px-4 shadow">
        ← Kembali
    </a>

</div>

@endsection