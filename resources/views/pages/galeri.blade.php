@extends('layouts.app')

@section('title', 'Galeri - Geosite Danau Toba')

@section('content')

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    background: #faf8f2;
}

/* ===================== GALLERY HERO ===================== */
.gallery-hero {
    position: relative;
    overflow: hidden;
    padding: 90px 20px 70px;
    background: linear-gradient(135deg, rgba(0, 51, 102, 0.95), rgba(26, 74, 122, 0.90));
    color: #fff;
    border-radius: 36px;
    box-shadow: 0 35px 100px rgba(0, 0, 0, 0.18);
    margin-bottom: 48px;
}

.gallery-hero::before,
.gallery-hero::after {
    content: '';
    position: absolute;
    border-radius: 50%;
    filter: blur(80px);
    opacity: 0.28;
    pointer-events: none;
}

.gallery-hero::before {
    width: 300px;
    height: 300px;
    top: -90px;
    right: -60px;
    background: rgba(198,164,59,0.25);
}

.gallery-hero::after {
    width: 260px;
    height: 260px;
    bottom: -90px;
    left: -50px;
    background: rgba(255,255,255,0.12);
}

.gallery-hero-content {
    position: relative;
    max-width: 760px;
    margin: 0 auto;
    text-align: center;
    z-index: 1;
}

.gallery-hero .hero-label {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 18px;
    padding: 12px 20px;
    border-radius: 999px;
    background: rgba(255,255,255,0.16);
    color: #f7e09b;
    font-size: 0.85rem;
    letter-spacing: 0.18em;
    text-transform: uppercase;
}

.gallery-hero h2 {
    font-size: 3.4rem;
    margin: 0;
    line-height: 1.03;
    letter-spacing: -1px;
}

.gallery-hero p {
    max-width: 640px;
    margin: 20px auto 0;
    color: rgba(255,255,255,0.86);
    font-size: 1rem;
    line-height: 1.8;
}

.gallery-hero .hero-btn {
    display: inline-flex;
    align-items: center;
    gap: 12px;
    margin-top: 32px;
    padding: 14px 32px;
    color: #10293e;
    background: #f7e09b;
    border-radius: 999px;
    font-weight: 700;
    text-decoration: none;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.gallery-hero .hero-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 18px 32px rgba(0,0,0,0.12);
}

/* ===================== SPOTLIGHT SECTION ===================== */
.spotlight-section {
    padding: 0;
    background: transparent;
}

.spotlight-header {
    text-align: center;
    margin-bottom: 26px;
    max-width: 720px;
    margin-left: auto;
    margin-right: auto;
}

.spotlight-header h1 {
    font-size: 32px;
    font-weight: 700;
    letter-spacing: -0.4px;
    line-height: 1.08;
}

.spotlight-header p {
    color: #5e5e5e;
    font-size: 15px;
    margin-top: 10px;
    line-height: 1.75;
}

.spotlight-wrapper {
    overflow: visible;
    padding: 0 0 20px;
}

.spotlight-track {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 32px;
    align-items: stretch;
}

/* CARD */
.story-card {
    width: 100%;
    min-height: 420px;
    border-radius: 30px;
    overflow: hidden;
    position: relative;
    cursor: pointer;
    box-shadow: 0 26px 85px rgba(0,0,0,0.12), 0 14px 34px rgba(0,0,0,0.08);
    transition: transform 0.35s ease, box-shadow 0.35s ease;
    background: #ffffff;
    border: 1px solid rgba(0,0,0,0.08);
}

.story-card::after {
    content: '';
    position: absolute;
    top: 18px;
    left: 18px;
    width: 64px;
    height: 4px;
    background: linear-gradient(90deg, #c6a43b, #f0d678);
    border-radius: 999px;
    box-shadow: 0 6px 20px rgba(198,164,59,0.15);
}

.story-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.45s ease, filter 0.35s ease;
}

.story-card::before {
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(180deg, rgba(255,255,255,0.04) 0%, rgba(0,0,0,0.10) 100%);
    pointer-events: none;
}

.story-badge {
    position: absolute;
    top: 22px;
    left: 22px;
    z-index: 2;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 10px 16px;
    background: rgba(255,255,255,0.92);
    color: #10293e;
    border-radius: 999px;
    font-size: 0.75rem;
    font-weight: 700;
    letter-spacing: 0.08em;
    text-transform: uppercase;
    box-shadow: 0 12px 30px rgba(0,0,0,0.12);
}

