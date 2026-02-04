<!doctype html>
<html lang="id">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'INFOBASE') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=Inter:wght@200;300;400;500;600;700;800;900&family=Source+Serif+4:ital,wght@1,400;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
      @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else
      <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @endif
  </head>
  <body class="bg-gradient-to-br from-gray-50 via-white to-blue-50 text-gray-900 antialiased">
    <div id="app">
      @includeIf('components.navbar')

      <main class="min-h-screen">
        @yield('content')
      </main>

      <!-- Footer -->
      <footer class="bg-[#00425A] text-white mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-16">
          <!-- Footer Content Grid -->
          <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Brand Section -->
            <div class="space-y-4">
              <h3 class="text-2xl font-bold">INFOBASE</h3>
              <p class="text-white text-opacity-80 leading-relaxed">
                Portal informasi terpadu Perpustakaan Jakarta untuk akses mudah pengumuman, jadwal, dan fasilitas.
              </p>
              <div class="flex gap-4 pt-4">
                <a href="#" class="inline-flex items-center justify-center w-10 h-10 bg-white bg-opacity-20 text-white rounded-full hover:bg-[#f85e38] transition duration-300">
                  <i class="fab fa-facebook-f text-sm"></i>
                </a>
                <a href="#" class="inline-flex items-center justify-center w-10 h-10 bg-white bg-opacity-20 text-white rounded-full hover:bg-[#f85e38] transition duration-300">
                  <i class="fab fa-twitter text-sm"></i>
                </a>
                <a href="#" class="inline-flex items-center justify-center w-10 h-10 bg-white bg-opacity-20 text-white rounded-full hover:bg-[#f85e38] transition duration-300">
                  <i class="fab fa-instagram text-sm"></i>
                </a>
                <a href="#" class="inline-flex items-center justify-center w-10 h-10 bg-white bg-opacity-20 text-white rounded-full hover:bg-[#f85e38] transition duration-300">
                  <i class="fab fa-youtube text-sm"></i>
                </a>
              </div>
            </div>

            <!-- Quick Links -->
            <div>
              <h4 class="text-lg font-bold mb-6">Menu Cepat</h4>
              <ul class="space-y-3">
                <li>
                  <a href="{{ route('home') }}" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    Beranda
                  </a>
                </li>
                <li>
                  <a href="{{ route('home') }}" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    InfoBase
                  </a>
                </li>
                <li>
                  <a href="{{ route('about') }}" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    Tentang Kami
                  </a>
                </li>
                <li>
                  <a href="{{ route('contact') }}" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    Hubungi Kami
                  </a>
                </li>
              </ul>
            </div>

            <!-- Resources -->
            <div>
              <h4 class="text-lg font-bold mb-6">Fitur</h4>
              <ul class="space-y-3">
                <li>
                  <a href="{{ route('infobase.pengumuman') }}" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    Pengumuman
                  </a>
                </li>
                <li>
                  <a href="{{ route('infobase.calendar-aktifitas') }}" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    Calendar Aktivitas
                  </a>
                </li>
                <li>
                  <a href="{{ route('infobase.tata-tertib') }}" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    Tata Tertib
                  </a>
                </li>
                <li>
                  <a href="{{ route('infobase.profile-ruangan') }}" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    Profile Ruangan
                  </a>
                </li>
              </ul>
            </div>

            <!-- Contact Info -->
            <div>
              <h4 class="text-lg font-bold mb-6">Hubungi Kami</h4>
              <ul class="space-y-4">
                <li class="flex gap-3">
                  <div class="flex-shrink-0 mt-1">
                    <i class="fas fa-map-marker-alt text-[#f85e38]"></i>
                  </div>
                  <div>
                    <p class="text-white text-opacity-80 text-sm">
                      Jl. Cikini Raya No. 73<br>Jakarta Pusat 10330
                    </p>
                  </div>
                </li>
                <li class="flex gap-3">
                  <div class="flex-shrink-0 mt-1">
                    <i class="fas fa-phone text-[#f85e38]"></i>
                  </div>
                  <div>
                    <a href="tel:+62214706295" class="text-white text-opacity-80 hover:text-white text-sm transition duration-300">
                      (+62 21) 4706-295
                    </a>
                  </div>
                </li>
                <li class="flex gap-3">
                  <div class="flex-shrink-0 mt-1">
                    <i class="fas fa-envelope text-[#f85e38]"></i>
                  </div>
                  <div>
                    <a href="mailto:info@perpustakaan.jakarta.go.id" class="text-white text-opacity-80 hover:text-white text-sm transition duration-300 break-all">
                      info@perpustakaan.jakarta.go.id
                    </a>
                  </div>
                </li>
              </ul>
            </div>
          </div>

          <!-- Divider -->
          <div class="border-t border-white border-opacity-20 my-12"></div>

          <!-- Footer Bottom -->
          <div class="grid md:grid-cols-2 gap-6 items-center">
            <div class="text-white text-opacity-80 text-sm">
              <p>© {{ date('Y') }} Perpustakaan Jakarta — INFOBASE. Semua hak dilindungi.</p>
            </div>
            <div class="flex gap-6 justify-end">
              <a href="#" class="text-white text-opacity-80 hover:text-white text-sm transition duration-300">Kebijakan Privasi</a>
              <a href="#" class="text-white text-opacity-80 hover:text-white text-sm transition duration-300">Syarat & Ketentuan</a>
            </div>
          </div>
        </div>
      </footer>

      <!-- Scroll to Top Button -->
      <button id="scrollToTop" class="fixed bottom-6 right-6 w-12 h-12 bg-[#f85e38] text-white rounded-full shadow-lg hover:bg-[#00425A] transition duration-300 flex items-center justify-center z-40 opacity-0 pointer-events-none hover:shadow-xl">
        <i class="fas fa-arrow-up"></i>
      </button>
    </div>

    <script>
      // Scroll to Top functionality
      const scrollToTopBtn = document.getElementById('scrollToTop');

      window.addEventListener('scroll', () => {
        if (window.pageYOffset > 300) {
          scrollToTopBtn.classList.remove('opacity-0', 'pointer-events-none');
        } else {
          scrollToTopBtn.classList.add('opacity-0', 'pointer-events-none');
        }
      });

      scrollToTopBtn.addEventListener('click', () => {
        window.scrollTo({
          top: 0,
          behavior: 'smooth'
        });
      });
    </script>
  </body>
</html>