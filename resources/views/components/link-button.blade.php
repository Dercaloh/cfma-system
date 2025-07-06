{{-- link-button.blade.php --}}
{{-- This file defines a reusable link button component with a specific style and hover effect --}}
@props(['href'])

<a href="{{ $href }}"
   class="inline-block px-4 py-2 mt-4 font-medium text-white transition rounded-xl bg-sena-verde hover:bg-sena-verde-sec">
   {{ $slot }}
</a>
