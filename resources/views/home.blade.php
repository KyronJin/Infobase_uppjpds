@extends('layouts.app')

@section('content')
    <section id="home" class="relative min-h-screen flex items-center bg-gradient-to-br from-blue-50 via-white to-gray-50 overflow-hidden">
        <!-- Decorative Elements -->
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-100 rounded-full blur-3xl opacity-40 -translate-x-1/3 -translate-y-1/3"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-orange-100 rounded-full blur-3xl opacity-30 translate-x-1/3 translate-y-1/3"></div>

        <div class="hero-wrap">
            <div class="hero-panel" aria-hidden></div>
            <!-- Left: Text Content -->
            <div class="hero-text" style="z-index:20">
                    <span class="welcome-badge">{{ $content['hero_badge'] ?? 'Selamat Datang di' }}</span>

                    <h1 class="main-title">
                        {!! $content['hero_title'] ?? 'INFOBASE <span class="highlight">UPPJPDS</span>' !!}
                    </h1>

                    <p class="subtitle lead">{{ $content['hero_subtitle'] ?? 'Belajar • Berkarya • Bertumbuh Bersama' }}</p>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center lg:justify-start">
                        <a href="{{ Route::has('admin.login') ? route('admin.login') : '#' }}" class="btn-primary login-btn">Masuk Admin</a>
                        <a href="#about" class="action secondary">Pelajari Lebih Lanjut</a>
                    </div>

                    <p class="footer-url">dispusip.jakarta.go.id/cikini</p>
                </div>

                <!-- Right: Image + Decorations -->
                <div class="hero-image" style="z-index:20">
                    <div class="image-container">
                        <img src="{{ asset('images/hero-photo.jpg') }}" alt="Tim Perpustakaan Jakarta">
                    </div>
                    <div class="circle-decoration" aria-hidden></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Quick Links to Priority Features -->
    <section id="features" class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-6 text-center">
            <h2 class="h2 mb-8">Fitur Utama</h2>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="text-3xl mb-3">📢</div>
                    <div class="title">Pengumuman</div>
                    <div class="desc">Lihat pengumuman terbaru, pengumuman acara, dan informasi penting dari perpustakaan.</div>
                </div>

                <div class="feature-card">
                    <div class="text-3xl mb-3">📅</div>
                    <div class="title">Calendar Aktifitas</div>
                    <div class="desc">Jadwal event dan kegiatan yang bisa diikuti oleh pengunjung.</div>
                </div>

                <div class="feature-card">
                    <div class="text-3xl mb-3">📜</div>
                    <div class="title">Tata Tertib</div>
                    <div class="desc">Aturan dan pedoman penggunaan fasilitas perpustakaan.</div>
                </div>

                <div class="feature-card">
                    <div class="text-3xl mb-3">🏆</div>
                    <div class="title">Staff of Month</div>
                    <div class="desc">Profil staff berprestasi dan pengakuan bulanan.</div>
                </div>

                <div class="feature-card">
                    <div class="text-3xl mb-3">🏛️</div>
                    <div class="title">Profile Ruangan</div>
                    <div class="desc">Detail ruang, kapasitas, dan fasilitas yang tersedia untuk publik.</div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about" class="py-20 lg:py-28 bg-white">
        <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
            <div class="grid lg:grid-cols-2 gap-12 items-center">
                <div>
                    <h2 class="h2 mb-6">Tentang Perpustakaan Jakarta</h2>
                    <p class="lead mb-8">
                        Perpustakaan Jakarta (UPPJPDS) menyediakan sumber daya pembelajaran, ruang kolaborasi, dan program untuk mendorong literasi serta kreativitas masyarakat. Kami berfokus pada akses informasi yang mudah dan program pemberdayaan.
                    </p>

                    <h3 class="h3 mb-4">Visi</h3>
                    <p class="lead">
                        Menjadi pusat pengetahuan yang inklusif dan inovatif untuk seluruh warga Jakarta.
                    </p>
                </div>

                <div class="relative">
                    @if(!empty($content['about_image']))
                        <img 
                            src="{{ $content['about_image'] }}" 
                            alt="Perpustakaan Jakarta" 
                            class="rounded-2xl shadow-2xl w-full object-cover aspect-[4/3]"
                        >
                    @else
                        <div class="rounded-2xl bg-gray-100 aspect-[4/3] flex items-center justify-center text-gray-400 text-xl font-medium shadow-xl">
                            Gambar Perpustakaan
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-20 lg:py-28 bg-gray-50">
        <div class="container mx-auto px-6 lg:px-8 max-w-6xl">
                <div class="text-center mb-16">
                <h2 class="h2 mb-4">Hubungi Kami</h2>
                <p class="lead max-w-2xl mx-auto">
                    Punya pertanyaan, saran, atau ingin berkolaborasi? Jangan ragu menghubungi kami.
                </p>
            </div>

            <div class="grid lg:grid-cols-2 gap-12 items-start">
                <!-- Left: Info -->
                <div class="space-y-10">
                    {!! $content['contact_html'] ?? '
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Alamat</h3>
                            <p class="text-gray-600">Perpustakaan Jakarta<br>Jl. Contoh No.1, Jakarta Pusat</p>
                        </div>
                        <div>
                            <h3 class="text-2xl font-semibold text-gray-800 mb-4">Kontak</h3>
                            <p class="text-gray-600">
                                Email: info@perpustakaan.jakarta.go.id<br>
                                Telepon: (021) 1234-5678
                            </p>
                        </div>
                    ' !!}
                </div>

                <!-- Right: Form -->
                <div class="contact-form">
                    @if(session('success'))
                        <div class="mb-4 p-4 bg-green-100 text-green-800 rounded">{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                        @csrf

                        <div class="form-group">
                            <label for="name" class="form-label">Nama Lengkap</label>
                            <input type="text" name="name" id="name" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" required class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="message" class="form-label">Pesan</label>
                            <textarea name="message" id="message" rows="5" required class="form-control"></textarea>
                        </div>

                        <button type="submit" class="form-submit">Kirim Pesan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
