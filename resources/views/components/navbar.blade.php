<style>
  /* ==================== NAVBAR BASE STATE (TRANSPARENT FOR HOME, DEFAULT FOR NON-HOME) ==================== */
  
  /* HOME PAGE - Make header fully transparent initially */
  header.navbar-home {
    background: transparent !important;
    background-color: transparent !important;
    background-image: none !important;
    border: none !important;
    border-bottom: none !important;
    box-shadow: none !important;
    transition: all 0.4s ease !important;
  }

  /* Ensure nav inside header is also transparent - HOME */
  header.navbar-home nav {
    background: transparent !important;
    background-color: transparent !important;
  }

  /* All child elements should be transparent background initially - HOME */
  header.navbar-home > * {
    background: transparent !important;
    background-color: transparent !important;
  }

  /* DEFAULT NAVBAR - Non-home pages - has white background */
  header.navbar-default {
    background-color: white !important;
    background-image: none !important;
    border-bottom: 1px solid #e5e7eb !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
    transition: all 0.4s ease !important;
  }

  header.navbar-default nav {
    background-color: white !important;
    background-image: none !important;
  }

  /* Force WHITE text on all elements - ONLY FOR HOME PAGE */
  header.navbar-home,
  header.navbar-home div,
  header.navbar-home span,
  header.navbar-home a,
  header.navbar-home button,
  header.navbar-home li,
  header.navbar-home ul,
  header.navbar-home button > i {
    color: white !important;
  }

  /* Override any Tailwind color classes to white - ONLY FOR HOME PAGE */
  header.navbar-home .text-gray-700,
  header.navbar-home .text-gray-800,
  header.navbar-home .text-black,
  header.navbar-home .text-slate-900,
  header.navbar-home .text-gray-900,
  header.navbar-home .text-white,
  header.navbar-home.text-gray-700,
  header.navbar-home.text-gray-800,
  header.navbar-home.text-black {
    color: white !important;
  }

  /* Default navbar - DARK TEXT */
  header.navbar-default,
  header.navbar-default div,
  header.navbar-default span,
  header.navbar-default a,
  header.navbar-default button,
  header.navbar-default li,
  header.navbar-default ul,
  header.navbar-default i,
  header.navbar-default * {
    color: #111827 !important;
  }

  /* Force override all Tailwind text colors for non-home */
  header.navbar-default .text-white,
  header.navbar-default .text-gray-700,
  header.navbar-default .text-gray-800,
  header.navbar-default .text-black,
  header.navbar-default .text-slate-900,
  header.navbar-default .text-gray-900 {
    color: #111827 !important;
  }

  /* Orange text becomes lighter orange on transparent bg - HOME ONLY */
  header.navbar-home .text-orange-300 {
    color: #fcd34d !important;
  }

  header.navbar-home .text-orange-400,
  header.navbar-home .text-orange-500 {
    color: #fbbf24 !important;
  }

  /* Brand logo styling - initial state - HOME */
  header.navbar-home .brand-logo-text {
    color: white !important;
  }

  header.navbar-home .brand-logo-text span {
    color: #fbbf24 !important;
  }

  header.navbar-home .brand-logo-subtitle {
    color: rgba(255, 255, 255, 0.85) !important;
  }

  header.navbar-home .brand-logo-icon {
    background-color: #f97316 !important;
    color: white !important;
  }

  /* Navigation buttons - UPPERCASE WHITE - HOME ONLY */
  header.navbar-home .nav-links a {
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    font-size: 0.95rem !important;
    color: white !important;
    background: none !important;
  }

  /* HOME NAVBAR HOVER - ONLY ORANGE UNDERLINE, NO BACKGROUND */
  header.navbar-home .nav-links a:hover {
    color: #fcd34d !important;
    background: transparent !important;
  }

  header.navbar-home #data-info-btn,
  header.navbar-home #lang-btn,
  header.navbar-home #admin-btn {
    color: white !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    background: none !important;
  }

  /* HOME BUTTONS HOVER - ONLY ORANGE TEXT, NO BACKGROUND */
  header.navbar-home #data-info-btn:hover,
  header.navbar-home #lang-btn:hover {
    color: #fcd34d !important;
    background: transparent !important;
  }

  header.navbar-home .fa-bars,
  header.navbar-home .fa-times,
  header.navbar-home i {
    color: white !important;
  }

  /* DEFAULT NAVBAR - NON-HOME - DARK TEXT */
  header.navbar-default .brand-logo-text {
    color: #f97316 !important;
  }

  header.navbar-default .brand-logo-text span {
    color: #f97316 !important;
  }

  header.navbar-default .brand-logo-subtitle {
    color: #6b7280 !important;
  }

  header.navbar-default .nav-links a {
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
    font-size: 0.95rem !important;
    color: #111827 !important;
  }

  header.navbar-default .nav-links a:hover {
    color: #f97316 !important;
  }

  header.navbar-default #data-info-btn,
  header.navbar-default #lang-btn,
  header.navbar-default #admin-btn {
    color: #111827 !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
  }

  header.navbar-default .fa-bars,
  header.navbar-default .fa-times,
  header.navbar-default i {
    color: #111827 !important;
  }

  header.navbar-default .fa-bars:hover,
  header.navbar-default .fa-times:hover {
    color: #f97316 !important;
  }
  header.navbar-default #lang-btn:hover {
    color: #f97316 !important;
  }

  header.navbar-default #admin-btn {
    background-color: #f85e38 !important;
  }

  header.navbar-default #admin-btn:hover {
    background-color: #d94e2e !important;
    color: white !important;
  }

  /* ==================== NAVBAR SCROLLED STATE - HOME ONLY ==================== */

  header.navbar-home.navbar-scrolled {
    background-color: white !important;
    background: white !important;
    background-image: none !important;
    border-bottom: 1px solid #e5e7eb !important;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08) !important;
  }

  /* Keep children transparent in scrolled state */
  header.navbar-home.navbar-scrolled nav,
  header.navbar-home.navbar-scrolled > div {
    background: transparent !important;
    background-color: transparent !important;
  }

  /* All text becomes DARK when scrolled */
  header.navbar-home.navbar-scrolled,
  header.navbar-home.navbar-scrolled div,
  header.navbar-home.navbar-scrolled span,
  header.navbar-home.navbar-scrolled a,
  header.navbar-home.navbar-scrolled button,
  header.navbar-home.navbar-scrolled li,
  header.navbar-home.navbar-scrolled ul,
  header.navbar-home.navbar-scrolled i {
    color: #111827 !important;
  }

  /* Override Tailwind colors when scrolled */
  header.navbar-home.navbar-scrolled .text-white,
  header.navbar-home.navbar-scrolled .text-gray-700,
  header.navbar-home.navbar-scrolled .text-gray-800,
  header.navbar-home.navbar-scrolled .text-orange-300,
  header.navbar-home.navbar-scrolled .text-orange-400,
  header.navbar-home.navbar-scrolled .text-orange-500 {
    color: #111827 !important;
  }

  /* Brand styling when scrolled */
  header.navbar-home.navbar-scrolled .brand-logo-text {
    color: #111827 !important;
  }

  header.navbar-home.navbar-scrolled .brand-logo-text span {
    color: #f97316 !important;
  }

  header.navbar-home.navbar-scrolled .brand-logo-subtitle {
    color: #111827 !important;
  }

  header.navbar-home.navbar-scrolled .brand-logo-icon {
    background-color: #f97316 !important;
    color: white !important;
  }

  /* Navigation links styling when scrolled */
  header.navbar-home.navbar-scrolled .nav-links a {
    color: #111827 !important;
    text-transform: uppercase !important;
  }

  header.navbar-home.navbar-scrolled .nav-links a:hover {
    color: #f97316 !important;
  }

  /* Buttons styling when scrolled */
  header.navbar-home.navbar-scrolled #data-info-btn,
  header.navbar-home.navbar-scrolled #lang-btn {
    color: #111827 !important;
  }

  header.navbar-home.navbar-scrolled #data-info-btn:hover,
  header.navbar-home.navbar-scrolled #lang-btn:hover {
    color: #f97316 !important;
  }

  header.navbar-home.navbar-scrolled #admin-btn {
    background-color: #f97316 !important;
    color: white !important;
  }

  header.navbar-home.navbar-scrolled #admin-btn:hover {
    background-color: #ea580c !important;
  }

  /* Icons when scrolled */
  header.navbar-home.navbar-scrolled .fa-bars,
  header.navbar-home.navbar-scrolled .fa-times {
    color: #111827 !important;
  }

  header.navbar-home.navbar-scrolled .fa-bars:hover,
  header.navbar-home.navbar-scrolled .fa-times:hover {
    background-color: #f3f4f6 !important;
    color: #111827 !important;
  }

  /* Mobile menu when scrolled */
  header.navbar-home.navbar-scrolled #mobile-menu {
    background-color: white !important;
    border-top: 1px solid #e5e7eb !important;
  }

  header.navbar-home.navbar-scrolled #mobile-menu a {
    color: #111827 !important;
  }

  /* ==================== DROPDOWN PROTECTION - Always consistent style ==================== */
  /* Ensure dropdowns are never affected by scroll state */
  #data-info-menu,
  #lang-menu,
  #admin-menu,
  #mobile-data-info-menu,
  #mobile-admin-menu,
  header #data-info-menu,
  header #lang-menu,
  header #admin-menu {
    background-color: white !important;
    color: #111827 !important;
  }

  #data-info-menu a,
  #lang-menu a,
  #admin-menu a,
  #mobile-data-info-menu a,
  #mobile-admin-menu a,
  header #data-info-menu a,
  header #lang-menu a,
  header #admin-menu a {
    color: #111827 !important;
  }

  /* Ensure text inside dropdown links is visible */
  #data-info-menu a p,
  #lang-menu a p,
  #admin-menu a p,
  #mobile-data-info-menu a p,
  #mobile-admin-menu a p,
  header #data-info-menu a p,
  header #lang-menu a p,
  header #admin-menu a p {
    color: #111827 !important;
  }

  #data-info-menu a:hover,
  #lang-menu a:hover,
  #admin-menu a:hover,
  #mobile-data-info-menu a:hover,
  #mobile-admin-menu a:hover,
  header #data-info-menu a:hover,
  header #lang-menu a:hover,
  header #admin-menu a:hover {
    color: #f97316 !important;
    background-color: #f3f4f6 !important;
  }

  /* Smooth transitions for all elements */
  header,
  header *,
  header > * {
    transition: all 0.4s ease !important;
  }

  /* Enhanced Brand Logo Sizing */
  .brand-logo-icon {
    width: 2.5rem !important;
    height: 2.5rem !important;
    font-size: 1.25rem !important;
  }

  .brand-logo-text {
    font-size: 1.125rem !important;
    font-weight: 800 !important;
    line-height: 1.1 !important;
  }

  .brand-logo-subtitle {
    font-size: 0.75rem !important;
    margin-top: 0.25rem !important;
  }
