    @extends('layouts.app')

    @section('title', 'Destinasi Geosite - Danau Toba')

    @section('content')

    <style>
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.95);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Hero Section */
        .destinasi-hero {
            height: 50vh;
            background: linear-gradient(135deg, rgba(0,0,0,0.7), rgba(0,0,0,0.5)),
                        url('{{ asset('uploads/A1.JPEG') }}');
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
            animation: slideInDown 0.8s ease-out;
        }
        
        .destinasi-hero::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: radial-gradient(circle, transparent 30%, rgba(0,0,0,0.5) 100%);
        }
        
        .destinasi-hero .container {
            position: relative;
            z-index: 2;
        }

        .destinasi-hero h1 {
            animation: fadeInUp 0.8s ease-out;
        }

        .destinasi-hero p {
            animation: fadeInUp 0.8s ease-out 0.1s both;
        }
        
        /* Filter Buttons */
        .filter-btn {
            background: transparent;
            border: 2px solid rgba(255,255,255,0.3);
            color: white;
            padding: 10px 24px;
            border-radius: 50px;
            font-weight: 500;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            margin: 5px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            animation: scaleIn 0.5s ease-out backwards;
        }
        
        .filter-btn:hover {
            background: #c6a43b;
            border-color: #c6a43b;
            color: #1a1a1a;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(198, 164, 59, 0.3);
        }

        .filter-btn.active {
            background: #c6a43b;
            border-color: #c6a43b;
            color: #1a1a1a;
            box-shadow: 0 5px 15px rgba(198, 164, 59, 0.3);
        }
        
        /* Destination Cards */
        .destinasi-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
            padding: 60px 20px;
        }
        
        .dest-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            transition: all 0.4s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            cursor: pointer;
            position: relative;
            animation: fadeInUp 0.6s ease-out backwards;
        }

        .dest-card[data-aos-delay="100"] { animation-delay: 0.1s; }
        .dest-card[data-aos-delay="200"] { animation-delay: 0.2s; }
        .dest-card[data-aos-delay="300"] { animation-delay: 0.3s; }
        
        .dest-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 50px rgba(0,0,0,0.2);
        }
        
        .dest-card:hover .dest-img {
            transform: scale(1.08);
        }
        
        .dest-img-wrapper {
            position: relative;
            overflow: hidden;
            height: 280px;
            background: linear-gradient(135deg, #e0e0e0, #f0f0f0);
        }
        
        .dest-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .dest-badge {
            position: absolute;
            top: 20px;
            right: 20px;
            background: #c6a43b;
            color: #1a1a1a;
            padding: 8px 16px;
            border-radius: 30px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 1px;
            z-index: 2;
            animation: scaleIn 0.5s ease-out 0.3s backwards;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        
        .dest-badge.geologi {
            background: #2c5f8a;
            color: white;
        }
        
        .dest-badge.budaya {
            background: #8B4513;
            color: white;
        }
        
        .dest-badge.petualangan {
            background: #e67e22;
            color: white;
        }
        
        .dest-badge.kota {
            background: #3498db;
            color: white;
        }
        
        .dest-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(to top, rgba(0,0,0,0.9), rgba(0,0,0,0.5), transparent);
            padding: 30px 20px 20px;
            opacity: 0;
            transition: opacity 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            transform: translateY(10px);
        }
        
        .dest-card:hover .dest-overlay {
            opacity: 1;
            transform: translateY(0);
        }
        
        .dest-overlay p {
            color: white;
            font-size: 0.85rem;
            margin-bottom: 8px;
            animation: fadeInUp 0.3s ease-out;
        }
        
        .dest-info {
            padding: 25px;
            text-align: center;
        }
        
        .dest-info h3 {
            font-size: 1.6rem;
            font-family: 'Cormorant Garamond', serif;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1a1a1a;
            transition: color 0.3s ease;
        }
        
        .dest-location {
            font-size: 0.8rem;
            color: #c6a43b;
            letter-spacing: 1px;
            margin-bottom: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 5px;
            transition: all 0.3s ease;
        }
        
        .dest-location i {
            font-size: 0.7rem;
        }
        
        .dest-desc {
            font-size: 0.85rem;
            color: #666;
            line-height: 1.6;
            margin-bottom: 20px;
            transition: color 0.3s ease;
        }
        
        .dest-tags {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 8px;
            margin-bottom: 20px;
        }
        
        .dest-tags span {
            background: #f5f4f0;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 0.7rem;
            color: #333;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .dest-tags span:hover {
            background: #c6a43b;
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-destinasi {
            display: inline-block;
            background: transparent;
            border: 2px solid #c6a43b;
            color: #c6a43b;
            padding: 10px 28px;
            border-radius: 50px;
            font-size: 0.7rem;
            font-weight: 600;
            letter-spacing: 2px;
            text-transform: uppercase;
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            text-decoration: none;
            cursor: pointer;
            position: relative;
            overflow: hidden;
        }

        .btn-destinasi::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: rgba(198, 164, 59, 0.1);
            border-radius: 50%;
            transform: translate(-50%, -50%);
            transition: width 0.6s, height 0.6s;
        }

        .btn-destinasi:hover::before {
            width: 300px;
            height: 300px;
        }
        
        .btn-destinasi:hover {
            background: #c6a43b;
            color: white;
            text-decoration: none;
            transform: translateY(-3px);
            box-shadow: 0 8px 20px rgba(198, 164, 59, 0.3);
        }

        .btn-destinasi:active {
            transform: translateY(-1px);
        }
        
        /* Feature Section */
        .feature-section {
            background: linear-gradient(135deg, #1a1a2e, #16213e);
            color: white;
            padding: 80px 20px;
        }
        
        .feature-item {
            text-align: center;
            padding: 30px 20px;
            transition: all 0.3s ease;
        }

        .feature-item:hover {
            transform: translateY(-5px);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            background: rgba(198, 164, 59, 0.15);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        
        .feature-item:hover .feature-icon {
            background: #c6a43b;
            transform: scale(1.15) rotateZ(5deg);
            box-shadow: 0 10px 25px rgba(198, 164, 59, 0.3);
        }
        
        .feature-icon i {
            font-size: 35px;
            color: #c6a43b;
            transition: color 0.3s ease;
        }
        
        .feature-item:hover .feature-icon i {
            color: white;
            transform: scale(1.2);
        }
        
        .feature-item h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 10px;
            transition: color 0.3s ease;
        }

        .feature-item:hover h4 {
            color: #c6a43b;
        }
        
        .feature-item p {
            font-size: 0.85rem;
            color: rgba(255,255,255,0.6);
            transition: color 0.3s ease;
            line-height: 1.6;
        }

        .feature-item:hover p {
            color: rgba(255,255,255,0.8);
        }
        
        /* Responsive - Tablet */
        @media (max-width: 768px) {
            .destinasi-hero {
                height: 40vh;
                margin-top: 60px;
            }

            .destinasi-hero h1 {
                font-size: 2rem;
            }

            .destinasi-hero p {
                font-size: 0.95rem;
            }

            .destinasi-grid {
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                gap: 20px;
                padding: 40px 15px;
            }
            
            .filter-btn {
                padding: 8px 18px;
                font-size: 0.75rem;
                margin: 4px 2px;
            }

            .dest-img-wrapper {
                height: 250px;
            }

            .dest-info {
                padding: 20px;
            }
            
            .dest-info h3 {
                font-size: 1.3rem;
            }

            .dest-desc {
                font-size: 0.8rem;
                margin-bottom: 15px;
            }

            .dest-tags {
                gap: 6px;
                margin-bottom: 15px;
            }

            .dest-tags span {
                font-size: 0.65rem;
                padding: 4px 10px;
            }

            .btn-destinasi {
                padding: 8px 24px;
                font-size: 0.65rem;
            }

            .feature-section {
                padding: 60px 20px;
            }

            .feature-icon {
                width: 70px;
                height: 70px;
            }

            .feature-icon i {
                font-size: 30px;
            }

            .feature-item h4 {
                font-size: 1.1rem;
            }

            .feature-item p {
                font-size: 0.8rem;
            }
        }

        /* Responsive - Mobile */
        @media (max-width: 576px) {
            .destinasi-hero {
                height: 35vh;
                margin-top: 56px;
                padding: 20px;
            }

            .destinasi-hero h1 {
                font-size: 1.5rem;
            }

            .destinasi-hero p {
                font-size: 0.85rem;
            }

            .destinasi-grid {
                grid-template-columns: 1fr;
                gap: 18px;
                padding: 30px 10px;
            }

            .filter-btn {
                padding: 6px 14px;
                font-size: 0.7rem;
                margin: 3px 2px;
                width: calc(50% - 5px);
            }

            .dest-img-wrapper {
                height: 220px;
            }

            .dest-info {
                padding: 18px;
            }

            .dest-info h3 {
                font-size: 1.15rem;
                margin-bottom: 6px;
            }

            .dest-location {
                font-size: 0.75rem;
                margin-bottom: 10px;
            }

            .dest-desc {
                font-size: 0.75rem;
                line-height: 1.5;
                margin-bottom: 12px;
            }

            .dest-tags {
                gap: 5px;
                margin-bottom: 12px;
            }

            .dest-tags span {
                font-size: 0.6rem;
                padding: 3px 8px;
            }

            .btn-destinasi {
                padding: 7px 20px;
                font-size: 0.6rem;
                letter-spacing: 1px;
            }

            .feature-section {
                padding: 40px 15px;
            }

            .row {
                margin: -10px;
            }

            [class*='col-'] {
                padding: 10px;
            }

            .feature-icon {
                width: 60px;
                height: 60px;
            }

            .feature-icon i {
                font-size: 25px;
            }

            .feature-item {
                padding: 20px 10px;
            }

            .feature-item h4 {
                font-size: 1rem;
                margin-bottom: 8px;
            }

            .feature-item p {
                font-size: 0.75rem;
            }
        }

        /* Extra small devices */
        @media (max-width: 480px) {
            .destinasi-hero {
                height: 30vh;
            }

            .destinasi-hero h1 {
                font-size: 1.25rem;
            }

            .destinasi-grid {
                padding: 20px 5px;
            }

            .filter-btn {
                padding: 5px 12px;
                font-size: 0.65rem;
                margin: 2px 1px;
            }

            .dest-img-wrapper {
                height: 200px;
            }

            .dest-info {
                padding: 15px;
            }

            .dest-info h3 {
                font-size: 1rem;
            }

            .dest-desc {
                font-size: 0.7rem;
            }

            .btn-destinasi {
                padding: 6px 16px;
                font-size: 0.55rem;
            }
        }
    </style>

    <!-- HERO SECTION -->
    <section class="destinasi-hero">
        <div class="container">
            <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">Destinasi Geosite</h1>
            <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">Jelajahi 4 Geosite Unggulan Caldera Danau Toba</p>
            <div data-aos="fade-up" data-aos-delay="200">
                <button class="filter-btn active" data-filter="all">Semua</button>
                <button class="filter-btn" data-filter="alam">Alam</button>
                <button class="filter-btn" data-filter="buatan">Buatan</button>
                <button class="filter-btn" data-filter="budaya">Budaya</button>
            </div>
        </div>
    </section>

    <!-- DESTINASI GRID -->
    <section class="container-fluid">
        <div class="destinasi-grid container" id="destinasiGrid">
            
            <!-- BALIGE -->
            <div class="dest-card" data-category="buatan kota" data-aos="fade-up" data-aos-delay="0">
                <div class="dest-img-wrapper">
                    <img src="{{ asset('uploads/A2.JPG') }}" class="dest-img" alt="Balige" onerror="this.onerror=null;this.src='{{ asset('uploads/del.jpeg') }}'">
                    <span class="dest-badge budaya">KOTA BUDAYA</span>
                    <div class="dest-overlay">
                        <p><i class="fas fa-map-marker-alt me-1"></i> Kabupaten Toba Samosir</p>
                        <p><i class="fas fa-clock me-1"></i> 08:00 - 18:00 WIB</p>
                    </div>
                </div>
                <div class="dest-info">
                    <h3>Balige</h3>
                    <div class="dest-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Tepi Danau Toba</span>
                    </div>
                    <p class="dest-desc">Ibu kota Kabupaten Toba Samosir dengan panorama Danau Toba yang spektakuler. Museum Batak TB Silalahi, Pantai Bulung Cina, dan kuliner khas Batak menanti Anda.</p>
                    <div class="dest-tags">
                        <span>🏛️ Museum Batak</span>
                        <span>🏖️ Pantai</span>
                        <span>🍴 Kuliner</span>
                        <span>📸 Spot Foto</span>
                    </div>
                    <a href="{{ route('informasi') }}" class="btn-destinasi">Informasi Kota →</a>
                </div>
            </div>
            
            <!-- MEAT -->
            <div class="dest-card" data-category="budaya sejarah" data-aos="fade-up" data-aos-delay="100">
                <div class="dest-img-wrapper">
                    <img src="{{ asset('uploads/A3.JPG') }}" class="dest-img" alt="Meat" onerror="this.onerror=null;this.src='{{ asset('uploads/del.jpeg') }}'">
                    <span class="dest-badge budaya">DESA ADAT</span>
                    <div class="dest-overlay">
                        <p><i class="fas fa-map-marker-alt me-1"></i> Pulau Sibandang</p>
                        <p><i class="fas fa-clock me-1"></i> 08:00 - 17:00 WIB</p>
                    </div>
                </div>
                <div class="dest-info">
                    <h3>Meat</h3>
                    <div class="dest-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Pulau Sibandang, Danau Toba</span>
                    </div>
                    <p class="dest-desc">Desa adat dengan makam Opung Raja Hunsa, situs bersejarah yang dihormati masyarakat setempat. Pusat pelestarian budaya Batak dengan rumah adat tradisional.</p>
                    <div class="dest-tags">
                        <span>🏛️ Makam Raja</span>
                        <span>🪶 Tari Tortor</span>
                        <span>🧵 Tenun Ulos</span>
                        <span>🏠 Rumah Adat</span>
                    </div>
                    <a href="{{ url('/geosite/meat') }}" class="btn-destinasi">Jelajahi →</a>
                </div>
            </div>
            
            <!-- BATU BAHISAN -->
            <div class="dest-card" data-category="alam fotografi" data-aos="fade-up" data-aos-delay="200">
                <div class="dest-img-wrapper">
                    <img src="{{ asset('uploads/A4.JPG') }}" class="dest-img" alt="Batu Bahisan" onerror="this.onerror=null;this.src='{{ asset('uploads/del.jpeg') }}'">
                    <span class="dest-badge geologi">GEOLOGI UNIK</span>
                    <div class="dest-overlay">
                        <p><i class="fas fa-map-marker-alt me-1"></i> Pulau Sibandang</p>
                        <p><i class="fas fa-clock me-1"></i> 06:00 - 18:00 WIB</p>
                    </div>
                </div>
                <div class="dest-info">
                    <h3>Batu Bahisan</h3>
                    <div class="dest-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Pulau Sibandang, Danau Toba</span>
                    </div>
                    <p class="dest-desc">Formasi batuan unik hasil erosi ribuan tahun. Spot favorit untuk fotografi landscape, sunrise, dan sunset dengan latar Danau Toba yang memukau.</p>
                    <div class="dest-tags">
                        <span>🗻 Formasi Batu</span>
                        <span>📸 Instagramable</span>
                        <span>🌅 Sunrise</span>
                        <span>🥾 Trekking</span>
                    </div>
                    <a href="{{ url('/geosite/batu-bahisan') }}" class="btn-destinasi">Jelajahi →</a>
                </div>
            </div>
            
            <!-- LIANG SIPEGE -->
            <div class="dest-card" data-category="alam petualangan" data-aos="fade-up" data-aos-delay="300">
                <div class="dest-img-wrapper">
                    <img src="{{ asset('uploads/A5.JPG') }}" class="dest-img" alt="Liang Sipege" onerror="this.onerror=null;this.src='{{ asset('uploads/del.jpeg') }}'">
                    <span class="dest-badge petualangan">PETUALANGAN</span>
                    <div class="dest-overlay">
                        <p><i class="fas fa-map-marker-alt me-1"></i> Pulau Sibandang</p>
                        <p><i class="fas fa-clock me-1"></i> 08:00 - 17:00 WIB</p>
                    </div>
                </div>
                <div class="dest-info">
                    <h3>Liang Sipege</h3>
                    <div class="dest-location">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Pulau Sibandang, Danau Toba</span>
                    </div>
                    <p class="dest-desc">Goa alami dengan stalaktit dan stalakmit yang menakjubkan. Cocok untuk petualangan caving, eksplorasi, dan edukasi geologi.</p>
                    <div class="dest-tags">
                        <span>🕳️ Goa Alami</span>
                        <span>⛰️ Stalaktit</span>
                        <span>🧗 Caving</span>
                        <span>📚 Edukasi</span>
                    </div>
                    <a href="{{ url('/geosite/liang-sipege') }}" class="btn-destinasi">Jelajahi →</a>
                </div>
            </div>
            
        </div>
    </section>

    <!-- FEATURE SECTION -->
    <section class="feature-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="display-5 fw-light mb-3">Mengapa Harus ke Geosite Toba?</h2>
                <div style="width: 60px; height: 3px; background: #c6a43b; margin: 0 auto;"></div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="0">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-mountain"></i>
                        </div>
                        <h4>Geologi Unik</h4>
                        <p>Formasi batuan vulkanik hasil letusan supervolcano 74.000 tahun lalu</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-landmark"></i>
                        </div>
                        <h4>Budaya Batak</h4>
                        <p>Warisan budaya yang masih terjaga, tarian tradisional, dan tenun ulos</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <h4>Spot Foto</h4>
                        <p>Destinasi Instagramable dengan pemandangan Danau Toba yang memukau</p>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-umbrella-beach"></i>
                        </div>
                        <h4>Wisata Seru</h4>
                        <p>Aktivitas trekking, caving, camping, dan wisata budaya</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        // Filter functionality
        const filterButtons = document.querySelectorAll('.filter-btn');
        const cards = document.querySelectorAll('.dest-card');
        
        filterButtons.forEach(button => {
            button.addEventListener('click', () => {
                // Update active button
                filterButtons.forEach(btn => btn.classList.remove('active'));
                button.classList.add('active');
                
                const filterValue = button.getAttribute('data-filter');
                
                cards.forEach(card => {
                    const category = card.getAttribute('data-category');
                    
                    if (filterValue === 'all' || category.includes(filterValue)) {
                        card.style.display = 'block';
                        card.style.animation = 'fadeInUp 0.5s ease';
                    } else {
                        card.style.display = 'none';
                    }
                });
            });
        });
    </script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <!-- AOS -->
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50
        });
    </script>

    @endsection