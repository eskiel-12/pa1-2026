@extends('layouts.app')

@section('title', $informasi->judul . ' - Geosite Danau Toba')

@section('content')

<style>
    :root{
        --accent1: #3a7bd5; /* blue */
        --accent2: #a63fa1; /* purple */
        --accent3: #f08a5d; /* warm coral */
        --muted: #525252;
        --card-bg: linear-gradient(135deg, rgba(255,255,255,0.95), rgba(250,249,255,0.95));
    }

    .hero-detail {
        height: 60vh;
        background-size: cover;
        background-position: center;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        overflow: hidden;
    }

    .hero-overlay {
        position: absolute;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(58,123,213,0.55), rgba(166,63,161,0.45));
        mix-blend-mode: multiply;
    }

    .hero-text {
        position: relative;
        z-index: 2;
        text-align: center;
        animation: fadeIn 1.2s ease-in-out;
        text-shadow: 0 6px 18px rgba(0,0,0,0.35);
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);} 
        to {opacity: 1; transform: translateY(0);} 
    }

    .content-section {
        padding: 60px 0;
        background: linear-gradient(180deg, #fbfdff 0%, #fff7fb 100%);
    }

    .content-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .content-card {
        background: var(--card-bg);
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 12px 30px rgba(58,123,213,0.08), 0 4px 10px rgba(166,63,161,0.04);
        border-left: 6px solid rgba(58,123,213,0.12);
    }

    .content-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        padding-bottom: 10px;
        border-bottom: 1px dashed rgba(0,0,0,0.06);
        flex-wrap: wrap;
        gap: 10px;
    }

    .content-date {
        font-size: 0.8rem;
        color: var(--accent3);
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-weight: 700;
    }

    .content-views {
        font-size: 0.85rem;
        color: var(--muted);
    }

    .content-title {
        font-size: 2.6rem;
        font-family: 'Cormorant Garamond', serif;
        color: var(--accent1);
        margin-bottom: 20px;
        line-height: 1.15;
        background: linear-gradient(90deg, rgba(58,123,213,0.08), rgba(166,63,161,0.06));
        padding: 8px 12px;
        border-radius: 8px;
        display: inline-block;
    }

    .content-image {
        width: 100%;
        height: 420px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 8px 25px rgba(58,123,213,0.08);
        border: 1px solid rgba(0,0,0,0.03);
    }

    .content-body {
        font-size: 1.05rem;
        line-height: 1.9;
        color: #333;
        margin-bottom: 30px;
    }

    .content-body h2, .content-body h3, .content-body h4 {
        color: var(--accent2);
        margin-top: 30px;
        margin-bottom: 15px;
    }

    .content-body p {
        margin-bottom: 20px;
    }

    .content-body img {
        max-width: 100%;
        height: auto;
        border-radius: 8px;
        margin: 20px 0;
        box-shadow: 0 6px 20px rgba(0,0,0,0.08);
    }

    .content-body blockquote {
        border-left: 4px solid var(--accent2);
        padding: 12px 18px;
        background: rgba(166,63,161,0.03);
        color: #2b2b2b;
        border-radius: 6px;
        margin: 20px 0;
    }

    .back-btn {
        display: inline-block;
        background: linear-gradient(90deg, var(--accent1), var(--accent2));
        color: white;
        padding: 12px 28px;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.08em;
        font-size: 0.85rem;
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        margin-top: 20px;
        box-shadow: 0 6px 18px rgba(58,123,213,0.18);
    }

    .back-btn:hover {
        transform: translateY(-4px);
        box-shadow: 0 18px 40px rgba(58,123,213,0.18);
    }

    @media (max-width: 768px) {
        .hero-detail {
            height: 50vh;
        }
        .content-title {
            font-size: 1.9rem;
        }
        .content-card {
            padding: 25px;
        }
        .content-image {
            height: 250px;
        }
        .content-meta {
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }
    }
</style>

<!-- HERO -->
<div class="hero-detail" style="background-image: url('{{ $informasi->gambar_url ?: asset('uploads/del.jpeg') }}')">
    <div class="hero-overlay"></div>
    <div class="hero-text">
        <h1>{{ $informasi->judul }}</h1>
        <p>{{ $informasi->kategori }}</p>
    </div>
</div>

<!-- CONTENT -->
<section class="content-section">
    <div class="content-container">
        <div class="content-card">
            <div class="content-meta">
                <span class="content-date">{{ $informasi->created_at->format('d M Y') }}</span>
                <span class="content-views">{{ $informasi->views }} views</span>
            </div>

            <h1 class="content-title">{{ $informasi->judul }}</h1>

            @if($informasi->gambar)
            <img src="{{ $informasi->gambar_url }}" alt="{{ $informasi->judul }}" class="content-image">
            @endif

            <div class="content-body">
                {!! $informasi->konten !!}
            </div>

            <a href="{{ route('informasi') }}" class="back-btn">← Kembali ke Informasi</a>
        </div>
    </div>
</section>

@endsection
