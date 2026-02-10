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
        background: linear-gradient(135deg, #0052CC 0%, #0044A3 100%);
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 0.3rem;
    }

    .rule-text {
        color: #374151;
        line-height: 1.6;
        font-size: 0.9rem;
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
</style>

{{-- START: BAGIAN TESTING --}}
{{-- Hapus blok @php ini jika data dari database kamu sudah muncul --}}
@php
    if($jenis->isEmpty()) {
        $jenis = collect([
            (object)[
                'id' => 1,
                'name' => 'Tata Tertib Umum',
                'tataTertibs' => collect([
                    (object)['content' => 'Pengunjung wajib berpakaian rapi dan sopan.'],
                    (object)['content' => 'Dilarang membawa makanan dan minuman ke dalam perpustakaan.'],
                ])
            ],
            (object)[
                'id' => 2,
                'name' => 'Aturan Peminjaman',
                'tataTertibs' => collect([
                    (object)['content' => 'Maksimal peminjaman adalah 3 buku.'],
                    (object)['content' => 'Jangka waktu peminjaman selama 7 hari.'],
                ])
            ]
        ]);
    }
@endphp
{{-- END: BAGIAN TESTING --}}

<div class="page-header">
    <div class="header-content">
        <div class="header-left">
            <span><i class="fas fa-book mr-2"></i>Tata Tertib</span>
            <h1><i class="fas fa-scroll mr-3 text-white"></i>{{ $title ?? 'Tata Tertib & Peraturan' }}</h1>
            <p>{{ $content ?? 'Berisi Tata Tertib dan Peraturan di Perpustakaan' }}</p>
        </div>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
</div>

{{-- Search Form --}}
@include('partials.search-form', [
    'action' => route('infobase.tata-tertib'),
    'placeholder' => 'Cari tata tertib berdasarkan jenis atau isi...',
    'search' => $search ?? '',
    'resultCount' => $jenis->sum(function($j) { return $j->tataTertibs->count(); })
])

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
                            <p class="rule-text">{{ $t->content }}</p>
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