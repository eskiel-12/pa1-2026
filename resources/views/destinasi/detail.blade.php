@extends('layouts.app')

@section('content')

<style>
.hero-detail {
    height: 75vh;
    background-size: cover;
    background-position: center;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #fff;
    overflow: hidden;
}

.hero-overlay {
    position: absolute;
    width: 100%;
    height: 100%;
    background: linear-gradient(to bottom, rgba(0,0,0,0.32), rgba(0,0,0,0.75));
}

.hero-text {
    position: relative;
    z-index: 2;
    text-align: center;
    padding: 80px 30px;
}

.hero-text h1 {
    font-size: clamp(3rem, 5vw, 4.5rem);
    line-height: 1.05;
    letter-spacing: 0.02em;
    text-shadow: 0 18px 40px rgba(0,0,0,0.3);
}

.hero-text p {
    font-size: 1.1rem;
    color: rgba(255,255,255,0.92);
    margin-top: 1rem;
}

.hero-labels {
    margin-top: 1.5rem;
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 0.75rem;
}

.hero-label {
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    padding: 0.8rem 1rem;
    border-radius: 999px;
    background: rgba(255,255,255,0.16);
    border: 1px solid rgba(255,255,255,0.24);
    color: #fff;
    font-weight: 600;
}

.hero-label i {
    color: #f2b138;
}

.card-custom {
    border-radius: 20px;
    box-shadow: 0 22px 60px rgba(15, 23, 42, 0.08);
    padding: 30px;
    background: #ffffff;
    border: 1px solid rgba(14, 165, 233, 0.15);
    margin-bottom: 2rem;
}

.card-custom h2 {
    color: #094a82;
    margin-bottom: 1rem;
}

