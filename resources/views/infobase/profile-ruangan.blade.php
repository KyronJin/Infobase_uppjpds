@extends('layouts.app')

@push('styles')
<style>
    .room-description {
        max-width: 100%;
    }
    
    .room-description img {
        max-width: 100%;
        max-height: 300px;
        height: auto;
        object-fit: contain;
        border-radius: 8px;
        display: block;
        margin: 0.5rem 0;
    }
</style>
@endpush

@section('content')

<style>
    /* Profile Ruangan specific styles */

    /* Modern hero header (match other infobase pages) */
    .modern-page-header {
        background: linear-gradient(135deg, #f85e38 0%, #d94e2e 100%);
        padding: 4rem 0;
        color: white;
        margin-top: 2rem;
        position: relative;
        overflow: hidden;
    }

    .modern-page-header::before {
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

    .modern-page-header .header-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 2rem;
        position: relative;
        z-index: 1;
    }

    .modern-page-header .header-left span {
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

    .modern-page-header h1 {
        font-size: 3rem;
        font-weight: 700;
        color: white;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .modern-page-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.125rem;
        margin-top: 0.5rem;
    }

    .modern-page-header .back-link {
        color: white;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        padding: 0.75rem 1.5rem;
        background: rgba(255, 255, 255, 0.15);
        border-radius: 0.5rem;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
    }

    .modern-page-header .back-link:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateX(-4px);
    }
    .room-card {
        background: white;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(0, 82, 204, 0.1);
        transition: all 0.3s ease;
    }

    .room-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 12px 35px rgba(0, 0, 0, 0.12);
    }

    /* Compact Slider */
    .slider-wrapper {
        width: 100%;
        margin: 0;
        perspective: 1000px;
    }

    .slider {
        position: relative;
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
        overflow: hidden;
        border-radius: 0;
    }

    .slider input[type="radio"] {
        display: none;
    }

    .slider-content {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .slider-figure {
        position: absolute;
        width: 100%;
        height: 100%;
        opacity: 0;
        transition: opacity 0.6s ease-in-out;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .slider-figure img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        cursor: pointer;
        transition: transform 0.3s ease;
    }

    .slider-figure img:hover {
        transform: scale(1.02);
    }

    .slider input[type="radio"]:checked + .slider-figure {
        opacity: 1;
        z-index: 10;
    }

    /* Compact Navigation */
    .slider-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.5);
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-size: 16px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
        z-index: 20;
        backdrop-filter: blur(10px);
    }

    .slider-arrow:hover {
        background: rgba(255, 255, 255, 0.35);
        border-color: white;
        transform: translateY(-50%) scale(1.15);
    }

    .slider-arrow.prev {
        left: 15px;
    }

    .slider-arrow.next {
        right: 15px;
    }

    /* Compact Dots */
    .slider-dots {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 6px;
        z-index: 15;
    }

    .slider-dot {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        border: 1px solid rgba(255, 255, 255, 0.7);
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .slider-dot:hover {
        background: rgba(255, 255, 255, 0.6);
        transform: scale(1.2);
    }

    .slider input[type="radio"]:checked ~ .slider-dots .slider-dot:nth-child(1),
    .slider input[type="radio"]:nth-of-type(1):checked ~ .slider-dots .slider-dot:nth-child(1),
    .slider input[type="radio"]:nth-of-type(2):checked ~ .slider-dots .slider-dot:nth-child(2),
    .slider input[type="radio"]:nth-of-type(3):checked ~ .slider-dots .slider-dot:nth-child(3),
    .slider input[type="radio"]:nth-of-type(4):checked ~ .slider-dots .slider-dot:nth-child(4),
    .slider input[type="radio"]:nth-of-type(5):checked ~ .slider-dots .slider-dot:nth-child(5) {
        background: #063A76;
        border-color: #063A76;
        transform: scale(1.3);
    }

    /* Compact Counter */
    .slider-counter {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.6);
        color: white;
        padding: 6px 12px;
        border-radius: 12px;
        font-size: 11px;
        font-weight: 600;
        z-index: 20;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Compact Room Info */
    .room-info {
        background: white;
        padding: 1.25rem;
        margin: 0;
        border-radius: 0;
    }

    .room-title {
        font-size: 1.15rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, #063A76 0%, #063A76 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        line-height: 1.2;
    }

    .room-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.4rem;
        margin-bottom: 0.6rem;
    }

    .room-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.35rem 0.7rem;
        background: linear-gradient(135deg, #063A76 0%, #063A76 100%);
        color: white;
        border-radius: 0.4rem;
        font-size: 0.7rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(6, 58, 118, 0.25);
        transition: all 0.3s ease;
    }

    .room-badge:hover {
        transform: translateY(-1px);
        box-shadow: 0 4px 15px rgba(0, 82, 204, 0.35);
    }

    .room-badge i {
        font-size: 0.8rem;
    }

    .room-description {
        background: linear-gradient(135deg, #E0F0FF 0%, rgba(6, 58, 118, 0.05) 100%);
        border-left: 3px solid #063A76;
        padding: 0.7rem;
        border-radius: 0.4rem;
        color: #374151;
        line-height: 1.5;
        font-size: 0.8rem;
        margin-top: 0.6rem;
    }

    /* Container */
    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 1.5rem 1.5rem;
    }

    .rooms-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 2rem;
        margin-bottom: 2rem;
    }

    .empty-state {
        text-align: center;
        padding: 3rem 1.5rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #f0f1f3 100%);
        border-radius: 1.5rem;
        border: 2px dashed #e5e7eb;
        grid-column: 1 / -1;
    }

    .empty-state i {
        font-size: 3rem;
        color: #d1d5db;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 1rem;
        font-weight: 600;
        margin: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .rooms-grid {
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }
        
        .slider {
            height: 200px;
        }
        
        .modern-page-header h1 {
            font-size: 1.8rem;
        }
        
        .container {
            padding: 1.5rem 1rem;
        }
    }

    /* Simple Header Style */
    .simple-header {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem 0;
    }

    .simple-header .header-left h1 {
        color: #000000;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-shadow: none;
    }

    .simple-header .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    /* Detail Profile Modal */
    .detail-modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.85);
        z-index: 1000;
        backdrop-filter: blur(8px);
        overflow-y: auto;
        padding: 2rem 1rem;
    }

    .detail-modal-overlay.active {
        display: flex;
        align-items: flex-start;
        justify-content: center;
        animation: fadeIn 0.3s ease;
        padding-top: 2rem;
        padding-bottom: 2rem;
    }

    .detail-modal-wrapper {
        background: white;
        border-radius: 16px;
        max-width: 900px;
        width: 100%;
        overflow: hidden;
        animation: slideUp 0.3s ease;
        box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
        margin: auto;
    }

    .detail-modal-header {
        position: relative;
        background: linear-gradient(135deg, #063A76 0%, #063A76 100%);
        padding: 2rem;
        color: white;
    }

    .detail-modal-close {
        position: absolute;
        top: 15px;
        right: 15px;
        background: rgba(255, 255, 255, 0.2);
        border: 2px solid rgba(255, 255, 255, 0.4);
        color: white;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        font-size: 24px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        backdrop-filter: blur(10px);
    }

    .detail-modal-close:hover {
        background: rgba(255, 255, 255, 0.3);
        transform: scale(1.1);
    }

    .detail-modal-title {
        font-size: 1.75rem;
        font-weight: 700;
        margin: 0;
        margin-bottom: 0.5rem;
        color: white;
    }

    .detail-modal-badges {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-top: 1rem;
    }

    .detail-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border-radius: 6px;
        font-size: 0.9rem;
        font-weight: 600;
        border: 1px solid rgba(255, 255, 255, 0.3);
    }

    .detail-badge i {
        font-size: 1rem;
    }

    /* Image Slider in Detail Modal */
    .detail-image-carousel {
        position: relative;
        background: #1f2937;
        height: 400px;
        display: flex;
        align-items: center;
        justify-content: center;
        overflow: hidden;
    }

    .detail-image-wrapper {
        position: relative;
        width: 100%;
        height: 100%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-image {
        max-width: 90%;
        max-height: 100%;
        object-fit: contain;
        animation: imageZoom 0.4s ease;
    }

    @keyframes imageZoom {
        from {
            opacity: 0;
            transform: scale(0.95);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .detail-image-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        width: 45px;
        height: 45px;
        border-radius: 50%;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        z-index: 10;
    }

    .detail-image-nav:hover {
        background: rgba(0, 0, 0, 0.7);
        transform: translateY(-50%) scale(1.1);
    }

    .detail-image-nav.prev {
        left: 15px;
    }

    .detail-image-nav.next {
        right: 15px;
    }

    .detail-image-counter {
        position: absolute;
        bottom: 15px;
        right: 15px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-size: 0.9rem;
        font-weight: 600;
        z-index: 10;
    }

    .detail-image-dots {
        position: absolute;
        bottom: 15px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 8px;
        z-index: 10;
    }

    .detail-image-dot {
        width: 10px;
        height: 10px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        border: 2px solid rgba(255, 255, 255, 0.6);
        cursor: pointer;
        transition: all 0.2s;
    }

    .detail-image-dot.active {
        background: white;
        transform: scale(1.3);
    }

    .detail-image-dot:hover {
        background: rgba(255, 255, 255, 0.7);
    }

    /* Content Area */
    .detail-modal-content {
        padding: 2rem;
    }

    .detail-description-title {
        font-size: 1.3rem;
        font-weight: 700;
        color: #063A76;
        margin-bottom: 1rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .detail-description-title i {
        font-size: 1.25rem;
    }

    .detail-description-text {
        background: linear-gradient(135deg, #f0f7ff 0%, #e0f0ff 100%);
        border-left: 4px solid #063A76;
        padding: 1.5rem;
        border-radius: 8px;
        color: #374151;
        line-height: 1.7;
        font-size: 1rem;
        margin-bottom: 1.5rem;
        font-weight: 500;
    }

    .detail-description-text:empty {
        display: none;
    }

    .detail-description-text:empty + .detail-description-empty {
        display: block;
    }

    .detail-description-empty {
        display: none;
        background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
        border-left: 4px solid #9ca3af;
        padding: 1.5rem;
        border-radius: 8px;
        color: #6b7280;
        font-style: italic;
        text-align: center;
    }

    /* Image Thumbnails */
    .detail-image-thumbnails {
        border-top: 1px solid #e5e7eb;
        padding-top: 1.5rem;
        margin-top: 1.5rem;
    }

    .detail-thumbnails-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: #6b7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 1rem;
    }

    .detail-thumbnails-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(80px, 1fr));
        gap: 0.75rem;
    }

    .detail-thumbnail {
        cursor: pointer;
        border-radius: 8px;
        overflow: hidden;
        border: 3px solid transparent;
        transition: all 0.2s;
        height: 80px;
        background: #f3f4f6;
    }

    .detail-thumbnail img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.2s;
    }

    .detail-thumbnail:hover img {
        transform: scale(1.05);
    }

    .detail-thumbnail.active {
        border-color: #063A76;
        box-shadow: 0 0 0 2px white, 0 0 0 4px #063A76;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-modal-wrapper {
            border-radius: 12px;
            max-width: 100%;
        }

        .detail-image-carousel {
            height: 300px;
        }

        .detail-modal-content {
            padding: 1.5rem;
        }

        .detail-modal-header {
            padding: 1.5rem;
        }

        .detail-modal-title {
            font-size: 1.4rem;
        }

        .detail-badges {
            flex-direction: column;
        }

        .detail-image-nav {
            width: 40px;
            height: 40px;
            font-size: 18px;
        }

        .detail-image-nav.prev {
            left: 10px;
        }

        .detail-image-nav.next {
            right: 10px;
        }

        .detail-thumbnails-grid {
            grid-template-columns: repeat(auto-fill, minmax(70px, 1fr));
            gap: 0.5rem;
        }

        .detail-thumbnail {
            height: 70px;
        }
    }
