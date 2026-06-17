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
    color: #fff;
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0.32), rgba(0,0,0,0.75));
}

.hero-text {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 80px 30px;
}

.hero-text h1 {
    font-size: clamp(3rem, 5vw, 4.5rem);
    line-height: 1.05;
    letter-spacing: 0.02em;
    text-shadow: 0 18px 40px rgba(0,0,0,0.3);
}

.hero-text p {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.92);
    margin-top: 1rem;
}

.hero-labels {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.hero-label {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.8rem 1rem;
    border-radius: 999px;
    background: rgba(255,255,255,0.16);
    border: 1px solid rgba(255,255,255,0.24);
    color: #fff;
    font-weight: 600;
}

.hero-label i {
    color: #f2b138;
}

.card-custom {
    border-radius: 20px;
    box-shadow: 0 22px 60px rgba(15, 23, 42, 0.08);
    padding: 30px;
    background: #ffffff;
    border: 1px solid rgba(14, 165, 233, 0.15);
    margin-bottom: 2rem;
}

.card-custom h2 {
    color: #094a82;
    margin-bottom: 1rem;
}

.card-custom p {
    color: #475569;
    line-height: 1.75;
}

.gallery {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
    gap: 1rem;
}

.gallery img {
    width: 100%;
    min-height: 200px;
    max-height: 260px;
    object-fit: cover;
    border-radius: 16px;
    transition: transform 0.3s ease, opacity 0.3s ease;
    box-shadow: 0 16px 35px rgba(15, 23, 42, 0.08);
}

.gallery img:hover {
    transform: translateY(-3px) scale(1.01);
    opacity: 0.98;
}

.info-card {
    display: block;
}

.info-card .highlight-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.highlight-item {
    border-radius: 18px;
    padding: 1.3rem;
    background: #f4f9ff;
    border: 1px solid rgba(14, 165, 233, 0.16);
}

.highlight-item strong {
    display: block;
    font-size: 1.35rem;
    margin-bottom: 0.4rem;
    color: #094a82;
}

.highlight-item span {
    color: #475569;
}

.btn-primary {
    background-color: #094a82;
    border-color: #094a82;
}

.btn-primary:hover {
    background-color: #0b3f68;
    border-color: #0b3f68;
}

@media (max-width: 768px) {
    .hero-text {
        padding: 50px 20px;
    }
}
</style>

<!-- HERO -->
<div class="hero-detail" style="background-image: url('{{ $destinasi->gambar_url }}')">
    <div class="hero-overlay"></div>
    <div class="hero-text container">
        <h1 class="display-3 fw-bold">{{ $destinasi->nama }}</h1>
        <p class="lead">Geosite Danau Toba</p>
        <div class="hero-labels">
            <span class="hero-label">Kategori: {{ ucfirst($destinasi->kategori ?? 'Destinasi') }}</span>
            <span class="hero-label"><i class="fas fa-map-marker-alt"></i>{{ $destinasi->lokasi ?? 'Lokasi tidak tersedia' }}</span>
            <span class="hero-label"><i class="fas fa-star"></i>{{ $destinasi->rating ?? '4.8' }} / 5</span>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div class="container py-5">

    <!-- DESKRIPSI -->
    <div class="card-custom">
        <h2>Deskripsi</h2>
        <p>{{ $destinasi->deskripsi }}</p>
    </div>

    <!-- GALERI -->
    <div class="card-custom">
        <h2>Galeri</h2>
        <div class="row gallery">
            @forelse($galeri as $img)
                <div class="col-md-4 mb-3">
                    <img src="{{ $img }}" class="w-100" alt="Galeri {{ $destinasi->nama }}">
                </div>
            @empty
                <div class="col-12">
                    <p>Tidak ada galeri untuk destinasi ini.</p>
                </div>
            @endforelse
        </div>
    </div>

    <!-- GOOGLE MAPS -->
    <div class="card-custom">
        <h2>Lokasi</h2>
        <iframe 
            src="https://maps.google.com/maps?q={{ urlencode($destinasi->lokasi ?? 'Danau Toba') }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%" 
            height="450" 
            style="border:0; border-radius: 16px;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>

    <!-- UMKM -->
    <div class="card-custom">
        <h2>UMKM di Sekitar</h2>
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
    <div class="card-custom">
        <h2>Akomodasi</h2>
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
    <div class="card-custom">
        <h2>Transportasi</h2>
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

    <a href="/" class="btn btn-primary rounded-pill px-4 shadow">
        ← Kembali
    </a>

</div>

@endsection