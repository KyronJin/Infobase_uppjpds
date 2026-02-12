<?php $__env->startSection('content'); ?>

<section class="py-20 bg-white">
  <div class="container mx-auto px-6">
    <div class="text-center mb-12">
      <span class="inline-block px-4 py-2 bg-[#00425A] bg-opacity-10 text-white text-sm font-semibold rounded-full border border-[#00425A] border-opacity-20">
        Tentang Kami
      </span>
      <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mt-4 mb-4">Perpustakaan Jakarta — UPPJPDS</h1>
      <p class="text-lg text-gray-800 max-w-2xl mx-auto">Pusat pembelajaran, dokumentasi, dan layanan informasi untuk warga Jakarta.</p>
    </div>

    <div class="grid lg:grid-cols-1 gap-12 items-start mb-16 max-w-7xl mx-auto">
      <div class="lg:col-span-1">
        <h2 class="text-3xl font-bold mb-6 text-[#ffffff]">Tentang Kami</h2>
          <p class="text-gray-700 mb-6 text-lg leading-relaxed">
            Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen untuk menyediakan akses informasi berkualitas tinggi kepada seluruh masyarakat Jakarta. Kami berfungsi sebagai pusat pembelajaran, dokumentasi, dan pemeliharaan memori kolektif masyarakat.
          </p>
        <p class="text-gray-700 mb-8 text-lg leading-relaxed">
          Dengan koleksi lengkap, fasilitas modern, dan staf yang profesional, kami menawarkan lebih dari sekadar tempat meminjam buku. Kami adalah ruang untuk belajar, berkolaborasi, berinovasi, dan terhubung dengan komunitas pengetahuan.
        </p>

        <h3 class="text-2xl font-bold mb-4 text-[#00425A]">Visi Kami</h3>
        <div class="bg-[#00425A] bg-opacity-5 border-l-4 border-[#00425A] p-6 mb-8 rounded">
          <p class="text-sm text-white text-lg font-semibold leading-relaxed">
            Menjadi pusat pengetahuan yang inklusif, inovatif, dan relevan untuk mendukung literasi dan kreativitas seluruh warga Jakarta, sehingga perpustakaan menjadi jantung komunitas yang hidup dan dinamis.
          </p>
        </div>

        <h3 class="text-2xl font-bold mb-4 text-[#00425A]">Misi Kami</h3>
        <ul class="space-y-4">
          <li class="flex gap-4">
            <div class="flex-shrink-0">
              <i class="fas fa-check-circle text-[#f85e38] text-2xl mt-0.5"></i>
            </div>
            <div>
              <p class="text-gray-700 text-lg"><strong>Menyediakan akses informasi berkualitas:</strong> Memastikan semua orang dapat mengakses sumber daya pembelajaran tanpa hambatan finansial atau geografis.</p>
            </div>
          </li>
          <li class="flex gap-4">
            <div class="flex-shrink-0">
              <i class="fas fa-check-circle text-[#f85e38] text-2xl mt-0.5"></i>
            </div>
            <div>
              <p class="text-gray-700 text-lg"><strong>Mendorong budaya baca dan inovasi:</strong> Mengembangkan program yang menginspirasi masyarakat untuk membaca, belajar, dan berinovasi.</p>
            </div>
          </li>
          <li class="flex gap-4">
            <div class="flex-shrink-0">
              <i class="fas fa-check-circle text-[#f85e38] text-2xl mt-0.5"></i>
            </div>
            <div>
              <p class="text-gray-700 text-lg"><strong>Menciptakan ekosistem pembelajaran:</strong> Menyediakan ruang dan program yang mendukung pembelajaran seumur hidup untuk semua kalangan.</p>
            </div>
          </li>
          <li class="flex gap-4">
            <div class="flex-shrink-0">
              <i class="fas fa-check-circle text-[#f85e38] text-2xl mt-0.5"></i>
            </div>
            <div>
              <p class="text-gray-700 text-lg"><strong>Memberdayakan masyarakat:</strong> Membantu masyarakat mengembangkan keterampilan dan pengetahuan untuk meningkatkan kualitas hidup mereka.</p>
            </div>
          </li>
        </ul>
      </div>

      <div class="lg:col-span-1">
        <div class="sticky top-24">
          <!-- Gallery Carousel dalam Tentang Kami -->
          <h3 class="text-2xl font-bold mb-4 text-[#00425A]">Galeri Perpustakaan</h3>
          <div id="galleryCarousel" class="relative mb-8">
            <?php $__empty_1 = true; $__currentLoopData = $aboutPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
              <?php if($loop->index !== 1): ?>
              <div class="gallery-slide hidden group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 h-64 cursor-pointer fade-transition"
                onclick="openGalleryModal('<?php echo e(asset($photo->image_path)); ?>', '<?php echo e($photo->title); ?>', '<?php echo e($photo->description); ?>')">
                <!-- Image -->
                <img 
                  src="<?php echo e(asset($photo->image_path)); ?>" 
                  alt="<?php echo e($photo->title); ?>" 
                  class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                >
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                  <div>
                    <p class="text-white text-sm font-semibold line-clamp-1"><?php echo e($photo->title); ?></p>
                    <p class="text-gray-300 text-xs line-clamp-1"><?php echo e($photo->description); ?></p>
                  </div>
                </div>
              </div>
              <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
              <div class="text-center py-16 text-gray-500 bg-gray-100 rounded-lg">
                <i class="fas fa-image text-4xl mb-3 block opacity-50"></i>
                <p>Belum ada foto galeri</p>
              </div>
            <?php endif; ?>
            
            <!-- Navigation Buttons -->
            <?php if(count($aboutPhotos) > 0): ?>
              <button 
                id="nextCarousel" 
                onclick="nextCarouselSlide()" 
                class="absolute right-2 top-1/2 transform -translate-y-1/2 z-10 w-12 h-12 bg-white hover:bg-[#f85e38] text-[#00425A] hover:text-white rounded-full flex items-center justify-center transition-all duration-300 shadow-lg hover:shadow-2xl hover:scale-110 text-lg"
              >
                <i class="fas fa-chevron-right"></i>
              </button>

              <!-- Dots Indicator -->
              <div class="flex justify-center gap-2 mt-4">
                <?php for($i = 0; $i < count($aboutPhotos); $i++): ?>
                  <button 
                    onclick="goToCarouselSlide(<?php echo e($i); ?>)" 
                    class="carousel-dot w-2 h-2 rounded-full bg-gray-300 hover:bg-[#00425A] transition-all duration-300 <?php echo e($i === 0 ? 'bg-[#00425A] w-3' : ''); ?>"
                    data-index="<?php echo e($i); ?>"
                  ></button>
                <?php endfor; ?>
              </div>

              <!-- View All Button -->
              <button 
                onclick="openGalleryFullModal()" 
                class="w-full mt-4 px-6 py-3 bg-gradient-to-r from-[#00425A] to-[#003144] hover:from-[#f85e38] hover:to-[#d94e2e] text-white font-semibold rounded-lg transition-all duration-300 shadow-md hover:shadow-lg flex items-center justify-center gap-2"
              >
                <i class="fas fa-expand-alt"></i>Lihat Semua Foto
              </button>
            <?php endif; ?>
          </div>

          <h3 class="text-2xl font-bold mb-4 text-[#00425A]">Nilai Inti Kami</h3>
          <div class="grid grid-cols-2 gap-4">
            <div class="bg-gradient-to-br from-[#00425A] to-[#003144] text-white p-6 rounded-xl">
              <i class="fas fa-handshake text-3xl text-[#f85e38] mb-3 block"></i>
              <h4 class="font-bold  text-white">Belajar</h4>
              <p class="text-sm text-white text-opacity-90">Pusat gudang ilmu dengan ragam koleksi buku dan arsip, menjadikan Perpustakaan Jakarta sebagai sumber belajar.</p>
            </div>
            <div class="bg-gradient-to-br from-[#f85e38] to-[#d94e2e] text-white p-6 rounded-xl">
              <i class="fas fa-lightbulb text-3xl text-white mb-3 block"></i>
              <h4 class="font-bold  text-white">Berkarya</h4>
              <p class="text-sm text-white text-opacity-90">Tak hanya membaca, perpustakaan juga menjadi wadah untuk berkarya dengan penyediaan ruang-ruang eksploratif.
