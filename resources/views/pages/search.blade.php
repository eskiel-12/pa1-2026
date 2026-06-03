@extends('layouts.app')

@section('title', 'Hasil Pencarian - Geosite Danau Toba')

@section('content')

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

.logo-container {
    position: fixed;
    top: 20px;
    left: 20px;
    z-index: 9999;
    display: flex;
    align-items: center;
    gap: 20px;
    background: rgba(255, 255, 255, 0.98);
    padding: 8px 24px;
    border-radius: 60px;
    backdrop-filter: blur(8px);
    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.8);
}

.flag-img {
    width: 100px;
    height: auto;
    border-radius: 6px;
}

.logo-divider {
    width: 2px;
    height: 35px;
    background: #e0e0e0;
}

.del-img {
    width: 50px;
    height: auto;
    border-radius: 8px;
}

.geotoba-text {
    font-size: 1.5rem;
    font-weight: 800;
    letter-spacing: 1px;
    background: linear-gradient(135deg, #1a3c5e, #2c5f8a);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
}

.geotoba-sub {
    font-size: 0.7rem;
    font-weight: 500;
    color: #5a6e7c;
}

/* HERO SECTION */
.search-hero {
    height: auto;
    min-height: 300px;
    background: linear-gradient(135deg, #1a3c5e 0%, #2c5f8a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    margin-top: 76px;
    padding: 60px 20px;
    position: relative;
}

.search-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.3);
    z-index: 1;
}

.search-hero > div {
    position: relative;
    z-index: 2;
}

.search-hero h1 {
    font-size: 2.5rem;
    font-family: 'Cormorant Garamond', serif;
    margin-bottom: 10px;
    text-shadow: 0 2px 10px rgba(0, 0, 0, 0.3);
}

.search-hero p {
    font-size: 0.95rem;
    letter-spacing: 0.1em;
    text-shadow: 0 1px 5px rgba(0, 0, 0, 0.3);
}

.section {
    padding: 60px 0;
}

.container {
    max-width: 1100px;
    margin: 0 auto;
    padding: 0 20px;
}

/* SEARCH RESULTS SECTION */
.results-section {
    padding: 60px 20px;
}

.search-category {
    margin-bottom: 50px;
}

.search-category h3 {
    font-size: 1.8rem;
    font-weight: 700;
    margin-bottom: 30px;
    color: #1a3c5e;
    padding-bottom: 15px;
    border-bottom: 3px solid #2c5f8a;
}

.search-grid {
    display: grid;
    grid-template-columns: repeat(3, 1fr);
    gap: 30px;
}

.search-grid.galeri-grid {
    grid-template-columns: repeat(4, 1fr);
}

.search-card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    border: 1px solid #f0f0f0;
}

.search-card:hover {
    transform: translateY(-8px);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
}

.search-card-image {
    width: 100%;
    height: 200px;
    overflow: hidden;
    background: #f5f5f5;
}

.search-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.3s ease;
}

.search-card:hover .search-card-image img {
    transform: scale(1.05);
}

.search-card-body {
    padding: 20px;
}

.search-card-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 10px;
    color: #1a3c5e;
}

.search-card-title a {
    color: #1a3c5e;
    text-decoration: none;
    transition: color 0.3s ease;
}

.search-card-title a:hover {
    color: #2c5f8a;
}

.search-card-text {
    font-size: 0.9rem;
    color: #666;
    margin-bottom: 12px;
    line-height: 1.5;
}

.search-card-meta {
    font-size: 0.85rem;
    color: #999;
}

.search-card .badge {
    display: inline-block;
    background: #2c5f8a;
    color: white;
    padding: 5px 12px;
    border-radius: 20px;
    font-size: 0.8rem;
    margin-top: 10px;
}

/* EMPTY STATE */
.empty-state {
    text-align: center;
    padding: 60px 20px;
}

.empty-state h2 {
    font-size: 1.8rem;
    color: #1a3c5e;
    margin-bottom: 15px;
}

.empty-state p {
    font-size: 1rem;
    color: #666;
    margin-bottom: 30px;
}

.empty-state-icon {
    font-size: 3rem;
    margin-bottom: 20px;
}

/* RESPONSIVE */
@media (max-width: 1024px) {
    .search-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .search-grid.galeri-grid {
        grid-template-columns: repeat(3, 1fr);
    }
}

@media (max-width: 768px) {
    .search-grid {
        grid-template-columns: 1fr;
    }
    
    .search-grid.galeri-grid {
        grid-template-columns: repeat(2, 1fr);
    }
    
    .search-hero h1 {
        font-size: 1.8rem;
    }
}
</style>

<!-- HERO SECTION -->
<div class="search-hero">
    <div>
        <h1>Hasil Pencarian</h1>
        <p>"{{ $query }}"</p>
    </div>
