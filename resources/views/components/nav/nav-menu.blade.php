@props(['user' => Auth::user()])

@php
    use Illuminate\Support\Facades\Route;
    $role = $user->getRoleNames()->first() ?? 'Sin rol';
    $level = optional($user->roles->first())->level ?? 99;
@endphp

<nav class="w-full text-white border-b shadow-lg bg-sena-verde/90 backdrop-blur-md border-white/10" aria-label="Menú principal">
    <div class="px-4 mx-auto max-w-7xl sm:px-6 lg:px-8">

        {{-- Encabezado --}}
        <div class="flex items-center justify-between py-0">
            <div class="text-xl font-bold tracking-wide text-white uppercase drop-shadow">

            </div>

            {{-- Hamburguesa para móviles --}}
            <div class="sm:hidden">
                <input type="checkbox" id="menu-toggle" class="hidden peer">
                <label for="menu-toggle" class="cursor-pointer" aria-label="Abrir menú">
                    <svg class="w-6 h-6 text-white transition-transform peer-checked:rotate-90" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </label>
            </div>
        </div>

        {{-- Menú desplegable --}}
        <div class="flex-col hidden gap-4 py-4 text-sm font-medium transition-all duration-200 ease-in-out border-t peer-checked:flex sm:flex sm:flex-row sm:items-center sm:justify-between border-white/10">

            {{-- Enlaces principales --}}
            <div class="flex flex-col gap-4 sm:flex-row sm:items-center">
                @if (Route::has('dashboard'))
                    <x-nav.nav-link :href="route('dashboard')" label="Inicio" icon="heroicon-o-home" />
                @endif

                @if (Route::has('profile.edit'))
                    <x-nav.nav-link :href="route('profile.edit')" label="Perfil" icon="heroicon-o-user-circle" />
                @endif

                {{-- Acceso exclusivo: Administrador --}}
                @if ($level <= 0)
                    @if (Route::has('admin.inventario.index'))
                        <x-nav.nav-link :href="route('admin.inventario.index')" label="Inventario" icon="heroicon-o-cube" />
                    @endif
                    @if (Route::has('admin.dashboard'))
                        <x-nav.nav-link :href="route('admin.dashboard')" label="Admin" icon="heroicon-o-cog-6-tooth" />
                    @endif
                @endif

                {{-- Acceso a la vista de aprobación de préstamos (listado, no acción directa) --}}
                @if ($level <= 1 && Route::has('prestamos.pendientes'))
                    <x-nav.nav-link :href="route('prestamos.pendientes')" label="Aprobar" icon="heroicon-o-check-badge" />
                @endif

                {{-- Portería --}}
                @if ($level === 4)
                    @if (Route::has('porteria.checkin'))
                        <x-nav.nav-link :href="route('porteria.checkin')" label="Check-In" icon="heroicon-o-arrow-down-tray" />
                    @endif
                    @if (Route::has('porteria.checkout'))
                        <x-nav.nav-link :href="route('porteria.checkout')" label="Check-Out" icon="heroicon-o-arrow-up-tray" />
                    @endif
                @endif

                {{-- Vista de usuario para préstamos propios --}}
                @if (in_array($level, [0,1,2,3]) && Route::has('prestamos.index'))
                    <x-nav.nav-link :href="route('prestamos.index')" label="Mis Préstamos" icon="heroicon-o-clipboard-document-list" />
                @endif
            </div>

            {{-- Usuario y Logout --}}
            <div class="flex items-center gap-3 text-white/90">
                <span class="font-semibold truncate max-w-[140px] sm:max-w-none">{{ $user->full_name ?? $user->name }}</span>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit"
                        class="px-3 py-1 text-xs transition border rounded bg-white/10 hover:bg-white/20 border-white/20 focus:outline-none focus-visible:ring-2 focus-visible:ring-white/40"
                        aria-label="Cerrar sesión">
                        <x-heroicon-o-arrow-left-on-rectangle class="w-5 h-5" aria-hidden="true" />
                    </button>
                </form>
            </div>
        </div>
    </div>
</nav>
