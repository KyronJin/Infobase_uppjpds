@extends('layouts.app')

@section('content')

<style>
    * { box-sizing: border-box; }
    body, html { padding: 0; margin: 0; }

    .page-header {
        background: #f8fafc;
        padding: 2rem 0;
        border-bottom: 1px solid #e2e8f0;
        margin-top: 2rem;
    }

    .page-header .header-content {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 2rem;
    }

    .page-header .header-left span {
        display: inline-block;
        padding: 0.5rem 1rem;
        background: #fee8e0;
        color: #f85e38;
        font-size: 0.875rem;
        font-weight: 700;
        border-radius: 9999px;
        border: 1px solid #fdd4c3;
        margin-bottom: 1rem;
    }

    .page-header h1 {
        font-size: 3rem;
        font-weight: 700;
        color: #1f2937;
        margin: 0;
    }

    .page-header p {
        color: #4b5563;
        font-size: 1.125rem;
        margin-top: 0.5rem;
    }

    .page-header .back-link {
        color: #f85e38;
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.2s;
    }

    .page-header .back-link:hover {
        color: #d94e2e;
    }

    /* Slider Container */
    .slider-wrapper {
        width: 100%;
        margin: 2rem 0;
    }

    .slider {
        position: relative;
        width: 100%;
        height: 500px;
        background: #000;
        overflow: hidden;
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
        transition: opacity 0.5s ease-in-out;
    }

    .slider-figure img {
        width: 100%;
        height: 100%;
        object-fit: contain;
        background: #000;
        cursor: pointer;
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
        background: rgba(255, 255, 255, 0.25);
        color: white;
        border: none;
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
    }

    .slider-arrow:hover {
        background: rgba(255, 255, 255, 0.5);
        transform: translateY(-50%) scale(1.1);
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
        bottom: 100px;
        left: 50%;
        transform: translateX(-50%);
        display: flex;
        gap: 12px;
        z-index: 15;
    }

    .slider-dot {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.5);
        border: 2px solid #f85e38;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .slider-dot:hover {
        background: rgba(255, 255, 255, 0.8);
    }

    .slider input[type="radio"]:checked ~ .slider-dots .slider-dot:nth-child(1),
    .slider input[type="radio"]:nth-of-type(1):checked ~ .slider-dots .slider-dot:nth-child(1),
    .slider input[type="radio"]:nth-of-type(2):checked ~ .slider-dots .slider-dot:nth-child(2),
    .slider input[type="radio"]:nth-of-type(3):checked ~ .slider-dots .slider-dot:nth-child(3),
    .slider input[type="radio"]:nth-of-type(4):checked ~ .slider-dots .slider-dot:nth-child(4),
    .slider input[type="radio"]:nth-of-type(5):checked ~ .slider-dots .slider-dot:nth-child(5) {
        background: #f85e38;
    }

    /* Slider Counter */
    .slider-counter {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(0, 0, 0, 0.7);
        color: white;
        padding: 8px 16px;
        border-radius: 20px;
        font-size: 13px;
        font-weight: 600;
        z-index: 20;
    }

    /* Thumbnail Navigation */
    .slider-thumbnails {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        width: 100%;
        height: 90px;
        background: rgba(0, 0, 0, 0.7);
        display: flex;
        align-items: center;
        padding: 8px 10px;
        gap: 8px;
        overflow-x: auto;
        overflow-y: hidden;
        z-index: 15;
    }

    .slider-thumb {
        flex: 0 0 80px;
        height: 74px;
        border-radius: 6px;
        overflow: hidden;
        cursor: pointer;
        border: 2px solid transparent;
        opacity: 0.6;
        transition: all 0.3s ease;
    }

    .slider-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .slider-thumb:hover {
        opacity: 0.8;
    }

    .slider input[type="radio"]:checked ~ .slider-thumbnails .slider-thumb:nth-child(1),
    .slider input[type="radio"]:nth-of-type(1):checked ~ .slider-thumbnails .slider-thumb:nth-child(1),
    .slider input[type="radio"]:nth-of-type(2):checked ~ .slider-thumbnails .slider-thumb:nth-child(2),
    .slider input[type="radio"]:nth-of-type(3):checked ~ .slider-thumbnails .slider-thumb:nth-child(3),
    .slider input[type="radio"]:nth-of-type(4):checked ~ .slider-thumbnails .slider-thumb:nth-child(4),
    .slider input[type="radio"]:nth-of-type(5):checked ~ .slider-thumbnails .slider-thumb:nth-child(5) {
        border-color: #f85e38;
        opacity: 1;
    }

    /* Room Info Section */
    .room-info {
        background: white;
        padding: 2rem;
        margin-bottom: 3rem;
    }

    .room-title {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .room-meta {
        display: flex;
        flex-wrap: wrap;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .room-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.5rem 1rem;
        background: #f85e38;
        color: white;
        border-radius: 0.5rem;
        font-size: 0.875rem;
        font-weight: 600;
    }

    .room-description {
        background: #fee8e0;
        border-left: 3px solid #f85e38;
        padding: 1rem;
        border-radius: 0.5rem;
        color: #1f2937;
        line-height: 1.6;
    }

    /* Modal */
    .modal-overlay {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.95);
        z-index: 1000;
        backdrop-filter: blur(5px);
    }

    .modal-overlay.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        position: relative;
        max-width: 90%;
        max-height: 90vh;
    }

    .modal-content img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .modal-close {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.15);
        border: none;
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
    }

    .modal-close:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .modal-nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(255, 255, 255, 0.15);
        border: none;
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
    }

    .modal-nav:hover {
        background: rgba(255, 255, 255, 0.3);
    }

    .modal-nav.prev {
        left: 20px;
    }

    .modal-nav.next {
        right: 20px;
    }

    /* Container */
    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 2rem;
    }

    .empty-state i {
        font-size: 4rem;
        color: #d1d5db;
        margin-bottom: 1rem;
    }

    .empty-state p {
        color: #4b5563;
        font-size: 1.125rem;
        font-weight: 600;
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