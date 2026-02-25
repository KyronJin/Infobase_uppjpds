<?php $__env->startSection('content'); ?><script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link href="https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700;800;900&display=swap" rel="stylesheet">

<style>
    * {
        box-sizing: border-box;
    }

    .section-shell {
        padding-top: 6rem;
        padding-bottom: 6rem;
    }

    .section-title {
        font-size: 2.25rem;
        font-weight: 800;
        color: #111827;
        letter-spacing: -0.02em;
        line-height: 1.1;
        margin-bottom: 1rem;
    }

    .section-subtitle {
        font-size: 1.125rem;
        color: #4b5563;
        max-width: 42rem;
        margin-left: auto;
        margin-right: auto;
        line-height: 1.75;
    }

    .section-divider {
        height: 4px;
        width: 3.5rem;
        background-color: #f97316;
        border-radius: 9999px;
        margin: 0 auto 1.5rem;
    }

    .btn-primary-clean {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.9rem 2.25rem;
        border-radius: 0.75rem;
        background: #f97316;
        color: #ffffff;
        font-weight: 700;
        box-shadow: 0 10px 25px rgba(15, 23, 42, 0.15);
        transition: all 0.25s ease;
        border: 1px solid transparent;
    }

    .btn-primary-clean:hover {
        background: #ea580c;
        box-shadow: 0 14px 30px rgba(15, 23, 42, 0.22);
        transform: translateY(-2px);
    }

    @media (min-width: 1024px) {
        .section-title {
            font-size: 3rem;
        }
    }

    /* Hero Section Styles */
    .hero-section {
        min-height: 88vh;
        height: 88vh;
        overflow: hidden;
        border-bottom: 1px solid #e5e7eb;
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
        background: rgba(0, 0, 0, 0.52);
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

    /* Centered hero title */
    .hero-center-text {
        position: absolute;
        inset: 0;
        z-index: 25;
        display: flex;
        align-items: center;
        justify-content: center;
        pointer-events: none;
        text-align: center;
        padding: 1rem;
    }

    .hero-center-text .hero-title {
        color: #ffffff;
        font-weight: 800;
        font-size: 2.25rem; /* 36px */
        line-height: 1.05;
        letter-spacing: 0.04em;
        text-shadow: 0 8px 30px rgba(0,0,0,0.55);
        margin: 0;
        text-transform: uppercase;
    }

    @media (min-width: 768px) {
        .hero-center-text .hero-title { font-size: 3.5rem; /* 56px */ }
    }
    @media (min-width: 1024px) {
        .hero-center-text .hero-title { font-size: 4.5rem; /* 72px */ }
    }

    .announcement-card {
        background: #ffffff;
        border-radius: 1rem;
        border: 1px solid #e5e7eb;
        box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
        transition: all 0.35s ease;
        overflow: hidden;
    }

    .announcement-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 40px rgba(15, 23, 42, 0.12);
        border-color: #d1d5db;
    }

    .gallery-section {
        background: #f9fafb;
        border-top: 1px solid #f3f4f6;
        border-bottom: 1px solid #f3f4f6;
    }

    .gallery-overlay {
        position: absolute;
        inset: 0;
        background: rgba(17, 24, 39, 0.45);
        opacity: 0.7;
        transition: opacity 0.5s ease;
    }

    .about-section {
        background: #ffffff;
    }

    .about-summary {
        font-size: 1.125rem;
        color: #374151;
        line-height: 1.9;
        max-width: 62rem;
    }

    .about-card {
        display: flex;
        gap: 1.5rem;
        padding: 2rem;
        border-radius: 1rem;
        border: 1px solid #e5e7eb;
        background: #ffffff;
        box-shadow: 0 8px 20px rgba(15, 23, 42, 0.06);
        transition: all 0.3s ease;
    }

    .about-card:hover {
        box-shadow: 0 14px 34px rgba(15, 23, 42, 0.12);
        transform: translateY(-4px);
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
            effect: 'slide',
            speed: 800,
            slidesPerView: 1,
            centeredSlides: true,
            touchRatio: 1,
            threshold: 20,
            
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
                <?php if(isset($heroImages) && $heroImages->count()): ?>
                    
                    <?php $__currentLoopData = $heroImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $hero): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide relative" style="background-image: url('<?php echo e(asset($hero->image_path)); ?>');">
                            <div class="hero-overlay"></div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php else: ?>
                    
                    <div class="swiper-slide relative" style="background-image: url('https://images.unsplash.com/photo-1481627834876-b7833e8f5570?w=1920&h=1080&fit=crop');"></div>
                    <div class="swiper-slide relative" style="background-image: url('https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=1920&h=1080&fit=crop');"></div>
                    <div class="swiper-slide relative" style="background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=1920&h=1080&fit=crop');"></div>
                    <div class="swiper-slide relative" style="background-image: url('https://images.unsplash.com/photo-1524995997946-a1c2e315a42f?w=1920&h=1080&fit=crop');"></div>
                <?php endif; ?>
            </div>

            <!-- Centered title over hero -->
            <div class="hero-center-text animate-fadeInUp">
                <h1 class="hero-title">INFOBASE UPPJDS</h1>
            </div>

            <!-- Pagination - hanya dots, tidak ada tombol next/prev -->
            <div class="swiper-pagination"></div>
        </div>
    </section>

    <!-- Announcements Section -->
    <section id="announcements" class="section-shell bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-20">
                 <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">Berita dan Pengumuman</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">Informasi terbaru dan penting untuk Anda</p>
            </div>

            <?php if(isset($latestAnnouncements) && $latestAnnouncements->count()): ?>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    <?php $__currentLoopData = $latestAnnouncements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="announcement-card group">
                            <?php if($item->image_path): ?>
                                <div class="relative h-56 overflow-hidden bg-gray-200">
                                    <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>" alt="<?php echo e($item->title); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-black/20"></div>
                                </div>
                            <?php else: ?>
                                <div class="h-56 bg-orange-100 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-orange-400 text-6xl opacity-30"></i>
                                </div>
                            <?php endif; ?>

                            <div class="p-8">
                                <div class="flex items-center justify-between mb-4">
                                    <span class="inline-block px-4 py-2 bg-slate-50 text-teal-700 text-xs font-bold rounded-full">
                                        <i class="fas fa-calendar-alt mr-2"></i><?php echo e($item->published_at?->format('d M Y') ?? 'N/A'); ?>

                                    </span>
                                    <span class="text-orange-500 text-sm font-semibold">Pengumuman</span>
                                </div>

                                <h3 class="text-xl font-extrabold text-gray-900 mb-3 line-clamp-2 group-hover:text-orange-500 transition-colors duration-300">
                                    <?php echo e($item->title); ?>

                                </h3>

                                <p class="text-gray-600 text-base mb-6 line-clamp-3 leading-relaxed">
                                    <?php echo e(strip_tags($item->description)); ?>

                                </p>

                                <a href="<?php echo e(route('pengumuman.show', $item)); ?>" class="inline-flex items-center text-orange-500 font-bold hover:text-orange-600 transition-colors duration-300">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <div class="text-center">
                    <a href="<?php echo e(route('infobase.pengumuman')); ?>" class="btn-primary-clean">
                        Ketahui Lebih Lanjut
                        <i class="fas fa-arrow-right ml-3"></i>
                    </a>
                </div>
            <?php else: ?>
                <div class="text-center py-20">
                    <i class="fas fa-inbox text-gray-300 text-7xl mb-4"></i>
                    <p class="text-gray-500 text-xl">Belum ada pengumuman tersedia</p>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- Photo Gallery Carousel Section -->
    <section class="section-shell gallery-section">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">Galeri Perpustakaan</h2>
                <div class="section-divider"></div>
                <p class="section-subtitle">Jelajahi keindahan fasilitas dan koleksi kami</p>
            </div>

            <?php if(($homePhotos ?? collect())->count()): ?>
                <!-- Swiper Gallery Carousel -->
                <style>
                    .gallery-swiper {
                        position: relative;
                        width: 100%;
                        padding-bottom: 20px;
                    }

                    .gallery-swiper .swiper-slide {
                        height: auto;
                        display: flex;
                    }

                    .gallery-slide-content {
                        position: relative;
                        overflow: hidden;
                        border-radius: 1rem;
                        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                        width: 100%;
                        aspect-ratio: 4/3;
                        transition: all 0.3s ease;
                    }

                    .gallery-swiper .swiper-slide:hover .gallery-slide-content {
                        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.2);
                    }

                    .gallery-slide-content img {
                        width: 100%;
                        height: 100%;
                        object-fit: cover;
                    }

                    .gallery-swiper .swiper-slide:hover .gallery-overlay {
                        opacity: 0.85;
                    }

                    .gallery-content {
                        position: absolute;
                        inset: 0;
                        flex-direction: column;
                        align-items: center;
                        justify-content: flex-end;
                        padding: 2rem;
                        display: flex;
                        z-index: 10;
                    }

                    .gallery-title {
                        color: white;
                        font-weight: bold;
                        font-size: 1.125rem;
                        text-align: center;
                        margin: 0;
                    }

                    .gallery-divider {
                        margin-top: 0.75rem;
                        height: 4px;
                        width: 3rem;
                        background-color: rgb(249, 115, 22);
                        border-radius: 9999px;
                    }

                    /* Pagination */
                    .gallery-swiper .swiper-pagination {
                        bottom: 0;
                        display: flex;
                        gap: 8px;
                        justify-content: center;
                    }

                    .gallery-swiper .swiper-pagination-bullet {
                        width: 10px;
                        height: 10px;
                        background: rgba(107, 114, 128, 0.5);
                        opacity: 1;
                        border-radius: 50%;
                        transition: all 0.3s ease;
                        cursor: pointer;
                    }

                    .gallery-swiper .swiper-pagination-bullet:hover {
                        background: rgba(107, 114, 128, 0.8);
                    }

                    .gallery-swiper .swiper-pagination-bullet-active {
                        background: rgb(249, 115, 22);
                        width: 30px;
                        border-radius: 5px;
                    }
                </style>

                <div class="gallery-swiper swiper w-full">
                    <div class="swiper-wrapper">
                        <?php $__currentLoopData = $homePhotos ?? []; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="swiper-slide">
                            <div class="gallery-slide-content">
                                <img src="<?php echo e(asset($photo->image_path)); ?>" alt="<?php echo e($photo->title); ?>">
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Pagination -->
                    <div class="swiper-pagination"></div>
                </div>

                <script>
                    document.addEventListener('DOMContentLoaded', function () {
                        // Initialize Swiper untuk gallery carousel
                        const gallerySwiper = new Swiper('.gallery-swiper', {
                            loop: true,
                            spaceBetween: 20,
                            slidesPerView: 1,
                            centeredSlides: true,

                            // Breakpoints untuk responsive
                            breakpoints: {
                                640: {
                                    slidesPerView: 1,
                                    spaceBetween: 15,
                                },
                                768: {
                                    slidesPerView: 2,
                                    spaceBetween: 20,
                                },
                                1024: {
                                    slidesPerView: 3,
                                    spaceBetween: 24,
                                }
                            },

                            // Smooth sliding effect
                            effect: 'slide',
                            speed: 800,

                            // Autoplay
                            autoplay: {
                                delay: 4000,
                                disableOnInteraction: false,
                                pauseOnMouseEnter: true,
                            },

                            // Pagination
                            pagination: {
                                el: '.gallery-swiper .swiper-pagination',
                                clickable: true,
                                dynamicBullets: false,
                            },

                            // Touch & swipe
                            grabCursor: true,
                            touchEventsTarget: 'container',
                            simulateTouch: true,
                            touchRatio: 1,
                            touchAngle: 45,

                            // Keyboard
                            keyboard: {
                                enabled: true,
                            },

                            // Accessibility
                            a11y: {
                                enabled: true,
                            }
                        });
                    });
                </script>

                <div class="text-center mt-16">
                    <a href="<?php echo e(route('about')); ?>" class="btn-primary-clean">
                        Ketahui Lebih Lanjut
                        <i class="fas fa-arrow-right ml-3"></i>
                    </a>
                </div>
            <?php else: ?>
                <div class="py-20">
                    <div class="text-center">
                        <i class="fas fa-image text-gray-300 text-6xl mb-4"></i>
                        <p class="text-gray-500 text-lg">Galeri foto akan segera ditampilkan</p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="section-shell about-section">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <!-- Content -->
            <div class="space-y-8">
                    <div>
                        <div class="section-divider !mx-0 mb-4"></div>
                        <h2 class="section-title text-left">Tentang Perpustakaan Jakarta</h2>
                    </div>
                    
                    <p class="about-summary">
                        Perpustakaan Jakarta Cikini merupakan perpustakaan umum milik Pemerintah Provinsi DKI Jakarta yang berlokasi di kawasan Taman Ismail Marzuki, Menteng, Jakarta Pusat. Perpustakaan ini berfungsi sebagai pusat literasi modern yang menyediakan akses informasi, pengetahuan, serta ruang belajar terbuka bagi masyarakat dari berbagai kalangan, mulai dari pelajar, mahasiswa, peneliti hingga masyarakat umum. Pengelolaannya berada di bawah Dinas Perpustakaan dan Kearsipan Provinsi DKI Jakarta sebagai perangkat daerah yang melaksanakan urusan pemerintahan di bidang perpustakaan dan kearsipan.
                    </p>

                    <!-- Vision & Mission -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div class="about-card group cursor-pointer">
                            <div class="flex-shrink-0">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-orange-500 group-hover:bg-orange-600 transition-colors duration-300">
                                    <i class="fas fa-eye text-white text-2xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Visi</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Menjadi Perpustakaan yang berlaku sebagai Mesin Pendorong Kreativitas Masyarakat dalam Menyongsong Era Industri 4.0
                                </p>
                            </div>
                        </div>

                        <div class="about-card group cursor-pointer">
                            <div class="flex-shrink-0">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-teal-600 group-hover:bg-teal-700 transition-colors duration-300">
                                    <i class="fas fa-bullseye text-white text-2xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Misi</h3>
                                <p class="text-gray-700 leading-relaxed">
                                    Misi ini ingin menjadikan perpustakaan sebagai tempat masyarakat berkumpul, berdiskusi, berkolaborasi dalam mengembangkan ide/gagasan dan membangun pengetahuan baru.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="text-center mt-8">
                    <a href="<?php echo e(route('about')); ?>" class="btn-primary-clean">
                        Ketahui Lebih Lanjut
                        <i class="fas fa-arrow-right ml-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/home.blade.php ENDPATH**/ ?>