</p>
            </div>
            <div class="bg-gradient-to-br from-[#00425A] to-[#003144] text-white p-6 rounded-xl">
              <i class="fas fa-star text-3xl text-[#f85e38] mb-3 block"></i>
              <h4 class="font-bold  text-white">Bertumbuh</h4>
              <p class="text-sm text-white text-opacity-90">Wawasan yang diperoleh dari membaca, kreatifitas dari berkarya, menjadi bekal untuk membuat kota Jakarta, baik warga maupun kotanya tumbuh bersama</p>
            </div>
            <div class="bg-gradient-to-br from-[#f85e38] to-[#d94e2e] text-white p-6 rounded-xl aspect-[4/3] flex flex-col justify-center">
              <i class="fas fa-shield-alt text-3xl text-white mb-3 block"></i>
              <h4 class="font-bold text-white">Kepercayaan Publik</h4>
              <p class="text-sm text-white text-opacity-90">Menjadi lembaga yang dapat diandalkan masyarakat.</p>
            </div>
          </div>

          <div class="mt-8 bg-slate-50 border-l-4 border-[#00425A] p-6 rounded">
            <h4 class="font-bold text-[#00425A] mb-3">
              <i class="fas fa-info-circle mr-2"></i>Informasi Kontak
            </h4>
            <p class="text-gray-700 text-sm mb-2">
              <strong>Alamat:</strong> Jl. Cikini Raya No. 73 8, RT.8/RW.2, Cikini, Menteng, Kota Jakarta Pusat, DKI Jakarta 10330, Indonesia.
            </p>
            <p class="text-gray-700 text-sm mb-2">
              <strong>Telepon:</strong> <a href="tel:+62214706295" class="text-[#00425A] hover:text-[#f85e38]">(+62 21) 4706-295</a>
            </p>
            <p class="text-gray-700 text-sm">
              <strong>Email:</strong> <a href="mailto:info@perpustakaan.jakarta.go.id" class="text-[#00425A] hover:text-[#f85e38]">info@perpustakaan.jakarta.go.id</a>
            </p>
          </div>

          <a href="<?php echo e(route('contact')); ?>" class="mt-8 block text-center px-6 py-3 bg-[#00425A] text-white font-semibold rounded-lg hover:bg-[#003144] transition duration-300">
            <i class="fas fa-envelope mr-2"></i>Hubungi Kami
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php $__env->stopSection(); ?>

