{{-- resources/views/components/legal/legal-notice.blade.php --}}
<div {{ $attributes->merge(['class' => 'legal-notice']) }} role="note" aria-label="Aviso legal">
    {{ $slot }}
</div>
