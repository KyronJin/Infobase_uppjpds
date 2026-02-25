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
          <h2 class="text-3xl font-bold text-gray-900 mb-6">
            {{ $aboutContent ? $aboutContent->title : 'Profil Institusi' }}
          </h2>
          <div class="text-gray-700 text-base leading-relaxed prose prose-sm max-w-none">
            {!! $aboutContent ? $aboutContent->content : 'Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen untuk menyediakan akses informasi berkualitas tinggi kepada seluruh masyarakat Jakarta. Kami berfungsi sebagai pusat pembelajaran, dokumentasi, dan pemeliharaan memori kolektif masyarakat.<br><br>Dengan koleksi lengkap, fasilitas modern, dan staf yang profesional, kami menawarkan lebih dari sekadar tempat meminjam buku. Kami adalah ruang untuk belajar, berkolaborasi, berinovasi, dan terhubung dengan komunitas pengetahuan.' !!}
          </div>
        </div>

        <!-- Gallery Section (Right) -->
        @if(count($aboutPhotos) > 0)
        <div>
          <h2 class="text-3xl font-bold text-gray-900 mb-4">Galeri Perpustakaan</h2>
          <!-- Carousel Image - Clickable to open modal -->
          <div class="relative group cursor-pointer" onclick="openGalleryFromCarousel()">
            <div class="relative overflow-hidden rounded-lg h-64 shadow-md hover:shadow-lg transition-shadow" id="galleryCarousel">
              <img 
                id="carouselImage"
                src="{{ asset($aboutPhotos->first()->image_path) }}" 
                alt="Gallery" 
                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105"
              >
              <!-- Title Overlay -->
              <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent flex items-end p-4 pointer-events-none">
                <div class="text-white">
                  <p id="carouselTitle" class="font-bold text-lg">{{ $aboutPhotos->first()->title }}</p>
                </div>
              </div>

              <!-- Expand indicator -->
              <div class="absolute inset-0 bg-black/0 group-hover:bg-black/20 transition-all flex items-center justify-center pointer-events-none">
                <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                  <i class="fas fa-expand text-white text-3xl drop-shadow-lg"></i>
                </div>
              </div>

              <!-- Prev Button -->
              @if(count($aboutPhotos) > 1)
              <button type="button" class="absolute left-3 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full p-2 transition-all z-10 hover:scale-110" onclick="return prevCarouselPhoto(event);">
                <i class="fas fa-chevron-left"></i>
              </button>
              @endif

              <!-- Next Button -->
              @if(count($aboutPhotos) > 1)
              <button type="button" class="absolute right-3 top-1/2 -translate-y-1/2 bg-black/50 hover:bg-black/70 text-white rounded-full p-2 transition-all z-10 hover:scale-110" onclick="return nextCarouselPhoto(event);">
                <i class="fas fa-chevron-right"></i>
              </button>
              @endif
            </div>
          </div>

          <!-- Photo Counter -->
          @if(count($aboutPhotos) > 1)
          <div class="mt-3 text-sm text-gray-600 text-center">
            Foto <span id="currentPhotoNum">1</span> dari <span id="totalPhotoNum">{{ count($aboutPhotos) }}</span>
          </div>
          @endif

        </div>
        @endif
      </div>

      <!-- Vision Section -->
      <div class="mb-16">
        @if($visiMisiContent)
          <h2 class="text-4xl font-bold text-gray-900 mb-6">{{ $visiMisiContent->title }}</h2>
          <div class="bg-blue-50 border-l-4 border-[#00425A] p-8 rounded-lg prose prose-sm max-w-none">
            {!! $visiMisiContent->content !!}
          </div>
        @else
          <h2 class="text-4xl font-bold text-gray-900 mb-6">Visi Kami</h2>
          <div class="bg-blue-50 border-l-4 border-[#00425A] p-8 rounded-lg">
            <p class="text-lg text-gray-800 leading-relaxed">
              “Menjadi Perpustakaan yang berlaku sebagai Mesin Pendorong Kreativitas Masyarakat dalam Menyongsong Era Industri 4.0”

            </p>
          </div>
        @endif
      </div>

      <!-- Mission Section -->
      <div class="mb-16">
        <h2 class="text-4xl font-bold text-gray-900 mb-6">Misi Kami</h2>
        <div class="grid md:grid-cols-3 gap-6">
          <div class="p-6 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#00425A] text-2xl mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-bold text-gray-900 mb-2 text-lg">Mewujudkan Perpustakaan sebagai Pusat Kegiatan Kreatif Masyarakat</h3>
                <p class="text-gray-700">Misi ini ingin menjadikan perpustakaan sebagai alternatif kegiatan di antara pusat kegiatan lainnya yang mendasarkan diri pada aspek kreativitas. Perpustakaan oleh karenanya akan sekaligus menjadi ruang inklusi sosial yang ramah pada anak, lanjut usia, dan difabel.</p>
              </div>
            </div>
          </div>
          <div class="p-6 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#00425A] text-2xl mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-bold text-gray-900 mb-2 text-lg">Mewujudkan Perpustakaan sebagai Lokus Masyarakat Berpengetahuan</h3>
                <p class="text-gray-700">Misi ini ingin menjadikan perpustakaan sebagai tempat masyarakat berkumpul, berdiskusi, berkolaborasi dalam mengembangkan ide/gagasan dan membangun pengetahuan baru.</p>
              </div>
            </div>
          </div>
          <div class="p-6 bg-gray-50 rounded-lg hover:shadow-md transition-shadow">
            <div class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#00425A] text-2xl mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-bold text-gray-900 mb-2 text-lg">Mewujudkan Perpustakaan sebagai Jantung Inovasi Kota.</h3>
                <p class="text-gray-700">Misi ini ingin menjadikan perpustakaan sebagai pusat kegiatan untuk inovasi‐ inovasi kreatif yang dapat menjadi kota Jakarta sebagai kota pintar/belajar.
