<!doctype html>
<html lang="id" class="scroll-smooth">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <title><?php echo e(config('app.name', 'INFOBASE')); ?></title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@300;400;500;600;700;800;900&family=Inter:wght@200;300;400;500;600;700;800;900&family=Source+Serif+4:ital,wght@1,400;1,600;1,700&display=swap" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <?php if(file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot'))): ?>
      <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/brand.css', 'resources/css/consistent-layout.css', 'resources/js/app.js']); ?>
    <?php else: ?>
      <link rel="stylesheet" href="<?php echo e(asset('css/app.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('css/brand.css')); ?>">
      <link rel="stylesheet" href="<?php echo e(asset('css/consistent-layout.css')); ?>">
    <?php endif; ?>

    <!-- jQuery & jQuery UI for Sortable -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.min.js"></script>

    <!-- Quill Rich Text Editor -->
    <link href="https://cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
    <script src="https://cdn.quilljs.com/1.3.6/quill.js"></script>
    <style>
        .ql-container {
            font-size: 16px;
            border-bottom-left-radius: 0.5rem;
            border-bottom-right-radius: 0.5rem;
        }
        .ql-editor {
            min-height: 300px;
            padding: 12px;
        }
        .ql-toolbar {
            border-top-left-radius: 0.5rem;
            border-top-right-radius: 0.5rem;
            border-color: #d1d5db;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize Quill editors for all elements with editor div containers
            const editorDivs = document.querySelectorAll('[id^="editor-"]');
            
            editorDivs.forEach(function(editorDiv) {
                // Extract the field name from the div id (e.g., editor-description -> description)
                const fieldName = editorDiv.id.replace('editor-', '');
                
                // Find the corresponding textarea
                const textarea = document.querySelector(`textarea[id="${fieldName}"]`);
                
                if (textarea) {
                    const quill = new Quill('#' + editorDiv.id, {
                        theme: 'snow',
                        placeholder: textarea.placeholder || 'Mulai mengetik...',
                        modules: {
                            toolbar: [
                                ['bold', 'italic', 'underline', 'strike'],
                                ['blockquote', 'code-block'],
                                [{ 'header': 1 }, { 'header': 2 }],
                                [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                                [{ 'script': 'sub'}, { 'script': 'super' }],
                                [{ 'indent': '-1'}, { 'indent': '+1' }],
                                [{ 'size': ['small', false, 'large', 'huge'] }],
                                [{ 'color': [] }, { 'background': [] }],
                                [{ 'align': [] }],
                                [{ 'font': [] }],
                                ['link', 'image', 'video'],
                                ['clean']
                            ]
                        }
                    });
                    
                    // Set initial content from textarea if it exists
                    if (textarea.value) {
                        quill.root.innerHTML = textarea.value;
                    }
                    
                    // Sync content to textarea on every text change
                    quill.on('text-change', function() {
                        textarea.value = quill.root.innerHTML;
                    });
                    
                    // Update textarea on form submit
                    const form = textarea.closest('form');
                    if (form) {
                        form.addEventListener('submit', function(e) {
                            textarea.value = quill.root.innerHTML;
                            console.log('Quill content updated to textarea:', textarea.value);
                        }, true); // Use capture phase to ensure it runs first
                    }
                    
                    // Store reference for later access
                    if (!window.quillEditors) window.quillEditors = {};
                    window.quillEditors[fieldName] = quill;
                    console.log('Quill editor initialized for field:', fieldName);
                }
            });
        });
    </script>

    <style>
        .toast-notification {
            position: fixed;
            bottom: 2rem;
            right: 2rem;
            padding: 1rem 1.5rem;
            border-radius: 0.5rem;
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1);
            z-index: 999;
            animation: slideInUp 0.3s ease-out, slideOutDown 0.3s ease-in 2.7s forwards;
            max-width: 400px;
        }

        .toast-success {
            background-color: #ECFDF1;
            border: 1px solid #86EFAC;
            color: #166534;
        }

        .toast-error {
            background-color: #FEE2E2;
            border: 1px solid #FECACA;
            color: #991B1B;
        }

        .toast-info {
            background-color: #F0F9FF;
            border: 1px solid #BAE6FD;
            color: #0C4A6E;
        }

        .toast-notification i {
            margin-right: 0.75rem;
            font-weight: bold;
        }

        @keyframes slideInUp {
            from {
                transform: translateY(100%);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        @keyframes slideOutDown {
            from {
                transform: translateY(0);
                opacity: 1;
            }
            to {
                transform: translateY(100%);
                opacity: 0;
            }
        }

        @media (max-width: 640px) {
            .toast-notification {
                bottom: 1rem;
                right: 1rem;
                left: 1rem;
                max-width: none;
            }
        }
    </style>

    <script>
        // Global toast notification functions
        function showToast(message, type = 'success', duration = 3000) {
            const container = document.body;
            const toast = document.createElement('div');
            
            toast.className = `toast-notification toast-${type}`;
            
            let icon = '';
            switch(type) {
                case 'success':
                    icon = '<i class="fas fa-check-circle"></i>';
                    break;
                case 'error':
                    icon = '<i class="fas fa-exclamation-circle"></i>';
                    break;
                case 'info':
                    icon = '<i class="fas fa-info-circle"></i>';
                    break;
                default:
                    icon = '<i class="fas fa-bell"></i>';
            }
            
            toast.innerHTML = `${icon}<span>${message}</span>`;
            container.appendChild(toast);
            
            setTimeout(() => {
                toast.remove();
            }, duration);
        }

        function showSuccessToast(message, duration = 3000) {
            showToast(message, 'success', duration);
        }

        function showErrorToast(message, duration = 3000) {
            showToast(message, 'error', duration);
        }

        function showInfoToast(message, duration = 3000) {
            showToast(message, 'info', duration);
        }
    </script>
    
  </head>
  <body class="bg-white text-gray-900 antialiased font-primary">
    <div id="app">
      <?php if ($__env->exists('components.navbar')) echo $__env->make('components.navbar', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

      <!-- Notification Toast -->
      <?php echo $__env->make('components.notification-toast', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

      <main class="min-h-screen">
        <?php echo $__env->yieldContent('content'); ?>
      </main>

      <!-- Global Delete Modal Component -->
      <?php $__env->startComponent('components.delete-modal', ['id' => 'globalDeleteModal', 'title' => 'Konfirmasi Hapus?']); ?> <?php echo $__env->renderComponent(); ?>
    </div>

      <!-- Footer -->
      <footer class="bg-[#00425A] dark:bg-slate-950 text-white mt-20">
        <div class="max-w-7xl mx-auto px-6 lg:px-12 py-16">
          <!-- Footer Content Grid -->
          <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
            <!-- Brand Section -->
            <div class="space-y-4">
              <h3 class="text-2xl font-bold  text-white">INFOBASE</h3>
              <p class="text-white dark:text-gray-300 text-opacity-80 leading-relaxed">
                Portal informasi terpadu Perpustakaan Jakarta untuk akses mudah pengumuman, jadwal, dan fasilitas.
              </p>
              <div class="flex gap-4 pt-4">
                <a href="https://www.instagram.com/perpusjkt?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="inline-flex items-center justify-center w-10 h-10 bg-white text-[#00425A] rounded-full hover:bg-[#f85e38] hover:text-white transition duration-300">
                  <i class="fab fa-instagram text-sm"></i>
                </a>
                <a href="https://www.tiktok.com/@perpusjkt_pdshbjassin?is_from_webapp=1&sender_device=pc" class="inline-flex items-center justify-center w-10 h-10 bg-white text-[#00425A] rounded-full hover:bg-[#f85e38] hover:text-white transition duration-300">
                  <i class="fab fa-tiktok text-sm"></i>
                </a>
                <a href="https://www.youtube.com/@perpustakaanjakarta" class="inline-flex items-center justify-center w-10 h-10 bg-white text-[#00425A] rounded-full hover:bg-[#f85e38] hover:text-white transition duration-300">
                  <i class="fab fa-youtube text-sm"></i>
                </a>
              </div>
            </div>

            <!-- Quick Links -->
            <div>
              <h4 class="text-lg font-bold  text-white mb-6"><?php echo e(__('messages.footer_quick_links')); ?></h4>
              <ul class="space-y-3">
                <li>
                  <a href="<?php echo e(route('home')); ?>" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    <?php echo e(__('messages.home')); ?>

                  </a>
                </li>
                <li>
                  <a href="<?php echo e(route('home')); ?>" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    <?php echo e(__('messages.infobase')); ?>

                  </a>
                </li>
                <li>
                  <a href="<?php echo e(route('about')); ?>" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    <?php echo e(__('messages.about_us')); ?>

                  </a>
                </li>
                <li>
                  <a href="<?php echo e(route('contact')); ?>" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    <?php echo e(__('messages.footer_contact_us')); ?>

                  </a>
                </li>
              </ul>
            </div>

            <!-- Resources -->
            <div>
              <h4 class="text-lg font-bold  text-white mb-6"><?php echo e(__('messages.footer_features')); ?></h4>
              <ul class="space-y-3">
                <li>
                  <a href="<?php echo e(route('infobase.pengumuman')); ?>" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    <?php echo e(__('messages.announcements')); ?>

                  </a>
                </li>
                <li>
                  <a href="<?php echo e(route('infobase.calendar-aktifitas')); ?>" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    <?php echo e(__('messages.calendar')); ?>

                  </a>
                </li>
                <li>
                  <a href="<?php echo e(route('infobase.tata-tertib')); ?>" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    <?php echo e(__('messages.rules')); ?>

                  </a>
                </li>
                <li>
                  <a href="<?php echo e(route('infobase.profile-ruangan')); ?>" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    <?php echo e(__('messages.room_profiles')); ?>

                  </a>
                </li>
                <li>
                  <a href="<?php echo e(route('infobase.profil-pegawai')); ?>" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    <?php echo e(__('messages.staff_profiles')); ?>

                  </a>
                </li>
                <li>
                  <a href="<?php echo e(route('infobase.staff-of-month')); ?>" class="text-white text-opacity-80 hover:text-white hover:text-opacity-100 transition duration-300 flex items-center gap-2">
                    <i class="fas fa-chevron-right text-[#f85e38] text-sm"></i>
                    <?php echo e(__('messages.staff_of_month')); ?>

                  </a>
                </li>
              </ul>
            </div>

            <!-- Contact Info -->
            <div>
              <h4 class="text-lg font-bold  text-white mb-6"><?php echo e(__('messages.footer_contact_us')); ?></h4>
              <ul class="space-y-4">
                <li class="flex gap-3">
                  <div class="flex-shrink-0 mt-1">
                    <i class="fas fa-map-marker-alt text-[#f85e38]"></i>
                  </div>
                  <div>
                    <p class="text-white text-opacity-80 text-sm">
                     Jl. Cikini Raya No. 73  RT.8/RW.2, Cikini, Kec. Menteng
                     Kota Jakarta Pusat<br>Daerah Khusus Ibukota Jakarta 10330 Indonesia
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
              <p>© <?php echo e(date('Y')); ?> Perpustakaan Jakarta — INFOBASE. Semua hak dilindungi.</p>
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
<?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/layouts/app.blade.php ENDPATH**/ ?>