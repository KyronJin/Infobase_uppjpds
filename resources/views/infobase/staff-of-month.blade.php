@extends('layouts.app')

@section('content')
<style>
    * { box-sizing: border-box; }
    body, html { padding: 0; margin: 0; }

    .page-header {
        background: linear-gradient(135deg, #063A76 0%, #042354 100%);
        padding: 3rem 0;
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
        width: 600px;
        height: 600px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 50%;
        z-index: 0;
    }

    .page-header .header-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 2rem;
        position: relative;
        z-index: 1;
    }

    .page-header h1 {
        font-size: 2.5rem;
        font-weight: 800;
        color: white;
        margin: 0;
        text-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        line-height: 1.1;
    }

    .page-header .back-link {
        color: white;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        padding: 1rem 2rem;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 16px;
        backdrop-filter: blur(20px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        font-size: 1rem;
    }

    .page-header .back-link:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
    }

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .content-wrapper {
        padding: 3rem 0;
    }

    .position-filters {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 3rem;
        flex-wrap: wrap;
        padding: 2rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .position-filter {
        padding: 1rem 2rem;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        color: #64748b;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        font-size: 1rem;
        min-width: 120px;
        text-align: center;
    }

    .position-filter:hover {
        border-color: #2563eb;
        color: #2563eb;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.15);
        background: white;
    }

    .position-filter.active {
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        border-color: #2563eb;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(37, 99, 235, 0.3);
    }

    .staff-display {
        display: none;
        background: white;
        border-radius: 32px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(37, 99, 235, 0.1);
        min-height: 80vh;
    }

    .staff-display.active {
        display: block;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .staff-hero {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 4rem 2rem;
        text-align: center;
        min-height: 80vh;
    }

    .staff-image-section {
        margin-bottom: 3rem;
        position: relative;
    }

    .staff-image-container {
        width: 400px;
        height: 400px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(37, 99, 235, 0.2);
        position: relative;
        border: 10px solid white;
        margin: 0 auto;
    }

    .staff-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .staff-image-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .staff-info-section {
        max-width: 800px;
        width: 100%;
    }

    .staff-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.5rem;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
        border-radius: 50px;
        font-size: 0.875rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 2rem;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
        width: fit-content;
    }

    .staff-name {
        font-size: 3rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 1rem;
        line-height: 1.1;
    }

    .staff-position {
        font-size: 1.5rem;
        color: #2563eb;
        font-weight: 600;
        margin-bottom: 2rem;
        padding: 1rem 2rem;
        background: rgba(37, 99, 235, 0.1);
        border-radius: 16px;
        display: inline-block;
        width: fit-content;
    }

    .staff-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
        padding: 2rem;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
    }

    .staff-meta-item {
        text-align: center;
    }

    .staff-meta-label {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .staff-meta-value {
        font-size: 1.25rem;
        color: #1e293b;
        font-weight: 700;
    }

    .staff-bio {
        color: #475569;
        line-height: 1.8;
        font-size: 1.125rem;
        background: #f8fafc;
        padding: 2rem;
        border-radius: 16px;
        border-left: 4px solid #2563eb;
    }

    .empty-state {
        text-align: center;
        padding: 8rem 2rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 24px;
        border: 2px dashed #cbd5e1;
    }

    .empty-state i {
        font-size: 6rem;
        color: #cbd5e1;
        margin-bottom: 2rem;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #1e293b;
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 1rem 0;
    }

    .empty-state p {
        color: #64748b;
        font-size: 1.125rem;
        margin-top: 0.5rem;
    }

    @media (max-width: 768px) {
        .page-header .header-content {
            flex-direction: column;
            text-align: center;
            gap: 2rem;
        }

        .page-header h1 {
            font-size: 2rem;
        }

        .position-filters {
            gap: 0.5rem;
            padding: 1.5rem;
        }

        .position-filter {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            min-width: 100px;
        }

        .staff-hero {
            padding: 2rem 1rem;
        }

        .staff-image-container {
            width: 280px;
            height: 280px;
            border: 6px solid white;
        }

        .staff-name {
            font-size: 2rem;
        }

        .staff-position {
            font-size: 1.25rem;
        }

        .staff-meta {
            grid-template-columns: 1fr;
        }

        .staff-bio {
            font-size: 1rem;
        }
    }
</style>

<div class="page-header">
    <div class="header-content">
        <h1><i class="fas fa-award mr-4 text-white"></i>{{ $title ?? 'Staff of The Month' }}</h1>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
</div>

{{-- Search Form --}}
@include('partials.search-form', [
    'action' => route('infobase.staff-of-month'),
    'placeholder' => 'Cari staff berdasarkan nama, posisi, atau prestasi...',
    'search' => $search ?? '',
    'resultCount' => isset($staff) ? $staff->total() : ($staffByPosition ? $staffByPosition->count() : null)
])

<div class="container">
    <div class="content-wrapper">
        @if($staffByPosition && $staffByPosition->count())
            <!-- Position Filters -->
            <div class="position-filters">
                @foreach($positions as $index => $position)
                    <button class="position-filter {{ $index === 0 ? 'active' : '' }}" 
                            onclick="showStaffByPosition('{{ $position }}')"
                            data-position="{{ $position }}">
                        <i class="fas fa-briefcase mr-2"></i>{{ $position }}
                    </button>
                @endforeach
            </div>

            <!-- Staff Displays -->
            @foreach($staffByPosition as $position => $staff)
                <div class="staff-display {{ $loop->first ? 'active' : '' }}" id="staff-{{ Str::slug($position) }}">
                    <div class="staff-hero">
                        <!-- Foto di Atas -->
                        <div class="staff-image-section">
                            <div class="staff-image-container">
                                @if($staff->photo_path)
                                    <img src="{{ asset('storage/' . $staff->photo_path) }}" alt="{{ $staff->name }}" class="staff-image">
                                @elseif($staff->photo_link)
                                    <img src="{{ $staff->photo_link }}" alt="{{ $staff->name }}" class="staff-image">
                                @else
                                    <div class="staff-image-placeholder">
                                        <i class="fas fa-user text-white text-6xl opacity-40"></i>
                                    </div>
                                @endif
                            </div>
                        </div>
                        
                        <!-- Info di Bawah -->
                        <div class="staff-info-section">
                            <div class="staff-badge">
                                <i class="fas fa-star"></i>
                                Staff Terpilih
                            </div>
                            
                            <h2 class="staff-name">{{ $staff->name }}</h2>
                            <div class="staff-position">{{ $staff->position }}</div>
                            
                            @if($staff->month || $staff->year)
                            <div class="staff-meta">
                                @if($staff->month)
                                <div class="staff-meta-item">
                                    <div class="staff-meta-label">Bulan</div>
                                    <div class="staff-meta-value">
                                        {{ DateTime::createFromFormat('!m', $staff->month)->format('F') }}
                                    </div>
                                </div>
                                @endif
                                @if($staff->year)
                                <div class="staff-meta-item">
                                    <div class="staff-meta-label">Tahun</div>
                                    <div class="staff-meta-value">{{ $staff->year }}</div>
                                </div>
                                @endif
                            </div>
                            @endif
                            
                            @if($staff->bio)
                            <div class="staff-bio">{!! nl2br(e($staff->bio)) !!}</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>Belum Ada Staff Terpilih</h3>
                <p>Staff terbaik per posisi akan ditampilkan di sini ketika sudah ada yang terpilih.</p>
            </div>
        @endif
        
        {{-- Pagination --}}
        @if(isset($staff) && $staff->hasPages())
            <div class="d-flex justify-content-center mt-6">
                {{ $staff->appends(['search' => $search ?? ''])->links() }}
            </div>
        @endif
    </div>
</div>

<script>
function showStaffByPosition(position) {
    // Hide all staff displays
    document.querySelectorAll('.staff-display').forEach(display => {
        display.classList.remove('active');
    });
    
    // Remove active class from all filters
    document.querySelectorAll('.position-filter').forEach(filter => {
        filter.classList.remove('active');
    });
    
    // Show selected staff display
    const slug = position.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
    const targetDisplay = document.getElementById('staff-' + slug);
    if (targetDisplay) {
        targetDisplay.classList.add('active');
    }
    
    // Add active class to clicked filter
    const clickedFilter = document.querySelector(`[data-position="${position}"]`);
    if (clickedFilter) {
        clickedFilter.classList.add('active');
    }
}
</script>

@endsection