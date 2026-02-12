@extends('layouts.app')

@section('content')
<style>
    /* Profil Pegawai Org Chart specific styles */
    .orgchart-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 25px 15px;
    }

    /* Root card wrapper */
    .org-root {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }

    /* Garis vertikal dari root ke horizontal line */
    .org-root::after {
        content: '';
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 25px;
        background: #00425A;
    }

    /* Children wrapper */
    .org-children {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 50px;
        position: relative;
    }

    /* Garis horizontal di atas children */
    .org-children::before {
        content: '';
        position: absolute;
        top: -25px;
        left: var(--line-left, 0);
        width: var(--line-width, 100%);
        height: 2px;
        background: #00425A;
    }

    /* Wrapper untuk setiap child */
    .org-child {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        flex-shrink: 0;
    }

    /* Garis vertikal dari horizontal ke child card */
    .org-child::before {
        content: '';
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 25px;
        background: #00425A;
    }

    /* Grandchildren wrapper */
    .org-grandchildren {
        display: flex;
        justify-content: center;
        gap: 25px;
        margin-top: 50px;
        position: relative;
    }

    .org-grandchildren::before {
        content: '';
        position: absolute;
        top: -25px;
        left: var(--line-left, 0);
        width: var(--line-width, 100%);
        height: 2px;
        background: #00425A;
    }

    .org-grandchild {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        flex-shrink: 0;
    }

    .org-grandchild::before {
        content: '';
        position: absolute;
        top: -25px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 25px;
        background: #00425A;
    }

    /* Garis dari child card ke grandchildren */
    .org-child.has-children::after {
        content: '';
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 25px;
        background: #00425A;
    }

    /* Garis dari grandchild card ke great-grandchildren */
    .org-grandchild.has-children::after {
        content: '';
        position: absolute;
        bottom: -25px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 25px;
        background: #00425A;
    }

    /* Single child - tidak perlu garis horizontal */
    .org-children.single::before,
    .org-grandchildren.single::before {
        display: none;
    }

    /* ORG CARD - Compact Design dengan Foto Circular */
    .org-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 8px;
        width: 130px;
        padding: 12px 10px;
        min-height: auto;
        background: white;
        border: 1.5px solid #e0e7ff;
        border-radius: 10px;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-align: center;
    }

    .org-card:hover {
        border-color: #00425A;
        box-shadow: 0 4px 12px rgba(0, 66, 90, 0.15);
        transform: translateY(-2px);
    }

    /* Foto circular dalam org card */
    .org-card img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #00425A;
        flex-shrink: 0;
    }

    /* Icon placeholder circular */
    .org-card .icon-placeholder {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);
        border: 3px solid #00425A;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }

    .org-card .icon-placeholder i {
        font-size: 28px;
        color: #00425A;
    }

    /* Nama dalam org card */
    .org-card h4 {
        font-size: 12px;
        font-weight: 700;
        color: #00425A;
        margin: 0;
        line-height: 1.3;
        min-height: 26px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Jabatan dalam org card */
    .org-card p {
        font-size: 10px;
        color: #f85e38;
        font-weight: 600;
        margin: 0;
        line-height: 1.3;
        min-height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Banner uses shared page-header styling */
        display: flex;
        align-items: center;
        gap: 8px;
        background: white;
        padding: 6px;
        border-radius: 12px;
        border: 2px solid #e2e8f0;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
    }

    .view-toggle-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 48px;
        height: 48px;
        border-radius: 10px;
        border: none;
        background: transparent;
        color: #94a3b8;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .view-toggle-btn:hover {
        color: #00425A;
        background: #f1f5f9;
    }

    .view-toggle-btn.active {
        background: #00425A;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 66, 90, 0.3);
    }

    .view-toggle-btn i {
        font-size: 20px;
    }

    /* Responsive */
    @media (max-width: 1024px) {
        .org-children, .org-grandchildren {
            gap: 25px;
        }

        .org-card {
            width: 125px;
            padding: 11px 9px;
        }

        .org-card img {
            width: 55px;
            height: 55px;
        }

        .org-card .icon-placeholder {
            width: 55px;
            height: 55px;
        }

        .org-card h4 {
            font-size: 11px;
            min-height: 24px;
        }

        .org-card p {
            font-size: 9px;
            min-height: 18px;
        }
    }

    @media (max-width: 768px) {
        /* Tetap gunakan desktop layout, biarkan parent scroll */
        .orgchart-container {
            padding: 30px 15px;
            min-width: max-content;
        }

        .org-root::after {
            height: 30px;
            bottom: -30px;
        }

        .org-children, .org-grandchildren {
            gap: 20px;
            margin-top: 60px;
        }

        /* Jangan ubah ke flex-direction: column */
        .org-children::before, .org-grandchildren::before {
            display: block !important;
        }

        .org-child::before, .org-grandchild::before {
            display: block !important;
            height: 30px;
            top: -30px;
        }

        .org-child.has-children::after, .org-grandchild.has-children::after {
            height: 30px;
            bottom: -30px;
        }

        .org-card {
            width: 120px;
            padding: 10px 8px;
            gap: 6px;
        }

        .org-card img {
            width: 52px;
            height: 52px;
        }

        .org-card .icon-placeholder {
            width: 52px;
            height: 52px;
        }

        .org-card h4 {
            font-size: 10px;
            min-height: 22px;
        }

        .org-card p {
            font-size: 9px;
            min-height: 18px;
        }
    }

    @media (max-width: 480px) {
        .orgchart-container {
            padding: 20px 10px;
            min-width: max-content;
        }

        .org-root::after {
            height: 25px;
            bottom: -25px;
        }

        .org-children, .org-grandchildren {
            gap: 15px;
            margin-top: 50px;
        }

        .org-child::before, .org-grandchild::before {
            height: 25px;
            top: -25px;
        }

        .org-child.has-children::after, .org-grandchild.has-children::after {
            height: 25px;
            bottom: -25px;
        }

        .org-card {
            width: 110px;
            padding: 9px 7px;
            gap: 5px;
        }

        .org-card img {
            width: 48px;
            height: 48px;
        }

        .org-card .icon-placeholder {
            width: 48px;
            height: 48px;
        }

        .org-card h4 {
            font-size: 9px;
            min-height: 20px;
        }

        .org-card p {
            font-size: 8px;
            min-height: 16px;
        }

        .org-card .icon-placeholder i {
            font-size: 22px;
        }
    }

    @media (max-width: 360px) {
        .orgchart-container {
            padding: 15px 8px;
            min-width: max-content;
        }

        .org-children, .org-grandchildren {
            gap: 12px;
            margin-top: 40px;
        }

        .org-root::after,
        .org-child::before, .org-grandchild::before,
        .org-child.has-children::after, .org-grandchild.has-children::after {
            height: 20px;
            top: -20px;
            bottom: -20px;
        }

        .org-card {
            width: 100px;
            padding: 8px 6px;
            gap: 4px;
        }

        .org-card img {
            width: 45px;
            height: 45px;
        }

        .org-card .icon-placeholder {
            width: 45px;
            height: 45px;
        }

        .org-card h4 {
            font-size: 8px;
            min-height: 18px;
        }

        .org-card p {
            font-size: 7px;
            min-height: 15px;
        }

        .org-card .icon-placeholder i {
            font-size: 20px;
        }
    }
