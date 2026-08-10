@props(['size' => 'md', 'layout' => 'vertical'])

@php
    $logoSizes = [
        'sm' => 'h-10 w-10',
        'md' => 'h-16 w-16',
        'lg' => 'h-24 w-24',
        'xl' => 'h-32 w-32',
    ];
    $textSizes = [
        'sm' => 'text-sm',
        'md' => 'text-base',
        'lg' => 'text-xl',
        'xl' => 'text-2xl',
    ];
    $imgSize = $logoSizes[$size] ?? $logoSizes['md'];
    $txtSize = $textSizes[$size] ?? $textSizes['md'];
@endphp

@if ($layout === 'vertical')
    <div {{ $attributes->merge(['class' => 'flex flex-col items-center text-center']) }}>
        <img src="{{ asset('images/logo.svg') }}" alt="Logo Sistem Gadai Mahenswa" class="{{ $imgSize }} object-contain drop-shadow-md">
        <span class="font-extrabold tracking-tight {{ $txtSize }} bg-gradient-to-r from-blue-900 via-blue-700 to-cyan-600 bg-clip-text text-transparent mt-2 uppercase">
            sistem-gadai mahenswa
        </span>
    </div>
@else
    <div {{ $attributes->merge(['class' => 'flex items-center gap-3']) }}>
        <img src="{{ asset('images/logo.svg') }}" alt="Logo Sistem Gadai Mahenswa" class="{{ $imgSize }} object-contain drop-shadow-sm">
        <div class="flex flex-col">
            <span class="font-extrabold tracking-tight {{ $txtSize }} bg-gradient-to-r from-blue-900 via-blue-700 to-cyan-600 bg-clip-text text-transparent uppercase leading-tight">
                sistem-gadai mahenswa
            </span>
            <span class="text-[10px] font-semibold text-cyan-600 tracking-widest uppercase">Internal Management System</span>
        </div>
    </div>
@endif
