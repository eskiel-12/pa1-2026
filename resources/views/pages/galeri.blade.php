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
    border-radius: 20px;
    overflow: hidden;
    position: relative;
    flex-shrink: 0;
    margin-left: -50px;
    cursor: pointer;
    box-shadow: 0 10px 28px rgba(0,0,0,0.12);
    transition: transform 0.45s ease, box-shadow 0.45s ease;
}

.story-card:first-child {
    margin-left: 0;
}

.story-card img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.story-card::after{
    content: '';
    position: absolute;
    inset: 0;
    background: linear-gradient(to top, rgba(255,255,255,0.16), rgba(255,255,255,0.00));
    transition: background 0.25s ease;
}

.story-text {
    position: absolute;
    bottom: 18px;
    left: 18px;
    right: 18px;
    padding: 14px 16px;
    color: #0f172a;
    background: rgba(255,255,255,0.90);
    border-radius: 16px;
    box-shadow: 0 10px 26px rgba(15,23,42,0.08);
    backdrop-filter: blur(10px);
}

.story-text h3 {
    margin: 0;
    font-size: 1rem;
    line-height: 1.3;
    font-weight: 700;
}

/* hover */
.story-card:hover {
    transform: translateY(-5px) scale(1.01);
    box-shadow: 0 14px 36px rgba(0,0,0,0.11);
}

/* ===================== LIGHTBOX ===================== */

.lightbox {
    position: fixed;
    inset: 0;
    display: none;
    justify-content: center;
    align-items: center;
    z-index: 99999;
    background: rgba(255,255,255,0.78);
    backdrop-filter: blur(8px) saturate(130%);
    animation: fadeIn 0.34s ease-out;
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
    display: flex;
    gap: 24px;
    align-items: center;
    animation: zoomIn 0.3s ease-out;
    padding: 18px;
    max-width: 1100px;
    border-radius: 24px;
    overflow: hidden;
}

@keyframes zoomIn {
    from { transform: translateY(12px) scale(0.98); opacity: 0; }
    to { transform: translateY(0) scale(1); opacity: 1; }
}

.lightbox img {
    /* shrink image to leave room for full description on the right */
    width: 48%;
    max-width: 48%;
    max-height: 78vh;
    object-fit: contain;
    border-radius: 12px;
    transition: opacity 0.3s ease, transform 0.3s ease;
    opacity: 1;
    box-shadow: 0 20px 50px rgba(15,23,42,0.18);
}

.lightbox img.fade-out {
    opacity: 0;
    transform: scale(0.96);
}

/* description (right column) */

.lightbox-desc {
    width: 48%;
    color: #04263b;
    font-size: 1.08rem;
    font-weight: 600;
    background: linear-gradient(180deg, rgba(255,255,255,0.98), rgba(250,250,252,0.98));
    padding: 24px;
    border-radius: 12px;
    box-shadow: 0 16px 40px rgba(15,23,42,0.14);
    line-height: 1.7;
    overflow: auto;
}

.lightbox-desc .body {
    max-height: 220px;
    overflow: auto;
    margin-top: 8px;
    color: inherit;
    font-weight: 500;
}