</style>

<style>
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
            <h1>PROFIL PEGAWAI</h1>
        </div>
        <a href="{{ route('home') }}" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
</div>

{{-- Search Form --}}
@include('partials.search-form', [
    'action' => route('infobase.profil-pegawai'),
    'placeholder' => 'Cari pegawai berdasarkan nama, jabatan, atau deskripsi...',
    'search' => $search ?? '',
    'resultCount' => isset($pegawai) ? $pegawai->total() : null
])

<div class="min-h-screen bg-[#f8fafc] pt-6 pb-24">
    <div class="max-w-7xl mx-auto px-6">
            </div>

            <!-- View Toggle Icons -->
            <div class="view-toggle">
                <button id="sliderBtn" class="view-toggle-btn active" title="Tampilan Slider">
                    <i class="fas fa-images"></i>
                </button>
                <button id="orgBtn" class="view-toggle-btn" title="Tampilan Struktur Organisasi">
                    <i class="fas fa-sitemap"></i>
                </button>
            </div>
        </header>

        <!-- Slider Content -->
        <div id="sliderContent" class="view-content transition-opacity duration-300">
            @if(isset($slides) && $slides->count())
                <div class="relative group">
                    <div class="overflow-hidden rounded-2xl bg-white shadow-xl border border-gray-100">
                        <div id="slider" class="flex transition-transform duration-500 ease-in-out">
                            @foreach($slides as $slideIndex => $profilesInSlide)
                                <div class="w-full flex-shrink-0 p-8">
                                    <div class="flex justify-center gap-8">
                                        @foreach($profilesInSlide as $p)
                                            <div class="flex flex-col items-center text-center space-y-3 flex-1 max-w-max">
                                                <!-- Foto -->
                                                <div class="relative">
                                                    <div class="absolute inset-0 bg-[#f85e38] rounded-full blur-lg opacity-20 transform translate-y-2"></div>
                                                    @if($p->foto_path)
                                                        <img src="{{ asset('storage/' . $p->foto_path) }}" alt="{{ $p->nama }}" class="relative w-28 h-28 rounded-full object-cover border-4 border-white shadow-lg">
                                                    @else
                                                        <div class="relative w-28 h-28 bg-gray-100 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                                                            <i class="fas fa-user text-gray-300 text-3xl"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- Nama -->
                                                <h3 class="text-base font-bold text-[#00425A] leading-tight min-h-10">{{ $p->nama }}</h3>
                                                <!-- Posisi/Jabatan -->
                                                <p class="text-sm text-[#f85e38] font-semibold leading-tight min-h-8">{{ $p->jabatan ? $p->jabatan->name : 'Jabatan' }}</p>
                                                <!-- Deskripsi -->
                                                <p class="text-gray-600 text-xs leading-relaxed line-clamp-4 min-h-16">{{ $p->deskripsi ?? 'Berdedikasi untuk memberikan pelayanan terbaik bagi pengunjung perpustakaan.' }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Navigation Buttons -->
                    <button id="prevBtn" class="absolute left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-[#00425A] w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 backdrop-blur-sm">
                        <i class="fas fa-chevron-left text-lg"></i>
                    </button>
                    <button id="nextBtn" class="absolute right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-[#00425A] w-12 h-12 rounded-full shadow-lg flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 backdrop-blur-sm">
                        <i class="fas fa-chevron-right text-lg"></i>
                    </button>
                    
                    <!-- Dots -->
                    <div class="flex justify-center mt-8 space-x-3">
                        @for($i = 0; $i < $slides->count(); $i++)
                            <button class="dot w-3 h-3 rounded-full bg-gray-300 hover:bg-[#00425A] transition-colors" data-slide="{{ $i }}"></button>
                        @endfor
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl p-16 text-center border-2 border-dashed border-gray-200">
                    <i class="fas fa-users-slash text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800">Belum ada data pegawai</h3>
                    <p class="text-gray-500 mt-2">Data pegawai akan muncul di sini.</p>
                </div>
            @endif
        </div>

        <!-- OrgChart Content -->
        <div id="orgContent" class="view-content hidden">
            @if(isset($jabatans) && $jabatans->count() > 0 && isset($allPegawai) && $allPegawai->count() > 0)
                <div class="bg-white rounded-2xl p-8 md:p-12 overflow-x-auto shadow-sm border border-gray-200 min-h-[500px]">
                    
                    @php
                        $sortedJabatans = $jabatans->sortBy('order')->values();
                        $jabatanLevels = [];
                        foreach($sortedJabatans as $jabatan) {
                            $jabatanPegawais = $allPegawai->where('jabatan_id', $jabatan->id);
                            if($jabatanPegawais->count() > 0) {
                                $jabatanLevels[] = [
                                    'jabatan' => $jabatan,
                                    'pegawais' => $jabatanPegawais
                                ];
                            }
                        }
                    @endphp

                    <div class="orgchart-container">
                        @if(count($jabatanLevels) > 0)
                            {{-- Level 1: Root --}}
                            @php $rootLevel = $jabatanLevels[0]; @endphp
                            <div class="org-root {{ count($jabatanLevels) > 1 ? '' : 'no-children' }}" style="{{ count($jabatanLevels) <= 1 ? 'margin-bottom: 0;' : '' }}">
                                @foreach($rootLevel['pegawais'] as $pegawai)
                                    <div class="org-card">
                                        @if($pegawai->foto_path)
                                            <img src="{{ asset('storage/' . $pegawai->foto_path) }}" alt="{{ $pegawai->nama }}">
                                        @else
                                            <div class="icon-placeholder">
                                                <i class="fas fa-user"></i>
                                            </div>
                                        @endif
                                        <h4>{{ $pegawai->nama }}</h4>
                                        <p>{{ $rootLevel['jabatan']->name }}</p>
                                    </div>
                                @endforeach
                            </div>

                            {{-- Level 2: Children --}}
                            @if(count($jabatanLevels) > 1)
                                @php $childLevel = $jabatanLevels[1]; @endphp
                                <div class="org-children {{ $childLevel['pegawais']->count() == 1 ? 'single' : '' }}">
                                    @foreach($childLevel['pegawais'] as $pegawai)
                                        @php
                                            $hasGrandchildren = count($jabatanLevels) > 2;
                                        @endphp
                                        <div class="org-child {{ $hasGrandchildren ? 'has-children' : '' }}">
                                            <div class="org-card">
                                                @if($pegawai->foto_path)
                                                    <img src="{{ asset('storage/' . $pegawai->foto_path) }}" alt="{{ $pegawai->nama }}">
                                                @else
                                                    <div class="icon-placeholder">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                @endif
                                                <h4>{{ $pegawai->nama }}</h4>
                                                <p>{{ $childLevel['jabatan']->name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Level 3: Grandchildren --}}
                            @if(count($jabatanLevels) > 2)
                                @php $grandchildLevel = $jabatanLevels[2]; @endphp
                                <div class="org-grandchildren {{ $grandchildLevel['pegawais']->count() == 1 ? 'single' : '' }}">
                                    @foreach($grandchildLevel['pegawais'] as $pegawai)
                                        @php
                                            $hasGreatGrandchildren = count($jabatanLevels) > 3;
                                        @endphp
                                        <div class="org-grandchild {{ $hasGreatGrandchildren ? 'has-children' : '' }}">
                                            <div class="org-card">
                                                @if($pegawai->foto_path)
                                                    <img src="{{ asset('storage/' . $pegawai->foto_path) }}" alt="{{ $pegawai->nama }}">
                                                @else
                                                    <div class="icon-placeholder">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                @endif
                                                <h4>{{ $pegawai->nama }}</h4>
                                                <p>{{ $grandchildLevel['jabatan']->name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endif

                            {{-- Level 4+: Additional Levels --}}
                            @for($i = 3; $i < count($jabatanLevels); $i++)
                                @php 
                                    $level = $jabatanLevels[$i];
                                    $hasNext = $i < count($jabatanLevels) - 1;
                                @endphp
                                <div class="org-grandchildren {{ $level['pegawais']->count() == 1 ? 'single' : '' }}">
                                    @foreach($level['pegawais'] as $pegawai)
                                        <div class="org-grandchild {{ $hasNext ? 'has-children' : '' }}">
                                            <div class="org-card">
                                                @if($pegawai->foto_path)
                                                    <img src="{{ asset('storage/' . $pegawai->foto_path) }}" alt="{{ $pegawai->nama }}">
                                                @else
                                                    <div class="icon-placeholder">
                                                        <i class="fas fa-user"></i>
                                                    </div>
                                                @endif
                                                <h4>{{ $pegawai->nama }}</h4>
                                                <p>{{ $level['jabatan']->name }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @endfor
                        @endif
                    </div>

                </div>
            @else
                <div class="bg-white rounded-2xl p-16 text-center border-2 border-dashed border-gray-200">
                    <i class="fas fa-sitemap text-gray-300 text-5xl mb-4"></i>
                    <h3 class="text-xl font-bold text-gray-800">Menunggu Struktur</h3>
                    <p class="text-gray-500 mt-2">Struktur organisasi belum tersedia.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // View Switching Logic
    const sliderBtn = document.getElementById('sliderBtn');
    const orgBtn = document.getElementById('orgBtn');
    const sliderContent = document.getElementById('sliderContent');
    const orgContent = document.getElementById('orgContent');

    // Adjust OrgChart Lines
    function adjustOrgChartLines() {
        const containers = document.querySelectorAll('.org-children, .org-grandchildren');
        containers.forEach(container => {
            const children = container.querySelectorAll(':scope > div');
            if (children.length > 1) {
                // Force reflow untuk mendapatkan nilai terbaru
                void container.offsetHeight;
                
                const firstChild = children[0];
                const lastChild = children[children.length - 1];
                
                // Force reflow pada children juga
                void firstChild.offsetHeight;
                void lastChild.offsetHeight;
                
                // Gunakan getBoundingClientRect untuk kalkulasi yang akurat
                const containerRect = container.getBoundingClientRect();
                const firstRect = firstChild.getBoundingClientRect();
                const lastRect = lastChild.getBoundingClientRect();
                
                // Hitung relative to container
                const firstCenterX = firstRect.left - containerRect.left + firstRect.width / 2;
                const lastCenterX = lastRect.left - containerRect.left + lastRect.width / 2;
                
                const lineLeft = Math.min(firstCenterX, lastCenterX);
                const lineWidth = Math.abs(lastCenterX - firstCenterX);
                
                // Set dengan timeout untuk memastikan DOM settle
                requestAnimationFrame(() => {
                    container.style.setProperty('--line-left', lineLeft + 'px');
                    container.style.setProperty('--line-width', lineWidth + 'px');
                });
            } else if (children.length === 1) {
                // Single child - reset variables
                container.style.setProperty('--line-left', '0px');
                container.style.setProperty('--line-width', '0px');
            }
        });
    }

    function switchView(view) {
        if(view === 'slider') {
            sliderContent.classList.remove('hidden');
            orgContent.classList.add('hidden');
            sliderBtn.classList.add('active');
            orgBtn.classList.remove('active');
        } else {
            sliderContent.classList.add('hidden');
            orgContent.classList.remove('hidden');
            orgBtn.classList.add('active');
            sliderBtn.classList.remove('active');
            
            // Reset semua variables dulu sebelum hitung ulang
            document.querySelectorAll('.org-children, .org-grandchildren').forEach(container => {
                container.style.setProperty('--line-left', '0px');
                container.style.setProperty('--line-width', '0px');
            });
            
            // Trigger hitung ulang dengan delay yang lebih terstruktur
            requestAnimationFrame(() => {
                adjustOrgChartLines();
            });
            
            setTimeout(() => adjustOrgChartLines(), 100);
            setTimeout(() => adjustOrgChartLines(), 300);
            setTimeout(() => adjustOrgChartLines(), 600);
        }
    }

    sliderBtn.addEventListener('click', () => switchView('slider'));
    orgBtn.addEventListener('click', () => switchView('org'));

    // Initial setup dengan reset
    requestAnimationFrame(() => {
        adjustOrgChartLines();
    });
    
    // Re-calculate saat window resize
    let resizeTimeout;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimeout);
        resizeTimeout = setTimeout(() => {
            adjustOrgChartLines();
        }, 250);
    });
    
    window.addEventListener('load', () => {
        setTimeout(() => adjustOrgChartLines(), 100);
    });

    // Slider Logic
    let currentSlide = 0;
    const slider = document.getElementById('slider');
    const slides = slider ? slider.querySelectorAll(':scope > div') : [];
    const dots = document.querySelectorAll('.dot');
    const totalSlides = slides.length;

    function updateSlider() {
        if (totalSlides === 0 || !slider) return;
        slider.style.transform = `translateX(-${currentSlide * 100}%)`;
        dots.forEach((dot, index) => {
            if (index === currentSlide) {
                dot.classList.add('bg-[#00425A]');
                dot.classList.remove('bg-gray-300');
            } else {
                dot.classList.remove('bg-[#00425A]');
                dot.classList.add('bg-gray-300');
            }
        });
    }

    const nextBtn = document.getElementById('nextBtn');
    const prevBtn = document.getElementById('prevBtn');

    if (nextBtn) {
        nextBtn.addEventListener('click', () => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        });
    }

    if (prevBtn) {
        prevBtn.addEventListener('click', () => {
            currentSlide = (currentSlide - 1 + totalSlides) % totalSlides;
            updateSlider();
        });
    }

    dots.forEach((dot, index) => {
        dot.addEventListener('click', () => {
            currentSlide = index;
            updateSlider();
        });
    });

    if (totalSlides > 0) {
        updateSlider();
        setInterval(() => {
            currentSlide = (currentSlide + 1) % totalSlides;
            updateSlider();
        }, 60000);
    }
});
</script>
@endsection