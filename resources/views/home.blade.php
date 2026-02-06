@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center bg-gradient-to-br from-gray-50 to-white pt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full py-12">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Left: Text Content -->
                <div class="space-y-6">
                    <div class="inline-block">
                        <span class="inline-flex items-center px-5 py-2.5 bg-blue-50 text-blue-700 text-sm font-semibold rounded-full border border-blue-200">
                            <i class="fas fa-sparkles mr-2"></i>Selamat Datang
                        </span>
                    </div>

                    <h1 class="text-4xl lg:text-5xl xl:text-6xl font-bold leading-tight text-gray-900">
                        {{ $content['hero_title'] ?? 'INFOBASE' }}
                        <span class="block bg-gradient-to-r from-blue-600 to-purple-600 bg-clip-text text-transparent">UPPJPDS</span>
                    </h1>

                    <p class="text-lg text-gray-600 leading-relaxed max-w-xl">
                        {{ $content['hero_subtitle'] ?? 'Portal informasi terpadu untuk perpustakaan Jakarta. Akses pengumuman, jadwal aktivitas, dan informasi fasilitas dengan mudah.' }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="#announcements" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                            <i class="fas fa-arrow-down mr-2"></i>
                            Pelajari Lebih Lanjut
                        </a>
                        <a href="#contact" class="inline-flex items-center justify-center px-8 py-3.5 border-2 border-gray-300 text-gray-700 font-semibold rounded-lg hover:border-blue-600 hover:text-blue-600 transition-all duration-300">
                            <i class="fas fa-envelope mr-2"></i>
                            Hubungi Kami
                        </a>
                    </div>

                    <div class="flex items-center gap-2 pt-4 text-sm text-gray-500">
                        <i class="fas fa-globe text-blue-600"></i>
                        <span>dispusip.jakarta.go.id/cikini</span>
                    </div>
                </div>

                <!-- Right: Illustration Area -->
                <div class="relative">
                    @if(!empty($content['hero_image']))
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <img src="{{ $content['hero_image'] }}" alt="Hero" class="w-full h-auto object-cover aspect-[4/5] hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/20 to-transparent"></div>
                        </div>
                    @else
                        <div class="relative rounded-2xl bg-gradient-to-br from-blue-100 to-purple-100 aspect-[4/5] flex items-center justify-center shadow-2xl">
                            <div class="text-center space-y-4">
                                <div class="w-20 h-20 mx-auto bg-white/50 backdrop-blur rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-image text-blue-600 text-3xl"></i>
                                </div>
                                <p class="text-blue-700 font-medium">Hero Image</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Announcements Section -->
    <section id="announcements" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-flex items-center px-6 py-2.5 bg-orange-50 text-orange-600 text-sm font-bold rounded-full border border-orange-200 mb-4">
                    <i class="fas fa-bullhorn mr-2"></i>{{ __('home.latest_updates') }}
                </span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">{{ __('home.latest_announcements') }}</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">{{ __('home.important_latest_info') }}</p>
            </div>

            @if(isset($latestAnnouncements) && $latestAnnouncements->count())
                <!-- Announcements Grid -->
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
                    @foreach($latestAnnouncements as $item)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition-all duration-300 overflow-hidden border border-gray-100 group">
                            <!-- Image -->
                            @if($item->image_path)
                                <div class="relative h-48 overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                    <div class="absolute inset-0 bg-gradient-to-t from-gray-900/30 to-transparent"></div>
                                </div>
                            @else
                                <div class="relative h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                    <i class="fas fa-newspaper text-gray-400 text-4xl"></i>
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Date Badge -->
                                <span class="inline-block px-3 py-1 bg-blue-50 text-blue-600 text-xs font-semibold rounded-full mb-3">
                                    <i class="fas fa-calendar-alt mr-1"></i>
                                    {{ $item->published_at?->format('d M Y') ?? 'N/A' }}
                                </span>

                                <!-- Title -->
                                <h3 class="text-lg font-bold text-gray-900 mb-2 line-clamp-2 group-hover:text-blue-600 transition-colors duration-300">
                                    {{ $item->title }}
                                </h3>

                                <!-- Description -->
                                <p class="text-gray-600 text-sm mb-4 line-clamp-3 leading-relaxed">
                                    {{ strip_tags($item->description) }}
                                </p>

                                <!-- Link -->
                                <a href="{{ route('infobase.pengumuman') }}" class="inline-flex items-center text-blue-600 font-semibold text-sm hover:text-blue-700 transition-colors duration-300">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform duration-300"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- View All Button -->
                <div class="text-center">
                    <a href="{{ route('infobase.pengumuman') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-list mr-2"></i>
                        Lihat Semua Pengumuman
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">Belum ada pengumuman tersedia</p>
                </div>
            @endif
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 bg-gradient-to-br from-gray-50 to-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <!-- Image -->
                <div class="relative order-2 lg:order-1">
                    @if(!empty($content['about_image']))
                        <div class="relative rounded-2xl overflow-hidden shadow-2xl">
                            <img src="{{ $content['about_image'] }}" alt="Perpustakaan Jakarta" class="w-full h-auto object-cover aspect-[4/3] hover:scale-105 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-blue-900/20 to-transparent"></div>
                        </div>
                    @else
                        <div class="relative rounded-2xl bg-gradient-to-br from-blue-100 to-purple-100 aspect-[4/3] flex items-center justify-center shadow-2xl">
                            <div class="text-center space-y-4">
                                <div class="w-24 h-24 mx-auto bg-white/50 backdrop-blur rounded-2xl flex items-center justify-center">
                                    <i class="fas fa-university text-blue-600 text-4xl"></i>
                                </div>
                                <p class="text-blue-700 font-semibold text-lg">Perpustakaan Modern</p>
                            </div>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="space-y-6 order-1 lg:order-2">
                    <span class="inline-flex items-center px-6 py-2.5 bg-blue-50 text-blue-600 text-sm font-bold rounded-full border border-blue-200">
                        <i class="fas fa-info-circle mr-2"></i>Tentang Kami
                    </span>
                    
                    <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 leading-tight">Tentang Perpustakaan Jakarta</h2>
                    
                    <p class="text-lg text-gray-600 leading-relaxed">
                        Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen menyediakan sumber daya pembelajaran, ruang kolaborasi, dan program pemberdayaan masyarakat. Kami percaya bahwa akses informasi yang mudah adalah kunci kemajuan sosial dan intelektual.
                    </p>

                    <!-- Vision & Mission -->
                    <div class="space-y-4 pt-4">
                        <div class="flex gap-4 p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-blue-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-eye text-blue-600 text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Visi</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Menjadi pusat pengetahuan yang inklusif, inovatif, dan relevan untuk mendukung literasi dan kreativitas seluruh warga Jakarta.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4 p-4 bg-white rounded-xl shadow-sm border border-gray-100">
                            <div class="flex-shrink-0">
                                <div class="w-12 h-12 bg-purple-100 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-bullseye text-purple-600 text-xl"></i>
                                </div>
                            </div>
                            <div>
                                <h3 class="text-lg font-bold text-gray-900 mb-1">Misi</h3>
                                <p class="text-gray-600 text-sm leading-relaxed">
                                    Menyediakan akses informasi berkualitas, mendorong budaya baca dan inovasi, serta menciptakan ekosistem pembelajaran yang memberdayakan masyarakat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-semibold rounded-lg hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg">
                        Ketahui Lebih Lanjut
                        <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">
                    Galeri Perpustakaan
                </h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Jelajahi fasilitas dan koleksi perpustakaan kami melalui galeri foto
                </p>
            </div>

            <!-- Gallery Grid -->
            @if($homePhotos->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($homePhotos as $photo)
                        <div class="group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 h-64 cursor-pointer"
                            onclick="openHomeGalleryModal('{{ asset($photo->image_path) }}', '{{ $photo->title }}', '{{ $photo->description }}')">
                            <!-- Image -->
                            <img 
                                src="{{ asset($photo->image_path) }}" 
                                alt="{{ $photo->title }}" 
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                            >
                            <!-- Overlay -->
                            <div class="absolute inset-0 bg-gradient-to-t from-black/80 via-black/40 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-6">
                                <div>
                                    <p class="text-white text-lg font-bold line-clamp-2">{{ $photo->title }}</p>
                                    <p class="text-gray-200 text-sm line-clamp-2 mt-1">{{ $photo->description }}</p>
                                </div>
                            </div>
                            <!-- Badge -->
                            <div class="absolute top-4 right-4 opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                <span class="inline-flex items-center px-3 py-1.5 bg-blue-600 text-white text-xs font-semibold rounded-full">
                                    <i class="fas fa-search-plus mr-1"></i>Lihat
                                </span>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- View Gallery Button -->
                <div class="text-center mt-12">
                    <a href="{{ route('about') }}" class="inline-flex items-center justify-center px-8 py-3.5 bg-blue-600 text-white font-bold rounded-lg hover:bg-blue-700 transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl">
                        <i class="fas fa-images mr-2"></i>
                        Lihat Semua Galeri
                    </a>
                </div>
            @else
                <div class="text-center py-12">
                    <i class="fas fa-image text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">Galeri belum tersedia</p>
                </div>
            @endif
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <span class="inline-flex items-center px-6 py-2.5 bg-purple-50 text-purple-600 text-sm font-bold rounded-full border border-purple-200 mb-4">
                    <i class="fas fa-envelope mr-2"></i>Kontak Kami
                </span>
                <h2 class="text-3xl lg:text-4xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Punya pertanyaan, saran, atau ingin berkolaborasi? Jangan ragu untuk menghubungi kami. Tim kami siap membantu.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="space-y-6">
                    <!-- Address -->
                    <div class="flex gap-4 p-6 bg-gradient-to-br from-red-50 to-pink-50 rounded-xl border border-red-100 hover:shadow-lg transition-all duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-gradient-to-br from-red-500 to-pink-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-map-marker-alt text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Alamat</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Perpustakaan Jakarta<br>
                                Jl. Cikini Raya No. 73<br>
                                Jakarta Pusat 10330
                            </p>
                        </div>
                    </div>

                    <!-- Phone -->
                    <div class="flex gap-4 p-6 bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl border border-blue-100 hover:shadow-lg transition-all duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-500 to-cyan-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-phone text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Telepon</h3>
                            <a href="tel:+62214706295" class="text-blue-600 hover:text-blue-700 font-medium transition-colors">
                                (+62 21) 4706-295
                            </a>
                        </div>
                    </div>

                    <!-- Email -->
                    <div class="flex gap-4 p-6 bg-gradient-to-br from-green-50 to-emerald-50 rounded-xl border border-green-100 hover:shadow-lg transition-all duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-gradient-to-br from-green-500 to-emerald-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-envelope text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Email</h3>
                            <a href="mailto:info@perpustakaan.jakarta.go.id" class="text-green-600 hover:text-green-700 font-medium transition-colors break-all">
                                info@perpustakaan.jakarta.go.id
                            </a>
                        </div>
                    </div>

                    <!-- Operating Hours -->
                    <div class="flex gap-4 p-6 bg-gradient-to-br from-purple-50 to-violet-50 rounded-xl border border-purple-100 hover:shadow-lg transition-all duration-300">
                        <div class="flex-shrink-0">
                            <div class="w-14 h-14 bg-gradient-to-br from-purple-500 to-violet-600 rounded-xl flex items-center justify-center shadow-lg">
                                <i class="fas fa-clock text-white text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-lg font-bold text-gray-900 mb-2">Jam Operasional</h3>
                            <p class="text-gray-600 text-sm leading-relaxed">
                                Senin - Jumat: 09:00 - 17:00<br>
                                Sabtu: 09:00 - 15:00<br>
                                Minggu & Libur: Tutup
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="bg-gradient-to-br from-gray-50 to-white p-8 rounded-2xl shadow-lg border border-gray-100">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 text-green-700 rounded-lg border border-green-200 flex items-start gap-3">
                            <i class="fas fa-check-circle text-green-600 text-xl mt-0.5"></i>
                            <span>{{ session('success') }}</span>
                        </div>
                    @endif

                    <div class="mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 mb-2">Kirim Pesan</h3>
                        <p class="text-gray-600">Kami akan segera membalas pesan Anda</p>
                    </div>

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-5">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama Lengkap <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                required 
                                value="{{ old('name') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 transition-all duration-300 @error('name') border-red-500 ring-2 ring-red-200 @enderror"
                                placeholder="Masukkan nama lengkap Anda"
                            >
                            @error('name')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                required 
                                value="{{ old('email') }}"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 transition-all duration-300 @error('email') border-red-500 ring-2 ring-red-200 @enderror"
                                placeholder="email@contoh.com"
                            >
                            @error('email')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Message -->
                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-700 mb-2">
                                Pesan <span class="text-red-500">*</span>
                            </label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="5" 
                                required 
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent bg-white text-gray-900 resize-none transition-all duration-300 @error('message') border-red-500 ring-2 ring-red-200 @enderror"
                                placeholder="Tulis pesan Anda di sini..."
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-600 text-sm mt-2 flex items-center gap-1">
                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                </p>
                            @enderror
                        </div>

                        <!-- Submit Button -->
                        <button 
                            type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3.5 px-6 rounded-lg transform hover:scale-105 transition-all duration-300 shadow-lg hover:shadow-xl flex items-center justify-center gap-2"
                        >
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Modal for Home Gallery -->
    <div id="homeGalleryModal" class="fixed inset-0 z-50 hidden bg-black/80 flex items-center justify-center p-4" onclick="closeHomeGalleryModal(event)">
        <div class="relative max-w-4xl w-full bg-black rounded-lg overflow-hidden" onclick="event.stopPropagation()">
            <!-- Close Button -->
            <button 
                onclick="closeHomeGalleryModal()" 
                class="absolute top-4 right-4 z-10 w-12 h-12 bg-red-600 hover:bg-red-700 rounded-full flex items-center justify-center transition-all duration-300"
            >
                <i class="fas fa-times text-white text-xl"></i>
            </button>

            <!-- Modal Content -->
            <div class="grid grid-cols-1 md:grid-cols-4 gap-0">
                <!-- Large Image -->
                <div class="md:col-span-3">
                    <img id="homeModalImage" src="" alt="" class="w-full h-auto object-cover">
                </div>

                <!-- Info Section -->
                <div class="bg-gray-900 p-6 flex flex-col justify-between md:col-span-1">
                    <div>
                        <h3 id="homeModalTitle" class="text-2xl font-bold text-white mb-4"></h3>
                        <p id="homeModalDescription" class="text-gray-300 text-sm leading-relaxed"></p>
                    </div>
                    <div class="flex gap-3 pt-4 border-t border-gray-700">
                        <button 
                            onclick="prevHomeGalleryImage()" 
                            class="flex-1 px-4 py-2 bg-gray-700 hover:bg-gray-600 text-white rounded transition-all duration-300"
                        >
                            <i class="fas fa-chevron-left"></i>
                        </button>
                        <button 
                            onclick="nextHomeGalleryImage()" 
                            class="flex-1 px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded transition-all duration-300"
                        >
                            <i class="fas fa-chevron-right"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
    let currentHomeGalleryIndex = 0;
    const homeGalleryItems = [
        @forelse($homePhotos as $photo)
        {
            'title': '{{ $photo->title }}',
            'description': '{{ $photo->description }}',
            'image': '{{ asset($photo->image_path) }}',
        },
        @empty
        @endforelse
    ];

    function openHomeGalleryModal(image, title, description) {
        // Store clicked item index
        const index = homeGalleryItems.findIndex(item => item.image === image);
        if (index !== -1) {
            currentHomeGalleryIndex = index;
        }
        
        // Set modal data
        document.getElementById('homeModalImage').src = image;
        document.getElementById('homeModalTitle').textContent = title;
        document.getElementById('homeModalDescription').textContent = description;
        
        document.getElementById('homeGalleryModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeHomeGalleryModal(event) {
        if (event && event.target.id !== 'homeGalleryModal') return;
        
        document.getElementById('homeGalleryModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function updateHomeGalleryModal() {
        if (homeGalleryItems.length === 0) return;
        
        const item = homeGalleryItems[currentHomeGalleryIndex];
        if (item) {
            document.getElementById('homeModalImage').src = item.image;
            document.getElementById('homeModalTitle').textContent = item.title;
            document.getElementById('homeModalDescription').textContent = item.description;
        }
    }

    function nextHomeGalleryImage() {
        if (homeGalleryItems.length === 0) return;
        currentHomeGalleryIndex = (currentHomeGalleryIndex + 1) % homeGalleryItems.length;
        updateHomeGalleryModal();
    }

    function prevHomeGalleryImage() {
        if (homeGalleryItems.length === 0) return;
        currentHomeGalleryIndex = (currentHomeGalleryIndex - 1 + homeGalleryItems.length) % homeGalleryItems.length;
        updateHomeGalleryModal();
    }

    // Keyboard navigation for home gallery
    document.addEventListener('keydown', (e) => {
        if (document.getElementById('homeGalleryModal').classList.contains('hidden')) return;
        
        if (e.key === 'ArrowRight') nextHomeGalleryImage();
        if (e.key === 'ArrowLeft') prevHomeGalleryImage();
        if (e.key === 'Escape') closeHomeGalleryModal();
    });
    </script>
@endsection