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
    min-height: 350px;
    background: linear-gradient(135deg, #1a3c5e 0%, #2c5f8a 50%, #1a5f7a 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    color: white;
    margin-top: 76px;
    padding: 80px 20px;
    position: relative;
    overflow: hidden;
}

.search-hero::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: radial-gradient(circle at 20% 50%, rgba(198, 164, 59, 0.1), transparent),
                radial-gradient(circle at 80% 80%, rgba(198, 164, 59, 0.05), transparent);
    z-index: 1;
}

.search-hero > div {
    position: relative;
    z-index: 2;
}

.search-hero h1 {
    font-size: 3.2rem;
    font-family: 'Cormorant Garamond', serif;
    margin-bottom: 15px;
    text-shadow: 0 4px 16px rgba(0, 0, 0, 0.4);
    font-weight: 700;
    letter-spacing: 1px;
}

.search-hero p {
    font-size: 1.1rem;
    letter-spacing: 0.15em;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
    font-weight: 300;
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
    padding: 80px 20px;
    background: linear-gradient(180deg, #fafaf8 0%, #ffffff 50%, #fafaf8 100%);
}

.search-category {
    margin-bottom: 70px;
    animation: fadeIn 0.6s ease-out;
}

@keyframes fadeIn {
    from { opacity: 0; transform: translateY(20px); }
    to { opacity: 1; transform: translateY(0); }
}

.search-category h3 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 35px;
    color: #1a1a1a;
    padding-bottom: 18px;
    border-bottom: 3px solid #c6a43b;
    display: inline-block;
    letter-spacing: 0.5px;
}

.search-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
    gap: 35px;
}

.search-grid.galeri-grid {
    grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
}

.search-card {
    background: white;
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 8px 24px rgba(0, 0, 0, 0.1);
    transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    border: 1px solid rgba(198, 164, 59, 0.08);
    position: relative;
}

.search-card:hover {
    transform: translateY(-12px);
    box-shadow: 0 24px 48px rgba(0, 0, 0, 0.18);
    border-color: rgba(198, 164, 59, 0.25);
}

.search-card-image {
    width: 100%;
    height: 220px;
    overflow: hidden;
    background: linear-gradient(135deg, #f5f4f0, #efefec);
    position: relative;
}

.search-card-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s cubic-bezier(0.4, 0, 0.2, 1);
}

.search-card:hover .search-card-image img {
    transform: scale(1.08);
}

.search-card-body {
    padding: 24px;
    background: linear-gradient(180deg, #ffffff, #fafaf8);
}

.search-card-title {
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 12px;
    color: #1a1a1a;
    line-height: 1.4;
}

.search-card-title a {
    color: #1a1a1a;
    text-decoration: none;
    transition: color 0.3s ease;
}

.search-card-title a:hover {
    color: #c6a43b;
}

.search-card-text {
    font-size: 0.95rem;
    color: #555;
    margin-bottom: 14px;
    line-height: 1.6;
}

.search-card-meta {
    font-size: 0.9rem;
    color: #888;
    font-weight: 500;
}

.search-card .badge {
    display: inline-block;
    background: linear-gradient(135deg, #c6a43b, #d4b76e);
    color: white;
    padding: 7px 16px;
    border-radius: 25px;
    font-size: 0.8rem;
    margin-top: 12px;
    font-weight: 600;
    letter-spacing: 0.3px;
    transition: all 0.3s ease;
}

.search-card .badge:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(198, 164, 59, 0.25);
}

/* EMPTY STATE */
.empty-state {
    text-align: center;
    padding: 100px 20px;
    background: linear-gradient(135deg, #ffffff, #fafaf8);
    border-radius: 16px;
    border: 2px dashed rgba(198, 164, 59, 0.2);
}

.empty-state h2 {
    font-size: 2.2rem;
    color: #1a1a1a;
    margin-bottom: 18px;
    font-weight: 700;
}

.empty-state p {
    font-size: 1.05rem;
    color: #666;
    margin-bottom: 35px;
    line-height: 1.8;
    max-width: 600px;
    margin-left: auto;
    margin-right: auto;
}

.empty-state-icon {
    font-size: 4rem;
    margin-bottom: 25px;
    animation: float 3s ease-in-out infinite;
}

@keyframes float {
    0%, 100% { transform: translateY(0px); }
    50% { transform: translateY(-20px); }
}

/* RESPONSIVE */
@media (max-width: 1024px) {
    .search-grid {
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 28px;
    }
    
    .search-grid.galeri-grid {
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
    }
    
    .search-hero h1 {
        font-size: 2.5rem;
    }
}

@media (max-width: 768px) {
    .search-grid,
    .search-grid.galeri-grid {
        grid-template-columns: repeat(auto-fill, minmax(240px, 1fr));
        gap: 20px;
    }
    
    .search-hero {
        padding: 60px 20px;
        min-height: 280px;
    }
    
    .search-hero h1 {
        font-size: 2rem;
    }
    
    .search-hero p {
        font-size: 1rem;
    }
    
    .search-category h3 {
        font-size: 1.6rem;
        margin-bottom: 28px;
    }
    
    .search-card-body {
        padding: 18px;
    }
}

@media (max-width: 576px) {
    .search-grid,
    .search-grid.galeri-grid {
        grid-template-columns: 1fr;
        gap: 16px;
    }
    
    .search-hero {
        padding: 50px 16px;
        min-height: 240px;
    }
    
    .search-hero h1 {
        font-size: 1.6rem;
        margin-bottom: 10px;
    }
    
    .search-category h3 {
        font-size: 1.3rem;
        margin-bottom: 20px;
    }
    
    .search-card-image {
        height: 180px;
    }
    
    .empty-state {
        padding: 60px 16px;
    }
    
    .empty-state h2 {
        font-size: 1.6rem;
    }
    
    .empty-state p {
        font-size: 0.95rem;
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
