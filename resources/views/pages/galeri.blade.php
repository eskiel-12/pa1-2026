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
    background: #fff;
}

/* ===================== SPOTLIGHT SECTION ===================== */
.spotlight-section {
    padding: 80px 0;
}

.spotlight-header {
    text-align: center;
    margin-bottom: 40px;
}

.spotlight-header h1 {
    font-size: 34px;
    font-weight: 700;
}

.spotlight-header p {
    color: #777;
    font-size: 14px;
}

/* SCROLL */
.spotlight-wrapper {
    overflow-x: auto;
    scrollbar-width: none;
}

.spotlight-wrapper::-webkit-scrollbar {
    display: none;
}

.spotlight-track {
    display: flex;
    padding-left: 60px;
}

/* CARD */
.story-card {
    min-width: 260px;
    height: 380px;
    border-radius: 18px;
    overflow: hidden;
    position: relative;
    flex-shrink: 0;
    margin-left: -50px;
    cursor: pointer;
    box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    transition: 0.3s;
}

.story-card:first-child {
    margin-left: 0;
}

.story-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.story-text {
    position: absolute;
    bottom: 0;
    width: 100%;
    padding: 15px;
    color: #fff;
    background: linear-gradient(to top, rgba(0,0,0,0.7), transparent);
}

/* hover */
.story-card:hover {
    transform: translateY(-8px);
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

<!-- ===================== GALLERY ===================== -->
<section class="spotlight-section">
    <div class="container">

        <div class="spotlight-header">
            <h1>Stories in the spotlight</h1>
            <p>Cool things you might've missed</p>
        </div>

        <div class="spotlight-wrapper">
            <div class="spotlight-track">
                @if($galeri->count())
                    @foreach($galeri as $item)
                        <div class="story-card" onclick="openLightbox({{ $loop->index }})">
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
