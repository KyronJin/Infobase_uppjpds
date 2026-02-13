@extends('layouts.app')

@section('content')

<!-- Hero Section -->
<section class="bg-white pt-28 pb-12 border-b border-gray-200">
  <div class="container mx-auto px-6">
    <div class="text-center">
      <h1 class="text-5xl font-bold text-gray-900">
        Tentang Kami
      </h1>
    </div>
  </div>
</section>

<!-- Main Content -->
<section class="py-16 bg-white">
  <div class="container mx-auto px-6">
    <div class="max-w-6xl mx-auto">
      <!-- About & Gallery Grid -->
      <div class="grid lg:grid-cols-2 gap-12 mb-16">
        <!-- Profil Institusi (Left) -->
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-6">Profil Institusi</h2>
          <p class="text-gray-700 mb-4 text-base leading-relaxed">
            Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen untuk menyediakan akses informasi berkualitas tinggi kepada seluruh masyarakat Jakarta. Kami berfungsi sebagai pusat pembelajaran, dokumentasi, dan pemeliharaan memori kolektif masyarakat.
          </p>
          <p class="text-gray-700 text-base leading-relaxed">
            Dengan koleksi lengkap, fasilitas modern, dan staf yang profesional, kami menawarkan lebih dari sekadar tempat meminjam buku. Kami adalah ruang untuk belajar, berkolaborasi, berinovasi, dan terhubung dengan komunitas pengetahuan.
          </p>
        </div>

        <!-- Gallery Section (Right) -->
        @if(count($aboutPhotos) > 0)
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Galeri Perpustakaan</h2>
          <div class="relative group">
            <!-- Carousel Image - Draggable -->
            <div class="relative overflow-hidden rounded-lg h-64 shadow-md select-none" id="galleryCarousel" style="touch-action: none;">
              <img 
                id="carouselImage"
                src="{{ asset($aboutPhotos->first()->image_path) }}" 
                alt="Gallery" 
                class="w-full h-full object-cover cursor-grab active:cursor-grabbing transition-transform duration-300"
                draggable="false"
              >
              <!-- Overlay with title/desc -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4 pointer-events-none">
                <div class="text-white">
                  <p id="carouselTitle" class="font-bold text-lg">{{ $aboutPhotos->first()->title }}</p>
                  <p id="carouselDesc" class="text-sm text-gray-200">{{ $aboutPhotos->first()->description }}</p>
                </div>
              </div>
            </div>
          </div>

          <!-- Photo Counter -->
          @if(count($aboutPhotos) > 1)
          <div class="mt-3 text-sm text-gray-600 text-center">
            Foto <span id="currentPhotoNum">1</span> dari <span id="totalPhotoNum">{{ count($aboutPhotos) }}</span>
          </div>
          @endif

          <!-- Thumbnail Gallery -->
          @if(count($aboutPhotos) > 1)
          <div class="mt-4 flex gap-2 overflow-x-auto pb-2">
            @foreach($aboutPhotos as $index => $photo)
            <img 
              src="{{ asset($photo->image_path) }}" 
              alt="{{ $photo->title }}" 
              class="w-16 h-16 object-cover rounded border-2 cursor-pointer flex-shrink-0 transition-all hover:border-[#f85e38] hover:scale-110 @if($index === 0) border-[#f85e38] @else border-gray-300 @endif"
              onclick="openGalleryAtIndex({{ $index }})"
            >
            @endforeach
          </div>
          @endif
        </div>
        @endif
      </div>

      <!-- Vision Section -->
      <div class="mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Visi Kami</h2>
        <div class="bg-blue-50 border-l-4 border-[#00425A] p-8 rounded-lg">
          <p class="text-lg text-gray-800 leading-relaxed">
            Menjadi pusat pengetahuan yang inklusif, inovatif, dan relevan untuk mendukung literasi dan kreativitas seluruh warga Jakarta, sehingga perpustakaan menjadi jantung komunitas yang hidup dan dinamis.
          </p>
        </div>
      </div>

      <!-- Mission Section -->
      <div class="mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Misi Kami</h2>
        <div class="grid md:grid-cols-2 gap-6">
          <div class="p-6 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#00425A] text-2xl mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-bold text-gray-900 mb-2 text-lg">Menyediakan Akses Informasi Berkualitas</h3>
                <p class="text-gray-700">Memastikan semua orang dapat mengakses sumber daya pembelajaran tanpa hambatan finansial atau geografis.</p>
              </div>
            </div>
          </div>
          <div class="p-6 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#00425A] text-2xl mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-bold text-gray-900 mb-2 text-lg">Mendorong Budaya Baca dan Inovasi</h3>
                <p class="text-gray-700">Mengembangkan program yang menginspirasi masyarakat untuk membaca, belajar, dan berinovasi.</p>
              </div>
            </div>
          </div>
          <div class="p-6 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#00425A] text-2xl mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-bold text-gray-900 mb-2 text-lg">Menciptakan Ekosistem Pembelajaran</h3>
                <p class="text-gray-700">Menyediakan ruang dan program yang mendukung pembelajaran seumur hidup untuk semua kalangan.</p>
              </div>
            </div>
          </div>
          <div class="p-6 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#00425A] text-2xl mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-bold text-gray-900 mb-2 text-lg">Memberdayakan Masyarakat</h3>
                <p class="text-gray-700">Membantu masyarakat mengembangkan keterampilan dan pengetahuan untuk meningkatkan kualitas hidup mereka.</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Nilai Inti Kami & Hubungi Kami (Two Columns) -->
      <div class="grid lg:grid-cols-2 gap-12">
        <!-- Nilai Inti Kami (Left) -->
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-6">Nilai Inti Kami</h2>
          <ul class="space-y-4">
            <li class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#F85E38] text-lg mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-semibold text-gray-900">Belajar</h3>
                <p class="text-gray-600 text-sm">Kami adalah pusat gudang ilmu dengan ragam koleksi literature dan referensi</p>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#F85E38] text-lg mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-semibold text-gray-900">Berkarya</h3>
                <p class="text-gray-600 text-sm">Wadah untuk berkarya dan berinovasi dalam mengembangkan pengetahuan</p>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#F85E38] text-lg mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-semibold text-gray-900">Bertumbuh</h3>
                <p class="text-gray-600 text-sm">Tumbuh bersama melalui edukasi dan pengembangan berkelanjutan</p>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#F85E38] text-lg mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-semibold text-gray-900">Kepercayaan</h3>
                <p class="text-gray-600 text-sm">Lembaga yang dapat diandalkan dan dipercaya oleh masyarakat</p>
              </div>
            </li>
          </ul>
        </div>

        <!-- Hubungi Kami (Right) -->
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-6">Hubungi Kami</h2>
          <div class="space-y-6">
            <div class="flex items-start gap-4">
              <i class="fas fa-map-marker-alt text-[#F85E38] text-2xl flex-shrink-0 mt-1"></i>
              <div>
                <h3 class="font-semibold text-gray-900 mb-1">Lokasi</h3>
                <p class="text-gray-600 text-sm leading-relaxed">Jl. Cikini Raya No. 73 8<br>Cikini, Menteng, Jakarta Pusat</p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <i class="fas fa-phone text-[#F85E38] text-2xl flex-shrink-0 mt-1"></i>
              <div>
                <h3 class="font-semibold text-gray-900 mb-1">Telepon</h3>
                <p class="text-gray-600 text-sm"><a href="tel:+62214706295" class="text-[#F85E38] hover:underline font-semibold">(+62 21) 4706-295</a></p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <i class="fas fa-envelope text-[#F85E38] text-2xl flex-shrink-0 mt-1"></i>
              <div>
                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                <p class="text-gray-600 text-sm"><a href="mailto:info@perpustakaan.jakarta.go.id" class="text-[#F85E38] hover:underline font-semibold break-all">info@perpustakaan.jakarta.go.id</a></p>
              </div>
            </div>
          </div>
          <div class="mt-8">
            <a href="{{ route('contact') }}" class="block w-full bg-[#F85E38] text-white font-semibold py-3 rounded-lg hover:bg-[#e84d28] transition-colors text-center">
              Hubungi Kami Sekarang
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Gallery Modal -->
<div id="galleryModal" class="fixed inset-0 z-50 hidden bg-black/95 flex items-center justify-center p-4" onclick="closeGalleryModal(event)">
  <div class="relative w-full h-full max-w-7xl max-h-[95vh] bg-black rounded-lg overflow-hidden shadow-2xl" onclick="event.stopPropagation()">
    <!-- Close Button -->
    <button 
      onclick="closeGalleryModal()" 
      class="absolute top-6 right-6 z-20 w-12 h-12 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center transition-all hover:scale-110 shadow-lg"
    >
      <i class="fas fa-times text-white text-2xl"></i>
    </button>

    <!-- Main Content -->
    <div class="flex flex-col h-full">
      <!-- Image Section -->
      <div class="flex-1 flex items-center justify-center bg-black relative p-8 overflow-hidden">
        <img id="modalImage" src="" alt="" class="w-full h-full object-contain">
        
        <!-- Navigation Buttons -->
        <button 
          onclick="prevGalleryImage()" 
          class="absolute left-8 top-1/2 transform -translate-y-1/2 z-10 w-12 h-12 bg-white/20 hover:bg-[#f85e38] text-white rounded-full flex items-center justify-center transition-all hover:scale-110 shadow-lg text-xl"
        >
          <i class="fas fa-chevron-left"></i>
        </button>

        <button 
          onclick="nextGalleryImage()" 
          class="absolute right-8 top-1/2 transform -translate-y-1/2 z-10 w-12 h-12 bg-white/20 hover:bg-[#f85e38] text-white rounded-full flex items-center justify-center transition-all hover:scale-110 shadow-lg text-xl"
        >
          <i class="fas fa-chevron-right"></i>
        </button>
      </div>

      <!-- Info Section -->
      <div class="bg-gray-900 p-6 border-t border-gray-700">
        <div class="max-w-6xl mx-auto">
          <!-- Title & Counter -->
          <div class="flex justify-between items-start mb-4">
            <div class="flex-1">
              <h2 id="modalTitle" class="text-3xl font-bold text-white mb-2"></h2>
              <span class="inline-block px-3 py-1 bg-[#f85e38] text-white rounded-full text-sm font-semibold">
                Foto <span id="modalCounter"></span> / <span id="modalTotal"></span>
              </span>
            </div>
          </div>

          <!-- Description -->
          <p id="modalDescription" class="text-gray-300 text-base leading-relaxed mb-4"></p>

          <!-- Bottom Action -->
          <div class="flex gap-3">
            <button 
              onclick="prevGalleryImage()" 
              class="flex-1 px-6 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded-lg transition-all hover:scale-105 font-semibold flex items-center justify-center gap-2"
            >
              <i class="fas fa-chevron-left"></i>Sebelumnya
            </button>
            <button 
              onclick="nextGalleryImage()" 
              class="flex-1 px-6 py-2 bg-[#f85e38] hover:bg-[#d94e2e] text-white rounded-lg transition-all hover:scale-105 font-semibold flex items-center justify-center gap-2"
            >
              Selanjutnya<i class="fas fa-chevron-right"></i>
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
// Gallery Modal functionality
let currentGalleryIndex = 0;
let carouselPhotoIndex = 0;
const galleryItems = [
  @forelse($aboutPhotos as $photo)
  {
    title: '{{ $photo->title }}',
    description: '{{ $photo->description }}',
    image: '{{ asset($photo->image_path) }}'
  }{{ !$loop->last ? ',' : '' }}
  @empty
  @endforelse
];

