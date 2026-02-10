@extends('layouts.app')

@section('content')
<style>
    /* Pengumuman specific styles */

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

    .pengumuman-date-year {
        font-size: 0.65rem;
        opacity: 0.75;
        margin-top: 0.15rem;
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
    }

    .pengumuman-footer {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding-top: 1rem;
        border-top: 1px solid #e5e7eb;
    }

    .pengumuman-date-valid {
        display: flex;
        align-items: center;
        gap: 0.4rem;
        color: #6b7280;
        font-size: 0.8rem;
    }

    .pengumuman-date-valid::before {
        content: '';
        width: 6px;
        height: 6px;
        background: #10b981;
        border-radius: 50%;
    }

    .pengumuman-read-more {
        color: #0052CC;
        text-decoration: none;
        font-weight: 700;
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        transition: all 0.3s;
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;
        font-family: inherit;
        font-size: 0.9rem;
    }

    .pengumuman-read-more:hover {
        gap: 0.75rem;
        color: #003A99;
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
                            <div class="pengumuman-date-year">{{ $item->published_at?->format('Y') ?? '2024' }}</div>
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
                                <button class="pengumuman-read-more" onclick="openModal({{ $item->id }}, @json($item->title), @json($item->description), '{{ $item->image_path ? asset('storage/' . $item->image_path) : '' }}')">
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