<!-- Gallery Modal -->
<div id="galleryModal" class="fixed inset-0 z-50 hidden bg-black/95 flex items-center justify-center p-4" onclick="closeGalleryModal(event)">
  <div class="relative w-full h-full max-w-7xl max-h-[95vh] bg-black rounded-3xl overflow-hidden shadow-2xl" onclick="event.stopPropagation()">
    <!-- Close Button -->
    <button 
      onclick="closeGalleryModal()" 
      class="absolute top-6 right-6 z-20 w-16 h-16 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center transition-all duration-300 hover:scale-110 shadow-lg"
    >
      <i class="fas fa-times text-white text-3xl"></i>
    </button>

    <!-- Main Content -->
    <div class="flex flex-col h-full">
      <!-- Image Section (60%) -->
      <div class="flex-1 flex items-center justify-center bg-black relative p-8 overflow-hidden">
        <img id="modalImage" src="" alt="" class="w-full h-full object-cover fade-transition rounded-2xl shadow-2xl">
        
        <!-- Left Button (Sebelumnya) -->
        <button 
          onclick="prevGalleryImage()" 
          class="absolute left-8 top-1/2 transform -translate-y-1/2 z-10 w-14 h-14 bg-white/20 hover:bg-[#f85e38] text-white rounded-full flex items-center justify-center transition-all duration-300 hover:scale-125 shadow-2xl text-2xl group"
        >
          <i class="fas fa-chevron-left"></i>
        </button>

        <!-- Right Button (Selanjutnya) -->
        <button 
          onclick="nextGalleryImage()" 
          class="absolute right-8 top-1/2 transform -translate-y-1/2 z-10 w-14 h-14 bg-white/20 hover:bg-[#f85e38] text-white rounded-full flex items-center justify-center transition-all duration-300 hover:scale-125 shadow-2xl text-2xl group"
        >
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>

      <!-- Info Section (40%) -->
      <div class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 p-8 border-t border-gray-700 overflow-y-auto">
        <div class="max-w-6xl mx-auto">
          <!-- Pagination Dots (Top) -->
          <div id="paginationDotsContainer" class="flex justify-center gap-2 mb-6">
            <!-- Dots will be generated by JavaScript -->
          </div>

          <!-- Title & Counter -->
          <div class="flex justify-between items-start mb-4">
            <div class="flex-1">
              <h2 id="modalTitle" class="text-4xl font-bold text-white mb-2"></h2>
              <div class="flex items-center gap-3">
                <span class="inline-block px-3 py-1 bg-[#f85e38] text-white rounded-full text-sm font-semibold">
                  Foto <span id="modalCounter" class="font-bold"></span> / <span id="modalTotal"></span>
                </span>
              </div>
            </div>
          </div>

          <!-- Description -->
          <p id="modalDescription" class="text-gray-300 text-lg leading-relaxed mb-6 line-clamp-3"></p>

          <!-- Thumbnail Carousel -->
          <div class="mt-6">
            <p class="text-sm text-gray-400 font-semibold tracking-widest mb-3">LIHAT FOTO LAINNYA</p>
            <div class="flex gap-3 overflow-x-auto pb-3 scrollbar-hide">
              <div id="thumbnailContainer" class="flex gap-3">
                <!-- Thumbnails will be generated by JavaScript -->
              </div>
            </div>
          </div>

          <!-- Bottom Action -->
          <div class="flex gap-3 mt-6 pt-6 border-t border-gray-700">
            <button 
              onclick="prevGalleryImage()" 
              class="flex-1 px-6 py-3 bg-gray-700 hover:bg-gray-600 text-white rounded-xl transition-all duration-300 hover:scale-105 font-semibold flex items-center justify-center gap-2 hover:shadow-lg"
            >
              <i class="fas fa-chevron-left"></i>Sebelumnya
            </button>
            <button 
              onclick="nextGalleryImage()" 
              class="flex-1 px-6 py-3 bg-[#f85e38] hover:bg-[#d94e2e] text-white rounded-xl transition-all duration-300 hover:scale-105 font-semibold flex items-center justify-center gap-2 hover:shadow-lg"
            >
              Selanjutnya<i class="fas fa-chevron-right"></i>
            </button>
          </div>

          <!-- Help Text -->
          <p class="text-center text-gray-500 text-xs mt-4">💡 Gunakan Arrow Keys atau klik tombol untuk navigasi | Tekan ESC untuk tutup</p>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// CSS Animation untuk fade effect
