@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<style>
    .dashboard-stats {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(120px, 1fr));
        gap: 16px;
        margin-bottom: 30px;
    }
    
    .stat-card-dashboard {
        background: linear-gradient(135deg, #ffffff, #f8f9fa);
        border-left: 4px solid #c6a43b;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.08);
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        min-height: 110px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    
    .stat-card-dashboard:hover {
        transform: translateY(-6px);
        box-shadow: 0 8px 20px rgba(198, 164, 59, 0.25);
        border-left-color: #2c5f8a;
    }
    
    .stat-number-dashboard {
        font-size: 1.8rem;
        font-weight: 700;
        color: #c6a43b;
        margin-bottom: 8px;
    }
    
    .stat-label-dashboard {
        font-size: 0.75rem;
        font-weight: 600;
        color: #666;
        letter-spacing: 1px;
        text-transform: uppercase;
    }
</style>

<!-- Stats Row - All Side by Side -->
<div class="dashboard-stats">
    <div class="stat-card-dashboard">
        <div class="stat-number-dashboard">{{ $totalGaleri ?? 0 }}</div>
        <div class="stat-label-dashboard">Galeri</div>
    </div>
    <div class="stat-card-dashboard">
        <div class="stat-number-dashboard">{{ $totalBerita ?? 0 }}</div>
        <div class="stat-label-dashboard">Berita</div>
    </div>
    <div class="stat-card-dashboard">
        <div class="stat-number-dashboard">{{ $totalInformasi ?? 0 }}</div>
        <div class="stat-label-dashboard">Informasi</div>
    </div>
    <div class="stat-card-dashboard">
        <div class="stat-number-dashboard">{{ number_format($totalViews ?? 0) }}</div>
        <div class="stat-label-dashboard">Views</div>
    </div>
    <div class="stat-card-dashboard">
        <div class="stat-number-dashboard">{{ \App\Models\Destinasi::count() }}</div>
        <div class="stat-label-dashboard">Destinasi</div>
    </div>
    <div class="stat-card-dashboard">
        <div class="stat-number-dashboard">{{ \App\Models\Umkm::count() }}</div>
        <div class="stat-label-dashboard">UMKM</div>
    </div>
    <div class="stat-card-dashboard">
        <div class="stat-number-dashboard">{{ \App\Models\Akomodasi::count() }}</div>
        <div class="stat-label-dashboard">Akomodasi</div>
    </div>
    <div class="stat-card-dashboard">
        <div class="stat-number-dashboard">{{ \App\Models\Transportasi::count() }}</div>
        <div class="stat-label-dashboard">Transportasi</div>
    </div>
</div>

<!-- Recent News -->
<div class="card-table">
    <h5>Berita Terbaru</h5>
    <div class="table-responsive">
        <table>
            <thead>
                <tr><th>Judul</th><th>Tanggal</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @foreach(\App\Models\Berita::latest()->limit(5)->get() as $item)
                <tr>
                    <td>{{ Str::limit($item->judul, 30) }}</td>
                    <td>{{ $item->tanggal_terbit->format('d/m/Y') }}</td>
                    <td>@if($item->status)<span class="badge-success badge">Publish</span>@else<span class="badge-danger badge">Draft</span>@endif</td>
                    <td><a href="{{ route('admin.berita.edit', $item->id) }}" class="btn btn-sm btn-primary">Edit</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- Quick Actions -->
<div class="action-buttons">
    <a href="{{ route('admin.galeri.create') }}" class="action-btn"><i class="fas fa-plus-circle"></i> Galeri</a>
    <a href="{{ route('admin.berita.create') }}" class="action-btn"><i class="fas fa-plus-circle"></i> Berita</a>
    <a href="{{ route('admin.informasi.create') }}" class="action-btn"><i class="fas fa-plus-circle"></i> Informasi</a>
    <a href="{{ route('admin.banner.create') }}" class="action-btn"><i class="fas fa-plus-circle"></i> Banner</a>
    <a href="{{ route('admin.destinasi.create') }}" class="action-btn"><i class="fas fa-plus-circle"></i> Destinasi</a>
    <a href="{{ route('admin.umkm.create') }}" class="action-btn"><i class="fas fa-plus-circle"></i> UMKM</a>
    <a href="{{ url('/') }}" target="_blank" class="action-btn"><i class="fas fa-globe"></i> Website</a>
</div>
@endsection