</p>
              </div>
            </div>
          </div>
        </div>
      </div>

      <!-- Display Custom About Content Sections -->
      @if($allAbouts && count($allAbouts) > 0)
        @foreach($allAbouts as $about)
          @if(!in_array($about->key, ['profil_institusi', 'visi_misi']))
            <div class="mb-16 p-8 bg-gradient-to-r from-slate-50 to-gray-50 rounded-lg border border-gray-200">
              <h2 class="text-3xl font-bold text-gray-900 mb-6">{{ $about->title }}</h2>
              <div class="text-gray-700 prose prose-sm max-w-none leading-relaxed">
                {!! $about->content !!}
              </div>
            </div>
          @endif
        @endforeach
      @endif

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
                <p class="text-gray-600 text-sm">Pusat gudang ilmu dengan ragam koleksi buku dan arsip, menjadikan Perpustakaan Jakarta sebagai sumber belajar.</p>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#F85E38] text-lg mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-semibold text-gray-900">Berkarya</h3>
                <p class="text-gray-600 text-sm">Tak hanya membaca, perpustakaan juga menjadi wadah untuk berkarya dengan penyediaan ruang-ruang eksploratif.</p>
              </div>
            </li>
            <li class="flex items-start gap-3">
              <i class="fas fa-check-circle text-[#F85E38] text-lg mt-1 flex-shrink-0"></i>
              <div>
                <h3 class="font-semibold text-gray-900">Bertumbuh</h3>
                <p class="text-gray-600 text-sm">Wawasan yang diperoleh dari membaca, kreatifitas dari berkarya, menjadi bekal untuk membuat kota Jakarta, baik warga maupun kotanya tumbuh bersama.</p>
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
                <p class="text-gray-600 text-sm leading-relaxed">Jln. Cikini Raya No. 73, Gedung Ali Sadikin LT 3-7, Komplek Taman Ismail marzuki, Menteng, 10330, JAKARTA PUSAT</p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <i class="fas fa-phone text-[#F85E38] text-2xl flex-shrink-0 mt-1"></i>
              <div>
                <h3 class="font-semibold text-gray-900 mb-1">WhatsApp (No Call) </h3>
                <p class="text-gray-600 text-sm"><a href="tel:+6285179737368" class="text-[#F85E38] hover:underline font-semibold">+62 851-7973-7368</a></p>
              </div>
            </div>
            <div class="flex items-start gap-4">
              <i class="fas fa-envelope text-[#F85E38] text-2xl flex-shrink-0 mt-1"></i>
              <div>
                <h3 class="font-semibold text-gray-900 mb-1">Email</h3>
                <p class="text-gray-600 text-sm"><a href="mailto:info@perpustakaan.jakarta.go.id" class="text-[#F85E38] hover:underline font-semibold break-all">email@perpustakaan.jakarta.go.id</a></p>
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

