<header class="sticky top-0 z-50 bg-[#063A76] shadow-lg border-b-2 border-gray-200">
  <nav class="max-w-7xl mx-auto px-6 lg:px-12 py-3">
    <div class="flex items-center justify-between gap-8">
      <!-- Logo - Left -->
      <a href="{{ route('home') }}" class="brand-logo group flex-shrink-0">
        <div class="brand-logo-icon group-hover:bg-orange-500 group-hover:text-white">
          <i class="fas fa-book"></i>
        </div>
        <div class="hidden sm:block">
          <h1 class="brand-logo-text group-hover:text-orange-400">INFOBASE</h1>
          <p class="brand-logo-subtitle">Perpustakaan Jakarta</p>
        </div>
      </a>

      <!-- Desktop Navigation Links - Center -->
      <ul id="nav-links" class="hidden lg:flex items-center gap-8 flex-1 justify-center">
        <li>
          <a href="{{ route('home') }}" class="text-white font-medium hover:text-orange-300 transition duration-300 relative group/link whitespace-nowrap">
            {{ __('messages.home') }}
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-300 group-hover/link:w-full transition-all duration-300"></span>
          </a>
        </li>
        <li>
          <a href="{{ route('about') }}" class="text-white font-medium hover:text-orange-300 transition duration-300 relative group/link whitespace-nowrap">
            {{ __('About Us') }}
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-300 group-hover/link:w-full transition-all duration-300"></span>
          </a>
        </li>
        <li class="relative">
          <button id="data-info-btn" class="flex items-center gap-2 text-white font-medium hover:text-orange-300 transition duration-300 relative group/link cursor-pointer whitespace-nowrap">
            {{ __('messages.infobase') }}
            <i id="data-info-chevron" class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-300 group-hover/link:w-full transition-all duration-300"></span>
          </button>

          <!-- Dropdown Menu -->
          <div id="data-info-menu" class="absolute top-full left-0 mt-3 w-56 bg-white border border-gray-200 rounded-xl shadow-lg opacity-0 invisible transition-all duration-300 py-2 z-50">
            <a href="{{ route('infobase.pengumuman') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] transition duration-200 relative group/item">
              <i class="fas fa-bullhorn text-[#00425A] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">{{ __('messages.announcements') }}</p>
                <p class="text-xs text-gray-500">{{ __('View announcements') }}</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
            <a href="{{ route('infobase.calendar-aktifitas') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
              <i class="fas fa-calendar-alt text-[#f85e38] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">{{ __('messages.calendar') }}</p>
                <p class="text-xs text-gray-500">{{ __('View activities') }}</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
            <a href="{{ route('infobase.profile-ruangan') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
              <i class="fas fa-door-open text-[#00425A] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">{{ __('messages.room_profiles') }}</p>
                <p class="text-xs text-gray-500">{{ __('View room facilities') }}</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
            <a href="{{ route('infobase.tata-tertib') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
              <i class="fas fa-book text-[#f85e38] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">{{ __('messages.rules') }}</p>
                <p class="text-xs text-gray-500">{{ __('View regulations') }}</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
            <a href="{{ route('infobase.staff-of-month') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] border-b border-gray-100 transition duration-200 relative group/item">
              <i class="fas fa-star text-[#00425A] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">{{ __('messages.staff_of_month') }}</p>
                <p class="text-xs text-gray-500">{{ __('View featured staff') }}</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
            <a href="{{ route('infobase.profil-pegawai') }}" class="flex items-center gap-3 px-5 py-3 text-gray-700 hover:bg-gray-50 hover:text-[#00425A] transition duration-200 relative group/item">
              <i class="fas fa-users text-[#f85e38] text-lg"></i>
              <div>
                <p class="font-semibold text-sm">{{ __('messages.staff_profiles') }}</p>
                <p class="text-xs text-gray-500">{{ __('View staff data') }}</p>
              </div>
              <span class="absolute left-0 top-1/2 w-1 h-0 bg-[#f85e38] group-hover/item:h-1/2 transition-all duration-300 -translate-y-1/2"></span>
            </a>
          </div>
        </li>
      </ul>

      <!-- Language & Dark Mode - Center Right -->
      <div class="hidden lg:flex items-center gap-3">
        <!-- Language Selector -->
        <div class="relative">
          <button id="lang-btn" class="flex items-center gap-2 px-4 py-2.5 text-white hover:bg-white hover:bg-opacity-10 rounded-lg transition duration-300 whitespace-nowrap text-sm font-medium">
            <i class="fas fa-globe text-orange-300"></i>
            <span id="lang-display">{{ strtoupper(app()->getLocale()) }}</span>
            <i class="fas fa-chevron-down text-xs transition-transform duration-300" id="lang-chevron"></i>
          </button>
          
          <!-- Language Dropdown -->
          <div id="lang-menu" class="absolute top-full right-0 mt-2 w-40 bg-white border border-gray-200 rounded-lg shadow-lg opacity-0 invisible transition-all duration-300 py-2 z-40">
            <a href="{{ route('language.switch', 'id') }}" data-lang="id" class="w-full flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition duration-200 text-sm font-medium">
              <i class="fas fa-check text-[#f85e38] {{ app()->getLocale() == 'id' ? '' : 'hidden' }}" id="check-id"></i>
              <span>{{ __('messages.indonesian') }}</span>
            </a>
            <a href="{{ route('language.switch', 'en') }}" data-lang="en" class="w-full flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-gray-50 transition duration-200 text-sm font-medium border-t border-gray-100">
              <i class="fas fa-check text-[#f85e38] {{ app()->getLocale() == 'en' ? '' : 'hidden' }}" id="check-en"></i>
              <span>{{ __('messages.english') }}</span>
            </a>
          </div>
        </div>
      </div>

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
            <div id="admin-menu" class="absolute top-full right-0 mt-3 w-56 bg-white border border-gray-200 rounded-xl shadow-lg opacity-0 invisible transition-all duration-300 py-2 z-50">
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
      <button id="nav-toggle" aria-controls="mobile-menu" aria-expanded="false" class="lg:hidden p-2 text-black hover:bg-gray-100 rounded-lg transition duration-300">
        <i class="fas fa-bars text-2xl"></i>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4 border-t border-gray-200">
      <!-- Mobile Language & Dark Mode Controls -->
      <div class="flex items-center justify-between gap-2 px-4 py-3 mb-4 bg-gray-100 rounded-lg">
        <div class="flex items-center gap-2">
          <i class="fas fa-globe text-[#f85e38]"></i>
          <select id="mobile-lang-select" class="bg-transparent text-black text-sm font-medium outline-none cursor-pointer">
            <option value="id" class="bg-white text-black">ID</option>
            <option value="en" class="bg-white text-black">EN</option>
          </select>
        </div>
      </div>

      <ul class="space-y-2">
        <li>
          <a href="{{ route('home') }}" class="block px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition duration-300 font-medium">
            Beranda
          </a>
        </li>
        <li>
          <a href="{{ route('about') }}" class="block px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition duration-300 font-medium">
            Tentang
          </a>
        </li>
        <li class="border-t border-gray-200 pt-4 mt-4">
          <button id="mobile-data-info-btn" class="w-full flex items-center justify-between px-4 py-3 text-black hover:bg-gray-100 rounded-lg font-medium transition duration-300">
            Infobase
            <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
          </button>

          <div id="mobile-data-info-menu" class="hidden mt-2 space-y-2 pl-4 bg-gray-100 rounded-lg">
            <a href="{{ route('infobase.pengumuman') }}" class="flex items-center gap-3 px-4 py-3 text-black hover:bg-gray-200 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-bullhorn text-[#00425A]"></i>
              Pengumuman
            </a>
            <a href="{{ route('infobase.calendar-aktifitas') }}" class="flex items-center gap-3 px-4 py-3 text-black hover:bg-gray-200 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-calendar-alt text-[#f85e38]"></i>
              Calendar Aktivitas
            </a>
            <a href="{{ route('infobase.profile-ruangan') }}" class="flex items-center gap-3 px-4 py-3 text-black hover:bg-gray-200 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-door-open text-[#00425A]"></i>
              Profile Ruangan
            </a>
            <a href="{{ route('infobase.tata-tertib') }}" class="flex items-center gap-3 px-4 py-3 text-black hover:bg-gray-200 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-book text-[#f85e38]"></i>
              Tata Tertib
            </a>
            <a href="{{ route('infobase.staff-of-month') }}" class="flex items-center gap-3 px-4 py-3 text-black hover:bg-gray-200 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-star text-[#00425A]"></i>
              Staff of Month
            </a>
            <a href="{{ route('infobase.profil-pegawai') }}" class="flex items-center gap-3 px-4 py-3 text-black hover:bg-gray-200 rounded-lg transition duration-300 text-sm font-medium">
              <i class="fas fa-users text-[#f85e38]"></i>
              Profil Pegawai
            </a>
          </div>
        </li>

        <li class="border-t border-gray-200 pt-4 mt-4">
          @auth
            <button id="mobile-admin-btn" class="w-full flex items-center justify-between px-4 py-3 bg-[#f85e38] text-white rounded-lg font-semibold hover:bg-[#d94e2e] transition duration-300">
              <span class="flex items-center gap-2">
                <i class="fas fa-user-shield"></i>
                Admin
              </span>
              <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            </button>

            <div id="mobile-admin-menu" class="hidden mt-2 space-y-2">
              @if(Route::has('admin.pengumuman.index'))
              <a href="{{ route('admin.pengumuman.index') }}" class="flex items-center gap-3 px-4 py-3 text-black bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-bullhorn text-[#00425A]"></i>
                Pengumuman
              </a>
              @endif

              @if(Route::has('admin.calendar.index'))
              <a href="{{ route('admin.calendar.index') }}" class="flex items-center gap-3 px-4 py-3 text-black bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-calendar-alt text-[#f85e38]"></i>
                Calendar
              </a>
              @endif

              @if(Route::has('admin.profile.index'))
              <a href="{{ route('admin.profile.index') }}" class="flex items-center gap-3 px-4 py-3 text-black bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-door-open text-[#00425A]"></i>
                Profile Ruangan
              </a>
              @endif

              @if(Route::has('admin.tata_tertib.index'))
              <a href="{{ route('admin.tata_tertib.index') }}" class="flex items-center gap-3 px-4 py-3 text-black bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-book text-[#f85e38]"></i>
                Tata Tertib
              </a>
              @endif

              @if(Route::has('admin.staff-of-month.index'))
              <a href="{{ route('admin.staff-of-month.index') }}" class="flex items-center gap-3 px-4 py-3 text-black bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
                <i class="fas fa-star text-[#00425A]"></i>
                Staff of Month
              </a>
              @endif

              @if(Route::has('admin.profil_pegawai.index'))
              <a href="{{ route('admin.profil_pegawai.index') }}" class="flex items-center gap-3 px-4 py-3 text-black bg-gray-50 rounded-lg hover:bg-gray-100 transition duration-300 text-sm font-medium">
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
    console.log('Navbar JavaScript loaded');

    // ==================== MOBILE MENU TOGGLE ====================
    const navToggle = document.getElementById('nav-toggle');
    const mobileMenu = document.getElementById('mobile-menu');

    if (navToggle && mobileMenu) {
      navToggle.addEventListener('click', function(e) {
        e.preventDefault();
        const isExpanded = this.getAttribute('aria-expanded') === 'true';
        this.setAttribute('aria-expanded', !isExpanded);
        mobileMenu.classList.toggle('hidden');
        
        // Change icon
        const icon = this.querySelector('i');
        if (icon) {
          if (!isExpanded) {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
          } else {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
          }
        }
      });
    }

    // ==================== DESKTOP INFOBASE DROPDOWN ====================
    const dataInfoBtn = document.getElementById('data-info-btn');
    const dataInfoMenu = document.getElementById('data-info-menu');
    const dataInfoChevron = document.getElementById('data-info-chevron');
    let dataInfoTimeout;

    if (dataInfoBtn && dataInfoMenu && dataInfoChevron) {
      function showDataInfoMenu() {
        clearTimeout(dataInfoTimeout);
        dataInfoMenu.classList.remove('opacity-0', 'invisible');
        dataInfoChevron.classList.add('rotate-180');
      }

      function hideDataInfoMenu() {
        dataInfoTimeout = setTimeout(() => {
          dataInfoMenu.classList.add('opacity-0', 'invisible');
          dataInfoChevron.classList.remove('rotate-180');
        }, 150);
      }

      dataInfoBtn.addEventListener('mouseenter', showDataInfoMenu);
      dataInfoBtn.addEventListener('mouseleave', hideDataInfoMenu);
      dataInfoMenu.addEventListener('mouseenter', showDataInfoMenu);
      dataInfoMenu.addEventListener('mouseleave', hideDataInfoMenu);
      
      // Click handler for mobile
      dataInfoBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const isVisible = !dataInfoMenu.classList.contains('invisible');
        
        if (isVisible) {
          dataInfoMenu.classList.add('opacity-0', 'invisible');
          dataInfoChevron.classList.remove('rotate-180');
        } else {
          // Close other dropdowns first
          closeAllDropdowns();
          dataInfoMenu.classList.remove('opacity-0', 'invisible');
          dataInfoChevron.classList.add('rotate-180');
        }
      });
    }

    // ==================== DESKTOP ADMIN DROPDOWN ====================
    const adminBtn = document.getElementById('admin-btn');
    const adminMenu = document.getElementById('admin-menu');
    const adminChevron = document.getElementById('admin-chevron');

    if (adminBtn && adminMenu && adminChevron) {
      adminBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const isVisible = !adminMenu.classList.contains('invisible');
        
        if (isVisible) {
          adminMenu.classList.add('opacity-0', 'invisible');
          adminChevron.classList.remove('rotate-180');
        } else {
          // Close other dropdowns first
          closeAllDropdowns();
          adminMenu.classList.remove('opacity-0', 'invisible');
          adminChevron.classList.add('rotate-180');
        }
      });
    }

    // ==================== LANGUAGE DROPDOWN ====================
    const langBtn = document.getElementById('lang-btn');
    const langMenu = document.getElementById('lang-menu');
    const langDisplay = document.getElementById('lang-display');
    const langChevron = document.getElementById('lang-chevron');
    const langButtons = document.querySelectorAll('[data-lang]');
    const mobileLangSelect = document.getElementById('mobile-lang-select');

    // Initialize language from Laravel session
    const currentLanguage = '{{ app()->getLocale() }}';
    updateLanguageUI(currentLanguage);

    if (langBtn && langMenu && langChevron) {
      langBtn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        const isVisible = !langMenu.classList.contains('invisible');
        
        if (isVisible) {
          langMenu.classList.add('opacity-0', 'invisible');
          langChevron.classList.remove('rotate-180');
        } else {
          // Close other dropdowns first
          closeAllDropdowns();
          langMenu.classList.remove('opacity-0', 'invisible');
          langChevron.classList.add('rotate-180');
        }
      });
    }

    // Language selection
    langButtons.forEach(btn => {
      btn.addEventListener('click', function(e) {
        e.preventDefault();
        e.stopPropagation();
        // Let the link handle the navigation to Laravel route
        window.location.href = this.href;
      });
    });

    // Mobile language select
    if (mobileLangSelect) {
      mobileLangSelect.addEventListener('change', function() {
        const selectedLang = this.value;
        localStorage.setItem('app_language', selectedLang);
        updateLanguageUI(selectedLang);
      });
    }

    function updateLanguageUI(lang) {
      if (langDisplay) {
        langDisplay.textContent = lang.toUpperCase();
      }
      
      if (mobileLangSelect) {
        mobileLangSelect.value = lang;
      }
      
      // Update checkmarks
      const checkId = document.getElementById('check-id');
      const checkEn = document.getElementById('check-en');
      
      if (checkId && checkEn) {
        if (lang === 'id') {
          checkId.classList.remove('hidden');
          checkEn.classList.add('hidden');
        } else {
          checkId.classList.add('hidden');
          checkEn.classList.remove('hidden');
        }
      }
      
      // Emit language change event
      window.dispatchEvent(new CustomEvent('language-changed', { detail: { language: lang } }));
    }

    // ==================== DARK MODE TOGGLE ====================


    // ==================== MOBILE DROPDOWNS ====================
    const mobileDataInfoBtn = document.getElementById('mobile-data-info-btn');
    const mobileDataInfoMenu = document.getElementById('mobile-data-info-menu');
    const mobileAdminBtn = document.getElementById('mobile-admin-btn');
    const mobileAdminMenu = document.getElementById('mobile-admin-menu');

    if (mobileDataInfoBtn && mobileDataInfoMenu) {
      mobileDataInfoBtn.addEventListener('click', function(e) {
        e.preventDefault();
        mobileDataInfoMenu.classList.toggle('hidden');
        
        // Rotate chevron
        const chevron = this.querySelector('i.fa-chevron-down');
        if (chevron) {
          chevron.classList.toggle('rotate-180');
        }
      });
    }

    if (mobileAdminBtn && mobileAdminMenu) {
      mobileAdminBtn.addEventListener('click', function(e) {
        e.preventDefault();
        mobileAdminMenu.classList.toggle('hidden');
        
        // Rotate chevron
        const chevron = this.querySelector('i.fa-chevron-down');
        if (chevron) {
          chevron.classList.toggle('rotate-180');
        }
      });
    }

    // ==================== CLOSE DROPDOWNS ====================
    function closeAllDropdowns() {
      // Close Infobase dropdown
      if (dataInfoMenu && dataInfoChevron) {
        dataInfoMenu.classList.add('opacity-0', 'invisible');
        dataInfoChevron.classList.remove('rotate-180');
      }
      
      // Close Admin dropdown
      if (adminMenu && adminChevron) {
        adminMenu.classList.add('opacity-0', 'invisible');
        adminChevron.classList.remove('rotate-180');
      }
      
      // Close Language dropdown
      if (langMenu && langChevron) {
        langMenu.classList.add('opacity-0', 'invisible');
        langChevron.classList.remove('rotate-180');
      }
    }

    // Click outside to close dropdowns
    document.addEventListener('click', function(e) {
      const isDropdownElement = e.target.closest('#data-info-btn, #data-info-menu, #admin-btn, #admin-menu, #lang-btn, #lang-menu');
      
      if (!isDropdownElement) {
        closeAllDropdowns();
      }
    });

    // Close mobile menu when clicking on links
    const mobileLinks = document.querySelectorAll('#mobile-menu a');
    mobileLinks.forEach(link => {
      link.addEventListener('click', function() {
        if (mobileMenu && navToggle) {
          mobileMenu.classList.add('hidden');
          navToggle.setAttribute('aria-expanded', 'false');
          
          const icon = navToggle.querySelector('i');
          if (icon) {
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
          }
        }
      });
    });

    // ==================== ESCAPE KEY HANDLER ====================
    document.addEventListener('keydown', function(e) {
      if (e.key === 'Escape') {
        closeAllDropdowns();
        
        if (mobileMenu && !mobileMenu.classList.contains('hidden')) {
          mobileMenu.classList.add('hidden');
          if (navToggle) {
            navToggle.setAttribute('aria-expanded', 'false');
            const icon = navToggle.querySelector('i');
            if (icon) {
              icon.classList.remove('fa-times');
              icon.classList.add('fa-bars');
            }
          }
        }
      }
    });
  });
</script>