// Easing function untuk momentum scrolling
function easeOutExpo(t) {
  return t === 1 ? 1 : 1 - Math.pow(2, -10 * t);
}

// Carousel drag functionality dengan momentum
let isDragging = false;
let dragStartX = 0;
let dragCurrentX = 0;
let dragPrevX = 0;
let dragVelocity = 0;
let dragStartTime = 0;
let animationFrame = null;
const carouselContainer = document.getElementById('galleryCarousel');
const carouselImage = document.getElementById('carouselImage');

if(carouselContainer && galleryItems.length > 1) {
  carouselContainer.addEventListener('mousedown', (e) => {
    if(animationFrame) {
      cancelAnimationFrame(animationFrame);
      animationFrame = null;
    }
    isDragging = true;
    dragStartX = e.clientX;
    dragCurrentX = e.clientX;
    dragPrevX = e.clientX;
    dragStartTime = Date.now();
    carouselImage.style.cursor = 'grabbing';
    carouselImage.style.transition = 'none';
  });

  document.addEventListener('mousemove', (e) => {
    if(!isDragging || !carouselContainer) return;
    
    dragPrevX = dragCurrentX;
    dragCurrentX = e.clientX;
    dragVelocity = dragCurrentX - dragPrevX;
  });

  document.addEventListener('mouseup', (e) => {
    if(!isDragging) return;
    
    isDragging = false;
    carouselImage.style.cursor = 'grab';
    
    const dragDistance = dragCurrentX - dragStartX;
    const dragTime = Date.now() - dragStartTime;
    const baseVelocity = dragVelocity;
    
    // Threshold untuk swipe (minimal 20px)
    const threshold = 20;
    const velocityThreshold = 0.5; // pixel per millisecond
    
    // Calculate if swipe should trigger based on distance or velocity
    const shouldSwipeRight = dragDistance > threshold || (dragDistance > 10 && baseVelocity > velocityThreshold);
    const shouldSwipeLeft = dragDistance < -threshold || (dragDistance < -10 && baseVelocity < -velocityThreshold);
    
    // Momentum animation
    let momentum = Math.abs(baseVelocity);
    momentum = Math.min(momentum, 5); // Cap momentum
    
    if(shouldSwipeRight || shouldSwipeLeft) {
      // Perform swipe
      if(shouldSwipeRight) {
        performCarouselSwipe('prev');
      } else if(shouldSwipeLeft) {
        performCarouselSwipe('next');
      }
    } else {
      // Snap back - just reset opacity
      carouselImage.style.transition = 'opacity 200ms cubic-bezier(0.4, 0, 0.2, 1)';
      carouselImage.style.opacity = '1';
    }
  });

  // Touch events untuk mobile
  carouselContainer.addEventListener('touchstart', (e) => {
    if(animationFrame) {
      cancelAnimationFrame(animationFrame);
      animationFrame = null;
    }
    isDragging = true;
    dragStartX = e.touches[0].clientX;
    dragCurrentX = e.touches[0].clientX;
    dragPrevX = e.touches[0].clientX;
    dragStartTime = Date.now();
  });

  document.addEventListener('touchmove', (e) => {
    if(!isDragging) return;
    dragPrevX = dragCurrentX;
    dragCurrentX = e.touches[0].clientX;
    dragVelocity = dragCurrentX - dragPrevX;
  }, { passive: true });

  document.addEventListener('touchend', (e) => {
    if(!isDragging) return;
    isDragging = false;
    
    const dragDistance = dragCurrentX - dragStartX;
    const threshold = 50;
    const velocityThreshold = 1;
    
    const shouldSwipeRight = dragDistance > threshold || (dragDistance > 25 && Math.abs(dragVelocity) > velocityThreshold);
    const shouldSwipeLeft = dragDistance < -threshold || (dragDistance < -25 && Math.abs(dragVelocity) > velocityThreshold);
    
    if(shouldSwipeRight) {
      performCarouselSwipe('prev');
    } else if(shouldSwipeLeft) {
      performCarouselSwipe('next');
    } else {
      carouselImage.style.transition = 'opacity 200ms cubic-bezier(0.4, 0, 0.2, 1)';
      carouselImage.style.opacity = '1';
    }
  });

  // Prevent text selection during drag
  carouselContainer.addEventListener('selectstart', (e) => {
    if(isDragging) e.preventDefault();
  });
}