</div>

<!-- RESULTS SECTION -->
<div class="results-section">
    <div class="container">
        @if(empty($query))
            <div class="empty-state">
                <div class="empty-state-icon">🔍</div>
                <h2>Masukkan Kata Kunci Pencarian</h2>
                <p>Gunakan kolom pencarian untuk menemukan berita, destinasi, galeri, dan informasi yang Anda cari.</p>
            </div>
        @else
            @php
                $totalResults = collect($results)->sum(function($items) {
                    return is_countable($items) ? count($items) : 0;
                });
            @endphp

            @if($totalResults === 0)
                <div class="empty-state">
                    <div class="empty-state-icon">😔</div>
                    <h2>Tidak Ada Hasil</h2>
                    <p>Tidak ada hasil yang ditemukan untuk pencarian "{{ $query }}". Silakan coba kata kunci lain.</p>
                </div>
            @else

                <!-- BERITA RESULTS -->
                @if(!empty($results['berita']) && count($results['berita']) > 0)
                    <div class="search-category">
                        <h3>📰 Berita</h3>
                        <div class="search-grid">
                            @foreach($results['berita'] as $item)
                                <div class="search-card">
                                    <div class="search-card-body">
                                        <h4 class="search-card-title">
                                            <a href="{{ route('berita.detail', $item->slug) }}">
                                                {{ Str::limit($item->judul, 50) }}
                                            </a>
                                        </h4>
                                        <p class="search-card-text">
                                            {{ Str::limit($item->konten, 100) }}
                                        </p>
                                        <div class="search-card-meta">
                                            📅 {{ $item->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- DESTINASI RESULTS -->
                @if(!empty($results['destinasi']) && count($results['destinasi']) > 0)
                    <div class="search-category">
                        <h3>🏔️ Destinasi</h3>
                        <div class="search-grid">
                            @foreach($results['destinasi'] as $item)
                                <div class="search-card">
                                    <div class="search-card-body">
                                        <h4 class="search-card-title">
                                            <a href="{{ route('destinasi.show', $item->id) }}">
                                                {{ Str::limit($item->nama, 50) }}
                                            </a>
                                        </h4>
                                        <p class="search-card-text">
                                            {{ Str::limit($item->deskripsi, 100) }}
                                        </p>
                                        @if($item->jenis_wisata)
                                            <span class="badge">{{ $item->jenis_wisata }}</span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- INFORMASI RESULTS -->
                @if(!empty($results['informasi']) && count($results['informasi']) > 0)
                    <div class="search-category">
                        <h3>ℹ️ Informasi</h3>
                        <div class="search-grid">
                            @foreach($results['informasi'] as $item)
                                <div class="search-card">
                                    <div class="search-card-body">
                                        <h4 class="search-card-title">
                                            <a href="{{ route('informasi.detail', $item->slug) }}">
                                                {{ Str::limit($item->judul, 50) }}
                                            </a>
                                        </h4>
                                        <p class="search-card-text">
                                            {{ Str::limit($item->konten, 100) }}
                                        </p>
                                        <div class="search-card-meta">
                                            📅 {{ $item->created_at->format('d M Y') }}
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- GALERI RESULTS -->
                @if(!empty($results['galeri']) && count($results['galeri']) > 0)
                    <div class="search-category">
                        <h3>🖼️ Galeri</h3>
                        <div class="search-grid galeri-grid">
                            @foreach($results['galeri'] as $item)
                                <div class="search-card">
                                    @if($item->gambar)
                                        <div class="search-card-image">
                                            <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}">
                                        </div>
                                    @else
                                        <div class="search-card-image" style="background: #f5f5f5; display: flex; align-items: center; justify-content: center;">
                                            <span style="color: #ccc; font-size: 2rem;">📷</span>
                                        </div>
                                    @endif
                                    <div class="search-card-body">
                                        <h4 class="search-card-title">
                                            <a href="{{ route('galeri.detail', $item->slug) }}">
                                                {{ Str::limit($item->judul, 50) }}
                                            </a>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- UMKM RESULTS -->
                @if(!empty($results['umkm']) && count($results['umkm']) > 0)
                    <div class="search-category">
                        <h3>🏪 UMKM</h3>
                        <div class="search-grid">
                            @foreach($results['umkm'] as $item)
                                <div class="search-card">
                                    <div class="search-card-body">
                                        <h4 class="search-card-title">
                                            {{ Str::limit($item->nama, 50) }}
                                        </h4>
                                        <p class="search-card-text">
                                            {{ Str::limit($item->deskripsi, 100) }}
                                        </p>
                                        @if($item->nomor_telepon)
                                            <div class="search-card-meta">
                                                📞 {{ $item->nomor_telepon }}
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            @endif
        @endif
    </div>
</div>

@endsection
