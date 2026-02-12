<?php $__env->startSection('content'); ?>
<style>
    /* Pengumuman Card Styles */
    .pengumuman-card {
        background: white;
        padding: 1.5rem;
        margin-bottom: 1.25rem;
        border-radius: 1rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.06);
        border: 1px solid rgba(0, 82, 204, 0.1);
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 530px;
        overflow: hidden;
    }

    .pengumuman-card:hover {
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.12);
        transform: translateY(-4px);
    }

    .pengumuman-header {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 0.5rem;
        flex: 1;
        width: 100%;
        overflow: hidden;
    }

    .pengumuman-date {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 85px;
        padding: 0.75rem;
        background: linear-gradient(135deg, #00425A 0%, #002a3d 100%);
        color: white;
        border-radius: 8px;
        font-weight: 700;
        flex-shrink: 0;
    }

    .pengumuman-date-day {
        font-size: 1.5rem;
        line-height: 1;
    }

    .pengumuman-date-month {
        font-size: 0.75rem;
        text-transform: uppercase;
        opacity: 0.85;
        margin-top: 0.2rem;
    }

    .pengumuman-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        width: 100%;
        justify-content: space-between;
        overflow: hidden;
    }

    .pengumuman-image {
        width: 100%;
        height: 180px;
        object-fit: cover;
        border-radius: 8px;
        margin-bottom: 0.5rem;
        flex-shrink: 0;
    }

    .pengumuman-title {
        font-size: 1rem;
        font-weight: 800;
        color: #1f2937;
        margin-bottom: 0.3rem;
        transition: all 0.3s ease;
        line-height: 1.2;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        flex: 0 0 auto;
    }

    .pengumuman-card:hover .pengumuman-title {
        color: #00425A;
    }

    .pengumuman-description {
        color: #374151;
        line-height: 1.35;
        margin-bottom: 0.3rem;
        font-size: 0.78rem;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        text-overflow: ellipsis;
        flex: 1;
    }

    .pengumuman-footer {
        display: flex;
        flex-direction: column;
        gap: 0.3rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid #e5e7eb;
        flex-shrink: 0;
        height: auto;
        min-height: auto;
        margin-bottom: 0.5rem;
    }

    .pengumuman-date-valid {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        color: #6b7280;
        font-size: 0.75rem;
        font-weight: 500;
        white-space: normal;
        line-height: 1.2;
    }

    .pengumuman-date-valid::before {
        content: '';
        width: 4px;
        height: 4px;
        background: #10b981;
        border-radius: 50%;
        flex-shrink: 0;
    }

    .pengumuman-button-container {
        display: flex;
        justify-content: center;
        width: 100%;
        flex-shrink: 0;
        height: 45px;
        align-items: center;
        margin-top: 0;
    }

    .pengumuman-read-more {
        color: #ffffff;
        background: linear-gradient(135deg, #00425A 0%, #002a3d 100%);
        text-decoration: none;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        justify-content: center;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        padding: 0.6rem 1.2rem;
        font-size: 0.8rem;
        border-radius: 6px;
        box-shadow: 0 2px 8px rgba(0, 82, 204, 0.2);
        white-space: nowrap;
        width: 100%;
    }

    .pengumuman-read-more:hover {
        background: linear-gradient(135deg, #003A99 0%, #00297a 100%);
        box-shadow: 0 4px 12px rgba(0, 82, 204, 0.35);
        transform: translateY(-2px);
    }

    .pengumuman-read-more:active {
        transform: translateY(0);
    }

    .empty-state {
        text-align: center;
        padding: 6rem 2rem;
        background: linear-gradient(135deg, #f8f9fa 0%, #f0f1f3 100%);
        border-radius: 1.5rem;
        border: 2px dashed #e5e7eb;
    }

    .empty-state i {
        font-size: 5rem;
        color: #d1d5db;
        margin-bottom: 1rem;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #1f2937;
        font-size: 1.5rem;
        font-weight: 700;
        margin: 0;
    }

    .empty-state p {
        color: #6b7280;
        font-size: 1rem;
        margin-top: 0.5rem;
    }

    /* Modal enhancements */
    .modal-read-time {
        display: inline-flex;
        align-items: center;
        gap: 0.4rem;
        color: #00425A;
        font-weight: 500;
        font-size: 0.85rem;
        margin-top: 0.5rem;
    }

    .modal-read-time svg {
        width: 16px;
        height: 16px;
    }

    /* Simple Header Style */
    .simple-header {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem 0;
    }

    .simple-header .header-left h1 {
        color: #000000;
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
        text-shadow: none;
    }

    .simple-header .header-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>

<div class="page-header simple-header">
    <div class="header-content">
        <div class="header-left">
            <h1>PENGUMUMAN</h1>
        </div>
        <a href="<?php echo e(route('home')); ?>" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
</div>


<?php echo $__env->make('partials.search-form', [
    'action' => route('infobase.pengumuman'),
    'placeholder' => 'Cari pengumuman berdasarkan judul atau isi...',
    'search' => $search ?? '',
    'resultCount' => isset($pengumumans) ? $pengumumans->total() : null
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="min-h-screen bg-[#f8fafc] pt-12 pb-24">
    <div class="max-w-7xl mx-auto px-6">
        <div class="content-wrapper grid md:grid-cols-2 lg:grid-cols-3 gap-8">
        <?php if(isset($pengumumans) && $pengumumans->count()): ?>
            <?php $__currentLoopData = $pengumumans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="pengumuman-card">
                    <div class="pengumuman-header">
                        <div class="pengumuman-date">
                            <div class="pengumuman-date-day"><?php echo e($item->published_at?->format('d') ?? '00'); ?></div>
                            <div class="pengumuman-date-month"><?php echo e($item->published_at?->format('M') ?? 'Jan'); ?></div>
                        </div>
                        <div class="pengumuman-content">
                            <?php if($item->image_path): ?>
                                <img src="<?php echo e(asset('storage/' . $item->image_path)); ?>" alt="<?php echo e($item->title); ?>" class="pengumuman-image">
                            <?php endif; ?>
                            <div class="pengumuman-footer">
                                <div class="pengumuman-date-valid">
                                    <?php if($item->valid_from || $item->valid_until): ?>
                                        Berlaku: 
                                        <?php if($item->valid_from && $item->valid_until): ?>
                                            <?php echo e($item->valid_from->format('d M Y')); ?> - <?php echo e($item->valid_until->format('d M Y')); ?>

                                        <?php elseif($item->valid_from): ?>
                                            Dari <?php echo e($item->valid_from->format('d M Y')); ?>

                                        <?php else: ?>
                                            Sampai <?php echo e($item->valid_until->format('d M Y')); ?>

                                        <?php endif; ?>
                                    <?php else: ?>
                                        Berlaku sejak <?php echo e($item->published_at?->format('d M Y') ?? 'sekarang'); ?>

                                    <?php endif; ?>
                                </div>
                            </div>
                            <h2 class="pengumuman-title"><?php echo e($item->title); ?></h2>
                            <p class="pengumuman-description"><?php echo $item->description; ?></p>
                        </div>
                    </div>
                    <div class="pengumuman-button-container">
                        <button type="button" class="pengumuman-read-more" data-pengumuman-id="<?php echo e($item->id); ?>" data-title="<?php echo e($item->title); ?>" data-description="<?php echo e($item->description); ?>" data-image="<?php echo e($item->image_path ? asset('storage/' . $item->image_path) : ''); ?>">
                            Selengkapnya <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

            <!-- Pagination -->
            <div style="max-width: 1400px; margin: 0 auto; padding: 2rem 1.5rem; display: flex; justify-content: center;">
                <?php echo e($pengumumans->appends(['search' => $search ?? ''])->links()); ?>

            </div>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-inbox"></i>
                <h3><?php echo e($search ? 'Tidak ada hasil pencarian' : 'Belum ada pengumuman'); ?></h3>
                <p>
                    <?php if($search): ?>
                        Coba gunakan kata kunci yang berbeda untuk mencari pengumuman.
                    <?php else: ?>
                        Kami akan segera mengabari Anda jika ada informasi terbaru tersedia.
                    <?php endif; ?>
                </p>
            </div>
        <?php endif; ?>
    </div>
    </div>
</div>

<!-- Modal: gunakan dari consistent-layout.css -->
<div class="modal-overlay" id="pengumumanDetailModal">
    <div class="modal-content" onclick="event.stopPropagation()">
        <div class="modal-header">
            <div>
                <h2 id="pengumumanTitle"></h2>
                <div class="modal-read-time" id="pengumumanReadTime"></div>
            </div>
            <button type="button" class="modal-close" onclick="closePengumumanModal()">&times;</button>
        </div>
        <div class="modal-body">
            <div id="pengumumanImage"></div>
            <div id="pengumumanDescription"></div>
        </div>
        <div class="modal-footer">
            <p id="pengumumanFooter"></p>
        </div>
    </div>
</div>

<script>
    function calculateReadingTime(text) {
        const plain = text.replace(/<[^>]*>/g, '');
        const words = plain.trim().split(/\s+/).length;
        return Math.max(1, Math.ceil(words / 200));
    }

    document.querySelectorAll('.pengumuman-read-more').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            const title = this.getAttribute('data-title');
            const description = this.getAttribute('data-description');
            const image = this.getAttribute('data-image');
            
            // Set konten
            document.getElementById('pengumumanTitle').textContent = title;
            document.getElementById('pengumumanDescription').innerHTML = description;
            
            // Hitung reading time
            const readTime = calculateReadingTime(description);
            document.getElementById('pengumumanReadTime').innerHTML = 
                '<svg fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>' +
                '<span>Waktu baca: <strong>' + readTime + ' menit</strong></span>';
            
            // Set image
            if (image && image.trim() !== '') {
                document.getElementById('pengumumanImage').innerHTML = 
                    '<img src="' + image + '" alt="' + title + '" style="cursor: pointer; width: 100%; border-radius: 8px; margin-bottom: 1rem;" onclick="window.open(this.src, \'_blank\')">';
            } else {
                document.getElementById('pengumumanImage').innerHTML = '';
            }
            
            // Set footer
            const now = new Date();
            document.getElementById('pengumumanFooter').textContent = 
                'Diakses pada ' + now.toLocaleString('id-ID');
            
            // Buka modal
            const modal = document.getElementById('pengumumanDetailModal');
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        });
    });

    function closePengumumanModal() {
        const modal = document.getElementById('pengumumanDetailModal');
        modal.classList.remove('active');
        document.body.style.overflow = 'auto';
    }

    // Close dengan Escape
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closePengumumanModal();
        }
    });

    // Close dengan click outside
    document.getElementById('pengumumanDetailModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closePengumumanModal();
        }
    });
</script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/infobase/pengumuman.blade.php ENDPATH**/ ?>