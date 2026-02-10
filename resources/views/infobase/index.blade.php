@extends('layouts.app')

@section('content')
<style>
    /* Infobase Index specific styles */
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        text-decoration: none;
        color: inherit;
    }

    .infobase-card:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        transform: translateY(-8px);
    }

    .infobase-card-header {
        width: 100%;
        height: 140px;
        background: linear-gradient(135deg, #0052CC 0%, #003A99 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .infobase-card-header i {
        color: white;
        font-size: 2.75rem;
        transition: transform 0.3s ease;
    }

    .infobase-card:hover .infobase-card-header i {
        transform: scale(1.15) rotateZ(5deg);
    }

    .infobase-card-body {
        padding: 1.5rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .infobase-card-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1f2937;
        margin: 0 0 0.6rem 0;
    }

    .infobase-card-description {
        color: #6b7280;
        font-size: 0.85rem;
        line-height: 1.6;
        margin: 0 0 1rem 0;
        flex: 1;
    }

    .infobase-card-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #0052CC;
        font-weight: 700;
        transition: all 0.3s;
        font-size: 0.9rem;
    }

    .infobase-card:hover .infobase-card-link {
        gap: 1rem;
    }

    .officer-section {
        background: white;
        padding: 1.75rem;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 82, 204, 0.1);
    }

    .officer-card {
        text-align: center;
    }

    .officer-image {
        width: 120px;
        height: 120px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #0052CC;
        margin: 0 auto 1.25rem;
        box-shadow: 0 10px 30px rgba(0, 82, 204, 0.15);
    }

    .officer-name {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.4rem;
    }

    .officer-position {
        color: #0052CC;
        font-weight: 700;
        font-size: 0.9rem;
    }
</style>

<div class="page-header">
    <div class="header-content">
        <span><i class="fas fa-book-open mr-2"></i>Pusat Informasi</span>
        <h1><i class="fas fa-info-circle mr-3 text-white"></i>INFOBASE UPPJPDS</h1>
        <p class="subtitle">Pusat Informasi Perpustakaan Jakarta Pusat</p>
    </div>
</div>

<div class="container">
    <div class="content-wrapper">
        <!-- Officer Section -->
        <div style="margin-bottom: 4rem;">
            <h2 class="section-title">
                <i class="fas fa-user-tie"></i>Petugas Hari Ini
            </h2>
            <div class="officer-section" style="max-width: 300px; margin: 0 auto;">
                <div class="officer-card">
                    <img src="{{ $todayOfficer['image'] }}" alt="{{ $todayOfficer['name'] }}" class="officer-image">
                    <h3 class="officer-name">{{ $todayOfficer['name'] }}</h3>
                    <p class="officer-position">{{ $todayOfficer['position'] }}</p>
                </div>
            </div>
        </div>

        <!-- Info Sections -->
        <div>
            <h2 class="section-title">
                <i class="fas fa-database"></i>Akses Informasi
            </h2>
            <div class="infobase-grid">
                @foreach($infobaseData as $item)
                <a href="{{ $item['route'] }}" class="infobase-card">
                    <div class="infobase-card-header">
                        <i class="{{ $item['icon'] ?? 'fas fa-file' }}"></i>
                    </div>
                    <div class="infobase-card-body">
                        <h3 class="infobase-card-title">{{ $item['title'] }}</h3>
                        <p class="infobase-card-description">{{ $item['description'] }}</p>
                        <div class="infobase-card-link">
                            <span>Buka</span>
                            <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection