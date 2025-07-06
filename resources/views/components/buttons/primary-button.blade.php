{{-- primary-button.blade.php --}}
<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-sena-verde text-white text-sm font-medium rounded-lg shadow-md hover:bg-sena-verde-sec focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-sena-verde']) }}>
    {{ $slot }}
</button>