</style>

<div class="page-header simple-header">
    <div class="header-content">
        <div class="header-left">
            <h1>PROFILE RUANGAN</h1>
        </div>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
</div>

{{-- Search Form --}}
@include('partials.search-form', [
    'action' => route('infobase.profile-ruangan'),
    'placeholder' => 'Cari ruangan berdasarkan nama, lantai, atau deskripsi...',
    'search' => $search ?? '',
    'resultCount' => isset($items) ? $items->total() : null
])

<div class="container">
    @if($items->isNotEmpty())
        <div class="rooms-grid">
            @foreach($items as $item)
                <div class="room-card" onclick="openDetailModal({{ $item->id }}, this)">
                    <!-- Compact Slider -->
                    @if($item->images->count() > 0)
                        <div class="slider-wrapper">
                            <div class="slider" id="slider-{{ $item->id }}">
                                @foreach($item->images as $index => $image)
                                    <input 
                                        type="radio" 
                                        id="img-{{ $item->id }}-{{ $index }}" 
                                        name="room-{{ $item->id }}"
                                        {{ $index === 0 ? 'checked' : '' }}
                                    >
                                    <figure class="slider-figure">
                                        <img src="{{ route('profile-ruangan.image', ['filename' => basename($image->image_path)]) }}" alt="{{ $item->room_name }}" loading="lazy">
                                    </figure>
                                @endforeach

                                <!-- Compact Navigation -->
                                @if($item->images->count() > 1)
                                    <div class="slider-dots">
                                        @foreach($item->images as $index => $image)
                                            <label class="slider-dot" for="img-{{ $item->id }}-{{ $index }}"></label>
                                        @endforeach
                                    </div>

                                    <button class="slider-arrow prev" onclick="slidePrev('{{ $item->id }}')">
                                        <i class="fas fa-chevron-left"></i>
                                    </button>
                                    <button class="slider-arrow next" onclick="slideNext('{{ $item->id }}')">
                                        <i class="fas fa-chevron-right"></i>
                                    </button>

                                    <div class="slider-counter">
                                        <span id="counter-{{ $item->id }}">1</span> / {{ $item->images->count() }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif

                    <!-- Compact Room Info -->
                    <div class="room-info">
                        <h2 class="room-title">{{ $item->room_name }}</h2>
                        
                        <div class="room-meta">
                            @if($item->floor)
                                <span class="room-badge">
                                    <i class="fas fa-layer-group"></i>Lantai {{ $item->floor }}
                                </span>
                            @endif
                            @if($item->capacity)
                                <span class="room-badge">
                                    <i class="fas fa-users"></i>{{ $item->capacity }} Orang
                                </span>
                            @endif
                        </div>

                        @if($item->description)
                            <div class="room-description">
                                {!! nl2br(e(Str::limit($item->description, 150))) !!}
                            </div>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
        
        {{-- Pagination --}}
        @if($items->hasPages())
            <div class="d-flex justify-content-center mt-6">
                {{ $items->appends(['search' => $search ?? ''])->links() }}
            </div>
        @endif
    @else
        <div class="rooms-grid">
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <p>Tidak ada ruangan yang tersedia</p>
            </div>
        </div>
    @endif
</div>

<!-- Detail Profile Modal -->
<div class="detail-modal-overlay" id="detailModal" onclick="closeDetailModal(event)">
    <div class="detail-modal-wrapper" onclick="event.stopPropagation()">
        <div class="detail-modal-header">
            <button class="detail-modal-close" onclick="closeDetailModal()">
                <i class="fas fa-times"></i>
            </button>
            <h2 class="detail-modal-title" id="detailRoomName"></h2>
            <div class="detail-modal-badges" id="detailBadges"></div>
        </div>
        
        <div class="detail-image-carousel" id="detailImageCarousel">
            <div class="detail-image-wrapper">
                <img id="detailImage" class="detail-image" src="" alt="Room image">
            </div>
            <button class="detail-image-nav prev" id="detailPrev" onclick="detailPrevImage()" style="display:none;">
                <i class="fas fa-chevron-left"></i>
            </button>
            <button class="detail-image-nav next" id="detailNext" onclick="detailNextImage()" style="display:none;">
                <i class="fas fa-chevron-right"></i>
            </button>
            <div class="detail-image-dots" id="detailDots"></div>
            <div class="detail-image-counter" id="detailCounter" style="display:none;"></div>
        </div>

        <div class="detail-modal-content">
            <div class="detail-image-thumbnails" id="detailThumbnails">
                <div class="detail-thumbnails-title">Foto-foto Ruangan</div>
                <div class="detail-thumbnails-grid" id="detailThumbnailsGrid"></div>
            </div>

            <div style="margin-top: 2rem;">
                <h3 class="detail-description-title">
                    <i class="fas fa-align-left"></i> Deskripsi Ruangan
                </h3>
                <div class="detail-description-text" id="detailDescriptionText"></div>
                <div class="detail-description-empty">Tidak ada deskripsi untuk ruangan ini</div>
            </div>
        </div>
    </div>
</div>

<script>
    // Detail Modal Data
    const detailModalData = {
        @foreach($items as $item)
            "{{ $item->id }}": {
                name: "{{ $item->room_name }}",
                floor: "{{ $item->floor ?? '' }}",
                capacity: "{{ $item->capacity ?? '' }}",
                description: `{{ str_replace('`', '\`', e($item->description)) }}`,
                images: [
                    @foreach($item->images as $image)
                        "{{ route('profile-ruangan.image', ['filename' => basename($image->image_path)]) }}"{{ !$loop->last ? ',' : '' }}
                    @endforeach
                ]
            }{{ !$loop->last ? ',' : '' }}
        @endforeach
    };

    let currentDetailRoomId = null;
    let currentDetailImageIndex = 0;

    function openDetailModal(roomId, element) {
        const data = detailModalData[roomId];
        if (!data) return;

        currentDetailRoomId = roomId;
        currentDetailImageIndex = 0;

        // Set content
        document.getElementById('detailRoomName').textContent = data.name;
        
        // Set badges
        const badgesHtml = `
            ${data.floor ? `<div class="detail-badge"><i class="fas fa-layer-group"></i> Lantai ${data.floor}</div>` : ''}
            ${data.capacity ? `<div class="detail-badge"><i class="fas fa-users"></i> Kapasitas ${data.capacity} Orang</div>` : ''}
        `;
        document.getElementById('detailBadges').innerHTML = badgesHtml;

        // Set image
        updateDetailImage();

        // Set thumbnails
        if (data.images.length > 0) {
            const thumbnailsHtml = data.images.map((img, idx) => `
                <div class="detail-thumbnail ${idx === 0 ? 'active' : ''}" onclick="selectDetailImage(${idx})">
                    <img src="${img}" alt="Foto ${idx + 1}">
                </div>
            `).join('');
            document.getElementById('detailThumbnailsGrid').innerHTML = thumbnailsHtml;

            // Hide thumbnails if only one image
            document.getElementById('detailThumbnails').style.display = data.images.length > 1 ? 'block' : 'none';
        }

        // Set description
        const descText = document.getElementById('detailDescriptionText');
        if (data.description && data.description.trim()) {
            descText.textContent = data.description;
            descText.style.display = 'block';
        } else {
            descText.style.display = 'none';
        }

        // Show/hide navigation
        const showNav = data.images.length > 1;
        document.getElementById('detailPrev').style.display = showNav ? 'flex' : 'none';
        document.getElementById('detailNext').style.display = showNav ? 'flex' : 'none';
        document.getElementById('detailCounter').style.display = showNav ? 'block' : 'none';

        // Update dots
        updateDetailDots();

        // Show modal
        document.getElementById('detailModal').classList.add('active');
    }

    function updateDetailImage() {
        const data = detailModalData[currentDetailRoomId];
        if (!data || !data.images[currentDetailImageIndex]) return;

        document.getElementById('detailImage').src = data.images[currentDetailImageIndex];
        document.getElementById('detailCounter').textContent = `${currentDetailImageIndex + 1} / ${data.images.length}`;

        // Update thumbnails
        const thumbnails = document.querySelectorAll('.detail-thumbnail');
        thumbnails.forEach((thumb, idx) => {
            thumb.classList.toggle('active', idx === currentDetailImageIndex);
        });
    }

    function updateDetailDots() {
        const data = detailModalData[currentDetailRoomId];
        if (!data) return;

        const dotsHtml = data.images.map((_, idx) => `
            <div class="detail-image-dot ${idx === currentDetailImageIndex ? 'active' : ''}" onclick="selectDetailImage(${idx})"></div>
        `).join('');
        document.getElementById('detailDots').innerHTML = dotsHtml;
    }

    function selectDetailImage(index) {
        currentDetailImageIndex = index;
        updateDetailImage();
        updateDetailDots();
    }

    function detailPrevImage() {
        const data = detailModalData[currentDetailRoomId];
        if (!data) return;
        currentDetailImageIndex = (currentDetailImageIndex - 1 + data.images.length) % data.images.length;
        updateDetailImage();
        updateDetailDots();
    }

    function detailNextImage() {
        const data = detailModalData[currentDetailRoomId];
        if (!data) return;
        currentDetailImageIndex = (currentDetailImageIndex + 1) % data.images.length;
        updateDetailImage();
        updateDetailDots();
    }

    function closeDetailModal(event) {
        if (!event || event.target.id === 'detailModal') {
            document.getElementById('detailModal').classList.remove('active');
        }
    }

    // Keyboard navigation for detail modal
    document.addEventListener('keydown', (e) => {
        if (document.getElementById('detailModal').classList.contains('active')) {
            if (e.key === 'ArrowLeft') detailPrevImage();
            if (e.key === 'ArrowRight') detailNextImage();
            if (e.key === 'Escape') closeDetailModal();
        }
    });

    // Prevent image modal from opening when clicking on card
    function slidePrev(roomId) {
        const slider = document.getElementById(`slider-${roomId}`);
        const inputs = slider.querySelectorAll('input[type="radio"]');
        let currentIndex = 0;
        
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].checked) {
                currentIndex = i;
                break;
            }
        }
        
        const prevIndex = (currentIndex - 1 + inputs.length) % inputs.length;
        inputs[prevIndex].checked = true;
        updateCounter(roomId, prevIndex);
    }

    function slideNext(roomId) {
        const slider = document.getElementById(`slider-${roomId}`);
        const inputs = slider.querySelectorAll('input[type="radio"]');
        let currentIndex = 0;
        
        for (let i = 0; i < inputs.length; i++) {
            if (inputs[i].checked) {
                currentIndex = i;
                break;
            }
        }
        
        const nextIndex = (currentIndex + 1) % inputs.length;
        inputs[nextIndex].checked = true;
        updateCounter(roomId, nextIndex);
    }

    function updateCounter(roomId, index) {
        const counter = document.getElementById(`counter-${roomId}`);
        if (counter) counter.textContent = index + 1;
    }

    // Modal functions removed
</script>

@endsection