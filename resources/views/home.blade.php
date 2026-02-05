@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section id="home" class="relative min-h-screen flex items-center bg-white pt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 w-full">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <!-- Left: Text Content -->
                <div class="space-y-8 brand-animate-left">
                    <div class="inline-block">
                        <span class="inline-flex items-center px-6 py-3 bg-gray-100 text-gray-700 text-sm font-semibold rounded-full border-2 border-gray-200">
                            <i class="fas fa-sparkles mr-2 text-gray-600"></i>Selamat Datang
                        </span>
                    </div>

                    <h1 class="text-5xl lg:text-6xl font-bold leading-tight text-black">
                        {{ $content['hero_title'] ?? 'INFOBASE' }}
                        <span class="block text-black">UPPJPDS</span>
                    </h1>

                    <p class="text-lg text-gray-700 max-w-xl">
                        {{ $content['hero_subtitle'] ?? 'Portal informasi terpadu untuk perpustakaan Jakarta. Akses pengumuman, jadwal aktivitas, dan informasi fasilitas dengan mudah.' }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-4 pt-4">
                        <a href="#announcements" class="inline-flex items-center justify-center px-6 py-3 border-2 border-black text-black font-semibold rounded-lg hover:bg-black hover:text-white transition duration-300">
                            <i class="fas fa-arrow-down mr-2"></i>
                            Pelajari Lebih Lanjut
                        </a>
                    </div>

                    <p class="text-sm text-gray-500 pt-6">
                        <i class="fas fa-globe mr-2 text-gray-600"></i>
                        dispusip.jakarta.go.id/cikini
                    </p>
                </div>

                <!-- Right: Illustration Area -->
                <div class="relative hidden lg:block brand-animate-right">
                    @if(!empty($content['hero_image']))
                        <img src="{{ $content['hero_image'] }}" alt="Hero" class="relative z-10 rounded-3xl shadow-2xl w-full object-cover aspect-[3/4] border-4 border-white">
                    @else
                        <div class="relative z-10 rounded-3xl bg-gray-200 aspect-[3/4] flex items-center justify-center border-4 border-white shadow-2xl">
                            <i class="fas fa-image text-gray-400 text-6xl opacity-30"></i>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Announcements Section (Pengumuman Terbaru) -->
    <section id="announcements" class="py-24 bg-gradient-to-b from-white to-gray-50 relative overflow-hidden">
        <!-- Background decoration -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-orange-400/10 to-red-500/10 rounded-full transform translate-x-48 -translate-y-48"></div>
        
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="text-center mb-20">
                <div class="inline-block mb-6 group">
                    <span class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-orange-50 to-red-50 text-orange-600 text-sm font-bold rounded-2xl border border-orange-200 shadow-lg group-hover:shadow-xl transform group-hover:scale-105 transition-all duration-300">
                        <i class="fas fa-bullhorn mr-3 text-orange-500 group-hover:animate-pulse"></i>{{ __('home.latest_updates') }}
                    </span>
                </div>
                <h2 class="text-5xl lg:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900 mb-8 tracking-tight">{{ __('home.latest_announcements') }}</h2>
                <p class="text-xl leading-relaxed text-gray-600 max-w-4xl mx-auto font-medium">{{ __('home.important_latest_info') }}</p>
            </div>

            @if(isset($latestAnnouncements) && $latestAnnouncements->count())
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($latestAnnouncements as $item)
                        <div class="bg-white rounded-lg shadow-md group border-2 border-gray-100 hover:shadow-lg transition-all duration-300">
                            <!-- Image -->
                            @if($item->image_path)
                                <div class="relative h-48 overflow-hidden bg-gray-100">
                                    <img src="{{ asset('storage/' . $item->image_path) }}" alt="{{ $item->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                </div>
                            @else
                                <div class="relative h-48 bg-gray-200 flex items-center justify-center transition-all duration-500">
                                    <i class="fas fa-newspaper text-gray-400 text-4xl opacity-40"></i>
                                </div>
                            @endif

                            <!-- Content -->
                            <div class="p-6">
                                <!-- Date -->
                                <div class="mb-3">
                                    <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs font-semibold rounded-full border border-gray-200">
                                        {{ $item->published_at?->format('d M Y') ?? 'N/A' }}
                                    </span>
                                </div>

                                <!-- Title -->
                                <h3 class="text-xl font-semibold mb-2 text-black line-clamp-2 group-hover:text-blue-600 transition duration-300">
                                    {{ $item->title }}
                                </h3>

                                <!-- Description -->
                                <p class="text-gray-600 mb-4 line-clamp-3">
                                    {{ strip_tags($item->description) }}
                                </p>

                                <!-- Link -->
                                <a href="{{ route('infobase.pengumuman') }}" class="inline-flex items-center text-black font-semibold text-sm hover:text-blue-600 transition duration-300">
                                    Baca Selengkapnya
                                    <i class="fas fa-arrow-right ml-2"></i>
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- View All Link -->
                <div class="text-center mt-12">
                    <a href="{{ route('infobase.pengumuman') }}" class="inline-flex items-center justify-center px-8 py-4 bg-black text-white font-bold rounded-lg hover:bg-gray-800 transition duration-300">
                        <i class="fas fa-list mr-2"></i>
                        Lihat Semua Pengumuman
                    </a>
                </div>
            @endif
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-24 lg:py-32 bg-gradient-to-br from-gray-50 via-white to-gray-50 text-black relative overflow-hidden">
        <!-- Background decorations -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-gradient-to-br from-blue-400/10 to-purple-500/10 rounded-full transform -translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 right-0 w-80 h-80 bg-gradient-to-tl from-green-400/10 to-blue-500/10 rounded-full transform translate-x-32 translate-y-32"></div>
        
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="grid lg:grid-cols-2 gap-16 items-center">
                <div class="relative hidden lg:block order-2 group">
                    @if(!empty($content['about_image']))
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-purple-500 rounded-3xl transform rotate-3 opacity-20 scale-105 group-hover:rotate-6 group-hover:scale-110 transition-all duration-700"></div>
                            <img src="{{ $content['about_image'] }}" alt="Perpustakaan Jakarta" class="relative z-10 rounded-3xl shadow-2xl w-full object-cover aspect-[4/3] border-4 border-white hover:scale-105 transition-transform duration-700">
                        </div>
                    @else
                        <div class="relative">
                            <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-purple-500 rounded-3xl transform rotate-3 opacity-20 scale-105 group-hover:rotate-6 group-hover:scale-110 transition-all duration-700"></div>
                            <div class="relative z-10 rounded-3xl bg-gradient-to-br from-blue-50 to-purple-50 aspect-[4/3] flex items-center justify-center border-4 border-white shadow-2xl hover:shadow-3xl transition-all duration-500">
                                <div class="text-center space-y-4 group-hover:scale-110 transition-transform duration-300">
                                    <div class="w-24 h-24 mx-auto bg-gradient-to-br from-blue-500 to-purple-600 rounded-3xl flex items-center justify-center shadow-xl">
                                        <i class="fas fa-university text-white text-3xl"></i>
                                    </div>
                                    <p class="text-gray-600 font-semibold text-lg">Perpustakaan Modern</p>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>

                <div class="space-y-10 order-1 lg:order-1">
                    <div class="space-y-6">
                        <div class="inline-block group">
                            <span class="inline-flex items-center px-6 py-3 bg-gradient-to-r from-blue-50 to-purple-50 text-blue-600 text-sm font-bold rounded-2xl border border-blue-200 shadow-lg group-hover:shadow-xl transform group-hover:scale-105 transition-all duration-300">
                                <i class="fas fa-info-circle mr-3 text-blue-500 group-hover:animate-pulse"></i>Tentang Kami
                            </span>
                        </div>
                        
                        <h2 class="text-5xl lg:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900 mb-8 tracking-tight leading-tight">Tentang Perpustakaan Jakarta</h2>
                        
                        <p class="text-xl leading-relaxed text-gray-600 font-medium">
                            Perpustakaan Jakarta (UPPJPDS) adalah institusi publik yang berkomitmen menyediakan sumber daya pembelajaran, ruang kolaborasi, dan program pemberdayaan masyarakat. Kami percaya bahwa akses informasi yang mudah adalah kunci kemajuan sosial dan intelektual.
                        </p>
                    </div>

                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-black text-2xl mt-1"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 text-black">Visi</h3>
                                <p class="text-gray-700">
                                    Menjadi pusat pengetahuan yang inklusif, inovatif, dan relevan untuk mendukung literasi dan kreativitas seluruh warga Jakarta.
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <div class="flex-shrink-0">
                                <i class="fas fa-check-circle text-black text-2xl mt-1"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold mb-2 text-black">Misi</h3>
                                <p class="text-gray-700">
                                    Menyediakan akses informasi berkualitas, mendorong budaya baca dan inovasi, serta menciptakan ekosistem pembelajaran yang memberdayakan masyarakat.
                                </p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('about') }}" class="inline-flex items-center px-6 py-3 bg-black text-white font-semibold rounded-lg hover:bg-gray-800 transition duration-300">
                        <i class="fas fa-arrow-right mr-2"></i>
                        Ketahui Lebih Lanjut
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-24 lg:py-32 bg-gradient-to-b from-gray-50 to-white relative overflow-hidden">
        <!-- Background decorations -->
        <div class="absolute top-0 right-0 w-96 h-96 bg-gradient-to-bl from-purple-400/10 to-blue-500/10 rounded-full transform translate-x-48 -translate-y-48"></div>
        <div class="absolute bottom-0 left-0 w-80 h-80 bg-gradient-to-tr from-green-400/10 to-purple-500/10 rounded-full transform -translate-x-32 translate-y-32"></div>
        
        <div class="max-w-7xl mx-auto px-6 lg:px-12 relative z-10">
            <div class="text-center mb-20">
                <div class="inline-block mb-6 group">
                    <span class="inline-flex items-center px-8 py-4 bg-gradient-to-r from-purple-50 to-blue-50 text-purple-600 text-sm font-bold rounded-2xl border border-purple-200 shadow-lg group-hover:shadow-xl transform group-hover:scale-105 transition-all duration-300">
                        <i class="fas fa-envelope mr-3 text-purple-500 group-hover:animate-pulse"></i>Kontak Kami
                    </span>
                </div>
                <h2 class="text-5xl lg:text-6xl font-black text-transparent bg-clip-text bg-gradient-to-r from-gray-900 via-gray-700 to-gray-900 mb-8 tracking-tight">Hubungi Kami</h2>
                <p class="text-xl leading-relaxed text-gray-600 max-w-4xl mx-auto font-medium">
                    Punya pertanyaan, saran, atau ingin berkolaborasi? Jangan ragu untuk menghubungi kami. Tim kami siap membantu.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-16">
                <!-- Contact Info -->
                <div class="space-y-8">
                    <div class="group p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl border border-gray-100 hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-16 w-16 rounded-2xl bg-gradient-to-br from-red-500 to-pink-600 text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                    <i class="fas fa-map-marker-alt text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-black mb-3 group-hover:text-red-600 transition-colors duration-300">Alamat</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Perpustakaan Jakarta<br>
                                    Jl. Cikini Raya No. 73<br>
                                    Jakarta Pusat 10330
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl border border-gray-100 hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-16 w-16 rounded-2xl bg-gradient-to-br from-blue-500 to-cyan-600 text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                    <i class="fas fa-phone text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-black mb-3 group-hover:text-blue-600 transition-colors duration-300">Telepon</h3>
                                <p class="text-gray-600">
                                    <a href="tel:+62214706295" class="hover:text-blue-600 transition duration-300 font-medium">
                                    (+62 21) 4706-295
                                </a>
                            </p>
                        </div>
                    </div>

                    <div class="flex gap-6">
                        <div class="flex-shrink-0">
                    <div class="group p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl border border-gray-100 hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-16 w-16 rounded-2xl bg-gradient-to-br from-green-500 to-emerald-600 text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                    <i class="fas fa-envelope text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-black mb-3 group-hover:text-green-600 transition-colors duration-300">Email</h3>
                                <p class="text-gray-600">
                                    <a href="mailto:info@perpustakaan.jakarta.go.id" class="hover:text-green-600 transition duration-300 font-medium">
                                        info@perpustakaan.jakarta.go.id
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>

                    <div class="group p-6 bg-white rounded-2xl shadow-lg hover:shadow-xl border border-gray-100 hover:-translate-y-1 transition-all duration-300">
                        <div class="flex items-start gap-6">
                            <div class="flex-shrink-0">
                                <div class="flex items-center justify-center h-16 w-16 rounded-2xl bg-gradient-to-br from-purple-500 to-violet-600 text-white shadow-lg group-hover:scale-110 group-hover:rotate-3 transition-all duration-300">
                                    <i class="fas fa-clock text-xl"></i>
                                </div>
                            </div>
                            <div class="flex-1">
                                <h3 class="text-2xl font-bold text-black mb-3 group-hover:text-purple-600 transition-colors duration-300">Jam Operasional</h3>
                                <p class="text-gray-600 leading-relaxed">
                                    Senin - Jumat: 09:00 - 17:00<br>
                                    Sabtu: 09:00 - 15:00<br>
                                    Minggu & Libur: Tutup
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Contact Form -->
        <section class="py-12 bg-white">
    <div class="max-w-2xl mx-auto px-4">
        <div class="bg-white p-8 rounded-lg shadow-md border border-gray-200">

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 text-green-800 rounded border border-green-300">
                    {{ session('success') }}
                </div>
            @endif

            <h2 class="text-2xl font-bold text-center mb-8 text-gray-800">Kirim Pesan</h2>
            <p class="text-center text-gray-600 mb-8">Kami akan segera membalas pesan Anda</p>

            <form action="{{ route('contact.store') }}" method="POST">
                @csrf

                <table class="w-full border-collapse">
                    <tr>
                        <td class="pb-4 pr-4 w-1/3 align-top">
                            <label for="name" class="block font-medium text-gray-700">Nama Lengkap</label>
                        </td>
                        <td class="pb-4">
                            <input 
                                type="text" 
                                name="name" 
                                id="name" 
                                required 
                                value="{{ old('name') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 bg-white text-gray-900 @error('name') border-red-500 @enderror"
                                placeholder="Nama Anda"
                            >
                            @error('name')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>

                    <tr>
                        <td class="pb-4 pr-4 align-top">
                            <label for="email" class="block font-medium text-gray-700">Email</label>
                        </td>
                        <td class="pb-4">
                            <input 
                                type="email" 
                                name="email" 
                                id="email" 
                                required 
                                value="{{ old('email') }}"
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 bg-white text-gray-900 @error('email') border-red-500 @enderror"
                                placeholder="email@contoh.com"
                            >
                            @error('email')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>

                    <tr>
                        <td class="pb-6 pr-4 align-top">
                            <label for="message" class="block font-medium text-gray-700">Pesan</label>
                        </td>
                        <td class="pb-6">
                            <textarea 
                                name="message" 
                                id="message" 
                                rows="6" 
                                required 
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:border-blue-500 bg-white text-gray-900 resize-y @error('message') border-red-500 @enderror"
                                placeholder="Tulis pesan Anda di sini..."
                            >{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" class="pt-4 text-center">
                            <button 
                                type="submit"
                                class="bg-blue-600 hover:bg-blue-700 text-white font-medium py-3 px-8 rounded-md transition duration-200"
                            >
                                Kirim Pesan
                            </button>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</section>
@endsection