<!-- Gallery Modal (Sama seperti profile-ruangan) -->
<style>
  .gallery-modal-overlay {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, 0.95);
    z-index: 1000;
    backdrop-filter: blur(4px);
    padding: 2rem 1rem;
    overflow-y: auto;
  }

  .gallery-modal-overlay.active {
    display: flex;
    align-items: flex-start;
    justify-content: center;
    animation: fadeIn 0.3s ease;
    padding-top: 2rem;
    padding-bottom: 2rem;
  }
  .gallery-modal-wrapper {
    background: white;
    border-radius: 16px;
    max-width: 900px;
    width: 100%;
    overflow: hidden;
    animation: slideUp 0.3s ease;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    margin: auto;
  }
  .gallery-modal-wrapper {
    background: white;
    border-radius: 16px;
    max-width: 900px;
    width: 100%;
    overflow: hidden;
    animation: slideUp 0.3s ease;
    box-shadow: 0 25px 50px rgba(0, 0, 0, 0.3);
    margin: auto;
  }

  .gallery-modal-header {
    position: relative;
    background: linear-gradient(135deg, #063A76 0%, #063A76 100%);
    padding: 2rem;
    color: white;
  }

  .gallery-modal-close {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.2);
    border: 2px solid rgba(255, 255, 255, 0.4);
    color: white;
    width: 40px;
    height: 40px;
    border-radius: 50%;
    font-size: 24px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    backdrop-filter: blur(10px);
  }

  .gallery-modal-close:hover {
    background: rgba(255, 255, 255, 0.3);
    transform: scale(1.1);
  }

  .gallery-modal-title {
    font-size: 1.75rem;
    font-weight: 700;
    margin: 0;
    color: white;
  }

  .gallery-image-carousel {
    position: relative;
    background: #1f2937;
    height: 400px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
  }

  .gallery-image-wrapper {
    position: relative;
    width: 100%;
    height: 100%;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .gallery-image-img {
    max-width: 90%;
    max-height: 100%;
    object-fit: contain;
    animation: imageZoom 0.4s ease;
  }

  @keyframes imageZoom {
    from {
      opacity: 0;
      transform: scale(0.95);
    }
    to {
      opacity: 1;
      transform: scale(1);
    }
  }

  .gallery-image-nav {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background: rgba(0, 0, 0, 0.5);
    color: white;
    border: none;
    width: 45px;
    height: 45px;
    border-radius: 50%;
    font-size: 20px;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: all 0.2s;
    z-index: 10;
  }

  .gallery-image-nav:hover {
    background: rgba(0, 0, 0, 0.7);
    transform: translateY(-50%) scale(1.1);
  }

  .gallery-image-nav.prev {
    left: 15px;
  }

  .gallery-image-nav.next {
    right: 15px;
  }

  .gallery-image-counter {
    position: absolute;
    bottom: 15px;
    right: 15px;
    background: rgba(0, 0, 0, 0.7);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.9rem;
    font-weight: 600;
    z-index: 10;
  }

  .gallery-image-dots {
    position: absolute;
    bottom: 15px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 10;
  }

  .gallery-image-dot {
    width: 10px;
    height: 10px;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.4);
    border: 2px solid rgba(255, 255, 255, 0.6);
    cursor: pointer;
    transition: all 0.2s;
  }

  .gallery-image-dot.active {
    background: white;
    transform: scale(1.3);
  }

  .gallery-image-dot:hover {
    background: rgba(255, 255, 255, 0.7);
  }

  .gallery-modal-content {
    padding: 2rem;
  }

  .gallery-description-title {
    font-size: 1.3rem;
    font-weight: 700;
    color: #063A76;
    margin-bottom: 1rem;
    display: flex;
    align-items: center;
    gap: 0.75rem;
  }

  .gallery-description-title i {
    font-size: 1.25rem;
  }

  .gallery-description-text {
    background: linear-gradient(135deg, #f0f7ff 0%, #e0f0ff 100%);
    border-left: 4px solid #063A76;
    padding: 1.5rem;
    border-radius: 8px;
    color: #374151;
    line-height: 1.7;
    font-size: 1rem;
    font-weight: 500;
  }

  .gallery-description-empty {
    display: none;
    background: linear-gradient(135deg, #f3f4f6 0%, #e5e7eb 100%);
    border-left: 4px solid #9ca3af;
    padding: 1.5rem;
    border-radius: 8px;
    color: #6b7280;
    font-style: italic;
    text-align: center;
  }

  @keyframes fadeIn {
    from {
      opacity: 0;
    }
    to {
      opacity: 1;
    }
  }

  @keyframes slideUp {
    from {
      transform: translateY(30px);
      opacity: 0;
    }
    to {
      transform: translateY(0);
      opacity: 1;
    }
  }

  @media (max-width: 768px) {
    .gallery-modal-wrapper {
      border-radius: 12px;
      max-width: 100%;
    }

    .gallery-image-carousel {
      height: 300px;
    }

    .gallery-modal-content {
      padding: 1.5rem;
    }

    .gallery-modal-header {
      padding: 1.5rem;
    }

    .gallery-modal-title {
      font-size: 1.4rem;
    }

    .gallery-image-nav {
      width: 40px;
      height: 40px;
      font-size: 18px;
    }

    .gallery-image-nav.prev {
      left: 10px;
    }

    .gallery-image-nav.next {
      right: 10px;
    }
  }
</style>

<div class="gallery-modal-overlay" id="galleryModal" onclick="closeGalleryModal(event)">
  <div class="gallery-modal-wrapper" onclick="event.stopPropagation()">
    <div class="gallery-modal-header">
      <button type="button" class="gallery-modal-close" onclick="closeGalleryModal(); return false;">
        <i class="fas fa-times"></i>
      </button>
      <h2 class="gallery-modal-title" id="modalTitle"></h2>
    </div>
    
    <div class="gallery-image-carousel">
      <div class="gallery-image-wrapper">
        <img id="modalImage" class="gallery-image-img" src="" alt="Gallery image">
      </div>
      <button type="button" class="gallery-image-nav prev" id="prevBtn" onclick="prevGalleryImage(); return false;" style="display:none;">
        <i class="fas fa-chevron-left"></i>
      </button>
      <button type="button" class="gallery-image-nav next" id="nextBtn" onclick="nextGalleryImage(); return false;" style="display:none;">
        <i class="fas fa-chevron-right"></i>
      </button>
      <div class="gallery-image-dots" id="modalDots"></div>
      <div class="gallery-image-counter" id="modalCounter" style="display:none;"></div>
    </div>

    <div class="gallery-modal-content">
      <h3 class="gallery-description-title">
        <i class="fas fa-align-left"></i> Deskripsi
      </h3>
      <div class="gallery-description-text" id="modalDescription"></div>
      <div class="gallery-description-empty" id="modalEmptyDesc">Tidak ada deskripsi untuk foto ini</div>
    </div>
  </div>
</div>

<script>
  // Gallery data
  const galleryPhotos = {!! json_encode($aboutPhotos->map(function($photo) {
    return [
      'title' => $photo->title,
      'description' => $photo->description,
      'image' => asset($photo->image_path)
    ];
  })->toArray()) !!};

  let currentGalleryIndex = 0;
  let carouselPhotoIndex = 0;

  // Carousel navigation buttons
  function nextCarouselPhoto(e) {
    if(e) {
      e.stopPropagation();
      e.preventDefault();
    }
    if(galleryPhotos.length === 0) return false;
    carouselPhotoIndex = (carouselPhotoIndex + 1) % galleryPhotos.length;
    updateCarouselPhoto();
    return false;
  }

  function prevCarouselPhoto(e) {
    if(e) {
      e.stopPropagation();
      e.preventDefault();
    }
    if(galleryPhotos.length === 0) return false;
    carouselPhotoIndex = (carouselPhotoIndex - 1 + galleryPhotos.length) % galleryPhotos.length;
    updateCarouselPhoto();
    return false;
  }

  function updateCarouselPhoto() {
    if(galleryPhotos.length === 0) return;
    
    const item = galleryPhotos[carouselPhotoIndex];
    if(!item) return;
    
    // Update image with fade effect
    const carouselImage = document.getElementById('carouselImage');
    if(carouselImage) {
      carouselImage.style.transition = 'opacity 300ms ease-in-out';
      carouselImage.style.opacity = '0';
      
      setTimeout(() => {
        if(carouselImage) {
          carouselImage.src = item.image;
          carouselImage.alt = item.title;
          carouselImage.style.opacity = '1';
        }
      }, 150);
    }
    
    // Update title
    const titleEl = document.getElementById('carouselTitle');
    if(titleEl) {
      titleEl.textContent = item.title;
    }
    
    // Update counter
    const currentNumEl = document.getElementById('currentPhotoNum');
    if(currentNumEl) {
      currentNumEl.textContent = carouselPhotoIndex + 1;
    }
  }

  // Gallery modal functions
  function openGalleryFromCarousel() {
    if(!galleryPhotos || galleryPhotos.length === 0) return;
    
    currentGalleryIndex = carouselPhotoIndex;
    const modal = document.getElementById('galleryModal');
    
    if(modal) {
      updateGalleryModal();
      modal.classList.add('active');
      document.body.style.overflow = 'hidden';
    }
  }

  function closeGalleryModal(event) {
    // Only close if clicking on overlay background, not content
    if(event && event.target && event.target.id !== 'galleryModal') {
      return false;
    }
    
    const modal = document.getElementById('galleryModal');
    if(modal) {
      modal.classList.remove('active');
      document.body.style.overflow = 'auto';
    }
    return false;
  }

  function updateGalleryModal() {
    if(!galleryPhotos || galleryPhotos.length === 0) return;
    
    const item = galleryPhotos[currentGalleryIndex];
    if(!item) return;
    
    // Update image
    const modalImage = document.getElementById('modalImage');
    if(modalImage) {
      modalImage.src = item.image;
      modalImage.alt = item.title;
    }
    
    // Update title
    const modalTitle = document.getElementById('modalTitle');
    if(modalTitle) {
      modalTitle.textContent = item.title;
    }
    
    // Update description
    const descText = document.getElementById('modalDescription');
    const emptyDesc = document.getElementById('modalEmptyDesc');
    
    if(descText && emptyDesc) {
      if(item.description && item.description.trim()) {
        descText.textContent = item.description;
        descText.style.display = 'block';
        emptyDesc.style.display = 'none';
      } else {
        descText.style.display = 'none';
        emptyDesc.style.display = 'block';
      }
    }

    // Update counter
    const modalCounter = document.getElementById('modalCounter');
    if(modalCounter) {
      modalCounter.textContent = `${currentGalleryIndex + 1} / ${galleryPhotos.length}`;
    }

    // Show/hide navigation
    const showNav = galleryPhotos.length > 1;
    const prevBtn = document.getElementById('prevBtn');
    const nextBtn = document.getElementById('nextBtn');
    const counterEl = document.getElementById('modalCounter');
    
    if(prevBtn) prevBtn.style.display = showNav ? 'flex' : 'none';
    if(nextBtn) nextBtn.style.display = showNav ? 'flex' : 'none';
    if(counterEl) counterEl.style.display = showNav ? 'block' : 'none';

    // Update dots
    updateDots();
  }

  function updateDots() {
    if(!galleryPhotos || galleryPhotos.length === 0) return;
    
    const dotsContainer = document.getElementById('modalDots');
    if(!dotsContainer) return;
    
    const dotsHtml = galleryPhotos.map((_, idx) => `
      <div class="gallery-image-dot ${idx === currentGalleryIndex ? 'active' : ''}" onclick="selectPhoto(${idx}); return false;"></div>
    `).join('');
    
    dotsContainer.innerHTML = dotsHtml;
  }

  function nextGalleryImage() {
    if(!galleryPhotos || galleryPhotos.length === 0) return false;
    currentGalleryIndex = (currentGalleryIndex + 1) % galleryPhotos.length;
    updateGalleryModal();
    return false;
  }

  function prevGalleryImage() {
    if(!galleryPhotos || galleryPhotos.length === 0) return false;
    currentGalleryIndex = (currentGalleryIndex - 1 + galleryPhotos.length) % galleryPhotos.length;
    updateGalleryModal();
    return false;
  }

  function selectPhoto(index) {
    if(!galleryPhotos || index < 0 || index >= galleryPhotos.length) return false;
    currentGalleryIndex = index;
    updateGalleryModal();
    return false;
  }

  // Keyboard navigation
  document.addEventListener('keydown', (e) => {
    const modal = document.getElementById('galleryModal');
    if(!modal || !modal.classList.contains('active')) return;
    
    if(e.key === 'ArrowRight') {
      e.preventDefault();
      nextGalleryImage();
    }
    if(e.key === 'ArrowLeft') {
      e.preventDefault();
      prevGalleryImage();
    }
    if(e.key === 'Escape') {
      e.preventDefault();
      closeGalleryModal();
    }
  });

  // Initialize on document ready
  if(document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function() {
      // Gallery is ready
      if(galleryPhotos.length > 0) {
        updateCarouselPhoto();
      }
    });
  } else {
    // Document already loaded
    if(galleryPhotos.length > 0) {
      updateCarouselPhoto();
    }
  }
</script>

@endsection
