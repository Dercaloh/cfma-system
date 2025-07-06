{{-- resources/views/components/buttons/button-sena.blade.php --}}
<button {{ $attributes->merge([
    'type' => 'submit',
    'class' => 'btn-sena',
]) }}>
    {{ $slot }}
</button>