// Perform carousel swipe dengan smooth transition
function performCarouselSwipe(direction) {
  carouselImage.style.transition = 'opacity 300ms cubic-bezier(0.4, 0, 0.2, 1)';
  carouselImage.style.opacity = '0';
  
  setTimeout(() => {
    if(direction === 'next') {
      nextCarouselPhoto();
    } else if(direction === 'prev') {
      prevCarouselPhoto();
    }
    carouselImage.style.opacity = '1';
  }, 150);
}

// Carousel photo navigation
function nextCarouselPhoto() {
  if(galleryItems.length === 0) return;
  carouselPhotoIndex = (carouselPhotoIndex + 1) % galleryItems.length;
  updateCarouselPhoto();
}

function prevCarouselPhoto() {
  if(galleryItems.length === 0) return;
  carouselPhotoIndex = (carouselPhotoIndex - 1 + galleryItems.length) % galleryItems.length;
  updateCarouselPhoto();
}

function updateCarouselPhoto() {
  if(galleryItems.length === 0) return;
  
  const item = galleryItems[carouselPhotoIndex];
  
  // Update image src
  carouselImage.src = item.image;
  document.getElementById('carouselTitle').textContent = item.title;
  document.getElementById('carouselDesc').textContent = item.description;
  document.getElementById('currentPhotoNum').textContent = carouselPhotoIndex + 1;
  
  // Update thumbnail border
  const thumbnails = document.querySelectorAll('[onclick^="openGalleryAtIndex"]');
  if(thumbnails) {
    thumbnails.forEach((thumb, idx) => {
      if(idx === carouselPhotoIndex) {
        thumb.classList.add('border-[#f85e38]');
        thumb.classList.remove('border-gray-300');
      } else {
        thumb.classList.remove('border-[#f85e38]');
        thumb.classList.add('border-gray-300');
      }
    });
  }
}

