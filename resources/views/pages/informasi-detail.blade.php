@extends('layouts.app')

@section('title', $informasi->judul . ' - Geosite Danau Toba')

@section('content')

<style>
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
        background: linear-gradient(to bottom, rgba(0,0,0,0.4), rgba(0,0,0,0.7));
    }

    .hero-text {
        position: relative;
        z-index: 2;
        text-align: center;
        animation: fadeIn 1.5s ease-in-out;
    }

    @keyframes fadeIn {
        from {opacity: 0; transform: translateY(20px);}
        to {opacity: 1; transform: translateY(0);}
    }

    .content-section {
        padding: 60px 0;
        background: #f8f9fa;
    }

    .content-container {
        max-width: 800px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .content-card {
        background: white;
        border-radius: 16px;
        padding: 40px;
        box-shadow: 0 10px 30px rgba(0,0,0,0.08);
    }

    .content-meta {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        padding-bottom: 20px;
        border-bottom: 1px solid #eee;
        flex-wrap: wrap;
        gap: 10px;
    }

    .content-date {
        font-size: 0.8rem;
        color: #c6a43b;
        text-transform: uppercase;
        letter-spacing: 0.1em;
    }

    .content-views {
        font-size: 0.8rem;
        color: #666;
    }

    .content-title {
        font-size: 2.5rem;
        font-family: 'Cormorant Garamond', serif;
        color: #1a3c5e;
        margin-bottom: 20px;
        line-height: 1.2;
    }

    .content-image {
        width: 100%;
        height: 400px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 30px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }

    .content-body {
        font-size: 1.1rem;
        line-height: 1.8;
        color: #444;
        margin-bottom: 30px;
    }

    .content-body h2, .content-body h3, .content-body h4 {
        color: #1a3c5e;
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
        box-shadow: 0 3px 10px rgba(0,0,0,0.1);
    }

    .back-btn {
        display: inline-block;
        background: #c6a43b;
        color: #1a3c5e;
        padding: 12px 25px;
        border-radius: 40px;
        text-decoration: none;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.1em;
        font-size: 0.8rem;
        transition: 0.3s;
        margin-top: 30px;
    }

    .back-btn:hover {
        background: #1a3c5e;
        color: white;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .hero-detail {
            height: 50vh;
        }
        .content-title {
            font-size: 2rem;
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
<div class="hero-detail" style="background-image: url('{{ $informasi->gambar ?: asset('uploads/del.jpeg') }}')">
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
            <img src="{{ $informasi->gambar }}" alt="{{ $informasi->judul }}" class="content-image">
            @endif

            <div class="content-body">
                {!! $informasi->konten !!}
            </div>

            <a href="{{ route('informasi') }}" class="back-btn">← Kembali ke Informasi</a>
        </div>
    </div>
</section>

@endsection
