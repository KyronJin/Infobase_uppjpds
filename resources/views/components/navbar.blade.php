<header class="site-header">
  <nav id="site-nav" class="navbar">
    <div class="site-container" style="display:flex;align-items:center;justify-content:space-between;gap:12px;">
      <div style="display:flex;align-items:center;gap:12px;">
        <a href="{{ route('home') }}" class="logo">INFOBASE</a>
      </div>

      <ul id="nav-links" class="nav-links" role="menubar" style="margin-left:auto;">
        <li><a href="{{ route('home') }}" class="nav-link">Beranda</a></li>
        <li><a href="{{ route('infobase') }}" class="nav-link">InfoBase</a></li>
        <li><a href="{{ route('about') }}" class="nav-link">Tentang</a></li>
        <li><a href="{{ route('contact') }}" class="nav-link">Kontak</a></li>
      </ul>

      <button id="nav-toggle" aria-controls="mobile-menu" aria-expanded="false" aria-label="Toggle menu" class="nav-toggle" style="margin-left:12px;padding:8px;display:flex;align-items:center;justify-content:center;">
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 6h16M4 12h16M4 18h16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
        </svg>
      </button>

      <div style="display:flex;align-items:center;gap:10px;margin-left:18px;position:relative;">
        @auth
          <div style="position:relative;display:inline-block;" class="admin-dropdown">
            <button id="admin-btn" style="padding:8px 12px;background:#0f766e;color:white;border-radius:6px;font-weight:600;cursor:pointer;border:none;font-size:14px;display:flex;align-items:center;gap:6px;">
              Admin
              <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <polyline points="6 9 12 15 18 9"></polyline>
              </svg>
            </button>
            <div id="admin-menu" style="position:absolute;top:100%;right:0;background:white;border:1px solid #e2e8f0;border-radius:8px;min-width:220px;box-shadow:0 10px 15px rgba(0,0,0,0.1);margin-top:8px;z-index:1000;display:none;">
              @if(Route::has('admin.pengumuman.index'))
              <a href="{{ route('admin.pengumuman.index') }}" style="display:block;padding:12px 16px;color:#111;text-decoration:none;border-bottom:1px solid #f1f5f9;font-size:14px;transition:background 0.2s;">
                📢 Pengumuman
              </a>
              @endif
              @if(Route::has('admin.calendar.index'))
              <a href="{{ route('admin.calendar.index') }}" style="display:block;padding:12px 16px;color:#111;text-decoration:none;border-bottom:1px solid #f1f5f9;font-size:14px;transition:background 0.2s;">
                📅 Calendar Events
              </a>
              @endif
              @if(Route::has('admin.profile.index'))
              <a href="{{ route('admin.profile.index') }}" style="display:block;padding:12px 16px;color:#111;text-decoration:none;border-bottom:1px solid #f1f5f9;font-size:14px;transition:background 0.2s;">
                🏢 Profile Ruangan
              </a>
              @endif
              @if(Route::has('admin.tata_tertib.index'))
              <a href="{{ route('admin.tata_tertib.index') }}" style="display:block;padding:12px 16px;color:#111;text-decoration:none;border-bottom:1px solid #f1f5f9;font-size:14px;transition:background 0.2s;">
                📋 Tata Tertib
              </a>
              @endif
              <form action="{{ route('admin.logout') }}" method="POST" style="display:block;margin:0;">
                @csrf
                <button style="width:100%;padding:12px 16px;color:#dc2626;text-decoration:none;border:none;background:transparent;cursor:pointer;font-size:14px;text-align:left;" onmouseover="this.style.backgroundColor='#fee2e2'" onmouseout="this.style.backgroundColor='transparent'">
                  🚪 Keluar
                </button>
              </form>
            </div>
          </div>
        @else
          <a href="{{ Route::has('admin.login') ? route('admin.login') : '#' }}" class="nav-cta">Masuk</a>
        @endauth
      </div>
    </div>
  </nav>

  <!-- simple mobile menu (keeps markup minimal) -->
  <div id="mobile-menu" class="mobile-menu hidden" aria-hidden="true">
    <ul class="mobile-links" role="menu">
      <li><a href="{{ route('home') }}" class="nav-link">Beranda</a></li>
      <li><a href="{{ route('infobase') }}" class="nav-link">InfoBase</a></li>
      <li><a href="{{ route('about') }}" class="nav-link">Tentang</a></li>
      <li><a href="{{ route('contact') }}" class="nav-link">Kontak</a></li>
    </ul>
  </div>

  <script>
    (function(){
      var toggle = document.getElementById('nav-toggle');
      var mobile = document.getElementById('mobile-menu');
      if(toggle && mobile){
        toggle.addEventListener('click', function(){
          var expanded = toggle.getAttribute('aria-expanded') === 'true';
          toggle.setAttribute('aria-expanded', expanded ? 'false' : 'true');
          mobile.classList.toggle('hidden');
          mobile.setAttribute('aria-hidden', expanded ? 'true' : 'false');
        });
      }

      // Admin dropdown menu handler
      var adminBtn = document.getElementById('admin-btn');
      var adminMenu = document.getElementById('admin-menu');
      if(adminBtn && adminMenu){
        adminBtn.addEventListener('click', function(e){
          e.preventDefault();
          e.stopPropagation();
          adminMenu.style.display = adminMenu.style.display === 'none' ? 'block' : 'none';
        });

        // Close dropdown when clicking outside
        document.addEventListener('click', function(e){
          if(!e.target.closest('.admin-dropdown')){
            adminMenu.style.display = 'none';
          }
        });

        // Add hover effects to menu items
        var menuItems = adminMenu.querySelectorAll('a, button');
        menuItems.forEach(function(item){
          item.addEventListener('mouseenter', function(){
            this.style.backgroundColor = '#f1f5f9';
          });
          item.addEventListener('mouseleave', function(){
            this.style.backgroundColor = 'transparent';
          });
        });
      }
    })();
  </script>
</header>
