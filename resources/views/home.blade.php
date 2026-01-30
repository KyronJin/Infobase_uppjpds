@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center bg-white pt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Text Content -->
                <div class="space-y-8">
                    <div class="inline-block">
                        <span class="inline-block px-4 py-2 bg-blue-50 text-blue-700 text-sm font-semibold rounded-full border border-blue-200">
                            <i class="fas fa-sparkles mr-2"></i>Selamat Datang
                        </span>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold text-gray-900 leading-tight">
                        {{ $content['hero_title'] ?? 'INFOBASE' }}
                        <span class="block text-[#00425A]">UPPJPDS</span>
                    </h1>

                    <p class="text-xl text-gray-600 leading-relaxed max-w-xl">
                        {{ $content['hero_subtitle'] ?? 'Portal informasi terpadu untuk perpustakaan Jakarta. Akses pengumuman, jadwal aktivitas, dan informasi fasilitas dengan mudah.' }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="{{ Route::has('admin.login') ? route('admin.login') : '#' }}" class="inline-flex items-center justify-center px-8 py-4 bg-[#00425A] text-white font-semibold rounded-lg hover:bg-[#003144] transition duration-300 shadow-lg">
                            <i class="fas fa-sign-in-alt mr-2"></i>
                            Masuk Admin
                        </a>
                        <a href="#features" class="inline-flex items-center justify-center px-8 py-4 border-2 border-[#00425A] text-[#00425A] font-semibold rounded-lg hover:bg-[#00425A] hover:text-white transition duration-300">
                            <i class="fas fa-arrow-down mr-2"></i>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>

                    <p class="text-sm text-gray-500 pt-6">
                        <i class="fas fa-globe mr-2 text-[#f85e38]"></i>
                        dispusip.jakarta.go.id/cikini
                    </p>
                </div>

                <!-- Right: Illustration Area -->
                <div class="relative hidden lg:block">
                    @if(!empty($content['hero_image']))
                        <img src="{{ $content['hero_image'] }}" alt="Hero" class="relative z-10 rounded-2xl shadow-2xl w-full object-cover aspect-[3/4]">
                    @else
                        <div class="relative z-10 rounded-2xl bg-[#00425A] aspect-[3/4] flex items-center justify-center">
                            <i class="fas fa-image text-white text-6xl opacity-20"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Fitur Utama</h2>
                <p class="text-lg text-gray-600">Akses semua informasi perpustakaan dalam satu platform terpadu</p>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Feature Card 1 -->
                <div class="group p-8 bg-white border-2 border-gray-200 rounded-xl hover:border-[#00425A] hover:shadow-xl transition duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-[#00425A] text-white rounded-lg mb-6 group-hover:bg-[#f85e38] transition duration-300">
                        <i class="fas fa-bullhorn text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Pengumuman</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Dapatkan informasi terbaru tentang acara, pengumuman penting, dan berita dari perpustakaan.
                    </p>
                    <a href="{{ route('infobase.pengumuman') }}" class="inline-block mt-4 text-[#00425A] font-semibold hover:text-[#f85e38] transition duration-300">
                        Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Feature Card 2 -->
                <div class="group p-8 bg-white border-2 border-gray-200 rounded-xl hover:border-[#00425A] hover:shadow-xl transition duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-[#f85e38] text-white rounded-lg mb-6 group-hover:bg-[#00425A] transition duration-300">
                        <i class="fas fa-calendar-alt text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Calendar Aktivitas</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Jadwal lengkap event, workshop, dan kegiatan yang dapat Anda ikuti setiap bulannya.
                    </p>
                    <a href="{{ route('infobase.calendar-aktifitas') }}" class="inline-block mt-4 text-[#00425A] font-semibold hover:text-[#f85e38] transition duration-300">
                        Lihat Jadwal <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Feature Card 3 -->
                <div class="group p-8 bg-white border-2 border-gray-200 rounded-xl hover:border-[#00425A] hover:shadow-xl transition duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-[#00425A] text-white rounded-lg mb-6 group-hover:bg-[#f85e38] transition duration-300">
                        <i class="fas fa-book-open text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Tata Tertib</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Panduan lengkap aturan dan pedoman penggunaan fasilitas perpustakaan untuk kenyamanan bersama.
                    </p>
                    <a href="{{ route('infobase.tata-tertib') }}" class="inline-block mt-4 text-[#00425A] font-semibold hover:text-[#f85e38] transition duration-300">
                        Pelajari Aturan <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Feature Card 4 -->
                <div class="group p-8 bg-white border-2 border-gray-200 rounded-xl hover:border-[#00425A] hover:shadow-xl transition duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-[#f85e38] text-white rounded-lg mb-6 group-hover:bg-[#00425A] transition duration-300">
                        <i class="fas fa-star text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Staff of Month</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Apresiasi untuk staff berprestasi dan kontribusi luar biasa mereka setiap bulannya.
                    </p>
                    <a href="{{ route('infobase.staff-of-month') }}" class="inline-block mt-4 text-[#00425A] font-semibold hover:text-[#f85e38] transition duration-300">
                        Lihat Penghargaan <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Feature Card 5 -->
                <div class="group p-8 bg-white border-2 border-gray-200 rounded-xl hover:border-[#00425A] hover:shadow-xl transition duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-[#00425A] text-white rounded-lg mb-6 group-hover:bg-[#f85e38] transition duration-300">
                        <i class="fas fa-door-open text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Profile Ruangan</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Informasi detail ruang, kapasitas, dan fasilitas lengkap yang tersedia untuk publik.
                    </p>
                    <a href="{{ route('infobase.profile-ruangan') }}" class="inline-block mt-4 text-[#00425A] font-semibold hover:text-[#f85e38] transition duration-300">
                        Jelajahi Ruangan <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>

                <!-- Feature Card 6 -->
                <div class="group p-8 bg-white border-2 border-gray-200 rounded-xl hover:border-[#00425A] hover:shadow-xl transition duration-300">
                    <div class="inline-flex items-center justify-center w-16 h-16 bg-[#f85e38] text-white rounded-lg mb-6 group-hover:bg-[#00425A] transition duration-300">
                        <i class="fas fa-envelope text-2xl"></i>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-3">Hubungi Kami</h3>
                    <p class="text-gray-600 leading-relaxed">
                        Punya pertanyaan atau saran? Tim kami siap membantu dan mendengarkan masukan Anda.
                    </p>
                    <a href="#contact" class="inline-block mt-4 text-[#00425A] font-semibold hover:text-[#f85e38] transition duration-300">
                        Kirim Pesan <i class="fas fa-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 lg:py-28 bg-[#00425A] text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div class="relative hidden lg:block order-2">
                    @if(!empty($content['about_image']))
                        <img src="{{ $content['about_image'] }}" alt="Perpustakaan Jakarta" class="relative z-10 rounded-2xl shadow-2xl w-full object-cover aspect-[4/3]">
                    @else
                        <div class="relative z-10 rounded-2xl bg-white bg-opacity-5 aspect-[4/3] flex items-center justify-center">
                            <i class="fas fa-image text-white text-6xl opacity-30"></i>
                        </div>
                    @endif
                </div>

                <div class="space-y-8 order-1 lg:order-1">
                    <div>
                        <h2 class="text-4xl lg:text-5xl font-bold mb-6">Tentang Perpustakaan Jakarta</h2>
                        <p class="text-lg text-white text-opacity-90 leading-relaxed mb-8">
                            Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen menyediakan sumber daya pembelajaran, ruang kolaborasi, dan program pemberdayaan masyarakat. Kami percaya bahwa akses informasi yang mudah adalah kunci kemajuan sosial dan intelektual.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-[#f85e38] text-2xl mt-1"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Visi</h3>
                                <p class="text-white text-opacity-90">
                                    Menjadi pusat pengetahuan yang inklusif, inovatif, dan relevan untuk mendukung literasi dan kreativitas seluruh warga Jakarta.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-[#f85e38] text-2xl mt-1"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2">Misi</h3>
                                <p class="text-white text-opacity-90">
                                    Menyediakan akses informasi berkualitas, mendorong budaya baca dan inovasi, serta menciptakan ekosistem pembelajaran yang memberdayakan masyarakat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="inline-flex items-center px-6 py-3 bg-[#f85e38] text-white font-semibold rounded-lg hover:bg-white hover:text-[#f85e38] transition duration-300">
                        <i class="fas fa-arrow-right mr-2"></i>
                        Ketahui Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 lg:py-28 bg-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12">
            <div class="text-center mb-16">
                <h2 class="text-4xl lg:text-5xl font-bold text-gray-900 mb-4">Hubungi Kami</h2>
                <p class="text-lg text-gray-600 max-w-2xl mx-auto">
                    Punya pertanyaan, saran, atau ingin berkolaborasi? Jangan ragu untuk menghubungi kami. Tim kami siap membantu.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12">
                <!-- Contact Info -->
                <div class="space-y-8">
                    <div class="flex gap-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-[#00425A] text-white">
                                <i class="fas fa-map-marker-alt text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Alamat</h3>
                            <p class="text-gray-600 leading-relaxed">
                                Perpustakaan Jakarta<br>
                                Jl. Cikini Raya No. 73<br>
                                Jakarta Pusat 10330
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-[#f85e38] text-white">
                                <i class="fas fa-phone text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Telepon</h3>
                            <p class="text-gray-600">
                                <a href="tel:+62214706295" class="hover:text-[#00425A] transition duration-300">
                                    (+62 21) 4706-295
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-[#00425A] text-white">
                                <i class="fas fa-envelope text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Email</h3>
                            <p class="text-gray-600">
                                <a href="mailto:info@perpustakaan.jakarta.go.id" class="hover:text-[#00425A] transition duration-300">
                                    info@perpustakaan.jakarta.go.id
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-14 w-14 rounded-lg bg-[#f85e38] text-white">
                                <i class="fas fa-clock text-xl"></i>
                            </div>
                        </div>
                        <div>
                            <h3 class="text-xl font-bold text-gray-900 mb-2">Jam Operasional</h3>
                            <p class="text-gray-600">
                                Senin - Jumat: 09:00 - 17:00<br>
                                Sabtu: 09:00 - 15:00<br>
                                Minggu & Libur: Tutup
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
                <div class="p-10 bg-white border-2 border-gray-200 rounded-2xl">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border-l-4 border-green-500 text-green-800 rounded">
                            <i class="fas fa-check-circle mr-2"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-900 mb-3">
                                <i class="fas fa-user mr-2 text-[#00425A]"></i>
                                Nama Lengkap
                            </label>
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#00425A] transition duration-300 @error('name') border-red-500 @enderror"
                                placeholder="Nama Anda"
                                value="{{ old('name') }}"
                            >
                            @error('name')
                                <p class="text-red-500 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-900 mb-3">
                                <i class="fas fa-envelope mr-2 text-[#00425A]"></i>
                                Email
                            </label>
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#00425A] transition duration-300 @error('email') border-red-500 @enderror"
                                placeholder="email@example.com"
                                value="{{ old('email') }}"
                            >
                            @error('email')
                                <p class="text-red-500 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="message" class="block text-sm font-semibold text-gray-900 mb-3">
                                <i class="fas fa-comment mr-2 text-[#00425A]"></i>
                                Pesan
                            </label>
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="5" 
                                required 
                                class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:border-[#00425A] transition duration-300 resize-none @error('message') border-red-500 @enderror"
                                placeholder="Tulis pesan Anda di sini..."
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-2"><i class="fas fa-exclamation-circle mr-1"></i>{{ $message }}</p>
                            @enderror
                        </div>

                        <button 
                            type="submit" 
                            class="w-full py-4 bg-[#00425A] text-white font-bold rounded-lg hover:bg-[#003144] transition duration-300 flex items-center justify-center gap-2 shadow-lg hover:shadow-xl"
                        >
                            <i class="fas fa-paper-plane"></i>
                            Kirim Pesan
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-16 bg-[#00425A] text-white">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 text-center">
            <h2 class="text-3xl lg:text-4xl font-bold mb-6">Siap untuk Menjelajahi Perpustakaan?</h2>
            <p class="text-lg text-white text-opacity-90 mb-8 max-w-2xl mx-auto">
                Bergabunglah dengan ribuan pengunjung yang telah memanfaatkan layanan perpustakaan digital kami.
            </p>
            <a href="{{ route('infobase.index') }}" class="inline-flex items-center px-8 py-4 bg-[#f85e38] text-white font-bold rounded-lg hover:bg-white hover:text-[#f85e38] transition duration-300 shadow-lg">
                <i class="fas fa-arrow-right mr-2"></i>
                Mulai Sekarang
            </a>
        </div>
    </section>
@endsection