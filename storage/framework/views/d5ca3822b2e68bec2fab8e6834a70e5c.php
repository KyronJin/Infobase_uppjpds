<?php $__env->startSection('content'); ?>
<style>
    /* Staff of Month specific styles */

    .position-filters {
        display: flex;
        justify-content: center;
        gap: 1rem;
        margin-bottom: 2rem;
        flex-wrap: wrap;
        padding: 1.5rem;
        background: white;
        border-radius: 20px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .position-filter {
        padding: 0.75rem 1.5rem;
        background: #f8fafc;
        border: 2px solid #e2e8f0;
        border-radius: 50px;
        color: #64748b;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        font-size: 0.9rem;
        min-width: 110px;
        text-align: center;
    }

    .position-filter:hover {
        border-color: #063A76;
        color: #063A76;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(6, 58, 118, 0.15);
        background: white;
    }

    .position-filter.active {
        background: linear-gradient(135deg, #063A76 0%, #0D5C9E 100%);
        border-color: #063A76;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(6, 58, 118, 0.3);
    }

    .staff-display {
        display: none;
        background: white;
        border-radius: 32px;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
        border: 1px solid rgba(6, 58, 118, 0.1);
        min-height: 80vh;
    }

    .staff-display.active {
        display: block;
        animation: fadeIn 0.5s ease-in-out;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }

    .staff-hero {
        display: flex;
        flex-direction: column;
        align-items: center;
        padding: 2.5rem 1.5rem;
        text-align: center;
        min-height: auto;
    }

    .staff-image-section {
        margin-bottom: 2rem;
        position: relative;
    }

    .staff-image-container {
        width: 280px;
        height: 280px;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 20px 60px rgba(6, 58, 118, 0.2);
        position: relative;
        border: 8px solid white;
        margin: 0 auto;
    }

    .staff-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .staff-image-placeholder {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #063A76 0%, #041E3B 100%);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .staff-info-section {
        max-width: 800px;
        width: 100%;
    }

    .staff-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.6rem 1.2rem;
        background: linear-gradient(135deg, #fbbf24 0%, #f59e0b 100%);
        color: white;
        border-radius: 50px;
        font-size: 0.8rem;
        font-weight: 700;
        text-transform: uppercase;
        margin-bottom: 1.25rem;
        letter-spacing: 0.5px;
        box-shadow: 0 4px 12px rgba(251, 191, 36, 0.3);
        width: fit-content;
    }

    .staff-name {
        font-size: 2rem;
        font-weight: 800;
        color: #1e293b;
        margin-bottom: 0.75rem;
        line-height: 1.1;
    }

    .staff-position {
        font-size: 1.1rem;
        color: #063A76;
        font-weight: 600;
        margin-bottom: 1.5rem;
        padding: 0.75rem 1.5rem;
        background: rgba(6, 58, 118, 0.08);
        border-radius: 12px;
        display: inline-block;
        width: fit-content;
    }

    .staff-meta {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 2rem;
        margin-bottom: 2rem;
        padding: 2rem;
        background: #f8fafc;
        border-radius: 16px;
        border: 1px solid #e2e8f0;
    }

    .staff-meta-item {
        text-align: center;
    }

    .staff-meta-label {
        font-size: 0.875rem;
        color: #64748b;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 0.5rem;
    }

    .staff-meta-value {
        font-size: 1.25rem;
        color: #1e293b;
        font-weight: 700;
    }

    .staff-bio {
        color: #475569;
        line-height: 1.8;
        font-size: 1.125rem;
        background: #f8fafc;
        padding: 2rem;
        border-radius: 16px;
        border-left: 4px solid #063A76;
    }

    .empty-state {
        text-align: center;
        padding: 8rem 2rem;
        background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        border-radius: 24px;
        border: 2px dashed #cbd5e1;
    }

    .empty-state i {
        font-size: 6rem;
        color: #cbd5e1;
        margin-bottom: 2rem;
        opacity: 0.5;
    }

    .empty-state h3 {
        color: #1e293b;
        font-size: 2rem;
        font-weight: 700;
        margin: 0 0 1rem 0;
    }

    .empty-state p {
        color: #64748b;
        font-size: 1.125rem;
        margin-top: 0.5rem;
    }

    @media (max-width: 768px) {
        .page-header .header-content {
            flex-direction: column;
            text-align: center;
            gap: 2rem;
        }

        .page-header h1 {
            font-size: 2rem;
        }

        .position-filters {
            gap: 0.5rem;
            padding: 1.5rem;
        }

        .position-filter {
            padding: 0.75rem 1.5rem;
            font-size: 0.875rem;
            min-width: 100px;
        }

        .staff-hero {
            padding: 2rem 1rem;
        }

        .staff-image-container {
            width: 280px;
            height: 280px;
            border: 6px solid white;
        }

        .staff-name {
            font-size: 2rem;
        }

        .staff-position {
            font-size: 1.25rem;
        }

        .staff-meta {
            grid-template-columns: 1fr;
        }

        .staff-bio {
            font-size: 1rem;
        }
    }

    /* Simple Header Style */
    .simple-header {
        background: white;
        border-bottom: 1px solid #e5e7eb;
        padding: 1.5rem 0;
    }

    .simple-header .header-left h1,
    .simple-header h1 {
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
        <h1>STAFF OF THE MONTH</h1>
        <a href="<?php echo e(route('home')); ?>" class="back-link">
            <i class="fas fa-arrow-left"></i>Kembali
        </a>
    </div>
</div>


<?php echo $__env->make('partials.search-form', [
    'action' => route('infobase.staff-of-month'),
    'placeholder' => 'Cari staff berdasarkan nama, posisi, atau prestasi...',
    'search' => $search ?? '',
    'resultCount' => isset($staff) ? $staff->total() : ($staffByPosition ? $staffByPosition->count() : null)
], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<div class="container">
    <div class="content-wrapper">
        <?php if($staffByPosition && $staffByPosition->count()): ?>
            <!-- Month Filter Dropdown -->
            <div style="margin-bottom: 2rem; display: flex; justify-content: center;">
                <form method="GET" action="<?php echo e(route('infobase.staff-of-month')); ?>" style="display: flex; gap: 1rem; align-items: center;">
                    <?php if(request()->has('search')): ?>
                        <input type="hidden" name="search" value="<?php echo e(request('search')); ?>">
                    <?php endif; ?>
                    <label for="month-filter" style="font-weight: 600; color: #64748b;">Pilih Bulan:</label>
                    <select id="month-filter" name="month" onchange="this.form.submit()" style="
                        padding: 0.75rem 1.5rem;
                        background: #f8fafc;
                        border: 2px solid #e2e8f0;
                        border-radius: 50px;
                        color: #64748b;
                        font-weight: 600;
                        cursor: pointer;
                        transition: all 0.3s ease;
                        font-size: 0.9rem;
                    ">
                        <option value="">-- Semua Bulan --</option>
                        <?php $__currentLoopData = $allMonths; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $month): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($month); ?>" <?php echo e($selectedMonth == $month ? 'selected' : ''); ?>>
                                <?php echo e(DateTime::createFromFormat('!m', $month)->format('F')); ?>

                            </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </form>
            </div>

            <!-- Position Filters -->
            <div class="position-filters">
                <?php $__currentLoopData = $positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <button class="position-filter <?php echo e($index === 0 ? 'active' : ''); ?>" 
                            onclick="showStaffByPosition('<?php echo e($position); ?>')"
                            data-position="<?php echo e($position); ?>">
                        <i class="fas fa-briefcase mr-2"></i><?php echo e($position); ?>

                    </button>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>

            <!-- Staff Displays -->
            <?php $__currentLoopData = $staffByPosition; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $position => $staffItem): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="staff-display <?php echo e($loop->first ? 'active' : ''); ?>" id="staff-<?php echo e(Str::slug($position)); ?>">
                    <div class="staff-hero">
                        <!-- Foto di Atas -->
                        <div class="staff-image-section">
                            <div class="staff-image-container">
                                <?php if($staffItem->photo_path): ?>
                                    <img src="<?php echo e(asset('storage/' . $staffItem->photo_path)); ?>" alt="<?php echo e($staffItem->name); ?>" class="staff-image">
                                <?php elseif($staffItem->photo_link): ?>
                                    <img src="<?php echo e($staffItem->photo_link); ?>" alt="<?php echo e($staffItem->name); ?>" class="staff-image">
                                <?php else: ?>
                                    <div class="staff-image-placeholder">
                                        <i class="fas fa-user text-white text-6xl opacity-40"></i>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        
                        <!-- Info di Bawah -->
                        <div class="staff-info-section">
                            <div class="staff-badge">
                                <i class="fas fa-star"></i>
                                Staff Terpilih
                            </div>
                            
                            <h2 class="staff-name"><?php echo e($staffItem->name); ?></h2>
                            <div class="staff-position"><?php echo e($staffItem->position); ?></div>
                            
                            <?php if($staffItem->month || $staffItem->year): ?>
                            <div class="staff-meta">
                                <?php if($staffItem->month): ?>
                                <div class="staff-meta-item">
                                    <div class="staff-meta-label">Bulan</div>
                                    <div class="staff-meta-value">
                                        <?php echo e(DateTime::createFromFormat('!m', $staffItem->month)->format('F')); ?>

                                    </div>
                                </div>
                                <?php endif; ?>
                                <?php if($staffItem->year): ?>
                                <div class="staff-meta-item">
                                    <div class="staff-meta-label">Tahun</div>
                                    <div class="staff-meta-value"><?php echo e($staffItem->year); ?></div>
                                </div>
                                <?php endif; ?>
                            </div>
                            <?php endif; ?>
                            
                            <?php if($staffItem->bio): ?>
                            <div class="staff-bio"><?php echo nl2br(e($staffItem->bio)); ?></div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <div class="empty-state">
                <i class="fas fa-users"></i>
                <h3>Belum Ada Staff Terpilih</h3>
                <p>Staff terbaik per posisi akan ditampilkan di sini ketika sudah ada yang terpilih.</p>
            </div>
        <?php endif; ?>
        
        
        <?php if(isset($staff) && $staff->hasPages()): ?>
            <div class="d-flex justify-content-center mt-6">
                <?php echo e($staff->appends(['search' => $search ?? ''])->links()); ?>

            </div>
        <?php endif; ?>
    </div>
</div>

<script>
function showStaffByPosition(position) {
    // Hide all staff displays
    document.querySelectorAll('.staff-display').forEach(display => {
        display.classList.remove('active');
    });
    
    // Remove active class from all filters
    document.querySelectorAll('.position-filter').forEach(filter => {
        filter.classList.remove('active');
    });
    
    // Show selected staff display
    const slug = position.toLowerCase().replace(/[^a-z0-9]+/g, '-').replace(/^-+|-+$/g, '');
    const targetDisplay = document.getElementById('staff-' + slug);
    if (targetDisplay) {
        targetDisplay.classList.add('active');
    }
    
    // Add active class to clicked filter
    const clickedFilter = document.querySelector(`[data-position="${position}"]`);
    if (clickedFilter) {
        clickedFilter.classList.add('active');
    }
}
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/infobase/staff-of-month.blade.php ENDPATH**/ ?>