<aside id="adminSidebar" class="fixed inset-y-0 left-0 z-50 w-72 bg-white border-r border-slate-200 shadow-sm transform -translate-x-full lg:translate-x-0 transition-transform duration-300">
    <div class="h-20 px-6 flex items-center border-b border-slate-100">
        <a href="<?php echo e(route('admin.dashboard')); ?>" class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl bg-[#063A76] text-white flex items-center justify-center">
                <i class="fas fa-shield-halved"></i>
            </div>
            <div>
                <p class="text-xs text-slate-500 font-semibold uppercase tracking-wide">Infobase</p>
                <h1 class="text-base font-bold text-[#063A76] leading-tight">Admin Panel</h1>
            </div>
        </a>
    </div>

    <nav class="px-4 py-4 space-y-1 overflow-y-auto h-[calc(100vh-80px)]">
        <a href="<?php echo e(route('admin.pengumuman.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.pengumuman.*') ? 'active' : ''); ?>">
            <i class="fas fa-bullhorn w-5"></i>
            <span>Pengumuman</span>
        </a>

        <a href="<?php echo e(route('admin.calendar.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.calendar.*') ? 'active' : ''); ?>">
            <i class="fas fa-calendar-days w-5"></i>
            <span>Calendar Aktifitas</span>
        </a>

        <a href="<?php echo e(route('admin.tata_tertib.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.tata_tertib.*') ? 'active' : ''); ?>">
            <i class="fas fa-list-check w-5"></i>
            <span>Tata Tertib</span>
        </a>

        <a href="<?php echo e(route('admin.profile.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.profile.*') ? 'active' : ''); ?>">
            <i class="fas fa-door-open w-5"></i>
            <span>Profile Ruangan</span>
        </a>

        <a href="<?php echo e(route('admin.profil_pegawai.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.profil_pegawai.*') ? 'active' : ''); ?>">
            <i class="fas fa-id-card w-5"></i>
            <span>Profil Pegawai</span>
        </a>

        <a href="<?php echo e(route('admin.staff-of-month.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.staff-of-month.*') ? 'active' : ''); ?>">
            <i class="fas fa-star w-5"></i>
            <span>Staff of Month</span>
        </a>

        <a href="<?php echo e(route('admin.gallery.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.gallery.*') ? 'active' : ''); ?>">
            <i class="fas fa-images w-5"></i>
            <span>Gallery</span>
        </a>

        <a href="<?php echo e(route('admin.users.index')); ?>" class="admin-nav-link <?php echo e(request()->routeIs('admin.users.*') ? 'active' : ''); ?>">
            <i class="fas fa-user-shield w-5"></i>
            <span>Akun Admin</span>
        </a>

        <div class="my-4 border-t border-slate-200"></div>

        <a href="<?php echo e(route('home')); ?>" class="admin-nav-link">
            <i class="fas fa-globe w-5"></i>
            <span>Lihat Website</span>
        </a>

        <form method="POST" action="<?php echo e(route('admin.logout')); ?>">
            <?php echo csrf_field(); ?>
            <button type="submit" class="admin-nav-link w-full text-left text-red-600 hover:bg-red-50 hover:text-red-700">
                <i class="fas fa-right-from-bracket w-5"></i>
                <span>Logout</span>
            </button>
        </form>
    </nav>
</aside>

<div id="adminSidebarBackdrop" class="fixed inset-0 z-40 bg-slate-900/40 hidden lg:hidden"></div>
<?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/components/admin/sidebar.blade.php ENDPATH**/ ?>