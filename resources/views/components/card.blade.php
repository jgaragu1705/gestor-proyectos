{{-- Tarjeta blanca reutilizable --}}
<div {{ $attributes->merge(['class' => 'bg-white p-6 rounded-xl shadow']) }}>
    {{ $slot }}
</div>