.lightbox-desc .show-more-btn {
    display: inline-block;
    margin-top: 12px;
    background: linear-gradient(90deg,#3a7bd5,#a63fa1);
    color: #fff;
    padding: 8px 12px;
    border-radius: 8px;
    font-size: 0.9rem;
    cursor: pointer;
    border: none;
}

.lightbox-desc.expanded .body { max-height: 60vh; }
.lightbox-desc.dark { background: rgba(6,10,14,0.9); color: #fff; }
.lightbox-desc.dark .title { color: #fff; }
.lightbox-desc.dark .meta { color: rgba(255,255,255,0.78); }

/* small helper for title inside desc */
.lightbox-desc .title { font-weight: 700; color: #0b3f68; margin-bottom: 8px; font-size: 1.15rem; }
.lightbox-desc .meta { color: #6b7280; font-size: 0.9rem; margin-bottom: 10px; }

/* close + nav tweaks to fit side layout */
.close { top: 14px; right: 22px; font-size: 30px; }
.nav { font-size: 34px; padding: 12px 14px; }

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

@media (max-width: 1024px) {
    .story-card { min-width: 220px; height: 320px; }
}

@media (max-width: 900px) {
    .lightbox-content { flex-direction: column; gap: 14px; padding: 12px; }
    .lightbox img { max-width: 92vw; max-height: 60vh; }
    .lightbox-desc { max-width: 92vw; font-size: 1rem; }
}

@media (prefers-reduced-motion: reduce) {
    * { transition: none !important; animation: none !important; }
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

const lb = document.getElementById('lightbox');
lb.addEventListener('touchstart', e => { startX = e.touches[0].clientX; });
lb.addEventListener('touchend', e => {
    let endX = e.changedTouches[0].clientX;
    if(startX - endX > 50) nextImage(e);
    else if(endX - startX > 50) prevImage(e);
});

/* make description rich with contrast detection and show-more */
function updateLightbox(isOpen = false){
    const img = document.getElementById('lightbox-img');
    const desc = document.getElementById('lightbox-desc');
    const nextSrc = images[currentIndex].src;
    const nextDesc = images[currentIndex].desc || '';

    function renderContent(){
        const parts = nextDesc.split(' - ');
        const title = parts.shift() || 'Gambar';
        const body = parts.join(' - ');
        // always show full text so it appears to the right of the image
        const bodyHtml = `<div class=\"body\">${body}</div>`;
        desc.classList.remove('dark','expanded');
        desc.innerHTML = `<div class="title">${title}</div><div class="meta">Gambar ${currentIndex+1} dari ${images.length}</div>${bodyHtml}`;
    }

    function analyzeAndApplyContrast(imgEl, descEl){
        try{
            const tmp = new Image();
            tmp.crossOrigin = 'Anonymous';
            tmp.src = imgEl.src;
            tmp.onload = function(){
                const canvas = document.createElement('canvas');
                const w = Math.min(80, tmp.width);
                const h = Math.min(60, tmp.height);
                canvas.width = w; canvas.height = h;
                const ctx = canvas.getContext('2d');
                ctx.drawImage(tmp, 0, 0, w, h);
                const data = ctx.getImageData(0,0,w,h).data;
                let r,g,b,avg; let total=0;
                for(let i=0;i<data.length;i+=4){ r=data[i]; g=data[i+1]; b=data[i+2]; avg = 0.2126*r + 0.7152*g + 0.0722*b; total += avg; }
                const lum = total / (data.length/4);
                // only switch to dark panel for extremely bright images
                if(lum > 220) descEl.classList.add('dark');
                else descEl.classList.remove('dark');
            };
            tmp.onerror = function(){ descEl.classList.remove('dark'); };
        }catch(e){ desc.classList.remove('dark'); }
    }

    if (!isOpen) {
        isTransitioning = true;
        img.classList.add('fade-out');
        setTimeout(() => {
            img.src = nextSrc;
            renderContent();
            img.classList.remove('fade-out');
            // analyze contrast after image loads
            img.onload = () => analyzeAndApplyContrast(img, desc);
            isTransitioning = false;
        }, 220);
    } else {
        img.src = nextSrc;
        renderContent();
        img.onload = () => analyzeAndApplyContrast(img, desc);
        isTransitioning = false;
    }
}

function toggleDesc(btn){
    const desc = document.getElementById('lightbox-desc');
    if(desc.classList.contains('expanded')){
        desc.classList.remove('expanded');
        btn.innerText = 'Tampilkan lebih';
    } else {
        desc.classList.add('expanded');
        btn.innerText = 'Tutup';
    }
}

document.addEventListener('keydown', function(e) {
    if (!document.getElementById('lightbox').classList.contains('show')) return;
    if (e.key === 'ArrowRight') nextImage();
    if (e.key === 'ArrowLeft') prevImage();
});
</script>

@endsection
