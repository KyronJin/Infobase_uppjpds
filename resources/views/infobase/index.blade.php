@extends('layouts.app')

@section('content')
<style>
    * { box-sizing: border-box; }
    body, html { padding: 0; margin: 0; }

    .page-header {
        background: linear-gradient(135deg, #f85e38 0%, #d94e2e 100%);
        padding: 4rem 0;
        color: white;
        margin-top: 2rem;
        position: relative;
        overflow: hidden;
    }

    .page-header::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 500px;
        height: 500px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 0;
    }

    .page-header .header-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
        position: relative;
        z-index: 1;
    }

    .page-header span {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        font-size: 0.875rem;
        font-weight: 700;
        border-radius: 9999px;
        border: 1px solid rgba(255, 255, 255, 0.4);
        margin-bottom: 1rem;
        backdrop-filter: blur(10px);
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 700;
        color: white;
        margin: 0 0 0.5rem 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .page-header .subtitle {
        font-size: 1.125rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .content-wrapper {
        padding: 3rem 0;
    }

    .section-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 2rem;
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .section-title i {
        color: #f85e38;
        font-size: 1.75rem;
    }

    .infobase-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 2rem;
    }

    .infobase-card {
        background: white;
        border-radius: 1.5rem;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(248, 94, 56, 0.1);
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
        height: 180px;
        background: linear-gradient(135deg, #f85e38 0%, #d94e2e 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .infobase-card-header i {
        color: white;
        font-size: 3.5rem;
        transition: transform 0.3s ease;
    }

    .infobase-card:hover .infobase-card-header i {
        transform: scale(1.15) rotateZ(5deg);
    }

    .infobase-card-body {
        padding: 2rem;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .infobase-card-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1f2937;
        margin: 0 0 0.75rem 0;
    }

    .infobase-card-description {
        color: #6b7280;
        font-size: 0.95rem;
        line-height: 1.6;
        margin: 0 0 1.5rem 0;
        flex: 1;
    }

    .infobase-card-link {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #f85e38;
        font-weight: 700;
        transition: all 0.3s;
    }

    .infobase-card:hover .infobase-card-link {
        gap: 1rem;
    }

    .officer-section {
        background: white;
        padding: 2.5rem;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(248, 94, 56, 0.1);
    }

    .officer-card {
        text-align: center;
    }

    .officer-image {
        width: 160px;
        height: 160px;
        border-radius: 50%;
        object-fit: cover;
        border: 4px solid #f85e38;
        margin: 0 auto 1.5rem;
        box-shadow: 0 10px 30px rgba(248, 94, 56, 0.2);
    }

    .officer-name {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.5rem;
    }

    .officer-position {
        color: #f85e38;
        font-weight: 700;
        font-size: 1rem;
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