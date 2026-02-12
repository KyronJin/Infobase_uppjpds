@extends('layouts.app')

@section('content')
<style>
    /* Tata Tertib specific styles */

    .rule-item {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1rem;
    }

    .rule-item:last-child {
        margin-bottom: 0;
    }

    .rule-dot {
        width: 10px;
        height: 10px;
        background: linear-gradient(135deg, #00425A 0%, #002a3d 100%);
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 0.3rem;
    }

    .rule-text {
        color: #374151;
        line-height: 1.6;
        font-size: 0.9rem;
    }

    .rule-text img {
        max-width: 100%;
        max-height: 300px;
        height: auto;
        display: block;
        object-fit: contain;
        border-radius: 4px;
        margin: 0.5rem 0;
    }

    .empty-state {
        text-align: center;
        padding: 4rem 1.5rem;
        background: #F8FAFC;
        border-radius: 8px;
        border: 2px dashed #E2E8F0;
    }

    .empty-state i {
        font-size: 4rem;
        color: #CBD5E1;
        margin-bottom: 1rem;
    }

    .empty-state h3 {
        color: #1f2937;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 0.9rem;
        margin-top: 0.4rem;
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
            <h1>TATA TERTIB</h1>
        </div>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
</div>

<div class="container">
    <div class="content-wrapper">
        @forelse($jenis as $j)
            <div class="accordion-item" id="accordion-{{ $j->id }}">
                <button class="accordion-header" onclick="toggleAccordion('{{ $j->id }}')">
                    <h2 class="accordion-title">{{ $j->name }}</h2>
                    <svg class="accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                
                <div class="accordion-content">
                    @forelse($j->tataTertibs as $t)
                        <div class="rule-item">
                            <div class="rule-dot"></div>
                            <p class="rule-text">{!! $t->content !!}</p>
                        </div>
                    @empty
                        <p style="color: #9ca3af; font-style: italic;">Belum ada butir aturan untuk kategori ini.</p>
                    @endforelse
                </div>
            </div>
        @empty
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3>Data Tidak Ditemukan</h3>
                <p>Pastikan database sudah terisi dan Controller mengirimkan data dengan benar.</p>
            </div>
        @endforelse
    </div>
</div>

<script>
    function toggleAccordion(id) {
        const item = document.getElementById('accordion-' + id);
        if (item) {
            item.classList.toggle('active');
        }
    }
</script>
@endsection