</style>

<header class="@if(Route::currentRouteName() === 'home') fixed navbar-home @else sticky navbar-default @endif top-0 left-0 right-0 z-50 w-full">
  <nav class="w-full px-4 md:px-6 lg:px-8 py-4">
    <div class="flex items-center justify-between gap-6 lg:gap-8">
      <!-- Logo - Left -->
      <a href="{{ route('home') }}" class="brand-logo group flex-shrink-0">
        <div class="brand-logo-icon bg-orange-500 text-white">
          <i class="fas fa-book"></i>
        </div>
        <div class="hidden sm:block">
          <h1 class="brand-logo-text text-orange-400 tracking-tighter transition-colors">INFO<span class="text-orange-400 transition-colors">BASE</span></h1>
          <p class="brand-logo-subtitle">{{ __('messages.library_name') }}</p>
        </div>
      </a>

      <!-- Desktop Navigation Links - Center -->
      <ul id="nav-links" class="hidden lg:flex items-center gap-12 flex-1 justify-center nav-links">
        <li>
          <a href="{{ route('home') }}" class="text-white font-semibold hover:text-orange-300 transition duration-300 relative group/link whitespace-nowrap text-base">
            {{ __('messages.home') }}
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-300 group-hover/link:w-full transition-all duration-300"></span>
          </a>
        </li>
        <li>
          <a href="{{ route('about') }}" class="text-white font-semibold hover:text-orange-300 transition duration-300 relative group/link whitespace-nowrap text-base">
            {{ __('messages.about_us') }}
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-300 group-hover/link:w-full transition-all duration-300"></span>
          </a>
        </li>
        <li class="relative">
          <button id="data-info-btn" class="flex items-center gap-2 text-white font-semibold hover:text-orange-300 transition duration-300 relative group/link cursor-pointer whitespace-nowrap text-base">
            {{ __('messages.infobase') }}
            <i id="data-info-chevron" class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            <span class="absolute bottom-0 left-0 w-0 h-0.5 bg-orange-300 group-hover/link:w-full transition-all duration-300"></span>
          </button>

          <!-- Dropdown Menu -->
          <div id="data-info-menu" class="absolute top-full left-0 mt-3 w-48 bg-white border border-gray-200 rounded-xl shadow-lg opacity-0 invisible transition-all duration-300 py-2 z-50">
            <a href="{{ route('infobase.pengumuman') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 transition duration-200 text-sm font-medium">
              {{ __('messages.announcements') }}
            </a>
            <a href="{{ route('infobase.calendar-aktifitas') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 border-b border-gray-100 transition duration-200 text-sm font-medium">
              {{ __('messages.calendar') }}
            </a>
            <a href="{{ route('infobase.profile-ruangan') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 border-b border-gray-100 transition duration-200 text-sm font-medium">
              {{ __('messages.room_profiles') }}
            </a>
            <a href="{{ route('infobase.tata-tertib') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 border-b border-gray-100 transition duration-200 text-sm font-medium">
              {{ __('messages.rules') }}
            </a>
            <a href="{{ route('infobase.staff-of-month') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 border-b border-gray-100 transition duration-200 text-sm font-medium">
              {{ __('messages.staff_of_month') }}
            </a>
            <a href="{{ route('infobase.profil-pegawai') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 transition duration-200 text-sm font-medium">
              {{ __('messages.staff_profiles') }}
            </a>
          </div>
        </li>
      </ul>

      <!-- Language & Dark Mode - Center Right -->
      <div class="hidden lg:flex items-center gap-3">
        <!-- Language Selector -->
        <div class="relative">
          <button id="lang-btn" class="flex items-center gap-2 px-3 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-lg transition duration-300 whitespace-nowrap text-sm font-medium">
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
            <button id="admin-btn" class="flex items-center gap-2 px-5 py-2 bg-[#f85e38] text-white font-semibold rounded-lg hover:bg-[#d94e2e] transition duration-300 shadow-md hover:shadow-lg whitespace-nowrap">
              <i class="fas fa-user-shield"></i>
              Admin
              <i id="admin-chevron" class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            </button>

            <!-- Dropdown Menu -->
            <div id="admin-menu" class="absolute top-full right-0 mt-3 w-48 bg-white border border-gray-200 rounded-xl shadow-lg opacity-0 invisible transition-all duration-300 py-2 z-50">
              @if(Route::has('admin.pengumuman.index'))
              <a href="{{ route('admin.pengumuman.index') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 transition duration-200 text-sm font-medium">
                {{ __('messages.announcements') }}
              </a>
              @endif

              @if(Route::has('admin.calendar.index'))
              <a href="{{ route('admin.calendar.index') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 border-t border-gray-100 transition duration-200 text-sm font-medium">
                {{ __('messages.calendar') }}
              </a>
              @endif

              @if(Route::has('admin.profile.index'))
              <a href="{{ route('admin.profile.index') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 border-t border-gray-100 transition duration-200 text-sm font-medium">
                Profile Ruangan
              </a>
              @endif

              @if(Route::has('admin.tata_tertib.index'))
              <a href="{{ route('admin.tata_tertib.index') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 border-t border-gray-100 transition duration-200 text-sm font-medium">
                Tata Tertib
              </a>
              @endif

              @if(Route::has('admin.staff-of-month.index'))
              <a href="{{ route('admin.staff-of-month.index') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 border-t border-gray-100 transition duration-200 text-sm font-medium">
                Staff of Month
              </a>
              @endif

              @if(Route::has('admin.profil_pegawai.index'))
              <a href="{{ route('admin.profil_pegawai.index') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 border-t border-gray-100 transition duration-200 text-sm font-medium">
                Profil Pegawai
              </a>
              @endif

              @if(Route::has('admin.gallery.index'))
              <a href="{{ route('admin.gallery.index') }}" class="block px-5 py-3 text-gray-700 hover:text-[#f97316] hover:bg-gray-50 border-t border-gray-100 transition duration-200 text-sm font-medium">
                Galeri
              </a>
              @endif

              <form action="{{ route('admin.logout') }}" method="POST" class="mt-1">
                @csrf
                <button type="submit" class="w-full text-left px-5 py-3 text-red-600 hover:text-red-700 hover:bg-red-50 transition duration-200 font-medium text-sm border-t border-gray-100">
                  Keluar
                </button>
              </form>
            </div>
          </div>
        @endauth
      </div>

      <!-- Mobile Menu Toggle -->
      <button id="nav-toggle" aria-controls="mobile-menu" aria-expanded="false" class="lg:hidden p-1.5 text-black hover:bg-gray-100 rounded-lg transition duration-300">
        <i class="fas fa-bars text-xl"></i>
      </button>
    </div>

    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden lg:hidden mt-4 pb-4 border-t border-gray-200">
      <!-- Mobile Language & Dark Mode Controls -->
      <div class="flex items-center justify-between gap-2 px-4 py-3 mb-4 bg-gray-100 rounded-lg">
        <div class="flex items-center gap-2">
          <i class="fas fa-globe text-[#f85e38]"></i>
          <select id="mobile-lang-select" class="bg-transparent text-black text-sm font-medium outline-none cursor-pointer">
            <option value="id" class="bg-white text-black" {{ app()->getLocale() == 'id' ? 'selected' : '' }}>ID</option>
            <option value="en" class="bg-white text-black" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>EN</option>
          </select>
        </div>
      </div>

      <ul class="space-y-2">
        <li>
          <a href="{{ route('home') }}" class="block px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition duration-300 font-medium">
            {{ __('messages.home') }}
          </a>
        </li>
        <li>
          <a href="{{ route('about') }}" class="block px-4 py-3 text-black hover:bg-gray-100 rounded-lg transition duration-300 font-medium">
            {{ __('messages.about_us') }}
          </a>
        </li>
        <li class="border-t border-gray-200 pt-4 mt-4">
          <button id="mobile-data-info-btn" class="w-full flex items-center justify-between px-4 py-3 text-black hover:bg-gray-100 rounded-lg font-medium transition duration-300">
            Infobase
            <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
          </button>

          <div id="mobile-data-info-menu" class="hidden mt-2 space-y-1 pl-4 bg-gray-50 rounded-xl overflow-hidden shadow-inner">
            <a href="{{ route('infobase.pengumuman') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white hover:text-[#00425A] transition duration-300 transform hover:translate-x-1">
              <div class="w-8 h-8 rounded-lg bg-[#00425A]/10 flex items-center justify-center text-[#00425A]">
                <i class="fas fa-bullhorn"></i>
              </div>
              <span class="text-sm font-semibold">{{ __('messages.announcements') }}</span>
            </a>
            <a href="{{ route('infobase.calendar-aktifitas') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white hover:text-[#f85e38] transition duration-300 transform hover:translate-x-1">
              <div class="w-8 h-8 rounded-lg bg-[#f85e38]/10 flex items-center justify-center text-[#f85e38]">
                <i class="fas fa-calendar-alt"></i>
              </div>
              <span class="text-sm font-semibold">{{ __('messages.calendar') }}</span>
            </a>
            <a href="{{ route('infobase.profile-ruangan') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white hover:text-[#00425A] transition duration-300 transform hover:translate-x-1">
              <div class="w-8 h-8 rounded-lg bg-[#00425A]/10 flex items-center justify-center text-[#00425A]">
                <i class="fas fa-door-open"></i>
              </div>
              <span class="text-sm font-semibold">{{ __('messages.room_profiles') }}</span>
            </a>
            <a href="{{ route('infobase.tata-tertib') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white hover:text-[#f85e38] transition duration-300 transform hover:translate-x-1">
              <div class="w-8 h-8 rounded-lg bg-[#f85e38]/10 flex items-center justify-center text-[#f85e38]">
                <i class="fas fa-book"></i>
              </div>
              <span class="text-sm font-semibold">{{ __('messages.rules') }}</span>
            </a>
            <a href="{{ route('infobase.staff-of-month') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white hover:text-[#00425A] transition duration-300 transform hover:translate-x-1">
              <div class="w-8 h-8 rounded-lg bg-[#00425A]/10 flex items-center justify-center text-[#00425A]">
                <i class="fas fa-star"></i>
              </div>
              <span class="text-sm font-semibold">{{ __('messages.staff_of_month') }}</span>
            </a>
            <a href="{{ route('infobase.profil-pegawai') }}" class="flex items-center gap-3 px-4 py-3 text-gray-700 hover:bg-white hover:text-[#f85e38] transition duration-300 transform hover:translate-x-1">
              <div class="w-8 h-8 rounded-lg bg-[#f85e38]/10 flex items-center justify-center text-[#f85e38]">
                <i class="fas fa-users"></i>
              </div>
              <span class="text-sm font-semibold">{{ __('messages.staff_profiles') }}</span>
            </a>
          </div>
        </li>

        <li class="border-t border-gray-200 pt-4 mt-4">
          @auth
            <button id="mobile-admin-btn" class="w-full flex items-center justify-between px-4 py-2 bg-[#f85e38] text-white rounded-lg font-semibold hover:bg-[#d94e2e] transition duration-300">
              <span class="flex items-center gap-2">
                <i class="fas fa-user-shield"></i>
                Admin
              </span>
              <i class="fas fa-chevron-down text-xs transition-transform duration-300"></i>
            </button>

            <div id="mobile-admin-menu" class="hidden mt-2 space-y-1 pl-4 bg-gray-50 rounded-xl overflow-hidden shadow-inner">
              @if(Route::has('admin.pengumuman.index'))
              <a href="{{ route('admin.pengumuman.index') }}" class="block px-4 py-3 text-gray-700 hover:text-[#f85e38] hover:bg-white transition duration-300">
                <span class="text-sm font-semibold">{{ __('messages.announcements') }}</span>
              </a>
              @endif

              @if(Route::has('admin.calendar.index'))
              <a href="{{ route('admin.calendar.index') }}" class="block px-4 py-3 text-gray-700 hover:text-[#f85e38] hover:bg-white transition duration-300 border-t border-gray-200">
                <span class="text-sm font-semibold">{{ __('messages.calendar') }}</span>
              </a>
              @endif

              @if(Route::has('admin.profile.index'))
              <a href="{{ route('admin.profile.index') }}" class="block px-4 py-3 text-gray-700 hover:text-[#f85e38] hover:bg-white transition duration-300 border-t border-gray-200">
                <span class="text-sm font-semibold">Profile Ruangan</span>
              </a>
              @endif

              @if(Route::has('admin.tata_tertib.index'))
              <a href="{{ route('admin.tata_tertib.index') }}" class="block px-4 py-3 text-gray-700 hover:text-[#f85e38] hover:bg-white transition duration-300 border-t border-gray-200">
                <span class="text-sm font-semibold">Tata Tertib</span>
              </a>
              @endif

              @if(Route::has('admin.staff-of-month.index'))
              <a href="{{ route('admin.staff-of-month.index') }}" class="block px-4 py-3 text-gray-700 hover:text-[#f85e38] hover:bg-white transition duration-300 border-t border-gray-200">
                <span class="text-sm font-semibold">Staff of Month</span>
              </a>
              @endif

              @if(Route::has('admin.profil_pegawai.index'))
              <a href="{{ route('admin.profil_pegawai.index') }}" class="block px-4 py-3 text-gray-700 hover:text-[#f85e38] hover:bg-white transition duration-300 border-t border-gray-200">
                <span class="text-sm font-semibold">Profil Pegawai</span>
              </a>
              @endif

              @if(Route::has('admin.gallery.index'))
              <a href="{{ route('admin.gallery.index') }}" class="block px-4 py-3 text-gray-700 hover:text-[#f85e38] hover:bg-white transition duration-300 border-t border-gray-200">
                <span class="text-sm font-semibold">Galeri</span>
              </a>
              @endif

              <form action="{{ route('admin.logout') }}" method="POST" class="pt-2 border-t border-gray-200">
                @csrf
                <button type="submit" class="w-full text-left px-4 py-3 text-red-600 hover:text-red-700 hover:bg-red-50 transition duration-300 font-semibold text-sm">
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
        
        // Close the dropdown first
        if (langMenu && langChevron) {
          langMenu.classList.add('opacity-0', 'invisible');
          langChevron.classList.remove('rotate-180');
        }
        
        // Navigate to Laravel language switch route
        window.location.href = this.href;
      });
    });

    // Mobile language select
    if (mobileLangSelect) {
      mobileLangSelect.addEventListener('change', function() {
        const selectedLang = this.value;
        // Navigate to Laravel language switch route
        window.location.href = '/language/' + selectedLang;
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

    // ==================== NAVBAR SCROLL EFFECT - HOME ONLY ==================== 
    const header = document.querySelector('header');
    const scrollThreshold = 50;
    const isHomePage = header.classList.contains('navbar-home');

    // Debug: Check initial state
    console.log('Navbar initialized. Is home page?', isHomePage);
    console.log('Scroll threshold:', scrollThreshold);
    console.log('Initial scroll position:', window.scrollY);
    
    // Only apply scroll effect to home page
    if (isHomePage) {
      console.log('Scroll effect enabled for home page');
      
      window.addEventListener('scroll', function() {
        const scrollPosition = window.scrollY || document.documentElement.scrollTop;
        const hasScrolledClass = header.classList.contains('navbar-scrolled');
        
        if (scrollPosition > scrollThreshold) {
          if (!hasScrolledClass) {
            header.classList.add('navbar-scrolled');
            console.log('✓ Added navbar-scrolled class at scroll position:', scrollPosition);
          }
        } else {
          if (hasScrolledClass) {
            header.classList.remove('navbar-scrolled');
            console.log('✓ Removed navbar-scrolled class at scroll position:', scrollPosition);
          }
        }
      });

      // Initialize navbar state on page load
      const initialScrollPosition = window.scrollY || document.documentElement.scrollTop;
      if (initialScrollPosition > scrollThreshold) {
        header.classList.add('navbar-scrolled');
        console.log('✓ Added navbar-scrolled class on page load');
      } else {
        header.classList.remove('navbar-scrolled');
        console.log('✓ Ensured navbar-scrolled class NOT present on page load');
      }
    } else {
      console.log('Scroll effect DISABLED - not home page');
    }
  });
</script>