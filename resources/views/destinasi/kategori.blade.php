@extends('layouts.app')

@section('title', 'Destinasi ' . $kategori . ' - Geosite Danau Toba')

@section('content')

<style>
    /* ==================== HERO SECTION ==================== */
    .kategori-hero {
        height: 60vh;
        min-height: 450px;
        position: relative;
        overflow: hidden;
        margin-top: 0;
    }
    
    .kategori-hero .hero-bg {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-position: center;
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0,0,0,0.8) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.6) 100%);
    }
    
    .hero-content {
        position: relative;
        z-index: 10;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        text-align: center;
        color: white;
        padding: 0 20px;
    }
    
    .back-btn {
        position: absolute;
        top: 30px;
        left: 30px;
        z-index: 20;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 12px 24px;
        border-radius: 50px;
        color: white;
        text-decoration: none;
        font-size: 0.8rem;
        font-weight: 500;
        transition: all 0.3s ease;
        display: inline-flex;
        align-items: center;
        gap: 8px;
    }
    
    .back-btn:hover {
        background: #c6a43b;
        color: #1a1a1a;
        transform: translateX(-5px);
    }
    
    .hero-badge {
        display: inline-block;
        padding: 6px 20px;
        background: rgba(198, 164, 59, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(198, 164, 59, 0.5);
        border-radius: 50px;
        font-size: 0.7rem;
        letter-spacing: 3px;
        margin-bottom: 20px;
    }
    
    .hero-content h1 {
        font-size: 3.5rem;
        font-weight: 800;
        margin-bottom: 15px;
    }
    
    .hero-content p {
        font-size: 1rem;
        max-width: 600px;
        margin: 0 auto;
        opacity: 0.9;
    }
    
    /* ==================== DESTINASI GRID ==================== */
    .destinasi-section {
        padding: 80px 0;
        background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
    }
    
    .destinasi-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    
    .dest-card {
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.08);
        transition: all 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        cursor: pointer;
    }
    
    .dest-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.15);
    }
    
    .card-image {
        position: relative;
        height: 260px;
        overflow: hidden;
    }
    
    .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .dest-card:hover .card-image img {
        transform: scale(1.08);
    }
    
    .card-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        background: #c6a43b;
        color: #1a1a1a;
        padding: 6px 15px;
        border-radius: 30px;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 1px;
        z-index: 2;
    }
    
    .card-content {
        padding: 25px;
    }
    
    .card-title {
        font-size: 1.4rem;
        font-weight: 700;
        margin-bottom: 8px;
        color: #1a1a1a;
    }
    
    .card-location {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 4px 12px;
        background: #f5f4f0;
        border-radius: 30px;
        font-size: 0.7rem;
        color: #c6a43b;
        margin-bottom: 15px;
    }
    
    .card-location i {
        font-size: 0.6rem;
    }
    
    .card-desc {
        font-size: 0.85rem;
        color: #666;
        line-height: 1.7;
        margin-bottom: 20px;
    }
    
    .card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-bottom: 25px;
    }
    
    .card-tags span {
        background: #f5f4f0;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.7rem;
        color: #555;
        transition: all 0.3s ease;
    }
    
    .card-tags span:hover {
        background: #c6a43b;
        color: white;
    }
    
    .card-btn {
        display: inline-flex;
        align-items: center;
        gap: 10px;
        background: transparent;
        border: 2px solid #c6a43b;
        color: #c6a43b;
        padding: 10px 28px;
        border-radius: 50px;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 2px;
        text-transform: uppercase;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .card-btn:hover {
        background: #c6a43b;
        color: #1a1a1a;
        gap: 15px;
    }

    /* ==================== SEARCH SECTION ==================== */
    .search-bar {
        display: flex;
        justify-content: center;
        margin-bottom: 40px;
    }

    .destinasi-search-input-wrapper {
        position: relative;
        width: 100%;
        max-width: 320px;
    }

    .destinasi-search-input {
        width: 100% !important;
        border: 1.5px solid #ddd !important;
        padding: 12px 48px 12px 16px !important;
        border-radius: 40px !important;
        font-size: 0.88rem !important;
        color: #1a1a1a !important;
        background: #fbfbfb !important;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06) !important;
        transition: all 0.25s ease !important;
    }

    .destinasi-search-input::placeholder {
        color: #999 !important;
    }

    .destinasi-search-input:focus {
        outline: none !important;
        border-color: #c6a43b !important;
        box-shadow: 0 6px 18px rgba(198, 164, 59, 0.16) !important;
    }

    .destinasi-search-button {
        position: absolute !important;
        right: 10px !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
        width: 36px !important;
        height: 36px !important;
        border: none !important;
        background: transparent !important;
        color: #c6a43b !important;
        cursor: pointer !important;
        display: flex !important;
        align-items: center !important;
        justify-content: center !important;
        border-radius: 50% !important;
        transition: background 0.2s ease !important;
    }

    .destinasi-search-button:hover {
        background: rgba(198, 164, 59, 0.12) !important;
    }

    .destinasi-search-button i {
        font-size: 1rem !important;
    }

    .search-info {
        text-align: center;
        margin-bottom: 30px;
        color: #666;
        font-size: 0.95rem;
    }

    .search-info span {
        font-weight: 700;
        color: #c6a43b;
    }

    /* Empty State */
    .empty-state {
        grid-column: 1 / -1;
        text-align: center;
        padding: 80px 20px;
        background: white;
        border-radius: 24px;
    }
    
    .empty-state i {
        font-size: 4rem;
        color: #ddd;
        margin-bottom: 20px;
    }
    
    .empty-state h3 {
        font-size: 1.5rem;
        color: #666;
        margin-bottom: 10px;
    }
    
    /* Responsive */
    @media (max-width: 992px) {
        .destinasi-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .hero-content h1 {
            font-size: 2.5rem;
        }
    }
    
    @media (max-width: 768px) {
        .kategori-hero {
            height: 50vh;
            min-height: 400px;
        }
        .destinasi-grid {
            grid-template-columns: 1fr;
        }
        .hero-content h1 {
            font-size: 1.8rem;
        }
        .back-btn {
            top: 80px;
            left: 20px;
            padding: 8px 16px;
            font-size: 0.7rem;
        }
    }
</style>

<!-- ==================== HERO SECTION ==================== -->
<section class="kategori-hero">
    <div class="hero-bg" style="background-image: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(0,0,0,0.4)), url('/image/destinasi-{{ strtolower($kategori) }}.jpg');"></div>
    <div class="hero-overlay"></div>
    <a href="{{ url('/destinasi') }}" class="back-btn">
        <i class="fas fa-arrow-left"></i> Kembali
    </a>
    <div class="hero-content">
        <span class="hero-badge">{{ strtoupper($kategori) }}</span>
        <h1>Destinasi {{ $kategori }}</h1>
        <p>{{ $deskripsi }}</p>
    </div>
</section>

<!-- ==================== DESTINASI GRID ==================== -->
<section class="destinasi-section">
    <div class="container">
        <div class="search-bar" data-aos="fade-up">
            <div class="destinasi-search-input-wrapper">
                <input type="text" id="destinasiSearch" class="search-input destinasi-search-input" placeholder="Cari destinasi, lokasi, atau tag...">
                <button type="button" class="search-button destinasi-search-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
        <div class="search-info" id="searchInfo" data-aos="fade-up" data-aos-delay="50">
            Menampilkan <span id="searchCount">{{ count($destinasi) }}</span> destinasi di kategori <span>{{ $kategori }}</span>
        </div>
        <div class="destinasi-grid" id="destinasiGrid">
            @forelse($destinasi as $item)
            <div class="dest-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="card-image">
                    <img src="{{ $item->gambar }}" alt="{{ $item->nama }}">
                    <span class="card-badge">{{ $kategori }}</span>
                </div>
                <div class="card-content">
                    <h3 class="card-title">{{ $item->nama }}</h3>
                    <div class="card-location">
                        <i class="fas fa-map-marker-alt"></i> {{ $item->lokasi }}
                    </div>
                    <p class="card-desc">{{ $item->deskripsi }}</p>
                    <div class="card-tags">
                        @foreach(json_decode($item->tags, true) ?? [] as $tag)
                        <span>#{{ $tag }}</span>
                        @endforeach
                    </div>
                    <a href="{{ $item->maps }}" target="_blank" class="card-btn">
    Jelajahi <i class="fas fa-arrow-right"></i>
</a>
                </div>
            </div>
            @empty
            <div class="empty-state">
                <i class="fas fa-mountain"></i>
                <h3>Belum Ada Destinasi</h3>
                <p>Destinasi pada kategori ini akan segera ditambahkan.</p>
            </div>
            @endforelse
            <div class="empty-state" id="searchEmptyState" style="display: none;">
                <i class="fas fa-search"></i>
                <h3>Tidak ada destinasi yang cocok</h3>
                <p>Coba kata kunci lain atau hapus filter pencarian untuk melihat semua destinasi.</p>
            </div>
        </div>
    </div>
</section>

<!-- Font Awesome & AOS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });

    const destinasiSearch = document.getElementById('destinasiSearch');
    const destinasiGrid = document.getElementById('destinasiGrid');
    const searchCount = document.getElementById('searchCount');
    const searchInfo = document.getElementById('searchInfo');

    destinasiSearch.addEventListener('input', function() {
        const query = this.value.trim().toLowerCase();
        const cards = destinasiGrid.querySelectorAll('.dest-card');
        let visibleCount = 0;

        cards.forEach(card => {
            const title = card.querySelector('.card-title').textContent.toLowerCase();
            const location = card.querySelector('.card-location').textContent.toLowerCase();
            const description = card.querySelector('.card-desc').textContent.toLowerCase();
            const tags = Array.from(card.querySelectorAll('.card-tags span')).map(tag => tag.textContent.toLowerCase());
            const text = [title, location, description, ...tags].join(' ');
            const match = query === '' || text.includes(query);

            card.style.display = match ? 'block' : 'none';
            if (match) visibleCount++;
        });

        searchCount.textContent = visibleCount;

        const emptyState = destinasiGrid.querySelector('.empty-state');
        if (emptyState) {
            emptyState.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        searchInfo.innerHTML = visibleCount > 0
            ? `Menampilkan <span>${visibleCount}</span> destinasi di kategori <span>{{ $kategori }}</span>`
            : 'Tidak ada destinasi yang cocok. Coba kata kunci lain.';
    });
</script>

@endsection