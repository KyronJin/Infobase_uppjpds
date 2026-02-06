@extends('layouts.app')

@section('content')

<section class="py-20 bg-white">
  <div class="container mx-auto px-6 max-w-6xl">
    <div class="text-center mb-12">
      <span class="inline-block px-4 py-2 bg-[#00425A] bg-opacity-10 text-[#00425A] text-sm font-semibold rounded-full border border-[#00425A] border-opacity-20">
        Tentang Kami
      </span>
      <h1 class="text-4xl lg:text-5xl font-bold text-gray-900 mt-4 mb-4">Perpustakaan Jakarta — UPPJPDS</h1>
      <p class="text-lg text-gray-800 max-w-2xl mx-auto">Pusat pembelajaran, dokumentasi, dan layanan informasi untuk warga Jakarta.</p>
    </div>

    <div class="grid lg:grid-cols-2 gap-12 items-start mb-16">
      <div>
        <h2 class="text-3xl font-bold mb-6 text-[#00425A]">Tentang Kami</h2>
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

      <div>
        <div class="sticky top-24">
          <!-- Gallery Grid dalam Tentang Kami -->
          <h3 class="text-2xl font-bold mb-4 text-[#00425A]">Galeri Perpustakaan</h3>
          <div class="grid grid-cols-2 gap-3 mb-8">
            @forelse($aboutPhotos as $photo)
              <div class="group relative overflow-hidden rounded-lg shadow-md hover:shadow-xl transition-all duration-300 h-32 cursor-pointer"
                onclick="openGalleryModal('{{ asset($photo->image_path) }}', '{{ $photo->title }}', '{{ $photo->description }}')">
                <!-- Image -->
                <img 
                  src="{{ asset($photo->image_path) }}" 
                  alt="{{ $photo->title }}" 
                  class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                >
                <!-- Overlay -->
                <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-3">
                  <div>
                    <p class="text-white text-sm font-semibold line-clamp-1">{{ $photo->title }}</p>
                    <p class="text-gray-300 text-xs line-clamp-1">{{ $photo->description }}</p>
                  </div>
                </div>
              </div>
            @empty
              <div class="col-span-2 text-center py-8 text-gray-500">
                <i class="fas fa-image text-3xl mb-2 block opacity-50"></i>
                <p>Belum ada foto galeri</p>
              </div>
            @endforelse
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
            <div class="bg-gradient-to-br from-[#f85e38] to-[#d94e2e] text-white p-6 rounded-xl">
              <i class="fas fa-shield-alt text-3xl text-white mb-3 block"></i>
              <h4 class="font-bold text-white">Kepercayaan Publik</h4>
              <p class="text-sm text-white text-opacity-90">Menjadi lembaga yang dapat diandalkan masyarakat.</p>
            </div>
          </div>

          <div class="mt-8 bg-blue-50 border-l-4 border-[#00425A] p-6 rounded">
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

          <a href="{{ route('contact') }}" class="mt-8 block text-center px-6 py-3 bg-[#00425A] text-white font-semibold rounded-lg hover:bg-[#003144] transition duration-300">
            <i class="fas fa-envelope mr-2"></i>Hubungi Kami
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

@endsection

<!-- Gallery Modal -->
<div id="galleryModal" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4" onclick="closeGalleryModal(event)">
  <div class="relative max-w-4xl w-full bg-black rounded-lg overflow-hidden" onclick="event.stopPropagation()">
    <!-- Close Button -->
    <button 
      onclick="closeGalleryModal()" 
      class="absolute top-4 right-4 z-10 w-12 h-12 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center transition-all duration-300"
    >
      <i class="fas fa-times text-white text-xl"></i>
    </button>

    <!-- Modal Content -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-0">
      <!-- Large Image -->
      <div class="md:col-span-3">
        <img id="modalImage" src="" alt="" class="w-full h-auto object-cover">
      </div>

      <!-- Info Section -->
      <div class="bg-gray-900 p-6 flex flex-col justify-between md:col-span-1">
        <div>
          <h3 id="modalTitle" class="text-2xl font-bold text-white mb-4"></h3>
          <p id="modalDescription" class="text-gray-300 text-sm leading-relaxed"></p>
        </div>
        <div class="flex gap-3 pt-4 border-t border-gray-700">
          <button 
            onclick="prevGalleryImage()" 
            class="flex-1 px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded transition-all duration-300"
          >
            <i class="fas fa-chevron-left"></i>
          </button>
          <button 
            onclick="nextGalleryImage()" 
            class="flex-1 px-4 py-2 bg-[#f85e38] hover:bg-[#d94e2e] text-white rounded transition-all duration-300"
          >
            <i class="fas fa-chevron-right"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
let currentGalleryIndex = 0;
const galleryItems = [
  @forelse($aboutPhotos as $photo)
  {
    'title': '{{ $photo->title }}',
    'description': '{{ $photo->description }}',
    'image': '{{ asset($photo->image_path) }}',
  },
  @empty
  @endforelse
];

function openGalleryModal(image, title, description) {
  // Store clicked item index
  const index = galleryItems.findIndex(item => item.image === image);
  if (index !== -1) {
    currentGalleryIndex = index;
  }
  
  // Set modal data
  document.getElementById('modalImage').src = image;
  document.getElementById('modalTitle').textContent = title;
  document.getElementById('modalDescription').textContent = description;
  
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
    document.getElementById('modalImage').src = item.image;
    document.getElementById('modalTitle').textContent = item.title;
    document.getElementById('modalDescription').textContent = item.description;
  }
}

function nextGalleryImage() {
  if (galleryItems.length === 0) return;
  currentGalleryIndex = (currentGalleryIndex + 1) % galleryItems.length;
  updateGalleryModal();
}

function prevGalleryImage() {
  if (galleryItems.length === 0) return;
  currentGalleryIndex = (currentGalleryIndex - 1 + galleryItems.length) % galleryItems.length;
  updateGalleryModal();
}

// Keyboard navigation
document.addEventListener('keydown', (e) => {
  if (document.getElementById('galleryModal').classList.contains('hidden')) return;
  
  if (e.key === 'ArrowRight') nextGalleryImage();
  if (e.key === 'ArrowLeft') prevGalleryImage();
  if (e.key === 'Escape') closeGalleryModal();
});
</script>
