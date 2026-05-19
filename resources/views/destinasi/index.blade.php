@extends('layouts.app')

@section('title', 'Destinasi Geosite - Danau Toba')

@section('content')

<style>
    /* ==================== HERO SECTION ==================== */
    .destinasi-hero {
        height: 85vh;
        min-height: 600px;
        position: relative;
        overflow: hidden;
        margin-top: 0;
    }
    
    .hero-background {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: url('/image/destinasi-hero.jpg');
        background-size: cover;
        background-position: center;
        animation: zoomSlow 20s ease-out infinite;
    }
    
    @keyframes zoomSlow {
        0% { transform: scale(1); }
        100% { transform: scale(1.1); }
    }
    
    .hero-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(0,0,0,0.75) 0%, rgba(0,0,0,0.4) 50%, rgba(0,0,0,0.6) 100%);
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
    
    .hero-badge {
        display: inline-block;
        padding: 6px 20px;
        background: rgba(198, 164, 59, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(198, 164, 59, 0.5);
        border-radius: 50px;
        font-size: 0.7rem;
        letter-spacing: 3px;
        margin-bottom: 25px;
        animation: fadeInUp 0.8s ease;
    }
    
    .hero-content h1 {
        font-size: 4.5rem;
        font-weight: 800;
        margin-bottom: 20px;
        animation: fadeInUp 0.8s ease 0.1s both;
        text-shadow: 0 4px 20px rgba(0,0,0,0.3);
    }
    
    .hero-content h1 span {
        color: #c6a43b;
    }
    
    .hero-content p {
        font-size: 1.1rem;
        max-width: 600px;
        margin: 0 auto 30px;
        opacity: 0.9;
        animation: fadeInUp 0.8s ease 0.2s both;
    }
    
    .hero-scroll {
        position: absolute;
        bottom: 30px;
        left: 50%;
        transform: translateX(-50%);
        animation: bounce 2s infinite;
        cursor: pointer;
        z-index: 10;
    }
    
    .hero-scroll a {
        color: white;
        font-size: 0.7rem;
        letter-spacing: 2px;
        text-decoration: none;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
    }
    
    .hero-scroll .line {
        width: 20px;
        height: 35px;
        border: 1px solid rgba(255,255,255,0.5);
        border-radius: 15px;
        position: relative;
    }
    
    .hero-scroll .line::before {
        content: '';
        position: absolute;
        top: 5px;
        left: 50%;
        transform: translateX(-50%);
        width: 3px;
        height: 8px;
        background: white;
        border-radius: 2px;
        animation: scrollMove 1.5s infinite;
    }
    
    @keyframes scrollMove {
        0% { top: 5px; opacity: 1; }
        80% { top: 20px; opacity: 0; }
        100% { top: 5px; opacity: 0; }
    }
    
    @keyframes fadeInUp {
        from { opacity: 0; transform: translateY(40px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes bounce {
        0%, 100% { transform: translateX(-50%) translateY(0); }
        50% { transform: translateX(-50%) translateY(-10px); }
    }
    
    /* ==================== CATEGORY SECTION ==================== */
    .category-section {
        padding: 100px 0;
        background: linear-gradient(180deg, #f8f9fa 0%, #ffffff 100%);
    }
    
    .section-header {
        text-align: center;
        margin-bottom: 60px;
    }
    
    .section-header .subtitle {
        display: inline-block;
        font-size: 0.7rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: #c6a43b;
        margin-bottom: 15px;
        font-weight: 600;
    }
    
    .section-header h2 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #1a1a1a;
    }
    
    .section-header .divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #c6a43b, #e8c45a);
        margin: 0 auto 20px;
        border-radius: 3px;
    }
    
    .section-header p {
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }
    
    /* Category Cards Premium */
    .category-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 30px;
    }
    
    .category-card {
        position: relative;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
        transition: all 0.5s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        cursor: pointer;
        background: white;
    }
    
    .category-card:hover {
        transform: translateY(-15px);
        box-shadow: 0 30px 60px rgba(0,0,0,0.2);
    }
    
    .category-card .card-image {
        position: relative;
        height: 300px;
        overflow: hidden;
    }
    
    .category-card .card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.8s ease;
    }
    
    .category-card:hover .card-image img {
        transform: scale(1.1);
    }
    
    .card-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(to bottom, transparent 0%, rgba(0,0,0,0.7) 100%);
    }
    
    .card-badge {
        position: absolute;
        top: 20px;
        right: 20px;
        padding: 8px 18px;
        background: rgba(0,0,0,0.6);
        backdrop-filter: blur(10px);
        border-radius: 30px;
        color: white;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 1px;
        z-index: 2;
    }
    
    .card-badge i {
        margin-right: 5px;
        color: #c6a43b;
    }
    
    .card-content {
        padding: 25px;
        text-align: center;
        position: relative;
        background: white;
    }
    
    .card-icon {
        width: 70px;
        height: 70px;
        background: linear-gradient(135deg, #c6a43b, #e8c45a);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: -50px auto 15px;
        position: relative;
        z-index: 2;
        box-shadow: 0 10px 20px rgba(198, 164, 59, 0.3);
    }
    
    .card-icon i {
        font-size: 28px;
        color: white;
    }
    
    .card-content h3 {
        font-size: 1.6rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #1a1a1a;
    }
    
    .card-content p {
        font-size: 0.85rem;
        color: #666;
        line-height: 1.7;
        margin-bottom: 20px;
    }
    
    .card-stats {
        display: flex;
        justify-content: center;
        gap: 20px;
        margin-bottom: 20px;
    }
    
    .stat {
        text-align: center;
    }
    
    .stat-number {
        font-size: 1.2rem;
        font-weight: 700;
        color: #c6a43b;
    }
    
    .stat-label {
        font-size: 0.6rem;
        color: #999;
        text-transform: uppercase;
    }
    
    .card-btn {
        display: inline-block;
        padding: 10px 30px;
        background: transparent;
        border: 2px solid #c6a43b;
        color: #c6a43b;
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
        transform: translateY(-3px);
    }
    
    /* ==================== STATS SECTION ==================== */
    .stats-section {
        background: linear-gradient(135deg, #1a1a2e, #16213e);
        padding: 80px 0;
        position: relative;
        overflow: hidden;
    }
    
    .stats-section::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(198,164,59,0.05) 0%, transparent 70%);
        animation: rotate 30s linear infinite;
    }
    
    @keyframes rotate {
        from { transform: rotate(0deg); }
        to { transform: rotate(360deg); }
    }
    
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
        position: relative;
        z-index: 2;
    }
    
    .stat-item {
        text-align: center;
        padding: 30px;
        background: rgba(255,255,255,0.05);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        border: 1px solid rgba(255,255,255,0.1);
        transition: all 0.3s ease;
    }
    
    .stat-item:hover {
        transform: translateY(-5px);
        background: rgba(255,255,255,0.1);
        border-color: #c6a43b;
    }
    
    .stat-number {
        font-size: 2.5rem;
        font-weight: 800;
        color: #c6a43b;
        margin-bottom: 10px;
    }
    
    .stat-label {
        font-size: 0.7rem;
        letter-spacing: 2px;
        text-transform: uppercase;
        color: rgba(255,255,255,0.7);
    }
    
    /* ==================== FEATURE SECTION ==================== */
    .feature-section {
        padding: 100px 0;
        background: #f8f9fa;
    }
    
    .features-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 30px;
    }
    
    .feature-card {
        text-align: center;
        padding: 30px 20px;
        background: white;
        border-radius: 20px;
        transition: all 0.3s ease;
        box-shadow: 0 10px 30px rgba(0,0,0,0.05);
    }
    
    .feature-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }
    
    .feature-icon {
        width: 80px;
        height: 80px;
        background: linear-gradient(135deg, #c6a43b20, #c6a43b40);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 20px;
        transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon {
        background: linear-gradient(135deg, #c6a43b, #e8c45a);
        transform: scale(1.1);
    }
    
    .feature-icon i {
        font-size: 35px;
        color: #c6a43b;
        transition: all 0.3s ease;
    }
    
    .feature-card:hover .feature-icon i {
        color: white;
    }
    
    .feature-card h4 {
        font-size: 1.1rem;
        font-weight: 700;
        margin-bottom: 10px;
        color: #1a1a1a;
    }
    
    .feature-card p {
        font-size: 0.8rem;
        color: #666;
        line-height: 1.6;
    }
    
    /* ==================== SEARCH & FILTER SECTION ==================== */
    .search-section {
        padding: 80px 0;
        background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
        position: relative;
    }

    .search-container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .search-header {
        text-align: center;
        margin-bottom: 40px;
    }

    .search-header .subtitle {
        display: inline-block;
        font-size: 0.7rem;
        letter-spacing: 4px;
        text-transform: uppercase;
        color: #c6a43b;
        margin-bottom: 15px;
        font-weight: 600;
    }

    .search-header h2 {
        font-size: 2.2rem;
        font-weight: 700;
        margin-bottom: 15px;
        color: #1a1a1a;
    }

    .search-header .divider {
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #c6a43b, #e8c45a);
        margin: 0 auto 20px;
        border-radius: 3px;
    }

    .search-header p {
        color: #666;
        max-width: 600px;
        margin: 0 auto;
    }

    .search-filters {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        margin-bottom: 40px;
        align-items: center;
    }

    .destinasi-search-input-wrapper {
        position: relative;
        flex: 1;
        min-width: 220px;
        max-width: 320px;
    }

    .destinasi-search-input {
        width: 100% !important;
        padding: 12px 48px 12px 16px !important;
        border: 1.5px solid #ddd !important;
        border-radius: 40px !important;
        font-size: 0.88rem !important;
        line-height: 1.4 !important;
        background: #fbfbfb !important;
        transition: all 0.25s ease !important;
        box-shadow: 0 6px 18px rgba(0,0,0,0.06) !important;
    }

    .destinasi-search-input::placeholder {
        color: #999 !important;
    }

    .destinasi-search-input:focus {
        outline: none !important;
        border-color: #c6a43b !important;
        box-shadow: 0 6px 20px rgba(198, 164, 59, 0.16) !important;
        transform: none !important;
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

    .filter-buttons {
        display: flex;
        gap: 10px;
        flex-wrap: wrap;
    }

    .filter-btn {
        padding: 10px 20px;
        border: 2px solid #e0e0e0;
        background: white;
        color: #666;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .filter-btn:hover,
    .filter-btn.active {
        border-color: #c6a43b;
        background: #c6a43b;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(198, 164, 59, 0.3);
    }

    .results-section {
        margin-top: 40px;
    }

    .results-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .results-count {
        font-size: 0.9rem;
        color: #666;
        font-weight: 600;
    }

    .results-count span {
        color: #c6a43b;
        font-weight: 700;
    }

    .sort-select {
        padding: 8px 15px;
        border: 1px solid #e0e0e0;
        border-radius: 8px;
        background: white;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .sort-select:focus {
        outline: none;
        border-color: #c6a43b;
        box-shadow: 0 0 0 2px rgba(198, 164, 59, 0.1);
    }

    .results-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 30px;
    }

    .result-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.1);
        transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        cursor: pointer;
        opacity: 0;
        transform: translateY(30px);
        animation: fadeInUp 0.6s ease forwards;
    }

    .result-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.15);
    }

    .result-card-image {
        position: relative;
        height: 200px;
        overflow: hidden;
    }

    .result-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }

    .result-card:hover .result-card-image img {
        transform: scale(1.1);
    }

    .result-card-badge {
        position: absolute;
        top: 15px;
        right: 15px;
        padding: 6px 12px;
        background: rgba(198, 164, 59, 0.9);
        backdrop-filter: blur(10px);
        border-radius: 20px;
        color: white;
        font-size: 0.7rem;
        font-weight: 600;
        letter-spacing: 1px;
    }

    .result-card-content {
        padding: 20px;
    }

    .result-card-title {
        font-size: 1.2rem;
        font-weight: 700;
        color: #1a1a1a;
        margin-bottom: 8px;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .result-card-category {
        font-size: 0.7rem;
        padding: 4px 10px;
        background: #f0f0f0;
        color: #666;
        border-radius: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .result-card-location {
        font-size: 0.8rem;
        color: #c6a43b;
        margin-bottom: 10px;
        font-weight: 600;
    }

    .result-card-desc {
        font-size: 0.85rem;
        color: #666;
        line-height: 1.6;
        margin-bottom: 15px;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .result-card-tags {
        display: flex;
        flex-wrap: wrap;
        gap: 6px;
        margin-bottom: 15px;
    }

    .result-card-tag {
        font-size: 0.65rem;
        padding: 4px 8px;
        background: #f8f9fa;
        color: #666;
        border-radius: 8px;
        font-weight: 500;
    }

    .result-card-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .result-card-rating {
        display: flex;
        align-items: center;
        gap: 5px;
        font-size: 0.8rem;
        color: #c6a43b;
        font-weight: 600;
    }

    .result-card-btn {
        padding: 8px 16px;
        background: transparent;
        border: 1px solid #c6a43b;
        color: #c6a43b;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 1px;
    }

    .result-card-btn:hover {
        background: #c6a43b;
        color: white;
        transform: translateY(-2px);
    }

    .no-results {
        text-align: center;
        padding: 60px 20px;
        color: #666;
    }

    .no-results i {
        font-size: 4rem;
        color: #e0e0e0;
        margin-bottom: 20px;
    }

    .no-results h3 {
        font-size: 1.5rem;
        margin-bottom: 10px;
        color: #1a1a1a;
    }

    .no-results p {
        font-size: 0.9rem;
        margin-bottom: 20px;
    }

    .no-results .search-btn {
        display: inline-block;
        padding: 12px 25px;
        background: #c6a43b;
        color: white;
        border-radius: 25px;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s ease;
    }

    .no-results .search-btn:hover {
        background: #b8953a;
        transform: translateY(-2px);
    }

    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 992px) {
        .hero-content h1 {
            font-size: 3rem;
        }
        .category-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .features-grid {
            grid-template-columns: repeat(2, 1fr);
        }
        .search-filters {
            flex-direction: column;
            align-items: stretch;
        }
        .search-input-wrapper {
            min-width: auto;
            max-width: none;
        }
        .filter-buttons {
            justify-content: center;
        }
        .results-grid {
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 20px;
        }
    }
    
    @media (max-width: 768px) {
        .destinasi-hero {
            height: 70vh;
            min-height: 500px;
        }
        .hero-content h1 {
            font-size: 2.2rem;
        }
        .hero-content p {
            font-size: 0.9rem;
        }
        .category-grid {
            grid-template-columns: 1fr;
        }
        .stats-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }
        .features-grid {
            grid-template-columns: 1fr;
        }
        .section-header h2 {
            font-size: 1.8rem;
        }
    }
</style>

<!-- ==================== HERO SECTION ==================== -->
<section class="destinasi-hero">
    <div class="hero-background"></div>
    <div class="hero-overlay"></div>
    <div class="hero-content">
        <span class="hero-badge" data-aos="fade-up">EXPLORE THE GEOSITE</span>
        <h1 data-aos="fade-up" data-aos-delay="100">Destinasi <span>GeoToba</span></h1>
        <p data-aos="fade-up" data-aos-delay="200">Jelajahi keindahan geologi, budaya, dan pesona alam Caldera Danau Toba yang diakui UNESCO</p>
    </div>
    <div class="hero-scroll">
        <a href="#search">
            <span>CARI DESTINASI</span>
            <div class="line"></div>
        </a>
    </div>
</section>

<!-- ==================== SEARCH & FILTER SECTION ==================== -->
<section class="search-section" id="search">
    <div class="search-container">
        <div class="search-header" data-aos="fade-up">
            <span class="subtitle">CARI DESTINASI</span>
            <h2>Temukan Destinasi Impianmu</h2>
            <div class="divider"></div>
            <p>Cari destinasi wisata GeoToba berdasarkan nama, lokasi, atau kategori favoritmu</p>
        </div>

        <div class="search-filters" data-aos="fade-up" data-aos-delay="100">
            <div class="destinasi-search-input-wrapper">
                <input type="text" class="search-input destinasi-search-input" id="searchInput" placeholder="Cari destinasi, lokasi, atau aktivitas...">
                <button type="button" class="search-button destinasi-search-button">
                    <i class="fas fa-search"></i>
                </button>
            </div>
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="alam">Alam</button>
                <button class="filter-btn" data-filter="buatan">Buatan</button>
                <button class="filter-btn" data-filter="budaya">Budaya</button>
            </div>
        </div>

        <div class="results-section">
            <div class="results-header">
                <div class="results-count">Menampilkan <span id="resultsCount">0</span> destinasi</div>
                <select class="sort-select" id="sortSelect">
                    <option value="name">Urutkan: Nama A-Z</option>
                    <option value="name-desc">Urutkan: Nama Z-A</option>
                    <option value="location">Urutkan: Lokasi</option>
                </select>
            </div>
            <div class="results-grid" id="resultsGrid">
                <!-- Results will be populated by JavaScript -->
            </div>
        </div>
    </div>
</section>


        




<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
<!-- AOS -->
<link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
<script src="https://unpkg.com/aos@next/dist/aos.js"></script>
<script>
    // Inisialisasi AOS
    AOS.init({
        duration: 800,
        once: true,
        offset: 50
    });

    // Smooth scroll
    document.querySelector('.hero-scroll a').addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector('#categories').scrollIntoView({
            behavior: 'smooth',
            block: 'start'
        });
    });

    // ==================== SEARCH & FILTER FUNCTIONALITY ====================
    @php
        $destinasiData = $destinasi->map(function ($item) {
            $tags = $item->tags;
            if (is_string($tags)) {
                $tags = json_decode($tags, true) ?: [];
            } elseif (is_null($tags)) {
                $tags = [];
            }
            return [
                'id' => $item->id,
                'nama' => $item->nama,
                'kategori' => strtolower($item->kategori),
                'lokasi' => $item->lokasi,
                'deskripsi' => $item->deskripsi,
                'gambar' => $item->gambar,
                'tags' => $tags,
                'maps' => $item->maps,
                'rating' => 4.5,
            ];
        });
    @endphp

    const destinasiData = @json($destinasiData);

    // DOM elements
    const searchInput = document.getElementById('searchInput');
    const filterButtons = document.querySelectorAll('.filter-btn');
    const resultsGrid = document.getElementById('resultsGrid');
    const resultsCount = document.getElementById('resultsCount');
    const sortSelect = document.getElementById('sortSelect');

    // Current state
    let currentFilter = 'all';
    let currentSearch = '';
    let currentSort = 'name';

    // Initialize
    document.addEventListener('DOMContentLoaded', function() {
        renderResults();
        setupEventListeners();
    });

    // Setup event listeners
    function setupEventListeners() {
        // Search input
        searchInput.addEventListener('input', function(e) {
            currentSearch = e.target.value.toLowerCase();
            renderResults();
        });

        // Filter buttons
        filterButtons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove active class from all buttons
                filterButtons.forEach(btn => btn.classList.remove('active'));
                // Add active class to clicked button
                this.classList.add('active');
                // Update current filter
                currentFilter = this.dataset.filter;
                renderResults();
            });
        });

        // Sort select
        sortSelect.addEventListener('change', function(e) {
            currentSort = e.target.value;
            renderResults();
        });
    }

    // Filter and search function
    function filterDestinasi() {
        return destinasiData.filter(destinasi => {
            // Filter by category
            const categoryMatch = currentFilter === 'all' || destinasi.kategori === currentFilter;

            // Filter by search
            const searchMatch = currentSearch === '' ||
                destinasi.nama.toLowerCase().includes(currentSearch) ||
                destinasi.lokasi.toLowerCase().includes(currentSearch) ||
                destinasi.deskripsi.toLowerCase().includes(currentSearch) ||
                destinasi.tags.some(tag => tag.toLowerCase().includes(currentSearch));

            return categoryMatch && searchMatch;
        });
    }

    // Sort function
    function sortDestinasi(destinasi) {
        return destinasi.sort((a, b) => {
            switch(currentSort) {
                case 'name':
                    return a.nama.localeCompare(b.nama);
                case 'name-desc':
                    return b.nama.localeCompare(a.nama);
                case 'location':
                    return a.lokasi.localeCompare(b.lokasi);
                default:
                    return 0;
            }
        });
    }

    // Render results
    function renderResults() {
        const filtered = filterDestinasi();
        const sorted = sortDestinasi(filtered);

        // Update count
        resultsCount.textContent = sorted.length;

        // Clear previous results
        resultsGrid.innerHTML = '';

        if (sorted.length === 0) {
            // No results
            resultsGrid.innerHTML = `
                <div class="no-results">
                    <i class="fas fa-search"></i>
                    <h3>Tidak ada destinasi ditemukan</h3>
                    <p>Coba ubah kata kunci pencarian atau filter kategori</p>
                    <a href="#search" class="search-btn" onclick="resetSearch()">Reset Pencarian</a>
                </div>
            `;
            return;
        }

        // Render results
        sorted.forEach((destinasi, index) => {
            const card = createDestinasiCard(destinasi, index);
            resultsGrid.appendChild(card);
        });
    }

    // Create destinasi card
    function createDestinasiCard(destinasi, index) {
        const card = document.createElement('div');
        card.className = 'result-card';
        card.style.animationDelay = `${index * 0.1}s`;

        const kategoriLabels = {
            'alam': 'Alam',
            'buatan': 'Buatan',
            'budaya': 'Budaya'
        };

        const kategoriColors = {
            'alam': '#4CAF50',
            'buatan': '#2196F3',
            'budaya': '#FF9800'
        };

        card.innerHTML = `
            <div class="result-card-image">
                <img src="${destinasi.gambar}" alt="${destinasi.nama}" onerror="this.src='/uploads/del.jpeg'">
                <span class="result-card-badge">${kategoriLabels[destinasi.kategori]}</span>
            </div>
            <div class="result-card-content">
                <h3 class="result-card-title">
                    ${destinasi.nama}
                    <span class="result-card-category" style="background: ${kategoriColors[destinasi.kategori]}20; color: ${kategoriColors[destinasi.kategori]};">${kategoriLabels[destinasi.kategori]}</span>
                </h3>
                <div class="result-card-location">
                    <i class="fas fa-map-marker-alt"></i> ${destinasi.lokasi}
                </div>
                <p class="result-card-desc">${destinasi.deskripsi}</p>
                <div class="result-card-tags">
                    ${destinasi.tags.map(tag => `<span class="result-card-tag">${tag}</span>`).join('')}
                </div>
                <div class="result-card-footer">
                    <div class="result-card-rating">
                        <i class="fas fa-star"></i> ${destinasi.rating}
                    </div>
                    <a href="/destinasi/${destinasi.id}" class="result-card-btn">Lihat Detail →</a>
                </div>
            </div>
        `;

        return card;
    }

    // Reset search function
    function resetSearch() {
        searchInput.value = '';
        currentSearch = '';
        currentFilter = 'all';
        filterButtons.forEach(btn => btn.classList.remove('active'));
        document.querySelector('[data-filter="all"]').classList.add('active');
        sortSelect.value = 'name';
        currentSort = 'name';
        renderResults();
        searchInput.focus();
    }

    // Add keyboard shortcuts
    document.addEventListener('keydown', function(e) {
        // Ctrl/Cmd + K to focus search
        if ((e.ctrlKey || e.metaKey) && e.key === 'k') {
            e.preventDefault();
            searchInput.focus();
        }

        // Escape to clear search
        if (e.key === 'Escape' && document.activeElement === searchInput) {
            resetSearch();
        }
    });
</script>

@endsection