@props(['class' => ''])

<div {{ $attributes->merge(['class' => "rounded-2xl p-6 bg-white shadow-md border border-gray-200 glass-card backdrop-blur-sm $class"]) }}>
    {{ $slot }}
</div>
