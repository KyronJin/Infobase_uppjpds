@extends('layouts.app')

@section('content')
<style>
    /* ===========================================
       ORGANIZATIONAL CHART STYLES
       =========================================== */

    /* Container */
    .orgchart-container {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 20px 10px;
        min-width: max-content;
    }

    /* Root Level */
    .org-root {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        margin-bottom: 40px;
    }

    .org-root::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 20px;
        background: #00425A;
    }

    /* Children and Grandchildren Levels */
    .org-children, .org-grandchildren {
        display: flex;
        justify-content: center;
        gap: 25px;
        margin-top: 40px;
        position: relative;
    }

    .org-children::before, .org-grandchildren::before {
        content: '';
        position: absolute;
        top: -20px;
        left: var(--line-left, 0);
        width: var(--line-width, 100%);
        height: 2px;
        background: #00425A;
    }

    /* Individual Child/Grandchild Wrappers */
    .org-child, .org-grandchild {
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
        flex-shrink: 0;
    }

    .org-child::before, .org-grandchild::before {
        content: '';
        position: absolute;
        top: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 20px;
        background: #00425A;
    }

    /* Connection Lines for Children */
    .org-child.has-children::after, .org-grandchild.has-children::after {
        content: '';
        position: absolute;
        bottom: -20px;
        left: 50%;
        transform: translateX(-50%);
        width: 2px;
        height: 20px;
        background: #00425A;
    }

    /* Single Child - No Horizontal Line */
    .org-children.single::before, .org-grandchildren.single::before {
        display: none;
    }

    /* Organization Card */
    .org-card {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 6px;
        width: 120px;
        padding: 10px 8px;
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

    /* Card Image */
    .org-card img, .org-card .icon-placeholder {
        width: 55px;
        height: 55px;
        border-radius: 50%;
        border: 3px solid #00425A;
        flex-shrink: 0;
    }

    .org-card img {
        object-fit: cover;
    }

    .org-card .icon-placeholder {
        background: linear-gradient(135deg, #f0f4ff 0%, #e0e7ff 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .org-card .icon-placeholder i {
        font-size: 24px;
        color: #00425A;
    }

    /* Card Text */
    .org-card h4 {
        font-size: 11px;
        font-weight: 700;
        color: #00425A;
        margin: 0;
        line-height: 1.3;
        min-height: 22px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .org-card p {
        font-size: 9px;
        color: #f85e38;
        font-weight: 600;
        margin: 0;
        line-height: 1.3;
        min-height: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* View Toggle Buttons */
    .view-toggle-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 44px;
        height: 44px;
        border-radius: 10px;
        border: none;
        background: transparent;
        color: #94a3b8;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 18px;
    }

    .view-toggle-btn:hover {
        color: #00425A;
        background: #f1f5f9;
        transform: scale(1.05);
    }

    .view-toggle-btn.active {
        background: #00425A;
        color: white;
        box-shadow: 0 4px 12px rgba(0, 66, 90, 0.3);
    }

    /* Mobile responsive for view toggle */
    @media (max-width: 640px) {
        .view-toggle-btn {
            width: 40px;
            height: 40px;
            font-size: 16px;
        }
    }

    /* ===========================================
       RESPONSIVE BREAKPOINTS
       =========================================== */

    /* Tablet */
    @media (max-width: 1024px) {
        .orgchart-container {
            padding: 25px 15px;
        }

        .org-children, .org-grandchildren {
            gap: 20px;
        }

        .org-card {
            width: 110px;
            padding: 9px 7px;
        }

        .org-card img, .org-card .icon-placeholder {
            width: 50px;
            height: 50px;
        }

        .org-card h4 {
            font-size: 10px;
            min-height: 20px;
        }

        .org-card p {
            font-size: 8px;
            min-height: 14px;
        }

        .org-card .icon-placeholder i {
            font-size: 22px;
        }
    }

    /* Mobile Large */
    @media (max-width: 768px) {
        .orgchart-container {
            padding: 20px 10px;
        }

        .org-root::after {
            height: 25px;
            bottom: -25px;
        }

        .org-children, .org-grandchildren {
            gap: 15px;
            margin-top: 45px;
        }

        .org-children::before, .org-grandchildren::before {
            display: block !important;
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
            width: 105px;
            padding: 8px 6px;
            gap: 5px;
        }

        .org-card img, .org-card .icon-placeholder {
            width: 48px;
            height: 48px;
        }

        .org-card h4 {
            font-size: 9px;
            min-height: 18px;
        }

        .org-card p {
            font-size: 8px;
            min-height: 14px;
        }

        .org-card .icon-placeholder i {
            font-size: 20px;
        }
    }

    /* Mobile Medium */
    @media (max-width: 480px) {
        .orgchart-container {
            padding: 15px 8px;
        }

        .org-root::after {
            height: 20px;
            bottom: -20px;
        }

        .org-children, .org-grandchildren {
            gap: 12px;
            margin-top: 35px;
        }

        .org-child::before, .org-grandchild::before {
            height: 20px;
            top: -20px;
        }

        .org-child.has-children::after, .org-grandchild.has-children::after {
            height: 20px;
            bottom: -20px;
        }

        .org-card {
            width: 95px;
            padding: 7px 5px;
            gap: 4px;
        }

        .org-card img, .org-card .icon-placeholder {
            width: 45px;
            height: 45px;
        }

        .org-card h4 {
            font-size: 8px;
            min-height: 16px;
        }

        .org-card p {
            font-size: 7px;
            min-height: 12px;
        }

        .org-card .icon-placeholder i {
            font-size: 18px;
        }
    }

    /* Mobile Small */
    @media (max-width: 360px) {
        .orgchart-container {
            padding: 10px 5px;
        }

        .org-children, .org-grandchildren {
            gap: 10px;
            margin-top: 30px;
        }

        .org-root::after,
        .org-child::before, .org-grandchild::before,
        .org-child.has-children::after, .org-grandchild.has-children::after {
            height: 15px;
            top: -15px;
            bottom: -15px;
        }

        .org-card {
            width: 85px;
            padding: 6px 4px;
            gap: 3px;
        }

        .org-card img, .org-card .icon-placeholder {
            width: 40px;
            height: 40px;
        }

        .org-card h4 {
            font-size: 7px;
            min-height: 14px;
        }

        .org-card p {
            font-size: 6px;
            min-height: 10px;
        }

        .org-card .icon-placeholder i {
            font-size: 16px;
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
<div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem 1rem 1.5rem;">
    <form method="GET" action="{{ route('infobase.profil-pegawai') }}" class="flex gap-3 mb-6 flex-wrap">
        <div style="flex: 1; min-width: 200px;">
            <input 
                type="text" 
                name="search" 
                placeholder="Cari pegawai berdasarkan nama, jabatan, atau deskripsi..." 
                value="{{ $search ?? '' }}"
                class="w-full px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#00425A] transition duration-300"
            >
        </div>
        
        <!-- Jabatan Filter -->
        <select 
            name="jabatan_id"
            class="px-4 py-2 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#00425A] transition duration-300 bg-white"
        >
            <option value="">Semua Jabatan</option>
            @foreach($jabatans as $jabatan)
                <option value="{{ $jabatan->id }}" {{ isset($jabatanFilter) && $jabatanFilter == $jabatan->id ? 'selected' : '' }}>
                    {{ $jabatan->name }}
                </option>
            @endforeach
        </select>
        
        <button 
            type="submit" 
            class="px-6 py-2 bg-[#00425A] text-white font-semibold rounded-lg hover:bg-[#003144] transition duration-300 flex items-center gap-2"
        >
            <i class="fas fa-search"></i>
            Cari
        </button>
        @if(!empty($search) || !empty($jabatanFilter))
            <a 
                href="{{ route('infobase.profil-pegawai') }}" 
                class="px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-lg hover:bg-gray-400 transition duration-300"
            >
                <i class="fas fa-times"></i>
            </a>
        @endif
    </form>

    @if(!empty($search) || !empty($jabatanFilter))
        <div style="margin-bottom: 1.5rem; padding: 1rem; background: #e3f2fd; border-left: 4px solid #00425A; border-radius: 0.5rem;">
            <p style="color: #00425A; font-size: 0.95rem; margin: 0;">
                <i class="fas fa-info-circle mr-2"></i>
                Hasil pencarian:
                @if(!empty($search))
                    <strong>"{{ $search }}"</strong>
                @endif
                @if(!empty($jabatanFilter))
                    @php $selectedJabatan = $jabatans->find($jabatanFilter); @endphp
                    dengan jabatan <strong>{{ $selectedJabatan->name ?? 'Tidak diketahui' }}</strong>
                @endif
                <strong>({{ $allPegawai->count() }} pegawai ditemukan)</strong>
            </p>
        </div>
    @endif
</div>

<div class="min-h-screen bg-[#f8fafc] pt-6 pb-24">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <!-- Content Header with View Toggle -->
        <div class="bg-white rounded-2xl shadow-sm border border-gray-200 p-6 mb-8">
            <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4">
                <div>
                    <h2 class="text-2xl font-bold text-[#00425A] mb-2">Daftar Pegawai</h2>
                    <p class="text-gray-600">Temukan profil pegawai berdasarkan jabatan dan struktur organisasi</p>
                </div>

                <!-- View Toggle Icons -->
                <div class="flex items-center gap-2 bg-gray-50 rounded-xl p-1">
                    <button id="sliderBtn" class="view-toggle-btn active" title="Tampilan Slider">
                        <i class="fas fa-images"></i>
                    </button>
                    <button id="orgBtn" class="view-toggle-btn" title="Tampilan Struktur Organisasi">
                        <i class="fas fa-sitemap"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Slider Content -->
        <div id="sliderContent" class="view-content transition-opacity duration-300">
            @if(isset($slides) && $slides->count())
                <div class="relative group">
                    <div class="overflow-hidden rounded-2xl bg-white shadow-xl border border-gray-100">
                        <div id="slider" class="flex transition-transform duration-500 ease-in-out">
                            @foreach($slides as $slideIndex => $profilesInSlide)
                                <div class="w-full flex-shrink-0 p-4 sm:p-6 lg:p-8">
                                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-4 sm:gap-6 lg:gap-8 justify-items-center">
                                        @foreach($profilesInSlide as $p)
                                            <div class="flex flex-col items-center text-center space-y-3 max-w-xs">
                                                <!-- Foto -->
                                                <div class="relative">
                                                    <div class="absolute inset-0 bg-[#f85e38] rounded-full blur-lg opacity-20 transform translate-y-2"></div>
                                                    @if($p->foto_path)
                                                        <img src="{{ asset('storage/' . $p->foto_path) }}" alt="{{ $p->nama }}" class="relative w-20 h-20 sm:w-24 sm:h-24 lg:w-28 lg:h-28 rounded-full object-cover border-4 border-white shadow-lg">
                                                    @else
                                                        <div class="relative w-20 h-20 sm:w-24 sm:h-24 lg:w-28 lg:h-28 bg-gray-100 rounded-full flex items-center justify-center border-4 border-white shadow-lg">
                                                            <i class="fas fa-user text-gray-300 text-2xl sm:text-3xl"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <!-- Nama -->
                                                <h3 class="text-sm sm:text-base font-bold text-[#00425A] leading-tight min-h-[2.5rem] sm:min-h-10 flex items-center">{{ $p->nama }}</h3>
                                                <!-- Posisi/Jabatan -->
                                                <p class="text-xs sm:text-sm text-[#f85e38] font-semibold leading-tight min-h-6 sm:min-h-8 flex items-center">{{ $p->jabatan ? $p->jabatan->name : 'Jabatan' }}</p>
                                                <!-- Deskripsi -->
                                                <p class="text-gray-600 text-xs leading-relaxed line-clamp-3 sm:line-clamp-4 min-h-12 sm:min-h-16">{{ $p->deskripsi ?? 'Berdedikasi untuk memberikan pelayanan terbaik bagi pengunjung perpustakaan.' }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    
                    <!-- Navigation Buttons -->
                    <button id="prevBtn" class="absolute left-2 sm:left-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-[#00425A] w-10 h-10 sm:w-12 sm:h-12 rounded-full shadow-lg flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 backdrop-blur-sm">
                        <i class="fas fa-chevron-left text-sm sm:text-lg"></i>
                    </button>
                    <button id="nextBtn" class="absolute right-2 sm:right-4 top-1/2 -translate-y-1/2 bg-white/80 hover:bg-white text-[#00425A] w-10 h-10 sm:w-12 sm:h-12 rounded-full shadow-lg flex items-center justify-center transition-all opacity-0 group-hover:opacity-100 backdrop-blur-sm">
                        <i class="fas fa-chevron-right text-sm sm:text-lg"></i>
                    </button>
                    
                    <!-- Dots -->
                    <div class="flex justify-center mt-6 sm:mt-8 space-x-2 sm:space-x-3">
                        @for($i = 0; $i < $slides->count(); $i++)
                            <button class="dot w-2 h-2 sm:w-3 sm:h-3 rounded-full bg-gray-300 hover:bg-[#00425A] transition-colors" data-slide="{{ $i }}"></button>
                        @endfor
                    </div>
                </div>
            @else
                <div class="bg-white rounded-2xl p-8 sm:p-16 text-center border-2 border-dashed border-gray-200">
                    <i class="fas fa-search text-gray-300 text-4xl sm:text-5xl mb-4"></i>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800">
                        @if(!empty($search) || !empty($jabatanFilter))
                            Tidak ada hasil pencarian
                        @else
                            Belum ada data pegawai
                        @endif
                    </h3>
                    <p class="text-gray-500 mt-2">
                        @if(!empty($search) || !empty($jabatanFilter))
                            Coba ubah kata kunci atau filter pencarian Anda.
                            <br>
                            <a href="{{ route('infobase.profil-pegawai') }}" class="text-[#00425A] font-semibold hover:underline">
                                Tampilkan semua pegawai
                            </a>
                        @else
                            Data pegawai akan muncul di sini.
                        @endif
                    </p>
                </div>
            @endif
        </div>

        <!-- OrgChart Content -->
        <div id="orgContent" class="view-content hidden">
            @if(isset($jabatans) && $jabatans->count() > 0 && isset($allPegawai) && $allPegawai->count() > 0)
                <div class="bg-white rounded-2xl p-4 sm:p-6 lg:p-8 overflow-x-auto shadow-sm border border-gray-200 min-h-[400px] sm:min-h-[500px]">
                    
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
                <div class="bg-white rounded-2xl p-8 sm:p-16 text-center border-2 border-dashed border-gray-200">
                    <i class="fas fa-sitemap text-gray-300 text-4xl sm:text-5xl mb-4"></i>
                    <h3 class="text-lg sm:text-xl font-bold text-gray-800">Menunggu Struktur</h3>
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