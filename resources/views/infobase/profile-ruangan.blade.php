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
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 2rem;
        position: relative;
        z-index: 1;
    }

    .page-header .header-left span {
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
        font-size: 3rem;
        font-weight: 700;
        color: white;
        margin: 0;
        text-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .page-header p {
        color: rgba(255, 255, 255, 0.9);
        font-size: 1.125rem;
        margin-top: 0.5rem;
    }

    .page-header .back-link {
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

    .page-header .back-link:hover {
        background: rgba(255, 255, 255, 0.25);
        transform: translateX(-4px);
    }

    /* Slider Container */
    .slider-wrapper {
        width: 100%;
        margin: 2rem 0;
        perspective: 1000px;
    }

    .slider {
        position: relative;
        width: 100%;
        height: 400px;
        background: linear-gradient(135deg, #1f2937 0%, #374151 100%);
        overflow: hidden;
        border-radius: 1.5rem;
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
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

    /* Slider Navigation Arrows */
    .slider-arrow {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.2);
        color: white;
        border: 2px solid rgba(255, 255, 255, 0.5);
        width: 60px;
        height: 60px;
        border-radius: 50%;
        font-size: 24px;
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
        left: 20px;
    }

    .slider-arrow.next {
        right: 20px;
    }

    /* Slider Dots Navigation */
    .slider-dots {
        position: absolute;
        bottom: 85px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 10px;
        z-index: 15;
    }

    .slider-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.4);
        border: 2px solid rgba(255, 255, 255, 0.7);
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
        background: #f85e38;
        border-color: #f85e38;
        transform: scale(1.3);
    }

    /* Slider Counter */
    .slider-counter {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.5);
        color: white;
        padding: 10px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        z-index: 20;
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    /* Thumbnail Navigation */
    .slider-thumbnails {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 80px;
        background: linear-gradient(180deg, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.6) 100%);
        display: flex;
        align-items: center;
        padding: 8px 12px;
        gap: 8px;
        overflow-x: auto;
        overflow-y: hidden;
        z-index: 15;
        backdrop-filter: blur(5px);
    }

    .slider-thumbnails::-webkit-scrollbar {
        height: 6px;
    }

    .slider-thumbnails::-webkit-scrollbar-track {
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
    }

    .slider-thumbnails::-webkit-scrollbar-thumb {
        background: rgba(255, 255, 255, 0.3);
        border-radius: 10px;
    }

    .slider-thumbnails::-webkit-scrollbar-thumb:hover {
        background: rgba(255, 255, 255, 0.5);
    }

    .slider-thumb {
        flex: 0 0 70px;
        height: 60px;
        border-radius: 8px;
        overflow: hidden;
        cursor: pointer;
        border: 3px solid transparent;
        opacity: 0.6;
        transition: all 0.3s ease;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }

    .slider-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slider-thumb:hover {
        opacity: 0.9;
        transform: scale(1.05);
    }

    .slider input[type="radio"]:checked ~ .slider-thumbnails .slider-thumb:nth-child(1),
    .slider input[type="radio"]:nth-of-type(1):checked ~ .slider-thumbnails .slider-thumb:nth-child(1),
    .slider input[type="radio"]:nth-of-type(2):checked ~ .slider-thumbnails .slider-thumb:nth-child(2),
    .slider input[type="radio"]:nth-of-type(3):checked ~ .slider-thumbnails .slider-thumb:nth-child(3),
    .slider input[type="radio"]:nth-of-type(4):checked ~ .slider-thumbnails .slider-thumb:nth-child(4),
    .slider input[type="radio"]:nth-of-type(5):checked ~ .slider-thumbnails .slider-thumb:nth-child(5) {
        border-color: #f85e38;
        opacity: 1;
        box-shadow: 0 4px 15px rgba(248, 94, 56, 0.4);
    }

    /* Room Info Section */
    .room-info {
        background: white;
        padding: 2rem;
        margin-bottom: 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(248, 94, 56, 0.1);
        transition: all 0.3s ease;
    }

    .room-info:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .room-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.75rem;
        background: linear-gradient(135deg, #f85e38 0%, #d94e2e 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .room-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .room-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.5rem 1rem;
        background: linear-gradient(135deg, #f85e38 0%, #d94e2e 100%);
        color: white;
        border-radius: 0.75rem;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(248, 94, 56, 0.3);
        transition: all 0.3s ease;
    }

    .room-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(248, 94, 56, 0.4);
    }

    .room-badge i {
        font-size: 1rem;
    }

    .room-description {
        background: linear-gradient(135deg, #fee8e0 0%, rgba(248, 94, 56, 0.05) 100%);
        border-left: 4px solid #f85e38;
        padding: 1rem;
        border-radius: 0.75rem;
        color: #374151;
        line-height: 1.6;
        font-size: 0.95rem;
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
        width: 100%;
        height: 100%;
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
        max-width: 900px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .empty-state {
        text-align: center;
        padding: 6rem 2rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #f0f1f3 100%);
        border-radius: 1.5rem;
        border: 2px dashed #e5e7eb;
    }

    .empty-state i {
        font-size: 5rem;
        color: #d1d5db;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }
</style>

<div class="page-header">
    <div class="header-content">
        <div class="header-left">
            <span><i class="fas fa-door-open mr-2"></i>Profil Ruangan</span>
            <h1><i class="fas fa-building mr-3 text-[#f85e38]"></i>Ruangan & Fasilitas</h1>
            <p>Jelajahi ruangan dan fasilitas yang tersedia di perpustakaan kami.</p>
        </div>
        <a href="{{ route('infobase.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali ke Infobase
        </a>
    </div>
</div>

<div class="container">
    @forelse($items as $item)
        <!-- Slider -->
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
                        <figure class="slider-figure" onclick="openImageModal('{{ asset('storage/' . $image->image_path) }}', {{ $item->id }}, {{ $index }})">
                            <img src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $item->room_name }}">
                        </figure>
                    @endforeach

                    <!-- Dots -->
                    @if($item->images->count() > 1)
                        <div class="slider-dots">
                            @foreach($item->images as $index => $image)
                                <label class="slider-dot" for="img-{{ $item->id }}-{{ $index }}"></label>
                            @endforeach
                        </div>

                        <!-- Arrows -->
                        <button class="slider-arrow prev" onclick="slidePrev('{{ $item->id }}')">
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button class="slider-arrow next" onclick="slideNext('{{ $item->id }}')">
                            <i class="fas fa-chevron-right"></i>
                        </button>

                        <!-- Counter -->
                        <div class="slider-counter">
                            <span id="counter-{{ $item->id }}">1</span> / {{ $item->images->count() }}
                        </div>

                        <!-- Thumbnails -->
                        <div class="slider-thumbnails">
                            @foreach($item->images as $index => $image)
                                <label class="slider-thumb" for="img-{{ $item->id }}-{{ $index }}">
                                    <img src="{{ asset('storage/' . $image->image_path) }}" alt="Thumbnail {{ $index + 1 }}">
                                </label>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        @endif

        <!-- Room Info -->
        <div class="room-info">
            <h2 class="room-title">{{ $item->room_name }}</h2>
            
            <div class="room-meta">
                <span class="room-badge">
                    <i class="fas fa-layer-group"></i>Lantai {{ $item->floor }}
                </span>
                <span class="room-badge">
                    <i class="fas fa-users"></i>Kapasitas {{ $item->capacity }} Orang
                </span>
            </div>

            @if($item->description)
                <div class="room-description">
                    {!! nl2br(e($item->description)) !!}
                </div>
            @endif
        </div>
    @empty
        <div class="empty-state">
            <i class="fas fa-inbox"></i>
            <p>Tidak ada ruangan yang tersedia</p>
        </div>
    @endforelse
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