@extends('layouts.app')

@section('content')
<style>
    /* Staff of Month specific styles */

    .position-filters {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        padding: 1.5rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .position-filter {
        padding: 0.75rem 1.5rem;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        color: #64748b;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        font-size: 0.9rem;
        min-width: 110px;
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
        padding: 2.5rem 1.5rem;
        text-align: center;
        min-height: auto;
    }

    .staff-image-section {
        margin-bottom: 2rem;
        position: relative;
    }

    .staff-image-container {
        width: 280px;
        height: 280px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(37, 99, 235, 0.2);
        position: relative;
        border: 8px solid white;
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
        padding: 0.6rem 1.2rem;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 1.25rem;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
        width: fit-content;
    }

    .staff-name {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.75rem;
        line-height: 1.1;
    }

    .staff-position {
        font-size: 1.1rem;
        color: #0052CC;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding: 0.75rem 1.5rem;
        background: rgba(0, 82, 204, 0.08);
        border-radius: 12px;
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
            @foreach($staffByPosition as $position => $staffItem)
                <div class="staff-display {{ $loop->first ? 'active' : '' }}" id="staff-{{ Str::slug($position) }}">
                    <div class="staff-hero">
                        <!-- Foto di Atas -->
                        <div class="staff-image-section">
                            <div class="staff-image-container">
                                @if($staffItem->photo_path)
                                    <img src="{{ asset('storage/' . $staffItem->photo_path) }}" alt="{{ $staffItem->name }}" class="staff-image">
                                @elseif($staffItem->photo_link)
                                    <img src="{{ $staffItem->photo_link }}" alt="{{ $staffItem->name }}" class="staff-image">
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
                            
                            <h2 class="staff-name">{{ $staffItem->name }}</h2>
                            <div class="staff-position">{{ $staffItem->position }}</div>
                            
                            @if($staffItem->month || $staffItem->year)
                            <div class="staff-meta">
                                @if($staffItem->month)
                                <div class="staff-meta-item">
                                    <div class="staff-meta-label">Bulan</div>
                                    <div class="staff-meta-value">
                                        {{ DateTime::createFromFormat('!m', $staffItem->month)->format('F') }}
                                    </div>
                                </div>
                                @endif
                                @if($staffItem->year)
                                <div class="staff-meta-item">
                                    <div class="staff-meta-label">Tahun</div>
                                    <div class="staff-meta-value">{{ $staffItem->year }}</div>
                                </div>
                                @endif
                            </div>
                            @endif
                            
                            @if($staffItem->bio)
                            <div class="staff-bio">{!! nl2br(e($staffItem->bio)) !!}</div>
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