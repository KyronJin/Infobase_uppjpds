@extends('layouts.app')

@section('content')
<style>
    /* Pengumuman Card Styles */
    .pengumuman-card {
        background: white;
        padding: 1.5rem;
        margin-bottom: 1.25rem;
        border-radius: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 82, 204, 0.1);
        transition: all 0.3s ease;
    }

    .pengumuman-card:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .pengumuman-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1rem;
    }

    .pengumuman-date {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 85px;
        padding: 0.75rem;
        background: linear-gradient(135deg, #0052CC 0%, #0044A3 100%);
        color: white;
        border-radius: 8px;
        font-weight: 700;
    }

    .pengumuman-date-day {
        font-size: 1.5rem;
        line-height: 1;
    }

    .pengumuman-date-month {
        font-size: 0.75rem;
        text-transform: uppercase;
        opacity: 0.85;
        margin-top: 0.2rem;
    }

    .pengumuman-content {
        flex: 1;
    }

    .pengumuman-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 1rem;
    }

    .pengumuman-title {
        font-size: 1.25rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.75rem;
        transition: all 0.3s ease;
    }

    .pengumuman-card:hover .pengumuman-title {
        color: #0052CC;
    }

    .pengumuman-description {
        color: #374151;
        line-height: 1.6;
        margin-bottom: 1rem;
        font-size: 0.9rem;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }

    .pengumuman-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
        gap: 1rem;
    }

    .pengumuman-date-valid {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        color: #6b7280;
        font-size: 0.8rem;
        white-space: nowrap;
    }

    .pengumuman-date-valid::before {
        content: '';
        width: 6px;
        height: 6px;
        background: #10b981;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .pengumuman-read-more {
        color: #ffffff;
        background: linear-gradient(135deg, #0052CC 0%, #003A99 100%);
        text-decoration: none;
        font-weight: 600;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        padding: 0.5rem 1rem;
        font-size: 0.85rem;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 82, 204, 0.2);
        white-space: nowrap;
        flex-shrink: 0;
    }

    .pengumuman-read-more:hover {
        background: linear-gradient(135deg, #003A99 0%, #00297a 100%);
        box-shadow: 0 4px 12px rgba(0, 82, 204, 0.35);
        transform: translateY(-2px);
    }

    .pengumuman-read-more:active {
        transform: translateY(0);
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

    /* Modal enhancements */
    .modal-read-time {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: #0052CC;
        font-weight: 500;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .modal-read-time svg {
        width: 16px;
        height: 16px;
    }
</style>

<div class="page-header">
    <div class="header-content">
        <div class="header-left">
            <span><i class="fas fa-bullhorn mr-2"></i>Informasi Terkini</span>
            <h1><i class="fas fa-bullhorn mr-3 text-white"></i>Pengumuman</h1>
            <p>Dapatkan berita dan informasi terbaru mengenai layanan dan kegiatan Perpustakaan Jakarta.</p>
        </div>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
</div>

<!-- Breadcrumb -->
<div class="bg-gray-100 border-b border-gray-200">
    <div class="max-w-7xl mx-auto px-6 py-3">
        <nav class="flex items-center gap-2 text-sm">
            <a href="{{ route('home') }}" class="text-gray-600 hover:text-[#063A76] transition duration-300">
                <i class="fas fa-home mr-1"></i>Beranda
            </a>
            <i class="fas fa-chevron-right text-gray-400 text-xs"></i>
            <span class="text-[#063A76] font-semibold">Pengumuman</span>
        </nav>
    </div>
</div>

{{-- Search Form --}}
@include('partials.search-form', [
    'action' => route('infobase.pengumuman'),
    'placeholder' => 'Cari pengumuman berdasarkan judul atau isi...',
    'search' => $search ?? '',
    'resultCount' => isset($pengumumans) ? $pengumumans->total() : null
])

<div class="min-h-screen bg-[#f8fafc] pt-12 pb-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="content-wrapper grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        @if(isset($pengumumans) && $pengumumans->count())
            @foreach($pengumumans as $item)
                <div class="pengumuman-card">
                    <div class="pengumuman-header">
                        <div class="pengumuman-date">
                            <div class="pengumuman-date-day">{{ $item->published_at?->format('d') ?? '00' }}</div>
                            <div class="pengumuman-date-month">{{ $item->published_at?->format('M') ?? 'Jan' }}</div>
                        </div>
                        <div class="pengumuman-content">
                            @if($item->image_path)
                                <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="pengumuman-image">
                            @endif
                            <h2 class="pengumuman-title">{{ $item->title }}</h2>
                            <p class="pengumuman-description">{!! $item->description !!}</p>
                            <div class="pengumuman-footer">
                                <div class="pengumuman-date-valid">
                                    Berlaku: {{ $item->valid_from?->format('d/m/Y') ?? '-' }} - {{ $item->valid_until?->format('d/m/Y') ?? '-' }}
                                </div>
                                <button type="button" class="pengumuman-read-more" data-pengumuman-id="{{ $item->id }}" data-title="{{ $item->title }}" data-description="{{ $item->description }}" data-image="{{ $item->image_path ? asset('storage/' . $item->image_path) : '' }}">
                                    Baca Selengkapnya <i class="fas fa-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            <!-- Pagination -->
            <div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem; display: flex; justify-content: center;">
                {{ $pengumumans->appends(['search' => $search ?? ''])->links() }}
            </div>
        @else
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>{{ $search ? 'Tidak ada hasil pencarian' : 'Belum ada pengumuman' }}</h3>
                <p>
                    @if($search)
                        Coba gunakan kata kunci yang berbeda untuk mencari pengumuman.
                    @else
                        Kami akan segera mengabari Anda jika ada informasi terbaru tersedia.
                    @endif
                </p>
            </div>
        @endif
    </div>
    </div>
</div>

<!-- Modal: gunakan dari consistent-layout.css -->
<div class="modal-overlay" id="pengumumanDetailModal">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div>
                <h2 id="pengumumanTitle"></h2>
                <div class="modal-read-time" id="pengumumanReadTime"></div>
            </div>
            <button type="button" class="modal-close" onclick="closePengumumanModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div id="pengumumanImage"></div>
            <div id="pengumumanDescription"></div>
        </div>
        <div class="modal-footer">
            <p id="pengumumanFooter"></p>
        </div>
    </div>
</div>

<script>
    function calculateReadingTime(text) {
        const plain = text.replace(/<[^>]*>/g, '');
        const words = plain.trim().split(/\s+/).length;
        return Math.max(1, Math.ceil(words / 200));
    }

    document.querySelectorAll('.pengumuman-read-more').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const image = this.getAttribute('data-image');
            
            // Set konten
            document.getElementById('pengumumanTitle').textContent = title;
            document.getElementById('pengumumanDescription').innerHTML = description;
            
            // Hitung reading time
            const readTime = calculateReadingTime(description);
            document.getElementById('pengumumanReadTime').innerHTML = 
                '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' +
                '<span>Waktu baca: <strong>' + readTime + ' menit</strong></span>';
            
            // Set image
            if (image && image.trim() !== '') {
                document.getElementById('pengumumanImage').innerHTML = 
                    '<img src="' + image + '" alt="' + title + '" style="cursor: pointer; width: 100%; border-radius: 8px; margin-bottom: 1rem;" onclick="window.open(this.src, \'_blank\')">';
            } else {
                document.getElementById('pengumumanImage').innerHTML = '';
            }
            
            // Set footer
            const now = new Date();
            document.getElementById('pengumumanFooter').textContent = 
                'Diakses pada ' + now.toLocaleString('id-ID');
            
            // Buka modal
            const modal = document.getElementById('pengumumanDetailModal');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    function closePengumumanModal() {
        const modal = document.getElementById('pengumumanDetailModal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Close dengan Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePengumumanModal();
        }
    });

    // Close dengan click outside
    document.getElementById('pengumumanDetailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePengumumanModal();
        }
    });
</script>

@endsection
