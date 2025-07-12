@php
    $user = auth()->user();
    $now = now()->format('Y-m-d H:i:s');
@endphp

@if ($user)
    <div
        aria-hidden="true"
        class="fixed inset-0 z-[-1] print:z-50 pointer-events-none select-none"
        style="background-image:
            repeating-linear-gradient(
                45deg,
                rgba(0,0,0,0.03) 0px,
                rgba(0,0,0,0.03) 1px,
                transparent 1px,
                transparent 50px
            );
            background-size: 200px 200px;"
    >
        <p
            class="absolute bottom-4 right-4 text-[10px] sm:text-xs text-gray-700 opacity-60 print:opacity-80 print:text-black print:text-right"
            style="font-family: 'Work Sans', sans-serif;"
        >
            {{ $user->full_name }} — {{ $user->email }}<br>
            IP: {{ request()->ip() }} — {{ $now }}<br>
            SGPTI - CFMA SENA © {{ now()->year }}
        </p>
    </div>
@endif
