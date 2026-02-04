@extends('layouts.app')

@section('content')
<style>
    * { box-sizing: border-box; }
    body, html { padding: 0; margin: 0; }

    /* Modal Styles */
    .modal-overlay {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        backdrop-filter: blur(4px);
        z-index: 999;
        animation: fadeIn 0.3s ease-in-out;
    }

    .modal-overlay.active {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-content {
        background: white;
        border-radius: 12px;
        padding: 2.5rem;
        max-width: 600px;
        width: 90%;
        max-height: 80vh;
        overflow-y: auto;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.2);
        animation: slideUp 0.3s ease-out;
    }

    .modal-header {
        display: flex;
        justify-content: space-between;
        align-items: start;
        margin-bottom: 1.5rem;
        border-bottom: 2px solid #f85e38;
        padding-bottom: 1rem;
    }

    .modal-header h2 {
        margin: 0;
        color: #00425A;
        font-size: 1.5rem;
        max-width: 80%;
    }

    .modal-close {
        background: none;
        border: none;
        font-size: 1.5rem;
        color: #666;
        cursor: pointer;
        padding: 0;
        width: 30px;
        height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: color 0.2s;
    }

    .modal-close:hover {
        color: #f85e38;
    }

    .modal-body {
        color: #555;
        line-height: 1.8;
    }

    .modal-body img {
        max-width: 100%;
        height: auto;
        margin: 1rem 0;
        border-radius: 8px;
    }

    .modal-footer {
        margin-top: 2rem;
        padding-top: 1rem;
        border-top: 1px solid #eee;
        color: #999;
        font-size: 0.875rem;
    }

    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

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

    .container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1.5rem;
        background: linear-gradient(135deg, rgba(248, 94, 56, 0.02) 0%, rgba(0, 66, 90, 0.02) 100%);
        border-radius: 0;
    }

    .content-wrapper {
        padding: 3rem 0;
        background: linear-gradient(to bottom, transparent, rgba(255, 255, 255, 0.5));
    }

    .pengumuman-card {
        background: white;
        padding: 2.5rem;
        margin-bottom: 2rem;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(248, 94, 56, 0.1);
        transition: all 0.3s ease;
    }

    .pengumuman-card:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .pengumuman-header {
        display: flex;
        gap: 2rem;
        margin-bottom: 1.5rem;
    }

    .pengumuman-date {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 100px;
        padding: 1rem;
        background: linear-gradient(135deg, #f85e38 0%, #d94e2e 100%);
        color: white;
        border-radius: 1rem;
        font-weight: 700;
    }

    .pengumuman-date-day {
        font-size: 1.75rem;
        line-height: 1;
    }

    .pengumuman-date-month {
        font-size: 0.875rem;
        text-transform: uppercase;
        opacity: 0.9;
        margin-top: 0.25rem;
    }

    .pengumuman-date-year {
        font-size: 0.75rem;
        opacity: 0.8;
        margin-top: 0.25rem;
    }

    .pengumuman-content {
        flex: 1;
    }

    .pengumuman-image {
        width: 100%;
        height: 250px;
        object-fit: cover;
        border-radius: 1rem;
        margin-bottom: 1.5rem;
    }

    .pengumuman-title {
        font-size: 1.75rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }

    .pengumuman-card:hover .pengumuman-title {
        color: #f85e38;
    }

    .pengumuman-description {
        color: #374151;
        line-height: 1.8;
        margin-bottom: 1.5rem;
        font-size: 1rem;
    }

    .pengumuman-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
    }

    .pengumuman-date-valid {
        display: flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.9rem;
    }

    .pengumuman-date-valid::before {
        content: '';
        width: 8px;
        height: 8px;
        background: #10b981;
        border-radius: 50%;
    }

    .pengumuman-read-more {
        color: #f85e38;
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s;
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;
        font-family: inherit;
        font-size: 1rem;
    }

    .pengumuman-read-more:hover {
        gap: 1rem;
        color: #d94e2e;
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

    .empty-state h3 {
        color: #1f2937;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 1rem;
        margin-top: 0.5rem;
    }
</style>

<div class="page-header">
    <div class="header-content">
        <div class="header-left">
            <span><i class="fas fa-bell mr-2"></i>Pengumuman</span>
            <h1><i class="fas fa-megaphone mr-3 text-white"></i>Pengumuman & Informasi</h1>
            <p>Dapatkan berita dan informasi terbaru dari perpustakaan kami.</p>
        </div>
        <a href="{{ route('infobase.index') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali ke Infobase
        </a>
    </div>
</div>

<div class="container">
    <div class="content-wrapper">
        @if(isset($pengumumans) && $pengumumans->count())
            @foreach($pengumumans as $item)
                <div class="pengumuman-card">
                    <div class="pengumuman-header">
                        <div class="pengumuman-date">
                            <div class="pengumuman-date-day">{{ $item->published_at?->format('d') ?? '00' }}</div>
                            <div class="pengumuman-date-month">{{ $item->published_at?->format('M') ?? 'Jan' }}</div>
                            <div class="pengumuman-date-year">{{ $item->published_at?->format('Y') ?? '2024' }}</div>
                        </div>
                        <div class="pengumuman-content">
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="pengumuman-image">
                            @endif
                            <h2 class="pengumuman-title">{{ $item->title }}</h2>
                            <p class="pengumuman-description">{!! nl2br(e($item->description)) !!}</p>
                            <div class="pengumuman-footer">
                                <div class="pengumuman-date-valid">
                                    Berlaku: {{ $item->valid_from?->format('d/m/Y') ?? '-' }} - {{ $item->valid_until?->format('d/m/Y') ?? '-' }}
                                </div>
                                <button class="pengumuman-read-more" onclick="openModal({{ $item->id }}, '{{ addslashes($item->title) }}', '{!! addslashes(nl2br(e($item->description))) !!}', '{{ $item->image_path ? asset('storage/' . $item->image_path) : '' }}')">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Belum ada pengumuman</h3>
                <p>Kami akan segera mengabari Anda jika ada informasi terbaru tersedia.</p>
            </div>
        @endif
    </div>
</div>

<!-- Modal -->
<div class="modal-overlay" id="detailModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 id="modalTitle"></h2>
            <button class="modal-close" onclick="closeModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div id="modalImage"></div>
            <div id="modalDescription"></div>
        </div>
        <div class="modal-footer">
            <p id="modalFooter"></p>
        </div>
    </div>
</div>

<script>
    function openModal(id, title, description, image) {
        document.getElementById('modalTitle').textContent = title;
        document.getElementById('modalDescription').innerHTML = description;
        
        if (image) {
            document.getElementById('modalImage').innerHTML = '<img src="' + image + '" alt="' + title + '">';
        } else {
            document.getElementById('modalImage').innerHTML = '';
        }
        
        const now = new Date();
        document.getElementById('modalFooter').textContent = 'Diakses pada ' + now.toLocaleString('id-ID');
        
        document.getElementById('detailModal').classList.add('active');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        document.getElementById('detailModal').classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Close modal when clicking outside
    document.getElementById('detailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeModal();
        }
    });

    // Close modal with Escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeModal();
        }
    });
</script>

@endsection