const style = document.createElement('style');
style.textContent = `
  .fade-transition {
    animation: fadeInOut 0.6s ease-in-out;
  }
  
  @keyframes fadeInOut {
    0% {
      opacity: 0;
    }
    50% {
      opacity: 0.5;
    }
    100% {
      opacity: 1;
    }
  }

  .gallery-slide {
    transition: opacity 0.6s ease-in-out;
  }

  .gallery-slide.fade-in {
    animation: fadeInOut 0.6s ease-in-out;
  }
`;
document.head.appendChild(style);

// Carousel functionality
let currentCarouselIndex = 0;
let carouselAutoInterval = null;
const totalCarouselSlides = document.querySelectorAll('.gallery-slide').length;

function showCarouselSlide(index) {
  const slides = document.querySelectorAll('.gallery-slide');
  if (slides.length === 0) return;
  
  // Validasi index
  if (index >= slides.length) {
    currentCarouselIndex = 0;
  } else if (index < 0) {
    currentCarouselIndex = slides.length - 1;
  } else {
    currentCarouselIndex = index;
  }
  
  // Sembunyikan semua slides
  slides.forEach((slide) => {
    slide.classList.add('hidden');
    slide.classList.remove('fade-in');
  });
  
  // Tampilkan slide yang aktif dengan fade effect
  slides[currentCarouselIndex].classList.remove('hidden');
  slides[currentCarouselIndex].classList.add('fade-in');
  
  // Update dots
  const dots = document.querySelectorAll('.carousel-dot');
  dots.forEach((dot, idx) => {
    if (idx === currentCarouselIndex) {
      dot.classList.add('bg-[#00425A]', 'w-3');
      dot.classList.remove('w-2', 'bg-gray-300');
    } else {
      dot.classList.remove('bg-[#00425A]', 'w-3');
      dot.classList.add('w-2', 'bg-gray-300');
    }
  });
}

function nextCarouselSlide() {
  showCarouselSlide(currentCarouselIndex + 1);
  resetCarouselAutoplay();
}

function prevCarouselSlide() {
  showCarouselSlide(currentCarouselIndex - 1);
  resetCarouselAutoplay();
}

function goToCarouselSlide(index) {
  showCarouselSlide(index);
  resetCarouselAutoplay();
}

function startCarouselAutoplay() {
  carouselAutoInterval = setInterval(() => {
    nextCarouselSlide();
  }, 3000); // 3 detik
}

function stopCarouselAutoplay() {
  if (carouselAutoInterval) {
    clearInterval(carouselAutoInterval);
    carouselAutoInterval = null;
  }
}

function resetCarouselAutoplay() {
  stopCarouselAutoplay();
  startCarouselAutoplay();
}

// Initialize carousel on page load
document.addEventListener('DOMContentLoaded', () => {
  const slides = document.querySelectorAll('.gallery-slide');
  if (slides.length > 0) {
    showCarouselSlide(0);
    startCarouselAutoplay();
    
    // Hentikan autoplay saat hover
    const carousel = document.getElementById('galleryCarousel');
    if (carousel) {
      carousel.addEventListener('mouseenter', stopCarouselAutoplay);
      carousel.addEventListener('mouseleave', startCarouselAutoplay);
    }
  }
});

