{{-- resources/views/dashboard/index.blade.php --}}
<x-app-layout>
    <x-slot name="title">Panel de control</x-slot>

    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-900 font-work-sans">
            Panel de control – {{ ucfirst(__($role)) }}
        </h2>
    </x-slot>

    <div class="p-6 shadow-xl bg-white/60 backdrop-blur-md rounded-2xl ring-1 ring-black/5">
        @includeIf("dashboard.partials." . Str::slug($role, '_'), ['user' => Auth::user()])
    </div>
</x-app-layout>