.story-text {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 26px 24px 24px;
    color: #ffffff;
    background: linear-gradient(to top, rgba(14, 18, 39, 0.92), rgba(14, 18, 39, 0.04));
    backdrop-filter: blur(4px);
}

.story-text h3 {
    font-size: 1.18rem;
    margin-bottom: 8px;
}

.story-text p {
    font-size: 0.95rem;
    color: rgba(255,255,255,0.92);
    line-height: 1.75;
    margin: 0;
}

.story-text h3 {
    font-size: 1.15rem;
    margin-bottom: 8px;
    letter-spacing: -0.3px;
}

.story-text p {
    font-size: 0.95rem;
    color: rgba(255,255,255,0.9);
    line-height: 1.75;
    margin: 0;
}

/* hover */
.story-card:hover {
    transform: translateY(-14px);
    box-shadow: 0 38px 110px rgba(0,0,0,0.22), 0 20px 48px rgba(0,0,0,0.14);
}

.story-card:hover img {
    transform: scale(1.06);
    filter: brightness(1.10) saturate(1.08);
}

/* ===================== LIGHTBOX ===================== */
.lightbox {
    position: fixed;
    inset: 0;
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 99999;

    /* blur background */
    background: rgba(0,0,0,0.6);
    backdrop-filter: blur(10px);

    animation: fadeIn 0.3s ease;
}

.lightbox.show {
    display: flex;
}

@keyframes fadeIn {
    from { opacity: 0; }
    to { opacity: 1; }
}

.lightbox-content {
    position: relative;
    text-align: center;
    animation: zoomIn 0.25s ease;
}

@keyframes zoomIn {
    from { transform: scale(0.8); opacity: 0; }
    to { transform: scale(1); opacity: 1; }
}

.lightbox img {
    max-width: 90vw;
    max-height: 80vh;
    border-radius: 12px;
    transition: opacity 0.3s ease, transform 0.3s ease;
    opacity: 1;
}

.lightbox img.fade-out {
    opacity: 0;
    transform: scale(0.96);
}

/* description */
.lightbox-desc {
    margin-top: 15px;
    color: #fff;
    font-size: 18px;
    font-weight: 500;
    background: rgba(0,0,0,0.72);
    padding: 15px;
    border-radius: 10px;
    max-width: 80vw;
    margin-left: auto;
    margin-right: auto;
    line-height: 1.6;
}

/* close */
.close {
    position: absolute;
    top: 20px;
    right: 30px;
    font-size: 35px;
    color: white;
    cursor: pointer;
}

/* nav button */
.nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    font-size: 40px;
    color: white;
    cursor: pointer;
    user-select: none;
    padding: 14px 18px;
    border-radius: 50%;
    background: rgba(0, 0, 0, 0.45);
    border: 1px solid rgba(255, 255, 255, 0.18);
    transition: background 0.2s ease, transform 0.2s ease;
}

.nav:hover {
    background: rgba(255, 255, 255, 0.18);
    transform: translateY(-50%) scale(1.08);
}

.nav.left { left: 20px; }
.nav.right { right: 20px; }

@media (max-width: 768px) {
    .story-card {
        min-width: 200px;
        height: 300px;
    }
}
</style>

<section class="gallery-hero">
    <div class="gallery-hero-content">
        <span class="hero-label">Travel Highlights</span>
        <h2>Galeri Wisata Danau Toba yang Memukau</h2>
        <p>Jelajahi momen terbaik dari destinasi, budaya, dan petualangan; foto-foto ini dirancang untuk menginspirasi perjalanan Anda.</p>
        <a href="#gallery-cards" class="hero-btn">Telusuri Galeri</a>
    </div>
</section>

