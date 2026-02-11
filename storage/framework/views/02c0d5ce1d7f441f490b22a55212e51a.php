

<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'variant' => 'primary', // primary, secondary, danger, ghost, ghost-danger
    'size' => 'md', // sm, md, lg
    'icon' => null,
    'disabled' => false,
    'type' => 'button',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'variant' => 'primary', // primary, secondary, danger, ghost, ghost-danger
    'size' => 'md', // sm, md, lg
    'icon' => null,
    'disabled' => false,
    'type' => 'button',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $variantStyles = match($variant) {
        'primary' => 'background-color: #f97316; color: #ffffff; border: 1px solid #f97316;',
        'secondary' => 'background-color: #f3f4f6; color: #374151; border: 1px solid #d1d5db;',
        'danger' => 'background-color: #ef4444; color: #ffffff; border: 1px solid #ef4444;',
        'ghost' => 'background-color: #ffffff; color: #ea580c; border: 1px solid #fdba74;',
        'ghost-danger' => 'background-color: #ffffff; color: #dc2626; border: 1px solid #fca5a5;',
        default => 'background-color: #4b5563; color: #ffffff; border: 1px solid #4b5563;',
    };

    $sizeStyles = match($size) {
        'sm' => 'padding: 6px 12px; font-size: 12px;',
        'md' => 'padding: 8px 16px; font-size: 14px;',
        'lg' => 'padding: 10px 20px; font-size: 14px;',
        default => 'padding: 8px 16px; font-size: 14px;',
    };

    $baseStyles = 'display: inline-flex; align-items: center; gap: 8px; font-weight: 600; border-radius: 8px; cursor: pointer; text-decoration: none; white-space: nowrap; transition: all 0.2s; line-height: 1.4;';
    $disabledStyles = $disabled ? 'opacity: 0.5; cursor: not-allowed; pointer-events: none;' : '';

    $allStyles = "$variantStyles $sizeStyles $baseStyles $disabledStyles";
?>

<?php if($type === 'link'): ?>
    <a 
        <?php echo e($attributes->merge(['style' => $allStyles])); ?>

        <?php echo e($disabled ? 'onclick="return false;"' : ''); ?>

    >
        <?php if($icon): ?>
            <i class="fa-solid fa-<?php echo e($icon); ?>"></i>
        <?php endif; ?>
        <?php echo e($slot); ?>

    </a>
<?php else: ?>
    <button 
        type="<?php echo e($type); ?>" 
        <?php echo e($attributes->merge(['style' => $allStyles])); ?>

        <?php echo e($disabled ? 'disabled' : ''); ?>

    >
        <?php if($icon): ?>
            <i class="fa-solid fa-<?php echo e($icon); ?>"></i>
        <?php endif; ?>
        <?php echo e($slot); ?>

    </button>
<?php endif; ?>
<?php /**PATH C:\Users\Pemustaka\Desktop\Infobase_uppjpds\resources\views/components/button.blade.php ENDPATH**/ ?>