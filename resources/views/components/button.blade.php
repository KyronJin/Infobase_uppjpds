{{-- Reusable Button Component - uses inline styles for reliable rendering --}}

@props([
    'variant' => 'primary', // primary, secondary, danger, ghost, ghost-danger
    'size' => 'md', // sm, md, lg
    'icon' => null,
    'disabled' => false,
    'type' => 'button',
])

@php
    $variantStyles = match($variant) {
        'primary' => 'background-color: #f97316; color: #ffffff; border: 1px solid #f97316;',
        'secondary' => 'background-color: #f3f4f6; color: #374151; border: 1px solid #d1d5db;',
        'danger' => 'background-color: #ef4444; color: #ffffff; border: 1px solid #ef4444;',
        'ghost' => 'background-color: #ffffff; color: #ea580c; border: 1px solid #fdba74;',
        'ghost-danger' => 'background-color: #ffffff; color: #dc2626; border: 1px solid #fca5a5;',
        default => 'background-color: #4b5563; color: #ffffff; border: 1px solid #4b5563;',
    };

    $sizeStyles = match($size) {
        'sm' => 'padding: 8px 14px; font-size: 13px;',
        'md' => 'padding: 8px 16px; font-size: 14px;',
        'lg' => 'padding: 10px 20px; font-size: 14px;',
        default => 'padding: 8px 16px; font-size: 14px;',
    };

    $baseStyles = 'display: inline-flex; align-items: center; justify-content: center; gap: 8px; font-weight: 600; border-radius: 8px; cursor: pointer; text-decoration: none; white-space: nowrap; transition: all 0.2s; line-height: 1.4; min-width: fit-content;';
    $disabledStyles = $disabled ? 'opacity: 0.5; cursor: not-allowed; pointer-events: none;' : '';

    $allStyles = "$variantStyles $sizeStyles $baseStyles $disabledStyles";
@endphp

@if($type === 'link')
    <a 
        {{ $attributes->merge(['style' => $allStyles]) }}
        {{ $disabled ? 'onclick="return false;"' : '' }}
    >
        @if($icon)
            <i class="fa-solid fa-{{ $icon }}"></i>
        @endif
        {{ $slot }}
    </a>
@else
    <button 
        type="{{ $type }}" 
        {{ $attributes->merge(['style' => $allStyles]) }}
        {{ $disabled ? 'disabled' : '' }}
    >
        @if($icon)
            <i class="fa-solid fa-{{ $icon }}"></i>
        @endif
        {{ $slot }}
    </button>
@endif
