@extends('layouts.app')

@section('title', 'Kontak - Geosite Danau Toba')

@section('content')

<style>
    /* ==================== LOGO SECTION ==================== */
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
        transition: all 0.3s cubic-bezier(0.2, 0.9, 0.4, 1.1);
        border: 1px solid rgba(255, 255, 255, 0.8);
    }
    
    .logo-container:hover {
        background: white;
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.15);
        transform: translateY(-2px);
    }
    
    .flag-logo-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .flag-img {
        width: 100px;
        height: auto;
        border-radius: 6px;
        box-shadow: 0 3px 10px rgba(0,0,0,0.15);
        transition: transform 0.2s ease;
        border: 1px solid rgba(255,255,255,0.3);
    }
    
    .flag-img:hover {
        transform: scale(1.05);
    }
    
    .logo-divider {
        width: 2px;
        height: 35px;
        background: #e0e0e0;
        border-radius: 2px;
    }
    
    .del-logo-wrapper {
        display: flex;
        align-items: center;
        gap: 10px;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    
    .del-logo-wrapper:hover {
        transform: scale(1.02);
    }
    
    .del-img {
        width: 50px;
        height: auto;
        border-radius: 8px;
        transition: transform 0.2s ease;
    }
    
    .del-img:hover {
        transform: scale(1.05);
    }
    
    .geotoba-wrapper {
        display: flex;
        align-items: center;
        gap: 12px;
    }
    
    .geotoba-text {
        font-size: 1.5rem;
        font-weight: 800;
        letter-spacing: 1px;
        background: linear-gradient(135deg, #1a3c5e, #2c5f8a);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-family: 'Inter', 'Poppins', sans-serif;
        line-height: 1.2;
    }
    
    .geotoba-sub {
        font-size: 0.7rem;
        font-weight: 500;
        color: #5a6e7c;
        letter-spacing: 0.5px;
    }
    
    @media (max-width: 768px) {
        .logo-container {
            top: 12px;
            left: 12px;
            padding: 6px 18px;
            gap: 14px;
        }
        .flag-img {
            width: 60px;
        }
        .del-img {
            width: 35px;
        }
        .geotoba-text {
            font-size: 1.2rem;
        }
        .geotoba-sub {
            font-size: 0.6rem;
        }
        .logo-divider {
            height: 28px;
        }
    }
    
    @media (max-width: 576px) {
        .logo-container {
            padding: 5px 14px;
            gap: 10px;
        }
        .flag-img {
            width: 45px;
        }
        .del-img {
            width: 28px;
        }
        .geotoba-text {
            font-size: 0.9rem;
        }
        .geotoba-sub {
            font-size: 0.5rem;
        }
        .logo-divider {
            height: 24px;
        }
    }

    /* ==================== HERO ==================== */
    .kontak-hero {
        height: 45vh;
        background: linear-gradient(135deg, rgba(0,0,0,0.65), rgba(0,0,0,0.4)),
                    url('/image/kontak-hero.jpg');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
        color: white;
        margin-top: 76px;
        position: relative;
    }
    
    .kontak-hero::before {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        height: 80px;
        background: linear-gradient(to top, #fafaf8, transparent);
    }
    
    .kontak-hero h1 {
        font-size: 3.5rem;
        font-weight: 400;
        font-family: 'Cormorant Garamond', serif;
        letter-spacing: 0.02em;
        margin-bottom: 15px;
    }
    
    .kontak-hero p {
        font-size: 1rem;
        opacity: 0.85;
        letter-spacing: 0.2em;
        text-transform: uppercase;
    }
    
    /* ==================== KONTAK SECTION ==================== */
    .kontak-section {
        padding: 60px 0;
    }
    
    .kontak-card {
        background: white;
        border-radius: 20px;
        padding: 30px 20px;
        text-align: center;
        transition: all 0.3s ease;
        box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        border: 1px solid #f0f0f0;
        height: 100%;
    }
    
    .kontak-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 15px 35px rgba(0,0,0,0.1);
    }
    
    .kontak-icon {
        width: 65px;
        height: 65px;
        background: rgba(198, 164, 59, 0.1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 18px;
    }
    
    .kontak-icon i {
        font-size: 28px;
        color: #c6a43b;
    }
    
    .kontak-card h4 {
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 12px;
        color: #1a1a1a;
    }
    
    .kontak-card p {
        color: #666;
        margin-bottom: 5px;
        font-size: 0.85rem;
        line-height: 1.5;
    }
    
    /* ==================== FORM ==================== */
    .form-card {
        background: white;
        border-radius: 24px;
        padding: 35px;
        box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        border: 1px solid #f0f0f0;
        height: 100%;
    }
    
    .form-card h3 {
        font-size: 1.5rem;
        font-family: 'Cormorant Garamond', serif;
        font-weight: 500;
        margin-bottom: 20px;
        color: #1a1a1a;
    }
    
    .form-control, .form-select {
        border: 1px solid #e0e0e0;
        border-radius: 12px;
        padding: 12px 16px;
        font-size: 0.85rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: #c6a43b;
        box-shadow: 0 0 0 3px rgba(198, 164, 59, 0.08);
        outline: none;
    }
    
    .btn-send {
        background: #1a1a1a;
        color: white;
        border: none;
        padding: 12px 30px;
        border-radius: 50px;
        font-weight: 600;
        letter-spacing: 1px;
        transition: all 0.3s ease;
        width: 100%;
        font-size: 0.75rem;
        text-transform: uppercase;
    }
    
    .btn-send:hover {
        background: #c6a43b;
        color: #1a1a1a;
        transform: translateY(-2px);
    }
    
    /* ==================== MAPS ==================== */
    .map-card {
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 5px 20px rgba(0,0,0,0.04);
        border: 1px solid #f0f0f0;
        background: white;
        height: 100%;
    }
    
    .map-card iframe {
        width: 100%;
        height: 280px;
        border: 0;
    }
    
    .map-info {
        padding: 20px;
        text-align: center;
    }
    
    .map-info h4 {
        font-size: 1.15rem;
        font-weight: 600;
        margin-bottom: 15px;
        color: #1a1a1a;
    }
    
    .social-icons {
        display: flex;
        justify-content: center;
        gap: 12px;
        margin-bottom: 20px;
    }
    
    .social-icons a {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        background: #f5f4f0;
        border-radius: 50%;
        color: #1a1a1a;
        transition: all 0.3s ease;
        text-decoration: none;
    }
    
    .social-icons a:hover {
        background: #c6a43b;
        color: white;
        transform: translateY(-3px);
    }
    
    .jam-operasional p {
        margin-bottom: 5px;
        font-size: 0.85rem;
        color: #666;
    }
    
    .jam-operasional h5 {
        font-size: 0.9rem;
        font-weight: 600;
        margin-bottom: 8px;
        color: #1a1a1a;
    }
    
    /* ==================== RESPONSIVE ==================== */
    @media (max-width: 768px) {
        .kontak-hero h1 {
            font-size: 2.2rem;
        }
        .kontak-hero p {
            font-size: 0.8rem;
        }
        .kontak-section {
            padding: 40px 0;
        }
        .form-card {
            margin-bottom: 25px;
        }
    }
    
    @media (max-width: 576px) {
        .kontak-hero h1 {
            font-size: 1.8rem;
        }
        .kontak-card {
            padding: 20px 15px;
        }
        .form-card {
            padding: 25px;
        }
    }
</style>



<!-- HERO -->
<section class="kontak-hero">
    <div class="container">
        <h1 data-aos="fade-up">Hubungi Kami</h1>
        <p data-aos="fade-up" data-aos-delay="100">Senang mendengar dari Anda</p>
    </div>
</section>

<!-- KONTAK SECTION -->
<section class="kontak-section">
    <div class="container">
        <div class="row g-4 mb-5">
            <!-- ALAMAT -->
            <div class="col-md-4" data-aos="fade-up">
                <div class="kontak-card">
                    <div class="kontak-icon">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <h4>Alamat</h4>
                    @if($kontak->alamat)
                        <p>{{ $kontak->alamat }}</p>
                    @else
                        <p>Geosite Danau Toba</p>
                        <p>Pulau Sibandang, Danau Toba</p>
                        <p>Sumatera Utara, Indonesia</p>
                    @endif
                </div>
            </div>
            
            <!-- TELEPON -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="100">
                <div class="kontak-card">
                    <div class="kontak-icon">
                        <i class="fas fa-phone-alt"></i>
                    </div>
                    <h4>Telepon</h4>
                    @if($kontak->telepon_1)
                        <p>{{ $kontak->telepon_1 }}</p>
                    @endif
                    @if($kontak->telepon_2)
                        <p>{{ $kontak->telepon_2 }}</p>
                    @endif
                    @if($kontak->telepon_3)
                        <p>{{ $kontak->telepon_3 }}</p>
                    @else
                        <p>+62 812 3456 7890</p>
                        <p>+62 813 9876 5432</p>
                        <p>(0622) 12345</p>
                    @endif
                </div>
            </div>
            
            <!-- EMAIL -->
            <div class="col-md-4" data-aos="fade-up" data-aos-delay="200">
                <div class="kontak-card">
                    <div class="kontak-icon">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <h4>Email</h4>
                    @if($kontak->email_1)
                        <p>{{ $kontak->email_1 }}</p>
                    @endif
                    @if($kontak->email_2)
                        <p>{{ $kontak->email_2 }}</p>
                    @endif
                    @if($kontak->email_3)
                        <p>{{ $kontak->email_3 }}</p>
                    @else
                        <p>info@geotoba.com</p>
                        <p>reservasi@geotoba.com</p>
                        <p>support@geotoba.com</p>
                    @endif
                </div>
            </div>
        </div>
            
            <!-- MAPS & SOSIAL -->
            <div class="col-lg-6" data-aos="fade-left">
                <div class="map-card">
                    <iframe 
                        src="{{ $kontak->maps_url ?? 'https://www.google.com/maps?q=Muara,Tapanuli+Utara&output=embed' }}"
                        allowfullscreen="" 
                        loading="lazy">
                    </iframe>
                    <div class="map-info">
                        <h4>Ikuti Kami</h4>
                        <div class="social-icons">
                            @if($kontak->facebook)
                                <a href="{{ $kontak->facebook }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                            @endif
                            @if($kontak->instagram)
                                <a href="{{ $kontak->instagram }}" target="_blank"><i class="fab fa-instagram"></i></a>
                            @endif
                            @if($kontak->twitter)
                                <a href="{{ $kontak->twitter }}" target="_blank"><i class="fab fa-twitter"></i></a>
                            @endif
                            @if($kontak->youtube)
                                <a href="{{ $kontak->youtube }}" target="_blank"><i class="fab fa-youtube"></i></a>
                            @endif
                            @if($kontak->tiktok)
                                <a href="{{ $kontak->tiktok }}" target="_blank"><i class="fab fa-tiktok"></i></a>
                            @else
                                <a href="#"><i class="fab fa-facebook-f"></i></a>
                                <a href="#"><i class="fab fa-instagram"></i></a>
                                <a href="#"><i class="fab fa-twitter"></i></a>
                                <a href="#"><i class="fab fa-youtube"></i></a>
                                <a href="#"><i class="fab fa-tiktok"></i></a>
                            @endif
                        </div>
                        <div class="jam-operasional">
                            <h5>Jam Operasional</h5>
                            @if($kontak->jam_buka_kerja && $kontak->jam_tutup_kerja)
                                <p>Senin - Jumat: {{ $kontak->jam_buka_kerja }} - {{ $kontak->jam_tutup_kerja }}</p>
                            @else
                                <p>Senin - Jumat: 08:00 - 17:00</p>
                            @endif
                            @if($kontak->jam_buka_weekend && $kontak->jam_tutup_weekend)
                                <p>Sabtu - Minggu: {{ $kontak->jam_buka_weekend }} - {{ $kontak->jam_tutup_weekend }}</p>
                            @else
                                <p>Sabtu - Minggu: 08:00 - 18:00</p>
                            @endif
                        </div>
                    </div>
                </div>
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
    AOS.init({
        duration: 800,
        once: true
    });
</script>

@endsection