// Gallery Modal functionality
let currentGalleryIndex = 0;
let isFullGalleryMode = false;
const galleryItems = [
  <?php $__empty_1 = true; $__currentLoopData = $aboutPhotos; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $photo): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
  {
    title: '<?php echo e($photo->title); ?>',
    description: '<?php echo e($photo->description); ?>',
    image: '<?php echo e(asset($photo->image_path)); ?>'
  }<?php echo e(!$loop->last ? ',' : ''); ?>

  <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
  <?php endif; ?>
];

function generateThumbnails() {
  const container = document.getElementById('thumbnailContainer');
  const dotsContainer = document.getElementById('paginationDotsContainer');
  if (!container) return;
  
  // Clear thumbnails
  container.innerHTML = '';
  
  // Generate thumbnails
  galleryItems.forEach((item, index) => {
    const thumb = document.createElement('button');
    thumb.className = `flex-shrink-0 w-24 h-24 rounded-lg overflow-hidden transition-all duration-300 hover:scale-110 cursor-pointer border-3 ${
      index === currentGalleryIndex ? 'border-[#f85e38] ring-2 ring-[#f85e38]' : 'border-gray-600 hover:border-gray-400'
    }`;
    thumb.innerHTML = `<img src="${item.image}" class="w-full h-full object-cover" alt="${item.title}">`;
    thumb.onclick = () => {
      currentGalleryIndex = index;
      updateGalleryModal();
      generateThumbnails();
    };
    container.appendChild(thumb);
  });
  
  // Generate pagination dots
  if (dotsContainer) {
    dotsContainer.innerHTML = '';
    galleryItems.forEach((_, index) => {
      const dot = document.createElement('button');
      dot.className = `w-2 h-2 rounded-full transition-all duration-300 ${
        index === currentGalleryIndex 
          ? 'bg-[#f85e38] w-3' 
          : 'bg-gray-600 hover:bg-gray-500'
      }`;
      dot.onclick = () => {
        currentGalleryIndex = index;
        updateGalleryModal();
        generateThumbnails();
      };
      dotsContainer.appendChild(dot);
    });
  }
}

function openGalleryModal(image, title, description) {
  // Store clicked item index
  const index = galleryItems.findIndex(item => item.image === image);
  if (index !== -1) {
    currentGalleryIndex = index;
  }
  
  isFullGalleryMode = false;
  
  // Set modal data
  updateGalleryModal();
  generateThumbnails();
  
  document.getElementById('galleryModal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function openGalleryFullModal() {
  if (galleryItems.length === 0) return;
  
  currentGalleryIndex = 0;
  isFullGalleryMode = true;
  
  updateGalleryModal();
  generateThumbnails();
  
  document.getElementById('galleryModal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeGalleryModal(event) {
  if (event && event.target.id !== 'galleryModal') return;
  
  document.getElementById('galleryModal').classList.add('hidden');
  document.body.style.overflow = 'auto';
}

function updateGalleryModal() {
  if (galleryItems.length === 0) return;
  
  const item = galleryItems[currentGalleryIndex];
  if (item) {
    const modalImage = document.getElementById('modalImage');
    modalImage.classList.remove('fade-transition');
    // Trigger animation
    setTimeout(() => {
      modalImage.src = item.image;
      modalImage.classList.add('fade-transition');
    }, 10);
    
    document.getElementById('modalTitle').textContent = item.title;
    document.getElementById('modalDescription').textContent = item.description;
    
    // Update counter
    const counter = currentGalleryIndex + 1;
    document.getElementById('modalCounter').textContent = counter;
    document.getElementById('modalTotal').textContent = galleryItems.length;
  }
}

function nextGalleryImage() {
  if (galleryItems.length === 0) return;
  currentGalleryIndex = (currentGalleryIndex + 1) % galleryItems.length;
  updateGalleryModal();
  generateThumbnails();
}

function prevGalleryImage() {
  if (galleryItems.length === 0) return;
  currentGalleryIndex = (currentGalleryIndex - 1 + galleryItems.length) % galleryItems.length;
  updateGalleryModal();
  generateThumbnails();
}

// Keyboard navigation
document.addEventListener('keydown', (e) => {
  if (document.getElementById('galleryModal').classList.contains('hidden')) return;
  
  if (e.key === 'ArrowRight') nextGalleryImage();
  if (e.key === 'ArrowLeft') prevGalleryImage();
  if (e.key === 'Escape') closeGalleryModal();
});
</script>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/about.blade.php ENDPATH**/ ?>