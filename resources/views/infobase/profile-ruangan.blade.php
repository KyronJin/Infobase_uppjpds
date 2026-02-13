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
        background: #0052CC;
        border-color: #0052CC;
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
        background: linear-gradient(135deg, #0052CC 0%, #003A99 100%);
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
        background: linear-gradient(135deg, #0052CC 0%, #003A99 100%);
        color: white;
        border-radius: 0.4rem;
        font-size: 0.7rem;
        font-weight: 600;
        box-shadow: 0 2px 8px rgba(0, 82, 204, 0.25);
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
        background: linear-gradient(135deg, #E0EAFF 0%, rgba(0, 82, 204, 0.05) 100%);
        border-left: 3px solid #0052CC;
        padding: 0.7rem;
        border-radius: 0.4rem;
        color: #374151;
        line-height: 1.5;
        font-size: 0.8rem;
        margin-top: 0.6rem;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.92);
        z-index: 1000;
        backdrop-filter: blur(8px);
    }

    .modal-overlay.active {
        display: flex;
        align-items: center;
        justify-content: center;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .modal-content {
        position: relative;
        max-width: 90vw;
        max-height: 90vh;
        animation: slideUp 0.3s ease;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .modal-content img {
        max-width: 90%;
        max-height: 80vh;
        object-fit: contain;
        border-radius: 0.75rem;
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 28px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        z-index: 1001;
        backdrop-filter: blur(10px);
    }

    .modal-close:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
        transform: scale(1.1);
    }

    .modal-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.15);
        border: 2px solid rgba(255, 255, 255, 0.3);
        color: white;
        width: 50px;
        height: 50px;
        border-radius: 50%;
        font-size: 20px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.2s;
        z-index: 1001;
        backdrop-filter: blur(10px);
    }

    .modal-nav:hover {
        background: rgba(255, 255, 255, 0.25);
        border-color: rgba(255, 255, 255, 0.5);
        transform: translateY(-50%) scale(1.1);
    }

    .modal-nav.prev {
        left: 20px;
    }

    .modal-nav.next {
        right: 20px;
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
                <div class="room-card">
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
                                    <figure class="slider-figure" onclick="openImageModal('{{ route('profile-ruangan.image', ['filename' => basename($image->image_path)]) }}', {{ $item->id }}, {{ $index }})">
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

<!-- Modal -->
<div class="modal-overlay" id="imageModal" onclick="closeImageModal(event)">
    <div class="modal-content" onclick="event.stopPropagation()">
        <button class="modal-close" onclick="closeImageModal()">
            <i class="fas fa-times"></i>
        </button>
        <img id="modalImage" src="" alt="Full Image">
        <button class="modal-nav prev" id="modalPrev" onclick="prevImageModal()" style="display:none;">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button class="modal-nav next" id="modalNext" onclick="nextImageModal()" style="display:none;">
            <i class="fas fa-chevron-right"></i>
        </button>
    </div>
</div>

<script>
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

    // Modal
    let currentModalRoomId = null;
    let currentModalImageIndex = 0;
    let currentModalImages = [];

    function openImageModal(imageSrc, roomId, imageIndex) {
        const slider = document.querySelector(`[id="slider-${roomId}"]`);
        const images = slider.querySelectorAll('.slider-figure img');
        currentModalImages = Array.from(images).map(img => img.src);
        currentModalRoomId = roomId;
        currentModalImageIndex = imageIndex;

        document.getElementById('modalImage').src = imageSrc;
        document.getElementById('imageModal').classList.add('active');
        updateModalNav();
    }

    function closeImageModal(event) {
        if (!event || event.target.id === 'imageModal') {
            document.getElementById('imageModal').classList.remove('active');
        }
    }

    function prevImageModal() {
        currentModalImageIndex = (currentModalImageIndex - 1 + currentModalImages.length) % currentModalImages.length;
        document.getElementById('modalImage').src = currentModalImages[currentModalImageIndex];
    }

    function nextImageModal() {
        currentModalImageIndex = (currentModalImageIndex + 1) % currentModalImages.length;
        document.getElementById('modalImage').src = currentModalImages[currentModalImageIndex];
    }

    function updateModalNav() {
        const prev = document.getElementById('modalPrev');
        const next = document.getElementById('modalNext');
        prev.style.display = currentModalImages.length > 1 ? 'flex' : 'none';
        next.style.display = currentModalImages.length > 1 ? 'flex' : 'none';
    }

    document.addEventListener('keydown', (e) => {
        if (document.getElementById('imageModal').classList.contains('active')) {
            if (e.key === 'ArrowLeft') prevImageModal();
            if (e.key === 'ArrowRight') nextImageModal();
            if (e.key === 'Escape') closeImageModal();
        }
    });
</script>

@endsection