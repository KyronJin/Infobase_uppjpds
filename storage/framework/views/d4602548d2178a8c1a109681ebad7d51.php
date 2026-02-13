<?php $__env->startSection('content'); ?><script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
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

            <?php if(isset($latestAnnouncements) && $latestAnnouncements->count()): ?>
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    <?php $__currentLoopData = $latestAnnouncements; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden border border-gray-100 group">
                            <?php if($item->image_path): ?>
                                <div class="relative h-56 overflow-hidden bg-gradient-to-br from-gray-200 to-gray-300">
                                    <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>" alt="<?php echo e($item->title); ?>" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/40 to-transparent"></div>
                                </div>
                            <?php else: ?>
                                <div class="h-56 bg-gradient-to-br from-orange-100 to-orange-50 flex items-center justify-center">
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
                    <a href="<?php echo e(route('infobase.pengumuman')); ?>" class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-lg transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-2xl">
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
    <section class="py-20 bg-gradient-to-b from-white to-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-extrabold text-gray-900 mb-4">Galeri Perpustakaan</h2>
                <div class="h-1 w-16 bg-orange-500 mx-auto rounded-full mb-6"></div>
                <p class="text-lg text-gray-600">Jelajahi keindahan fasilitas dan koleksi kami</p>
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

                    .gallery-overlay {
                        position: absolute;
                        inset: 0;
                        background: linear-gradient(to top, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.2) 50%, transparent 100%);
                        opacity: 0.7;
                        transition: opacity 0.5s ease;
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

                    /* Navigation buttons */
                    .gallery-swiper .swiper-button-prev,
                    .gallery-swiper .swiper-button-next {
                        color: white;
                        width: 50px;
                        height: 50px;
                        background: rgba(249, 115, 22, 0.8);
                        border-radius: 50%;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        top: 50%;
                        transform: translateY(-50%);
                    }

                    .gallery-swiper .swiper-button-prev:hover,
                    .gallery-swiper .swiper-button-next:hover {
                        background: rgba(249, 115, 22, 1);
                        transform: translateY(-50%) scale(1.1);
                    }

                    .gallery-swiper .swiper-button-prev::after,
                    .gallery-swiper .swiper-button-next::after {
                        font-size: 20px;
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
                                <div class="gallery-overlay"></div>
                                <div class="gallery-content">
                                    <h3 class="gallery-title"><?php echo e($photo->title); ?></h3>
                                    <div class="gallery-divider"></div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>

                    <!-- Navigation buttons -->
                    <div class="swiper-button-prev text-orange-500"></div>
                    <div class="swiper-button-next text-orange-500"></div>

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

                            // Navigation arrows
                            navigation: {
                                nextEl: '.gallery-swiper .swiper-button-next',
                                prevEl: '.gallery-swiper .swiper-button-prev',
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
                    <a href="<?php echo e(route('about')); ?>" class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-lg transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-2xl">
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
    <section id="about" class="py-24 bg-gradient-to-b from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <!-- Content -->
            <div class="space-y-8">
                    <div>
                        <div class="h-1 w-16 bg-orange-500 rounded-full mb-4"></div>
                        <h2 class="text-5xl lg:text-6xl font-extrabold text-gray-900 leading-tight">Tentang Perpustakaan Jakarta</h2>
                    </div>
                    
                    <p class="text-lg lg:text-xl text-gray-700 leading-relaxed">
                        Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen menyediakan sumber daya pembelajaran, ruang kolaborasi, dan program pemberdayaan masyarakat. Kami percaya bahwa akses informasi yang mudah adalah kunci kemajuan sosial dan intelektual.
                    </p>

                    <!-- Vision & Mission -->
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
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

                        <div class="flex gap-6 p-8 bg-gradient-to-br from-slate-50 to-white rounded-2xl shadow-md border border-slate-200 hover:shadow-xl hover:border-slate-300 transition-all duration-300 group cursor-pointer">
                            <div class="flex-shrink-0">
                                <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-teal-600 group-hover:bg-teal-700 transition-colors duration-300">
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
                </div>

                <div class="text-center mt-8">
                    <a href="<?php echo e(route('about')); ?>" class="inline-flex items-center px-10 py-4 bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold rounded-lg transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-2xl">
                        Ketahui Lebih Lanjut
                        <i class="fas fa-arrow-right ml-3"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/home.blade.php ENDPATH**/ ?>