.card-custom p {
    color: #475569;
    line-height: 1.75;
}

    /* Gallery swiper */
    .gallery-card {
        background: linear-gradient(135deg, rgba(255,255,255,0.96), rgba(250,245,255,0.98));
        border-left: 6px solid rgba(58,123,213,0.12);
    }

    .gallery-swiper {
        position: relative;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .gs-track {
        display: flex;
        gap: 1rem;
        overflow-x: auto;
        scroll-snap-type: x mandatory;
        -webkit-overflow-scrolling: touch;
        padding: 12px 6px;
        scrollbar-width: thin;
    }

    .gs-item {
        flex: 0 0 calc(33.333% - 1rem);
        scroll-snap-align: center;
        border-radius: 12px;
        overflow: hidden;
        background: white;
        box-shadow: 0 12px 30px rgba(58,123,213,0.06);
        border: 1px solid rgba(0,0,0,0.03);
    }

    .gs-item img {
        width: 100%;
        height: 260px;
        object-fit: cover;
        display: block;
        transition: transform 0.35s ease;
    }

    .gs-item:hover img { transform: scale(1.02); }

    .gs-btn {
        background: linear-gradient(90deg,#3a7bd5,#a63fa1);
        color: white;
        border: none;
        width: 44px;
        height: 44px;
        border-radius: 999px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        box-shadow: 0 8px 22px rgba(58,123,213,0.16);
    }

    .gs-btn:active { transform: translateY(1px); }

    .gs-dots { display:flex; gap:8px; justify-content:center; margin-top:12px; }
    .gs-dot { width:10px; height:10px; border-radius:50%; background: rgba(0,0,0,0.12); border:none; }
    .gs-dot.active { background: linear-gradient(90deg,#3a7bd5,#a63fa1); box-shadow:0 6px 14px rgba(58,123,213,0.14); }

    @media (max-width: 992px) {
        .gs-item { flex: 0 0 calc(50% - 1rem); }
        .gs-item img { height: 200px; }
    }

    @media (max-width: 576px) {
        .gs-item { flex: 0 0 calc(85% - 1rem); }
        .gs-item img { height: 180px; }
    }

.info-card {
    display: block;
}

.info-card .highlight-list {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
    gap: 1rem;
    margin-top: 1rem;
}

.highlight-item {
    border-radius: 18px;
    padding: 1.3rem;
    background: #f4f9ff;
    border: 1px solid rgba(14, 165, 233, 0.16);
}

.highlight-item strong {
    display: block;
    font-size: 1.35rem;
    margin-bottom: 0.4rem;
    color: #094a82;
}

.highlight-item span {
    color: #475569;
}

.btn-primary {
    background-color: #094a82;
    border-color: #094a82;
}

.btn-primary:hover {
    background-color: #0b3f68;
    border-color: #0b3f68;
}

@media (max-width: 768px) {
    .hero-text {
        padding: 50px 20px;
    }
}
</style>

<!-- HERO -->
<div class="hero-detail" style="background-image: url('{{ $destinasi->gambar_url }}')">
    <div class="hero-overlay"></div>
    <div class="hero-text container">
        <h1 class="display-3 fw-bold">{{ $destinasi->nama }}</h1>
        <p class="lead">Geosite Danau Toba</p>
        <div class="hero-labels">
            <span class="hero-label">Kategori: {{ ucfirst($destinasi->kategori ?? 'Destinasi') }}</span>
            <span class="hero-label"><i class="fas fa-map-marker-alt"></i>{{ $destinasi->lokasi ?? 'Lokasi tidak tersedia' }}</span>
            <span class="hero-label"><i class="fas fa-star"></i>{{ $destinasi->rating ?? '4.8' }} / 5</span>
        </div>
    </div>
</div>

<!-- CONTENT -->
<div class="container py-5">

    <!-- DESKRIPSI -->
    <div class="card-custom">
        <h2>Deskripsi</h2>
        <p>{{ $destinasi->deskripsi }}</p>
    </div>

    <!-- GALERI -->
    <div class="card-custom gallery-card">
        <h2>Galeri</h2>
        @if(count($galeri))
            <div class="gallery-swiper">
                <button class="gs-btn prev" aria-label="Sebelumnya">‹</button>
                <div class="gs-track">
                    @foreach($galeri as $img)
                        <div class="gs-item">
                            <img src="{{ $img }}" alt="Galeri {{ $destinasi->nama }}">
                        </div>
                    @endforeach
                </div>
                <button class="gs-btn next" aria-label="Selanjutnya">›</button>
            </div>
            <div class="gs-dots" aria-hidden="false"></div>
        @else
            <p>Tidak ada galeri untuk destinasi ini.</p>
        @endif
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const track = document.querySelector('.gs-track');
            if(!track) return;
            const items = Array.from(track.querySelectorAll('.gs-item'));
            const prev = document.querySelector('.gs-btn.prev');
            const next = document.querySelector('.gs-btn.next');
            const dotsWrap = document.querySelector('.gs-dots');

            items.forEach((it, idx) => {
                const btn = document.createElement('button');
                btn.className = 'gs-dot';
                btn.setAttribute('aria-label', 'Gambar ' + (idx+1));
                btn.addEventListener('click', () => it.scrollIntoView({behavior:'smooth', inline:'center'}));
                dotsWrap.appendChild(btn);
            });

            const dots = Array.from(dotsWrap.querySelectorAll('.gs-dot'));

            function updateActive(){
                const trackRect = track.getBoundingClientRect();
                const center = trackRect.left + trackRect.width/2;
                let active = 0; let minDist = Infinity;
                items.forEach((it, idx) => {
                    const r = it.getBoundingClientRect();
                    const itCenter = r.left + r.width/2;
                    const dist = Math.abs(center - itCenter);
                    if(dist < minDist){ minDist = dist; active = idx; }
                });
                dots.forEach(d => d.classList.remove('active'));
                if(dots[active]) dots[active].classList.add('active');
            }

            track.addEventListener('scroll', () => { window.requestAnimationFrame(updateActive); });
            window.addEventListener('resize', updateActive);
            updateActive();

            prev.addEventListener('click', () => track.scrollBy({left: - (track.clientWidth * 0.8), behavior:'smooth'}));
            next.addEventListener('click', () => track.scrollBy({left: track.clientWidth * 0.8, behavior:'smooth'}));

            // mouse drag support
            let isDown = false, startX, scrollLeft;
            track.addEventListener('pointerdown', (e) => { isDown = true; track.style.cursor='grabbing'; startX = e.pageX; scrollLeft = track.scrollLeft; track.setPointerCapture(e.pointerId); });
            track.addEventListener('pointermove', (e) => { if(!isDown) return; const x = e.pageX; const walk = (startX - x); track.scrollLeft = scrollLeft + walk; });
            track.addEventListener('pointerup', (e) => { isDown = false; track.style.cursor='grab'; try{ track.releasePointerCapture(e.pointerId); }catch(e){} });
            track.addEventListener('pointerleave', (e) => { isDown = false; track.style.cursor='grab'; });
        });
    </script>

    <!-- GOOGLE MAPS -->
    <div class="card-custom">
        <h2>Lokasi</h2>
        <iframe 
            src="https://maps.google.com/maps?q={{ urlencode($destinasi->lokasi ?? 'Danau Toba') }}&t=&z=13&ie=UTF8&iwloc=&output=embed"
            width="100%" 
            height="450" 
            style="border:0; border-radius: 16px;" 
            allowfullscreen="" 
            loading="lazy">
        </iframe>
    </div>

    <!-- UMKM -->
    <div class="card-custom">
        <h2>UMKM di Sekitar</h2>
        <div class="row">
            @forelse($umkms as $u)
                <div class="col-md-4 mb-3">
                    <div class="card p-3 h-100">
                        <img src="{{ $u->gambar ? \Illuminate\Support\Facades\Storage::url($u->gambar) : asset('images/no-image.png') }}" class="w-100 mb-2" style="height:150px;object-fit:cover;border-radius:8px;">
                        <h5>{{ $u->nama }}</h5>
                        <p class="mb-0">{{ \Illuminate\Support\Str::limit($u->deskripsi, 100) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12">Tidak ada UMKM terdaftar di lokasi ini.</div>
            @endforelse
        </div>
    </div>

    <!-- AKOMODASI -->
    <div class="card-custom">
        <h2>Akomodasi</h2>
        <div class="row">
            @forelse($akomodasis as $a)
                <div class="col-md-4 mb-3">
                    <div class="card p-3 h-100">
                        <img src="{{ $a->gambar_url ?? asset('images/no-image.png') }}" class="w-100 mb-2" style="height:150px;object-fit:cover;border-radius:8px;">
                        <h5>{{ $a->nama }}</h5>
                        <p class="mb-0">{{ \Illuminate\Support\Str::limit($a->deskripsi, 100) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12">Tidak ada akomodasi terdaftar di lokasi ini.</div>
            @endforelse
        </div>
    </div>

    <!-- TRANSPORTASI -->
    <div class="card-custom">
        <h2>Transportasi</h2>
        <div class="row">
            @forelse($transportasis as $t)
                <div class="col-md-4 mb-3">
                    <div class="card p-3 h-100">
                        <img src="{{ $t->gambar_url ?? asset('images/no-image.png') }}" class="w-100 mb-2" style="height:150px;object-fit:cover;border-radius:8px;">
                        <h5>{{ $t->nama }}</h5>
                        <p class="mb-0">{{ \Illuminate\Support\Str::limit($t->deskripsi, 100) }}</p>
                    </div>
                </div>
            @empty
                <div class="col-12">Tidak ada informasi transportasi untuk lokasi ini.</div>
            @endforelse
        </div>
    </div>

    <a href="/" class="btn btn-primary rounded-pill px-4 shadow">
        ← Kembali
    </a>

</div>

@endsection