<!-- ===================== GALLERY ===================== -->
<section id="gallery-cards" class="spotlight-section">
    <div class="container">

        <div class="spotlight-header">
            <h1>Galeri Keindahan Wisata</h1>
            <p>Kumpulan foto destinasi unggulan Danau Toba dan pengalaman wisata yang dirancang untuk memberikan kesan profesional dan estetis.</p>
        </div>

        <div class="spotlight-wrapper">
            <div class="spotlight-track">
                @if($galeri->count())
                    @foreach($galeri as $item)
                        <div class="story-card" onclick="openLightbox({{ $loop->index }})">
                            <div class="story-badge">Eksplorasi</div>
                            <img src="{{ $item->gambar_url }}" alt="{{ $item->judul }}">
                            <div class="story-text">
                                <h3>{{ $item->judul }}</h3>
                                <p>{{ \Illuminate\Support\Str::limit($item->deskripsi ?? '', 60) }}</p>
                            </div>
                        </div>
                    @endforeach
                @else
                    <div class="p-4 text-center" style="width:100%;">
                        <p>Tidak ada foto galeri saat ini. Kembali lagi nanti.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="mt-4">
            {{ $galeri->links() }}
        </div>
    </div>
</section>

<audio id="bgMusic" loop preload="auto">
    <source src="{{ asset('audio/GONDANG HASAPI BERTUA SITANGGANG SULIM TONGOSAN.mp4') }}" type="audio/mp4">
    Your browser does not support the audio element.
</audio>

<!-- ===================== LIGHTBOX ===================== -->
<div class="lightbox" id="lightbox" onclick="outsideClick(event)">
    
    <span class="close" onclick="closeLightbox()">&times;</span>

    <span class="nav left" onclick="prevImage(event)" aria-label="Previous image">&#10094;</span>
    <span class="nav right" onclick="nextImage(event)" aria-label="Next image">&#10095;</span>

    <div class="lightbox-content">
        <img id="lightbox-img">
        <div class="lightbox-desc" id="lightbox-desc"></div>
    </div>

</div>

<!-- ===================== SCRIPT ===================== -->
<script>
const images = @json($galeri->map(function($item) {
    return [
        'src' => $item->gambar_url,
        'desc' => $item->judul ? $item->judul . ($item->deskripsi ? ' - ' . $item->deskripsi : '') : ($item->deskripsi ?? 'Galeri Foto'),
    ];
}));

const bgMusic = document.getElementById('bgMusic');
let currentIndex = 0;
let isTransitioning = false;

function tryPlayMusic() {
    if (!bgMusic) return;
    if (bgMusic.paused) {
        bgMusic.volume = 0.35;
        bgMusic.play().catch(() => {
            // browser menolak autoplay, tetap tenang
        });
    }
}

document.body.addEventListener('click', function() {
    tryPlayMusic();
}, { once: true });

function openLightbox(index){
    currentIndex = index;
    updateLightbox(true);
    document.getElementById('lightbox').classList.add('show');
    tryPlayMusic();
}

function updateLightbox(isOpen = false){
    const img = document.getElementById('lightbox-img');
    const desc = document.getElementById('lightbox-desc');
    const nextSrc = images[currentIndex].src;
    const nextDesc = images[currentIndex].desc;

    if (!isOpen) {
        isTransitioning = true;
        img.classList.add('fade-out');
        setTimeout(() => {
            img.src = nextSrc;
            desc.innerText = nextDesc;
            img.classList.remove('fade-out');
            isTransitioning = false;
        }, 220);
    } else {
        img.src = nextSrc;
        desc.innerText = nextDesc;
        isTransitioning = false;
    }
}

function closeLightbox(){
    document.getElementById('lightbox').classList.remove('show');
}

/* next prev */
function nextImage(e){
    if (e) e.stopPropagation();
    if (isTransitioning) return;
    currentIndex = (currentIndex + 1) % images.length;
    updateLightbox();
}

function prevImage(e){
    if (e) e.stopPropagation();
    if (isTransitioning) return;
    currentIndex = (currentIndex - 1 + images.length) % images.length;
    updateLightbox();
}

/* klik background */
function outsideClick(e){
    if(e.target.id === 'lightbox') closeLightbox();
}

/* ================= SWIPE MOBILE ================= */
let startX = 0;

document.getElementById('lightbox').addEventListener('touchstart', e => {
    startX = e.touches[0].clientX;
});

document.getElementById('lightbox').addEventListener('touchend', e => {
    let endX = e.changedTouches[0].clientX;

    if(startX - endX > 50){
        nextImage(e);
    } else if(endX - startX > 50){
        prevImage(e);
    }
});

document.addEventListener('keydown', function(e) {
    if (!document.getElementById('lightbox').classList.contains('show')) return;
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
});
</script>

@endsection
