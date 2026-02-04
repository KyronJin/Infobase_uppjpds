<header class="sticky top-0 z-50 bg-white shadow-lg border-b-2 border-[#f85e38]">
  <nav class="max-w-7xl mx-auto px-6 lg:px-12 py-3">
    <div class="flex items-center justify-between gap-8">
      <!-- Logo - Left -->
      <a href="{{ route('home') }}" class="flex items-center gap-2 group flex-shrink-0">
        <div class="w-14 h-14 bg-[#00425A] text-white rounded-lg flex items-center justify-center font-bold text-xl group-hover:bg-[#f85e38] transition duration-300">
          <i class="fas fa-book"></i>
        </div>
        <div class="hidden sm:block">
          <h1 class="text-lg font-bold text-[#00425A] group-hover:text-[#f85e38] transition duration-300 leading-tight">INFOBASE</h1>
          <p class="text-xs text-gray-600">Perpustakaan Jakarta</p>
        </div>
      </a>

      <!-- Desktop Navigation Links - Center -->
      <ul id="nav-links" class="hidden lg:flex items-center gap-8 flex-1 justify-center">
        <li>
          <a href="{{ route('home') }}" class="text-gray-700 font-medium hover:text-[#f85e38] transition duration-300 relative group/link whitespace-nowrap">
            Beranda
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#f85e38] group-hover/link:w-full transition-all duration-300"></span>
          </a>
        </li>
        <li>
          <a href="{{ route('about') }}" class="text-gray-700 font-medium hover:text-[#f85e38] transition duration-300 relative group/link whitespace-nowrap">
            Tentang
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#f85e38] group-hover/link:w-full transition-all duration-300"></span>
          </a>
        </li>
        <li class="relative">
          <button id="data-info-btn" class="flex items-center gap-2 text-gray-700 font-medium hover:text-[#f85e38] transition duration-300 relative group/link cursor-pointer whitespace-nowrap">
            Infobase
            <i id="data-info-chevron" class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-[#f85e38] group-hover/link:w-full transition-all duration-300"></span>
          </button>

          <!-- Dropdown Menu -->
          <div id="data-info-menu" class="absolute top-full left-0 mt-3 w-56 bg-white border border-gray-200 rounded-xl shadow-lg opacity-0 invisible transition-all duration-300 py-2">
            <a href="{{ route('infobase.pengumuman') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] transition duration-200 relative group/item">
              <i class="fas fa-bullhorn text-[#00425A] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">Pengumuman</p>
                <p class="text-xs text-gray-500">Lihat pengumuman</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
            <a href="{{ route('infobase.calendar-aktifitas') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
              <i class="fas fa-calendar-alt text-[#f85e38] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">Calendar</p>
                <p class="text-xs text-gray-500">Lihat aktivitas</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
            <a href="{{ route('infobase.profile-ruangan') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
              <i class="fas fa-door-open text-[#00425A] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">Profile Ruangan</p>
                <p class="text-xs text-gray-500">Lihat ruang fasilitas</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
            <a href="{{ route('infobase.tata-tertib') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
              <i class="fas fa-book text-[#f85e38] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">Tata Tertib</p>
                <p class="text-xs text-gray-500">Lihat peraturan</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
            <a href="{{ route('infobase.staff-of-month') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
              <i class="fas fa-star text-[#00425A] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">Staff of Month</p>
                <p class="text-xs text-gray-500">Lihat staff terpilih</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
            <a href="{{ route('infobase.profil-pegawai') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] transition duration-200 relative group/item">
              <i class="fas fa-users text-[#f85e38] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">Profil Pegawai</p>
                <p class="text-xs text-gray-500">Lihat data pegawai</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
          </div>
        </li>
      </ul>

      <!-- Auth Section - Right -->
      <div class="hidden lg:flex items-center gap-4 flex-shrink-0">
        @auth
          <div class="relative">
            <button id="admin-btn" class="flex items-center gap-2 px-6 py-2.5 bg-[#00425A] text-white font-semibold rounded-lg hover:bg-[#003144] transition duration-300 shadow-md hover:shadow-lg whitespace-nowrap">
              <i class="fas fa-user-shield"></i>
              Admin
              <i id="admin-chevron" class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="admin-menu" class="absolute top-full right-0 mt-3 w-56 bg-white border border-gray-200 rounded-xl shadow-lg opacity-0 invisible transition-all duration-300 py-2">
              @if(Route::has('admin.pengumuman.index'))
              <a href="{{ route('admin.pengumuman.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
                <i class="fas fa-bullhorn text-[#00425A] text-lg"></i>
                <div>
                  <p class="font-semibold text-sm">Pengumuman</p>
                  <p class="text-xs text-gray-500">Kelola pengumuman</p>
                </div>
                <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
              </a>
              @endif

              @if(Route::has('admin.calendar.index'))
              <a href="{{ route('admin.calendar.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
                <i class="fas fa-calendar-alt text-[#f85e38] text-lg"></i>
                <div>
                  <p class="font-semibold text-sm">Calendar</p>
                  <p class="text-xs text-gray-500">Kelola event aktivitas</p>
                </div>
                <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
              </a>
              @endif

              @if(Route::has('admin.profile.index'))
              <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
                <i class="fas fa-door-open text-[#00425A] text-lg"></i>
                <div>
                  <p class="font-semibold text-sm">Profile Ruangan</p>
                  <p class="text-xs text-gray-500">Kelola ruang fasilitas</p>
                </div>
                <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
              </a>
              @endif

              @if(Route::has('admin.tata_tertib.index'))
              <a href="{{ route('admin.tata_tertib.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
                <i class="fas fa-book text-[#f85e38] text-lg"></i>
                <div>
                  <p class="font-semibold text-sm">Tata Tertib</p>
                  <p class="text-xs text-gray-500">Kelola peraturan</p>
                </div>
                <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
              </a>
              @endif

              @if(Route::has('admin.staff-of-month.index'))
              <a href="{{ route('admin.staff-of-month.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
                <i class="fas fa-star text-[#00425A] text-lg"></i>
                <div>
                  <p class="font-semibold text-sm">Staff of Month</p>
                  <p class="text-xs text-gray-500">Kelola staff terpilih</p>
                </div>
                <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
              </a>
              @endif

              @if(Route::has('admin.profil_pegawai.index'))
              <a href="{{ route('admin.profil_pegawai.index') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
                <i class="fas fa-users text-[#f85e38] text-lg"></i>
                <div>
                  <p class="font-semibold text-sm">Profil Pegawai</p>
                  <p class="text-xs text-gray-500">Kelola data pegawai</p>
                </div>
                <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
              </a>
              @endif

              <form action="{{ route('admin.logout') }}" method="POST" class="mt-2">
                @csrf
                <button type="submit" class="w-full flex items-center gap-3 px-5 py-3 text-red-600 hover:bg-red-50 transition duration-200 font-semibold text-sm relative group/item">
                  <i class="fas fa-sign-out-alt"></i>
                  Keluar
                  <span class="absolute left-0 top-1/2 w-1 h-0 bg-red-500 group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
                </button>
              </form>
            </div>
          </div>
        @endauth
      </div>

      <!-- Mobile Menu Toggle -->
      <button id="nav-toggle" aria-controls="mobile-menu" aria-expanded="false" class="lg:hidden p-2 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-300">
        <i class="fas fa-bars text-2xl"></i>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4 border-t border-gray-200">
      <ul class="space-y-2">
        <li>
          <a href="{{ route('home') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-300 font-medium">
            Beranda
          </a>
        </li>
        <li>
          <a href="{{ route('about') }}" class="block px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg transition duration-300 font-medium">
            Tentang
          </a>
        </li>
        <li class="border-t border-gray-200 pt-4 mt-4">
          <button id="mobile-data-info-btn" class="w-full flex items-center justify-between px-4 py-3 text-gray-700 hover:bg-gray-100 rounded-lg font-medium transition duration-300">
            Infobase
            <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
          </button>

          <div id="mobile-data-info-menu" class="hidden mt-2 space-y-2 pl-4">
            <a href="{{ route('infobase.pengumuman') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-bullhorn text-[#00425A]"></i>
              Pengumuman
            </a>
            <a href="{{ route('infobase.calendar-aktifitas') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-calendar-alt text-[#f85e38]"></i>
              Calendar Aktivitas
            </a>
            <a href="{{ route('infobase.profile-ruangan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-door-open text-[#00425A]"></i>
              Profile Ruangan
            </a>
            <a href="{{ route('infobase.tata-tertib') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-book text-[#f85e38]"></i>
              Tata Tertib
            </a>
            <a href="{{ route('infobase.staff-of-month') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-star text-[#00425A]"></i>
              Staff of Month
            </a>
            <a href="{{ route('infobase.profil-pegawai') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-users text-[#f85e38]"></i>
              Profil Pegawai
            </a>
          </div>
        </li>

        <li class="border-t border-gray-200 pt-4 mt-4">
          @auth
            <button id="mobile-admin-btn" class="w-full flex items-center justify-between px-4 py-3 bg-[#00425A] text-white rounded-lg font-semibold hover:bg-[#003144] transition duration-300">
              <span class="flex items-center gap-2">
                <i class="fas fa-user-shield"></i>
                Admin
              </span>
              <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            </button>

            <div id="mobile-admin-menu" class="hidden mt-2 space-y-2">
              @if(Route::has('admin.pengumuman.index'))
              <a href="{{ route('admin.pengumuman.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-bullhorn text-[#00425A]"></i>
                Pengumuman
              </a>
              @endif

              @if(Route::has('admin.calendar.index'))
              <a href="{{ route('admin.calendar.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-calendar-alt text-[#f85e38]"></i>
                Calendar
              </a>
              @endif

              @if(Route::has('admin.profile.index'))
              <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-door-open text-[#00425A]"></i>
                Profile Ruangan
              </a>
              @endif

              @if(Route::has('admin.tata_tertib.index'))
              <a href="{{ route('admin.tata_tertib.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-book text-[#f85e38]"></i>
                Tata Tertib
              </a>
              @endif

              @if(Route::has('admin.staff-of-month.index'))
              <a href="{{ route('admin.staff-of-month.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-star text-[#00425A]"></i>
                Staff of Month
              </a>
              @endif

              @if(Route::has('admin.profil_pegawai.index'))
              <a href="{{ route('admin.profil_pegawai.index') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-users text-[#f85e38]"></i>
                Profil Pegawai
              </a>
              @endif

              <form action="{{ route('admin.logout') }}" method="POST" class="pt-2 border-t border-gray-200">
                @csrf
                <button type="submit" class="w-full flex items-center gap-2 px-4 py-3 text-red-600 bg-red-50 rounded-lg hover:bg-red-100 transition duration-300 font-semibold text-sm">
                  <i class="fas fa-sign-out-alt"></i>
                  Keluar
                </button>
              </form>
            </div>
          @endauth
        </li>
      </ul>
    </div>
  </nav>
</header>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Mobile Menu Toggle
    const navToggle = document.getElementById('nav-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    navToggle.addEventListener('click', function() {
      const isExpanded = this.getAttribute('aria-expanded') === 'true';
      this.setAttribute('aria-expanded', !isExpanded);
      mobileMenu.classList.toggle('hidden');
    });

    // Desktop Data & Informasi Dropdown Hover
    const dataInfoBtn = document.getElementById('data-info-btn');
    const dataInfoMenu = document.getElementById('data-info-menu');
    const dataInfoChevron = document.getElementById('data-info-chevron');

    if (dataInfoBtn && dataInfoMenu) {
      dataInfoBtn.addEventListener('mouseenter', function() {
        dataInfoMenu.classList.remove('opacity-0', 'invisible');
        dataInfoChevron.classList.add('rotate-180');
      });

      dataInfoBtn.addEventListener('mouseleave', function() {
        dataInfoMenu.classList.add('opacity-0', 'invisible');
        dataInfoChevron.classList.remove('rotate-180');
      });

      // Keep dropdown open when hovering over the menu itself
      dataInfoMenu.addEventListener('mouseenter', function() {
        dataInfoMenu.classList.remove('opacity-0', 'invisible');
        dataInfoChevron.classList.add('rotate-180');
      });

      dataInfoMenu.addEventListener('mouseleave', function() {
        dataInfoMenu.classList.add('opacity-0', 'invisible');
        dataInfoChevron.classList.remove('rotate-180');
      });
    }

    // Desktop Admin Dropdown Toggle
    const adminBtn = document.getElementById('admin-btn');
    const adminMenu = document.getElementById('admin-menu');
    const adminChevron = document.getElementById('admin-chevron');

    if (adminBtn && adminMenu) {
      adminBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        const isVisible = !adminMenu.classList.contains('invisible');
        
        if (isVisible) {
          adminMenu.classList.add('opacity-0', 'invisible');
          adminChevron.classList.remove('rotate-180');
        } else {
          adminMenu.classList.remove('opacity-0', 'invisible');
          adminChevron.classList.add('rotate-180');
        }
      });

      // Close dropdown when clicking outside
      document.addEventListener('click', function(e) {
        if (!adminBtn.contains(e.target) && !adminMenu.contains(e.target)) {
          adminMenu.classList.add('opacity-0', 'invisible');
          adminChevron.classList.remove('rotate-180');
        }
      });
    }

    // Mobile Data & Informasi Menu Toggle
    const mobileDataInfoBtn = document.getElementById('mobile-data-info-btn');
    const mobileDataInfoMenu = document.getElementById('mobile-data-info-menu');

    if (mobileDataInfoBtn && mobileDataInfoMenu) {
      mobileDataInfoBtn.addEventListener('click', function() {
        mobileDataInfoMenu.classList.toggle('hidden');
      });
    }

    // Mobile Admin Menu Toggle
    const mobileAdminBtn = document.getElementById('mobile-admin-btn');
    const mobileAdminMenu = document.getElementById('mobile-admin-menu');

    if (mobileAdminBtn && mobileAdminMenu) {
      mobileAdminBtn.addEventListener('click', function() {
        mobileAdminMenu.classList.toggle('hidden');
      });
    }

    // Close mobile menu when clicking on a link
    const mobileLinks = mobileMenu.querySelectorAll('a');
    mobileLinks.forEach(link => {
      link.addEventListener('click', function() {
        mobileMenu.classList.add('hidden');
        navToggle.setAttribute('aria-expanded', 'false');
      });
    });
  });
</script>