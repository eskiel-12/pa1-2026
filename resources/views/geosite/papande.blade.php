<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Papande - Geosite Danau Toba</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Cormorant+Garamond:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; background: #fafaf8; }

        .navbar { position: fixed; top: 0; left: 0; width: 100%; z-index: 1000; background: rgba(255,255,255,0.95); backdrop-filter: blur(10px); border-bottom: 1px solid rgba(0,0,0,0.05); padding: 16px 0; }
        .nav-container { max-width: 1200px; margin: 0 auto; padding: 0 24px; display: flex; justify-content: space-between; align-items: center; }
        .nav-logo { display: flex; align-items: center; gap: 16px; }
        .flag-img { width: 70px; height: auto; border-radius: 5px; }
        .logo-divider { width: 1px; height: 30px; background: #ddd; }
        .del-img { width: 35px; height: auto; border-radius: 5px; }
        .logo-text h4 { font-size: 0.9rem; font-weight: 700; color: #1a1a1a; }
        .logo-text p { font-size: 0.4rem; color: #888; }
        .nav-menu { display: flex; gap: 32px; align-items: center; }
        .nav-link { font-size: 0.7rem; letter-spacing: 0.15em; text-transform: uppercase; text-decoration: none; color: #444; font-weight: 500; transition: 0.3s; padding: 6px 0; }
        .nav-link:hover { color: #c6a43b; }
        .home-btn { background: #1a1a1a; color: white !important; padding: 8px 22px; border-radius: 40px; }
        .home-btn:hover { background: #c6a43b; color: #1a1a1a !important; }

        .hamburger { display: none; cursor: pointer; background: rgba(255,255,255,0.96); padding: 10px 14px; border-radius: 50px; border: 1px solid rgba(0,0,0,0.05); }
        .hamburger span { display: block; width: 22px; height: 2px; background: #1a1a1a; margin: 5px 0; }
        .mobile-overlay { position: fixed; top: 0; right: -100%; width: 280px; height: 100vh; background: rgba(255,255,255,0.98); backdrop-filter: blur(12px); z-index: 1001; transition: right 0.3s ease; padding: 80px 30px 30px; }
        .mobile-overlay.active { right: 0; }
        .mobile-close { position: absolute; top: 20px; right: 20px; font-size: 28px; cursor: pointer; color: #555; }
        .mobile-link { display: block; font-size: 0.85rem; letter-spacing: 0.15em; text-transform: uppercase; text-decoration: none; color: #444; font-weight: 500; padding: 15px 0; border-bottom: 1px solid #eee; text-align: center; }
        .mobile-link:hover { color: #c6a43b; }
        .mobile-home { background: #1a1a1a; color: white !important; border-radius: 40px; margin-bottom: 10px; }

        .hero { height: 60vh; min-height: 450px; background: url('{{ asset('uploads/A6.JPG') }}'); background-size: cover; background-position: center; display: flex; align-items: center; justify-content: center; text-align: center; color: white; margin-top: 70px; position: relative; }
        .hero::before { content: ''; position: absolute; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.3); z-index: 1; }
        .hero > div { position: relative; z-index: 2; }
        .hero-title { font-size: 4rem; font-weight: 600; font-family: 'Cormorant Garamond', serif; margin-bottom: 12px; text-shadow: 0 2px 5px rgba(0,0,0,0.2); }
        .hero-subtitle { font-size: 0.8rem; letter-spacing: 0.2em; text-transform: uppercase; text-shadow: 0 1px 3px rgba(0,0,0,0.2); }

        .section { padding: 70px 0; }
        .bg-light { background: #f5f4f0; }
        .container { max-width: 1100px; margin: 0 auto; padding: 0 24px; }
        .section-title { text-align: center; margin-bottom: 50px; }
        .section-title h2 { font-size: 2.2rem; font-family: 'Cormorant Garamond', serif; margin-bottom: 12px; }
        .divider { width: 50px; height: 2px; background: #c6a43b; margin: 0 auto; }

        .sejarah-item { display: flex; align-items: center; gap: 50px; margin-bottom: 50px; flex-wrap: wrap; }
        .sejarah-item.reverse { flex-direction: row-reverse; }
        .sejarah-text { flex: 1; }
        .sejarah-text p { color: #555; line-height: 1.9; font-size: 1rem; }
        .sejarah-image { flex: 1; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.08); }
        .sejarah-image img { width: 100%; height: 280px; object-fit: cover; }

        .grid-3 { display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; }
        .grid-2 { display: grid; grid-template-columns: repeat(2, 1fr); gap: 25px; }
        .card { background: white; border-radius: 14px; overflow: hidden; box-shadow: 0 4px 12px rgba(0,0,0,0.05); border: 1px solid #e0e8e8; transition: 0.3s; }
        .card:hover { transform: translateY(-5px); box-shadow: 0 12px 25px rgba(0,0,0,0.1); }
        .card-img { width: 100%; height: 170px; object-fit: cover; }
        .card-content { padding: 18px; }
        .card-content h3 { font-size: 1.1rem; font-weight: 700; margin-bottom: 6px; color: #2c5f8a; }
        .card-content p { color: #666; font-size: 0.8rem; margin-bottom: 8px; }
        .card-location, .card-price, .card-contact { font-size: 0.7rem; color: #888; margin-top: 5px; }
        .card-price { color: #c6a43b; font-weight: 600; }

        .fasilitas-item { background: white; border-radius: 12px; overflow: hidden; text-align: center; border: 1px solid #e0e8e8; transition: 0.3s; }
        .fasilitas-item:hover { transform: translateY(-3px); box-shadow: 0 8px 20px rgba(0,0,0,0.1); }
        .fasilitas-img { width: 100%; height: 130px; object-fit: cover; }
        .fasilitas-content { padding: 14px; }
        .fasilitas-content h4 { font-size: 0.9rem; font-weight: 700; color: #2c5f8a; }
        .fasilitas-content p { font-size: 0.7rem; color: #777; }
        .fasilitas-price { color: #c6a43b; font-weight: 600; font-size: 0.7rem; margin-top: 5px; }

        .galeri-grid { display: grid; grid-template-columns: repeat(4, 1fr); gap: 15px; margin-top: 30px; }
        .galeri-item { aspect-ratio: 1/1; overflow: hidden; border-radius: 12px; cursor: pointer; background: #e8e8e8; }
        .galeri-item img { width: 100%; height: 100%; object-fit: cover; transition: 0.3s; }

        .maps-section { background: white; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .maps-container iframe { width: 100%; height: 350px; border: 0; }
        .rute-info { background: #2c5f8a; color: white; padding: 20px; display: flex; justify-content: space-between; flex-wrap: wrap; gap: 15px; }
        .rute-item { flex: 1; text-align: center; }
        .rute-item h4 { font-size: 0.75rem; text-transform: uppercase; margin-bottom: 6px; }
        .rute-item p { font-size: 0.7rem; }

        .cta { background: #1a1a1a; padding: 60px 0; text-align: center; color: white; }
        .cta h3 { font-size: 1.8rem; font-family: 'Cormorant Garamond', serif; margin-bottom: 15px; }
        .cta .divider { margin: 0 auto 20px; }
        .cta p { opacity: 0.7; margin-bottom: 30px; }
        .cta-btn { display: inline-block; background: #c6a43b; color: #1a1a1a; padding: 12px 32px; font-size: 0.7rem; letter-spacing: 0.2em; text-transform: uppercase; border-radius: 40px; text-decoration: none; font-weight: 500; transition: 0.3s; }
        .cta-btn:hover { background: white; transform: translateY(-2px); }

        .footer { background: #1a1a1a; padding: 35px 0 25px; text-align: center; }
        .footer-container { max-width: 1100px; margin: 0 auto; padding: 0 20px; }
        .footer-logo { display: flex; justify-content: center; align-items: center; gap: 16px; margin-bottom: 20px; }
        .footer-logo-img { width: 40px; border-radius: 5px; }
        .footer-logo-divider { width: 1px; height: 25px; background: rgba(255,255,255,0.2); }
        .footer-logo-text h4 { font-size: 0.8rem; color: white; }
        .footer-logo-text p { font-size: 0.4rem; color: rgba(255,255,255,0.5); }
        .footer-nav { display: flex; justify-content: center; gap: 25px; flex-wrap: wrap; margin-bottom: 20px; }
        .footer-nav a { color: rgba(255,255,255,0.6); text-decoration: none; font-size: 0.65rem; letter-spacing: 0.1em; text-transform: uppercase; transition: 0.3s; }
        .footer-nav a:hover { color: #c6a43b; }
        .footer-copyright { font-size: 0.6rem; color: rgba(255,255,255,0.3); }
        img { width: 100%; height: 100%; object-fit: cover; display: block; }

        .lightbox { display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0,0,0,0.95); z-index: 10002; justify-content: center; align-items: center; cursor: pointer; }
        .lightbox.active { display: flex; }
        .lightbox img { max-width: 90%; max-height: 85vh; border-radius: 4px; }
        .lightbox-close { position: absolute; top: 20px; right: 30px; color: white; font-size: 32px; cursor: pointer; }

        @media (max-width: 768px) { .nav-menu { display: none; } .hamburger { display: block; } .hero-title { font-size: 2.5rem; } .grid-3, .grid-2 { grid-template-columns: 1fr; } .galeri-grid { grid-template-columns: repeat(2, 1fr); } .sejarah-item, .sejarah-item.reverse { flex-direction: column; text-align: center; } }
    </style>
</head>
<body>

<div class="navbar" id="navbar">
    <div class="nav-container">
        <div class="nav-logo">
            <img src="{{ asset('uploads/logobankindonesia.jpeg') }}" alt="Bank Indonesia" class="flag-img">
            <div class="logo-divider"></div>
            <img src="{{ asset('uploads/del.jpeg') }}" alt="Del" class="del-img">
            <div class="logo-divider"></div>
            <div class="logo-text"><h4>GEOTOBA</h4><p>Geopark Danau Toba</p></div>
        </div>
        <div class="nav-menu">
            <a href="{{ url('/') }}" class="nav-link home-btn">Home</a>
            <a href="#sejarah" class="nav-link">Sejarah</a>
            <a href="#umkm" class="nav-link">UMKM</a>
            <a href="#penginapan" class="nav-link">Penginapan</a>
            <a href="#fasilitas" class="nav-link">Fasilitas</a>
            <a href="#galeri" class="nav-link">Galeri</a>
            <a href="#lokasi" class="nav-link">Lokasi</a>
        </div>
        <div class="hamburger" id="hamburger"><span></span><span></span><span></span></div>
    </div>
</div>

<div class="mobile-overlay" id="mobileOverlay">
    <div class="mobile-close" id="mobileClose">&times;</div>
    <a href="{{ url('/') }}" class="mobile-link mobile-home">Home</a>
    <a href="#sejarah" class="mobile-link">Sejarah</a>
    <a href="#umkm" class="mobile-link">UMKM</a>
    <a href="#penginapan" class="mobile-link">Penginapan</a>
    <a href="#fasilitas" class="mobile-link">Fasilitas</a>
    <a href="#galeri" class="mobile-link">Galeri</a>
    <a href="#lokasi" class="mobile-link">Lokasi</a>
</div>

<section class="hero">
    <div>
        <h1 class="hero-title">Papande</h1>
        <p class="hero-subtitle">Pulau Sibandang - Danau Toba</p>
    </div>
</section>

<section id="sejarah" class="section">
    <div class="container">
        <div class="section-title"><h2>Sejarah</h2><div class="divider"></div></div>
        <div class="sejarah-item">
            <div class="sejarah-image"><img src="{{ asset('uploads/A6.JPG') }}" alt="Papande"></div>
            <div class="sejarah-text"><p>Papande adalah salah satu desa di Kecamatan Muara, Kabupaten Tapanuli Utara, yang terletak di Pulau Sibandang. Desa ini memiliki lingkungan yang asri dan tenang dengan masyarakat yang ramah.</p></div>
        </div>
        <div class="sejarah-item reverse">
            <div class="sejarah-image"><img src="{{ asset('uploads/A3.JPG') }}"></div>
            <div class="sejarah-text"><p>Masyarakat Papande sebagian besar bekerja di bidang pertanian dan perikanan. Kehidupan sosialnya masih kental dengan budaya Batak dan nilai-nilai adat yang kuat.</p></div>
        </div>
        <div class="sejarah-item">
            <div class="sejarah-image"><img src="{{ asset('uploads/A4.JPG') }}"></div>
            <div class="sejarah-text"><p>Lanskap Papande menawarkan ketenangan dengan perbukitan hijau, udara segar, dan keramahan penduduk lokal yang menciptakan pengalaman wisata yang autentik.</p></div>
        </div>
    </div>
</section>

<section id="umkm" class="section bg-light">
    <div class="container">
        <div class="section-title"><h2>UMKM Lokal</h2><div class="divider"></div></div>
        <div class="grid-3">
            <div class="card"><img src="{{ asset('uploads/del.jpeg') }}" class="card-img"><div class="card-content"><h3>Tenun Ulos</h3><p>Kain tenun khas Batak.</p><div class="card-location"><i class="fas fa-map-marker-alt"></i> Desa Papande</div></div></div>
            <div class="card"><img src="{{ asset('uploads/A1.jpeg') }}" class="card-img"><div class="card-content"><h3>Anyaman Bambu</h3><p>Kerajinan tangan dari bambu.</p><div class="card-location"><i class="fas fa-map-marker-alt"></i> Desa Papande</div></div></div>
            <div class="card"><img src="{{ asset('uploads/A2.JPG') }}" class="card-img"><div class="card-content"><h3>Madu Hutan</h3><p>Madu alami dari hutan sekitar.</p><div class="card-location"><i class="fas fa-map-marker-alt"></i> Kawasan Hutan</div></div></div>
        </div>
    </div>
</section>

<section id="penginapan" class="section">
    <div class="container">
        <div class="section-title"><h2>Penginapan</h2><div class="divider"></div></div>
        <div class="grid-3">
            <div class="card"><img src="{{ asset('uploads/A3.JPG') }}" class="card-img"><div class="card-content"><h3>Homestay Papande</h3><p>Menginap dengan suasana pedesaan.</p></div></div>
            <div class="card"><img src="{{ asset('uploads/A4.JPG') }}" class="card-img"><div class="card-content"><h3>Lake View Homestay</h3><p>Pemandangan Danau Toba.</p></div></div>
            <div class="card"><img src="{{ asset('uploads/A5.JPG') }}" class="card-img"><div class="card-content"><h3>Papande Lodge</h3><p>Tradisional dengan fasilitas modern.</p></div></div>
        </div>
    </div>
</section>

<section id="fasilitas" class="section bg-light">
    <div class="container">
        <div class="section-title"><h2>Fasilitas</h2><div class="divider"></div></div>
        <div class="grid-2">
            <div class="fasilitas-item"><img src="{{ asset('uploads/A1.jpeg') }}" class="fasilitas-img"><div class="fasilitas-content"><h4>Area Parkir</h4><p>Luas dan aman</p><div class="fasilitas-price">Gratis</div></div></div>
            <div class="fasilitas-item"><img src="{{ asset('uploads/A2.JPG') }}" class="fasilitas-img"><div class="fasilitas-content"><h4>Toilet</h4><p>Bersih</p><div class="fasilitas-price">Gratis</div></div></div>
            <div class="fasilitas-item"><img src="{{ asset('uploads/A3.JPG') }}" class="fasilitas-img"><div class="fasilitas-content"><h4>Warung Makan</h4><p>Kuliner khas</p><div class="fasilitas-price">Mulai Rp 15.000</div></div></div>
            <div class="fasilitas-item"><img src="{{ asset('uploads/A4.JPG') }}" class="fasilitas-img"><div class="fasilitas-content"><h4>Spot Foto</h4><p>View danau</p><div class="fasilitas-price">Gratis</div></div></div>
        </div>
    </div>
</section>

<section id="galeri" class="section">
    <div class="container">
        <div class="section-title"><h2>Galeri</h2><div class="divider"></div></div>
        <div class="galeri-grid">
            <div class="galeri-item"><img src="{{ asset('uploads/A1.jpeg') }}"></div>
            <div class="galeri-item"><img src="{{ asset('uploads/A2.JPG') }}"></div>
            <div class="galeri-item"><img src="{{ asset('uploads/A3.JPG') }}"></div>
            <div class="galeri-item"><img src="{{ asset('uploads/A4.JPG') }}"></div>
            <div class="galeri-item"><img src="{{ asset('uploads/A5.JPG') }}"></div>
            <div class="galeri-item"><img src="{{ asset('uploads/A6.JPG') }}"></div>
        </div>
    </div>
</section>

<section id="lokasi" class="section bg-light">
    <div class="container">
        <div class="section-title"><h2>Lokasi & Rute</h2><div class="divider"></div></div>
        <div class="maps-section">
            <div class="maps-container"><iframe src="https://maps.google.com/maps?q=Papande,+Tapanuli+Utara&output=embed" allowfullscreen loading="lazy"></iframe></div>
            <div class="rute-info">
                <div class="rute-item"><h4>Motor</h4><p>Dari dermaga Muara ke Papande (30 menit)</p></div>
                <div class="rute-item"><h4>Jalan Kaki</h4><p>Tersedia jalur trekking desa</p></div>
                <div class="rute-item"><h4>Estimasi</h4><p>Dari Balige: sekitar 2 jam</p></div>
            </div>
        </div>
    </div>
</section>

<section class="cta">
    <div class="container">
        <h3>Kunjungi Papande Sekarang</h3>
        <div class="divider"></div>
        <p>Jelajahi keindahan alam dan budaya di Geopark Danau Toba</p>
        <a href="{{ url('/') }}" class="cta-btn">Kembali ke Beranda</a>
    </div>
</section>

<footer class="footer">
    <div class="footer-container">
        <div class="footer-logo">
            <img src="{{ asset('uploads/logobankindonesia.jpeg') }}" class="footer-logo-img">
            <div class="footer-logo-divider"></div>
            <img src="{{ asset('uploads/del.jpeg') }}" class="footer-logo-img">
            <div class="footer-logo-divider"></div>
            <div class="footer-logo-text"><h4>GEOTOBA</h4><p>Geopark Danau Toba</p></div>
        </div>
        <div class="footer-nav">
            <a href="{{ url('/') }}">Home</a>
            <a href="#sejarah">Sejarah</a>
            <a href="#umkm">UMKM</a>
            <a href="#penginapan">Penginapan</a>
            <a href="#fasilitas">Fasilitas</a>
            <a href="#galeri">Galeri</a>
            <a href="#lokasi">Lokasi</a>
        </div>
        <div class="footer-copyright"><p>&copy; 2026 GEOTOBA. All rights reserved.</p></div>
    </div>
    <p style="font-size: 0.6rem; color: rgba(255,255,255,0.3);">Musik: D'Bamboo Official</p>
</footer>

<div class="lightbox" id="lightbox">
    <div class="lightbox-close" onclick="closeLightbox()">&times;</div>
    <img id="lightboxImg">
</div>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

<script>
    var hamburger = document.getElementById('hamburger');
    var mobileOverlay = document.getElementById('mobileOverlay');
    var mobileClose = document.getElementById('mobileClose');
    if (hamburger) { hamburger.addEventListener('click', function() { mobileOverlay.classList.add('active'); document.body.style.overflow = 'hidden'; }); }
    function closeMenu() { mobileOverlay.classList.remove('active'); document.body.style.overflow = ''; }
    if (mobileClose) mobileClose.addEventListener('click', closeMenu);
    document.querySelectorAll('.mobile-link').forEach(function(l) { l.addEventListener('click', closeMenu); });

    var lightbox = document.getElementById('lightbox');
    if (lightbox) {
        document.querySelectorAll('.galeri-item img').forEach(function(img) { img.addEventListener('click', function() { lightbox.classList.add('active'); document.getElementById('lightboxImg').src = img.src; }); });
        function closeLightbox() { lightbox.classList.remove('active'); }
        lightbox.addEventListener('click', function(e) { if (e.target === lightbox) closeLightbox(); });
    }

    document.querySelectorAll('.nav-link[href^="#"], .mobile-link[href^="#"]').forEach(function(a) { a.addEventListener('click', function(e) { e.preventDefault(); var t = document.querySelector(this.getAttribute('href')); if (t) window.scrollTo({ top: t.offsetTop - 80, behavior: 'smooth' }); }); });
</script>
</body>
</html>
