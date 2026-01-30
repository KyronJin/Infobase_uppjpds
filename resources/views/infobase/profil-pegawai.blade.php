@extends('layouts.app')

@section('content')
<style>
    /* ===== ORGCHART TREE STYLES ===== */
    .orgchart-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 40px 20px;
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
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 40px;
        background: #00425A;
    }

    /* Children wrapper */
    .org-children {
        display: flex;
        justify-content: center;
        gap: 40px;
        margin-top: 80px;
        position: relative;
    }

    /* Garis horizontal di atas children */
    .org-children::before {
        content: '';
        position: absolute;
        top: -40px;
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
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 40px;
        background: #00425A;
    }

    /* Grandchildren wrapper */
    .org-grandchildren {
        display: flex;
        justify-content: center;
        gap: 30px;
        margin-top: 80px;
        position: relative;
    }

    .org-grandchildren::before {
        content: '';
        position: absolute;
        top: -40px;
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
        top: -40px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 40px;
        background: #00425A;
    }

    /* Garis dari child card ke grandchildren */
    .org-child.has-children::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 40px;
        background: #00425A;
    }

    /* Garis dari grandchild card ke great-grandchildren */
    .org-grandchild.has-children::after {
        content: '';
        position: absolute;
        bottom: -40px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 40px;
        background: #00425A;
    }

    /* Single child - tidak perlu garis horizontal */
    .org-children.single::before,
    .org-grandchildren.single::before {
        display: none;
    }

    .org-children.single .org-child::before,
    .org-grandchildren.single .org-grandchild::before {
        display: block;
    }

    /* Card Styling */
    .org-card {
        background: white;
        border: 2px solid #e2e8f0;
        border-radius: 16px;
        padding: 20px 16px;
        text-align: center;
        width: 200px;
        height: auto;
        min-height: 240px;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        position: relative;
        z-index: 10;
        flex-shrink: 0;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: flex-start;
    }

    .org-card:hover {
        border-color: #00425A;
        transform: translateY(-5px);
        box-shadow: 0 12px 20px -5px rgba(0, 66, 90, 0.25);
    }

    .org-card img {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        margin: 0 auto 12px auto;
        border: 3px solid #00425A;
        object-fit: cover;
        display: block;
        flex-shrink: 0;
    }

    .org-card .icon-placeholder {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: linear-gradient(135deg, #f1f5f9 0%, #e2e8f0 100%);
        margin: 0 auto 12px auto;
        display: flex;
        align-items: center;
        justify-content: center;
        border: 3px solid #00425A;
        flex-shrink: 0;
    }

    .org-card .icon-placeholder i {
        color: #00425A;
        font-size: 28px;
    }

    .org-card h4 {
        font-size: 14px;
        font-weight: 700;
        color: #00425A;
        margin-bottom: 4px;
        line-height: 1.3;
        min-height: 35px;
        display: flex;
        align-items: center;
        justify-content: center;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    .org-card p {
        font-size: 12px;
        color: #64748b;
        font-weight: 500;
        min-height: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        word-wrap: break-word;
        overflow-wrap: break-word;
    }

    /* Toggle Button Styles */
    .view-toggle {
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
            gap: 30px;
        }

        .org-card {
            width: 180px;
            padding: 18px 14px;
            min-height: 220px;
        }

        .org-card img {
            width: 70px;
            height: 70px;
        }

        .org-card h4 {
            font-size: 13px;
            min-height: 32px;
        }

        .org-card p {
            font-size: 11px;
            min-height: 28px;
        }
    }

    @media (max-width: 768px) {
        /* Tetap gunakan desktop layout, biarkan parent scroll */
        .orgchart-container {
            padding: 40px 20px;
            min-width: max-content;
        }

        .org-root::after {
            height: 40px;
            bottom: -40px;
        }

        .org-children, .org-grandchildren {
            gap: 40px;
            margin-top: 80px;
        }

        /* Jangan ubah ke flex-direction: column */
        .org-children::before, .org-grandchildren::before {
            display: block !important;
        }

        .org-child::before, .org-grandchild::before {
            display: block !important;
            height: 40px;
            top: -40px;
        }

        .org-child.has-children::after, .org-grandchild.has-children::after {
            height: 40px;
            bottom: -40px;
        }

        .org-card {
            width: 160px;
            padding: 16px 12px;
            min-height: 200px;
            border-radius: 12px;
        }

        .org-card img {
            width: 65px;
            height: 65px;
            border-width: 2px;
        }

        .org-card h4 {
            font-size: 12px;
            min-height: 30px;
            margin-bottom: 3px;
        }

        .org-card p {
            font-size: 10px;
            min-height: 26px;
        }

        .org-card .icon-placeholder {
            width: 65px;
            height: 65px;
            border-width: 2px;
        }

        .org-card .icon-placeholder i {
            font-size: 24px;
        }
    }

    @media (max-width: 480px) {
        .orgchart-container {
            padding: 30px 15px;
            min-width: max-content;
        }

        .org-root::after {
            height: 35px;
            bottom: -35px;
        }

        .org-children, .org-grandchildren {
            gap: 35px;
            margin-top: 70px;
        }

        .org-child::before, .org-grandchild::before {
            height: 35px;
            top: -35px;
        }

        .org-child.has-children::after, .org-grandchild.has-children::after {
            height: 35px;
            bottom: -35px;
        }

        .org-card {
            width: 150px;
            padding: 14px 10px;
            min-height: 190px;
            border-radius: 10px;
        }

        .org-card img {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
            border-width: 2px;
        }

        .org-card h4 {
            font-size: 11px;
            min-height: 28px;
            margin-bottom: 2px;
            line-height: 1.2;
        }

        .org-card p {
            font-size: 9px;
            min-height: 24px;
            line-height: 1.2;
        }

        .org-card .icon-placeholder {
            width: 60px;
            height: 60px;
            margin-bottom: 10px;
            border-width: 2px;
        }

        .org-card .icon-placeholder i {
            font-size: 20px;
        }
    }

    @media (max-width: 360px) {
        .orgchart-container {
            padding: 25px 12px;
            min-width: max-content;
        }

        .org-children, .org-grandchildren {
            gap: 30px;
            margin-top: 65px;
        }

        .org-root::after,
        .org-child::before, .org-grandchild::before,
        .org-child.has-children::after, .org-grandchild.has-children::after {
            height: 30px;
            top: -30px;
            bottom: -30px;
        }

        .org-card {
            width: 140px;
            padding: 12px 8px;
            min-height: 180px;
            gap: 6px;
        }

        .org-card img {
            width: 55px;
            height: 55px;
            margin-bottom: 8px;
            border-width: 2px;
        }

        .org-card h4 {
            font-size: 10px;
            min-height: 26px;
        }

        .org-card p {
            font-size: 8px;
            min-height: 22px;
        }

        .org-card .icon-placeholder {
            width: 55px;
            height: 55px;
            margin-bottom: 8px;
            border-width: 2px;
        }

        .org-card .icon-placeholder i {
            font-size: 18px;
        }
    }
</style>

<div class="min-h-screen bg-[#f8fafc] pt-32 pb-24">
    <div class="max-w-7xl mx-auto px-6">
        <!-- Header Section -->
        <header class="flex flex-col md:flex-row md:items-end justify-between mb-12 gap-6 border-b border-gray-200 pb-8">
            <div class="space-y-4">
                <div class="inline-block">
                    <span class="inline-block px-4 py-2 bg-blue-50 text-[#00425A] text-sm font-bold rounded-full border border-blue-200">
                        <i class="fas fa-users mr-2"></i>Tim Kami
                    </span>
                </div>
                <div>
                    <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 tracking-tight">Profil Pegawai</h1>
                    <p class="text-gray-600 text-lg mt-2">Daftar struktur organisasi dan personel perpustakaan.</p>
                </div>
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
            @if($pegawais->count())
                <div class="relative group">
                    <div class="overflow-hidden rounded-2xl bg-white shadow-xl border border-gray-100">
                        <div id="slider" class="flex transition-transform duration-500 ease-in-out">
                            @foreach($pegawais as $pegawai)
                                <div class="w-full flex-shrink-0 p-8 md:p-16">
                                    <div class="flex flex-col md:flex-row items-center gap-10">
                                        <div class="flex-shrink-0 relative">
                                            <div class="absolute inset-0 bg-[#f85e38] rounded-full blur-lg opacity-20 transform translate-y-4"></div>
                                            @if($pegawai->foto_path)
                                                <img src="{{ asset('storage/' . $pegawai->foto_path) }}" alt="{{ $pegawai->nama }}" class="relative w-40 h-40 md:w-56 md:h-56 rounded-full object-cover border-4 border-white shadow-lg">
                                            @else
                                                <div class="relative w-40 h-40 md:w-56 md:h-56 bg-gray-100 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                                                    <i class="fas fa-user text-gray-300 text-6xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="flex-1 text-center md:text-left space-y-4">
                                            <div>
                                                <h2 class="text-3xl md:text-4xl font-bold text-[#00425A]">{{ $pegawai->nama }}</h2>
                                                <p class="text-xl text-[#f85e38] font-semibold mt-1">{{ $pegawai->jabatan ? $pegawai->jabatan->name : 'Jabatan Tidak Ditemukan' }}</p>
                                            </div>
                                            <div class="w-16 h-1 bg-gray-200 mx-auto md:mx-0 rounded-full"></div>
                                            <p class="text-gray-600 leading-relaxed text-lg max-w-2xl">{{ $pegawai->deskripsi ?? 'Berdedikasi untuk memberikan pelayanan terbaik bagi pengunjung perpustakaan.' }}</p>
                                        </div>
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
                        @for($i = 0; $i < $pegawais->count(); $i++)
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
            @if($jabatans->count() > 0 && $pegawais->count() > 0)
                <div class="bg-white rounded-2xl p-8 md:p-12 overflow-x-auto shadow-sm border border-gray-200 min-h-[500px]">
                    
                    @php
                        $sortedJabatans = $jabatans->sortBy('order')->values();
                        $jabatanLevels = [];
                        foreach($sortedJabatans as $jabatan) {
                            $jabatanPegawais = $pegawais->where('jabatan_id', $jabatan->id);
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
        }, 6000);
    }
});
</script>
@endsection