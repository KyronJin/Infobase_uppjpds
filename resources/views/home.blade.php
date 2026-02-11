@extends('layouts.app')

@section('content')<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

<style>
    * {
        box-sizing: border-box;
    }

    /* Hero Section Styles */
    .hero-section {
        height: 100vh;
        overflow: hidden;
    }

    .hero-swiper {
        position: relative;
        width: 100%;
        height: 100%;
    }

    .swiper-slide {
        background-size: cover;
        background-position: center;
    }

    .hero-overlay {
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.4);
        z-index: 10;
    }

    .hero-swiper .swiper-pagination {
        bottom: 24px;
        display: flex;
        gap: 8px;
        justify-content: center;
        z-index: 30;
    }

    .hero-swiper .swiper-pagination-bullet {
        width: 12px;
        height: 12px;
        background: rgba(255, 255, 255, 0.5);
        border-radius: 50%;
        opacity: 1;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .hero-swiper .swiper-pagination-bullet:hover {
        background: rgba(255, 255, 255, 0.8);
    }

    .hero-swiper .swiper-pagination-bullet-active {
        background: white;
        width: 32px;
        border-radius: 6px;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeInUp {
        animation: fadeInUp 0.8s ease-out 0.3s forwards;
        opacity: 0;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Initialize Swiper untuk background carousel saja - tanpa update text
        const swiper = new Swiper('.hero-swiper', {
            loop: true,
            autoplay: {
                delay: 3000, // Geser otomatis tiap 3 detik
                disableOnInteraction: false,
                pauseOnMouseEnter: true,
            },
            effect: 'fade',
            fadeEffect: { crossFade: true },
            speed: 1000,
            slidesPerView: 1,
            centeredSlides: true,
            
            // Pagination
            pagination: {
                el: '.hero-swiper .swiper-pagination',
                clickable: true,
                dynamicBullets: false,
            },

            // Keyboard control
            keyboard: {
                enabled: true,
            },

            // Touch control (swipe)
            touchEventsTarget: 'container',
            simulateTouch: true,
            grabCursor: true,

            // Add accessibility
            a11y: {
                enabled: true,
            }
        });
    });
</script>

    <!-- Hero Section - Swiper carousel only (no text) -->
    <section class="hero-section">
        <!-- Swiper untuk background images -->
        <div class="hero-swiper swiper w-full h-full">
            <div class="swiper-wrapper">
                @if(isset($heroImages) && $heroImages->count())
                    {{-- Display hero images from database --}}
                    @foreach($heroImages as $hero)
                        <div class="swiper-slide relative" style="background-image: url('{{ asset($hero->image_path) }}');">
                            <div class="hero-overlay"></div>
                        </div>
                    @endforeach
                @else
                    {{-- Default slides if no hero images from database --}}
                    <div class="swiper-slide relative" style="background-image: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=1920&h=1080&fit=crop');"></div>
                    <div class="swiper-slide relative" style="background-image: url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=1920&h=1080&fit=crop');"></div>
                    <div class="swiper-slide relative" style="background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=1920&h=1080&fit=crop');"></div>
                    <div class="swiper-slide relative" style="background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=1920&h=1080&fit=crop');"></div>
                @endif
            </div>

            <!-- Pagination - hanya dots, tidak ada tombol next/prev -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Announcements Section -->
    <section id="announcements" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-20">
                <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">Berita & Pengumuman</h2>
                <div class="h-1 w-16 bg-orange-500 mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-gray-600">Informasi terbaru dan penting untuk Anda</p>
            </div>

            @if(isset($latestAnnouncements) && $latestAnnouncements->count())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($latestAnnouncements as $item)
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 group">
                            @if($item->image_path)
                                <div class="relative h-56 overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300">
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/40 to-transparent"></div>
                                </div>
                            @else
                                <div class="h-56 bg-gradient-to-br from-orange-100 to-orange-50 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-orange-400 text-6xl opacity-30"></i>
                                </div>
                            @endif

                            <div class="p-8">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="inline-block px-4 py-2 bg-blue-50 text-blue-700 text-xs font-bold rounded-full">
                                        <i class="fas fa-calendar-alt mr-2"></i>{{ $item->published_at?->format('d M Y') ?? 'N/A' }}
                                    </span>
                                    <span class="text-orange-500 text-sm font-semibold">Pengumuman</span>
                                </div>

                                <h3 class="text-xl font-extrabold text-gray-900 mb-3 line-clamp-2 group-hover:text-orange-500 transition-colors duration-300">
                                    {{ $item->title }}
                                </h3>

                                <p class="text-gray-600 text-base mb-6 line-clamp-3 leading-relaxed">
                                    {{ strip_tags($item->description) }}
                                </p>

                                <a href="{{ route('pengumuman.show', $item) }}" class="inline-flex items-center text-orange-500 font-bold hover:text-orange-600 transition-colors duration-300">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="text-center">
                    <a href="{{ route('infobase.pengumuman') }}" class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-lg transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-2xl">
                        <i class="fas fa-list mr-3"></i>Lihat Semua Pengumuman
                        <i class="fas fa-arrow-right ml-3"></i>
                    </a>
                </div>
            @else
                <div class="text-center py-20">
                    <i class="fas fa-inbox text-gray-300 text-7xl mb-4"></i>
                    <p class="text-gray-500 text-xl">Belum ada pengumuman tersedia</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Photo Gallery Section -->
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">Galeri Perpustakaan</h2>
                <div class="h-1 w-16 bg-orange-500 mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-gray-600">Jelajahi keindahan fasilitas dan koleksi kami</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @forelse($homePhotos ?? [] as $photo)
                <div class="group relative overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-500 h-72">
                    <img src="{{ asset($photo->image_path) }}" alt="{{ $photo->title }}" 
                         class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-black/20 to-transparent opacity-70 group-hover:opacity-85 transition-opacity duration-500"></div>
                    <div class="absolute inset-0 flex flex-col items-center justify-end p-6 opacity-100 group-hover:opacity-100">
                        <h3 class="text-white font-bold text-lg text-center">{{ $photo->title }}</h3>
                        <div class="mt-3 h-1 w-12 bg-orange-500 rounded-full"></div>
                    </div>
                </div>
                @empty
                <div class="col-span-full py-20">
                    <div class="text-center">
                        <i class="fas fa-image text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500 text-lg">Galeri foto akan segera ditampilkan</p>
                    </div>
                </div>
                @endforelse
            </div>

            @if(($homePhotos ?? collect())->count())
            <div class="text-center mt-12">
                <a href="{{ route('about') }}" class="inline-flex items-center px-8 py-4 bg-orange-500 hover:bg-orange-600 text-white font-bold rounded-lg transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <i class="fas fa-images mr-3"></i>Lihat Selengkapnya
                </a>
            </div>
            @endif
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Image -->
                <div class="relative order-2 lg:order-1">
                    @if(!empty($content['about_image']))
                        <div class="relative rounded-3xl overflow-hidden shadow-2xl">
                            <img src="{{ $content['about_image'] }}" alt="Perpustakaan Jakarta" class="w-full h-auto object-cover aspect-[4/3] hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/20 to-transparent"></div>
                        </div>
                    @else
                        <div class="relative rounded-3xl bg-gradient-to-br from-orange-400 to-orange-600 aspect-[4/3] flex items-center justify-center shadow-2xl overflow-hidden group">
                            <div class="text-center space-y-6 transform group-hover:scale-110 transition-transform duration-700">
                                <i class="fas fa-university text-white text-8xl opacity-90"></i>
                                <p class="text-white font-bold text-2xl">Perpustakaan Modern Jakarta</p>
                            </div>
                            <div class="absolute inset-0 bg-gradient-to-br from-transparent via-transparent to-gray-900/20"></div>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="space-y-8 order-1 lg:order-2">
                    <div>
                        <div class="h-1 w-16 bg-orange-500 rounded-full mb-4"></div>
                        <h2 class="text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">Tentang Perpustakaan Jakarta</h2>
                    </div>
                    
                    <p class="text-lg lg:text-xl text-gray-700 leading-relaxed">
                        Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen menyediakan sumber daya pembelajaran, ruang kolaborasi, dan program pemberdayaan masyarakat. Kami percaya bahwa akses informasi yang mudah adalah kunci kemajuan sosial dan intelektual.
                    </p>

                    <!-- Vision & Mission -->
                    <div class="space-y-6">
                        <div class="flex gap-6 p-8 bg-gradient-to-br from-orange-50 to-white rounded-2xl shadow-md border border-orange-100 hover:shadow-xl hover:border-orange-200 transition-all duration-300 group cursor-pointer">
                            <div class="flex-shrink-0">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-orange-500 group-hover:bg-orange-600 transition-colors duration-300">
                                    <i class="fas fa-eye text-white text-2xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Visi</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Menjadi pusat pengetahuan yang inklusif, inovatif, dan relevan untuk mendukung literasi dan kreativitas seluruh warga Jakarta.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-6 p-8 bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-md border border-blue-100 hover:shadow-xl hover:border-blue-200 transition-all duration-300 group cursor-pointer">
                            <div class="flex-shrink-0">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-blue-500 group-hover:bg-blue-600 transition-colors duration-300">
                                    <i class="fas fa-bullseye text-white text-2xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Misi</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Menyediakan akses informasi berkualitas, mendorong budaya baca dan inovasi, serta menciptakan ekosistem pembelajaran yang memberdayakan masyarakat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-xl transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-2xl">
                        Ketahui Lebih Lanjut
                        <i class="fas fa-arrow-right ml-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection