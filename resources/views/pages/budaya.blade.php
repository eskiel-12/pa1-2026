@extends('layouts.app')

@section('title', 'Budaya - Geosite Danau Toba')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="text-center mb-5">
            <h1 class="display-5">Budaya Batak Toba</h1>
            <p class="lead">Pelajari tradisi, seni, dan warisan budaya masyarakat Danau Toba.</p>
        </div>

        @if($budayaItems->isEmpty())
            <div class="alert alert-info">Belum ada informasi budaya yang tersedia. Silakan tambahkan konten Budaya melalui dashboard admin.</div>
        @else
            <div class="row gy-4">
                @foreach($budayaItems as $item)
                    <div class="col-md-6">
                        <div class="card p-4 shadow-sm h-100">
                            @if($item->gambar)
                                <img src="{{ $item->gambar }}" alt="{{ $item->judul }}" class="card-img-top rounded mb-3" style="height: 240px; object-fit: cover;">
                            @endif
                            <h3 class="h5">{{ $item->judul }}</h3>
                            <p>{{ Str::limit(strip_tags($item->konten), 180) }}</p>
                            <a href="{{ route('informasi.detail', $item->slug) }}" class="btn btn-primary btn-sm">Baca Selengkapnya</a>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</section>
@endsection