function openGalleryModal(image, title, description) {
  if(galleryItems.length === 0) return;
  
  const index = galleryItems.findIndex(item => item.image === image);
  if(index !== -1) {
    currentGalleryIndex = index;
  }
  
  updateGalleryModal();
  document.getElementById('galleryModal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function openGalleryFromCarousel() {
  if(galleryItems.length === 0) return;
  
  currentGalleryIndex = carouselPhotoIndex;
  updateGalleryModal();
  document.getElementById('galleryModal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function openGalleryAtIndex(index) {
  if(galleryItems.length === 0) return;
  
  currentGalleryIndex = index;
  updateGalleryModal();
  document.getElementById('galleryModal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function closeGalleryModal(event) {
  if(event && event.target.id !== 'galleryModal') return;
  
  document.getElementById('galleryModal').classList.add('hidden');
  document.body.style.overflow = 'auto';
}

function openGalleryFullModal() {
  if(galleryItems.length === 0) return;
  
  currentGalleryIndex = 0;
  updateGalleryModal();
  document.getElementById('galleryModal').classList.remove('hidden');
  document.body.style.overflow = 'hidden';
}

function updateGalleryModal() {
  if(galleryItems.length === 0) return;
  
  const item = galleryItems[currentGalleryIndex];
  if(item) {
    document.getElementById('modalImage').src = item.image;
    document.getElementById('modalTitle').textContent = item.title;
    document.getElementById('modalDescription').textContent = item.description;
    document.getElementById('modalCounter').textContent = currentGalleryIndex + 1;
    document.getElementById('modalTotal').textContent = galleryItems.length;
  }
}

function nextGalleryImage() {
  if(galleryItems.length === 0) return;
  currentGalleryIndex = (currentGalleryIndex + 1) % galleryItems.length;
  updateGalleryModal();
}

function prevGalleryImage() {
  if(galleryItems.length === 0) return;
  currentGalleryIndex = (currentGalleryIndex - 1 + galleryItems.length) % galleryItems.length;
  updateGalleryModal();
}

// Keyboard navigation
document.addEventListener('keydown', (e) => {
  if(document.getElementById('galleryModal').classList.contains('hidden')) return;
  
  if(e.key === 'ArrowRight') nextGalleryImage();
  if(e.key === 'ArrowLeft') prevGalleryImage();
  if(e.key === 'Escape') closeGalleryModal();
});
</script>

@endsection
