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

    .container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 0 1.5rem;
    }

    .content-wrapper {
        padding: 3rem 0;
    }

    .accordion-item {
        background: white;
        padding: 2rem;
        margin-bottom: 1.5rem;
        border-radius: 1.5rem;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        border: 1px solid rgba(248, 94, 56, 0.1);
        transition: all 0.3s ease;
    }

    .accordion-item:hover {
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .accordion-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        cursor: pointer;
        border: none;
        background: none;
        width: 100%;
        padding: 0;
    }

    .accordion-title {
        font-size: 1.5rem;
        font-weight: 800;
        color: #1f2937;
        margin: 0;
        transition: all 0.3s ease;
    }

    .accordion-item:hover .accordion-title {
        color: #f85e38;
    }

    .accordion-icon {
        width: 24px;
        height: 24px;
        color: #f85e38;
        transition: transform 0.3s ease;
        flex-shrink: 0;
    }

    .accordion-item.active .accordion-icon {
        transform: rotate(180deg);
    }

    .accordion-content {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid #e5e7eb;
        display: none;
    }

    .accordion-item.active .accordion-content {
        display: block;
        animation: slideDown 0.3s ease;
    }

    @keyframes slideDown {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .accordion-item.hidden .accordion-content {
        display: none;
    }

    .rule-item {
        display: flex;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .rule-item:last-child {
        margin-bottom: 0;
    }

    .rule-dot {
        width: 12px;
        height: 12px;
        background: linear-gradient(135deg, #f85e38 0%, #d94e2e 100%);
        border-radius: 50%;
        flex-shrink: 0;
        margin-top: 0.35rem;
    }

    .rule-text {
        color: #374151;
        line-height: 1.8;
        font-size: 1rem;
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