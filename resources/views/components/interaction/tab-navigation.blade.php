{{-- resources/views/components/interaction/tab-navigation.blade.php --}}
@props([
    'tabs' => [],
    'active' => '',
    'id' => 'tab-navigation-' . uniqid(),
    'class' => '',
    'size' => 'md', // sm, md, lg
    'variant' => 'pills', // pills, underline, cards
    'position' => 'top' // top, bottom, left, right
])

@php
    $baseClasses = 'w-full';
    $tabsClasses = match($variant) {
        'pills' => 'flex p-1 space-x-1 bg-sena-gris-100 rounded-xl',
        'underline' => 'flex border-b border-sena-gris-200',
        'cards' => 'flex space-x-2 border-b border-sena-gris-200',
        default => 'flex p-1 space-x-1 bg-sena-gris-100 rounded-xl'
    };

    $tabClasses = match($variant) {
        'pills' => 'flex-1 px-3 py-2 text-sm font-medium text-center rounded-lg transition-all duration-200',
        'underline' => 'px-4 py-2 text-sm font-medium border-b-2 border-transparent transition-colors duration-200',
        'cards' => 'px-4 py-2 text-sm font-medium bg-white border rounded-t-lg transition-all duration-200',
        default => 'flex-1 px-3 py-2 text-sm font-medium text-center rounded-lg transition-all duration-200'
    };

    $activeTabClasses = match($variant) {
        'pills' => 'bg-white text-sena-verde shadow-sm',
        'underline' => 'border-sena-verde text-sena-verde',
        'cards' => 'bg-sena-verde text-white border-sena-verde',
        default => 'bg-white text-sena-verde shadow-sm'
    };

    $inactiveTabClasses = match($variant) {
        'pills' => 'text-sena-gris-600 hover:text-sena-verde hover:bg-white/50',
        'underline' => 'text-sena-gris-600 hover:text-sena-verde hover:border-sena-gris-300',
        'cards' => 'text-sena-gris-600 hover:text-sena-verde hover:bg-sena-gris-50',
        default => 'text-sena-gris-600 hover:text-sena-verde hover:bg-white/50'
    };
@endphp

<div {{ $attributes->merge(['class' => $baseClasses . ' ' . $class]) }}>
    <!-- Navegación de pestañas -->
    <nav class="{{ $tabsClasses }}" role="tablist" aria-label="Navegación por pestañas">
        @foreach($tabs as $tabKey => $tabData)
            @php
                $isActive = $active === $tabKey;
                $tabId = $id . '-tab-' . $tabKey;
                $panelId = $id . '-panel-' . $tabKey;
                $disabled = $tabData['disabled'] ?? false;
                $icon = $tabData['icon'] ?? null;
                $badge = $tabData['badge'] ?? null;
                $tooltip = $tabData['tooltip'] ?? null;
            @endphp

            <button
                type="button"
                role="tab"
                id="{{ $tabId }}"
                aria-controls="{{ $panelId }}"
                aria-selected="{{ $isActive ? 'true' : 'false' }}"
                tabindex="{{ $isActive ? '0' : '-1' }}"
                class="{{ $tabClasses }} {{ $isActive ? $activeTabClasses : $inactiveTabClasses }}
                       {{ $disabled ? 'opacity-50 cursor-not-allowed' : 'cursor-pointer' }}"
                @if(!$disabled)
                    onclick="switchTab('{{ $id }}', '{{ $tabKey }}')"
                    onkeydown="handleTabKeydown(event, '{{ $id }}', '{{ $tabKey }}')"
                @endif
                @if($tooltip)
                    title="{{ $tooltip }}"
                @endif
                {{ $disabled ? 'disabled' : '' }}
            >
                <span class="flex items-center space-x-2">
                    @if($icon)
                        <x-heroicon-o-{{ $icon }} class="w-4 h-4" />
                    @endif
                    <span>{{ $tabData['label'] }}</span>
                    @if($badge)
                        <span class="inline-flex items-center px-2 py-1 text-xs font-medium text-white rounded-full bg-sena-verde">
                            {{ $badge }}
                        </span>
                    @endif
                </span>
            </button>
        @endforeach
    </nav>

    <!-- Contenido de las pestañas -->
    <div class="mt-4">
        @foreach($tabs as $tabKey => $tabData)
            @php
                $isActive = $active === $tabKey;
                $panelId = $id . '-panel-' . $tabKey;
                $tabId = $id . '-tab-' . $tabKey;
            @endphp

            <div
                id="{{ $panelId }}"
                role="tabpanel"
                aria-labelledby="{{ $tabId }}"
                class="{{ $isActive ? 'block' : 'hidden' }}"
                tabindex="0"
            >
                @if(isset($tabData['content']))
                    {!! $tabData['content'] !!}
                @else
                    {{ $slot }}
                @endif
            </div>
        @endforeach
    </div>
</div>

<script>
    // Función para cambiar de pestaña
    function switchTab(navigationId, tabKey) {
        const navigation = document.querySelector(`#${navigationId}`);
        if (!navigation) return;

        // Ocultar todos los paneles
        const panels = navigation.querySelectorAll('[role="tabpanel"]');
        panels.forEach(panel => {
            panel.classList.add('hidden');
            panel.classList.remove('block');
        });

        // Desactivar todas las pestañas
        const tabs = navigation.querySelectorAll('[role="tab"]');
        tabs.forEach(tab => {
            tab.setAttribute('aria-selected', 'false');
            tab.setAttribute('tabindex', '-1');
            // Remover clases activas
            tab.classList.remove('bg-white', 'text-sena-verde', 'shadow-sm', 'border-sena-verde');
            // Agregar clases inactivas
            tab.classList.add('text-sena-gris-600');
        });

        // Activar la pestaña seleccionada
        const activeTab = navigation.querySelector(`#${navigationId}-tab-${tabKey}`);
        const activePanel = navigation.querySelector(`#${navigationId}-panel-${tabKey}`);

        if (activeTab && activePanel) {
            activeTab.setAttribute('aria-selected', 'true');
            activeTab.setAttribute('tabindex', '0');
            activeTab.classList.add('bg-white', 'text-sena-verde', 'shadow-sm');
            activeTab.classList.remove('text-sena-gris-600');

            activePanel.classList.remove('hidden');
            activePanel.classList.add('block');
            activePanel.focus();
        }

        // Disparar evento personalizado
        const event = new CustomEvent('tabChanged', {
            detail: { navigationId, tabKey }
        });
        document.dispatchEvent(event);
    }

    // Navegación por teclado
    function handleTabKeydown(event, navigationId, tabKey) {
        const navigation = document.querySelector(`#${navigationId}`);
        if (!navigation) return;

        const tabs = Array.from(navigation.querySelectorAll('[role="tab"]:not([disabled])'));
        const currentIndex = tabs.findIndex(tab => tab.id === `${navigationId}-tab-${tabKey}`);

        let nextIndex = currentIndex;

        switch(event.key) {
            case 'ArrowLeft':
                event.preventDefault();
                nextIndex = currentIndex > 0 ? currentIndex - 1 : tabs.length - 1;
                break;
            case 'ArrowRight':
                event.preventDefault();
                nextIndex = currentIndex < tabs.length - 1 ? currentIndex + 1 : 0;
                break;
            case 'Home':
                event.preventDefault();
                nextIndex = 0;
                break;
            case 'End':
                event.preventDefault();
                nextIndex = tabs.length - 1;
                break;
            case 'Enter':
            case ' ':
                event.preventDefault();
                switchTab(navigationId, tabKey);
                return;
        }

        if (nextIndex !== currentIndex) {
            tabs[nextIndex].focus();
        }
    }

    // Inicialización
    document.addEventListener('DOMContentLoaded', function() {
        // Configurar navegación por teclado para todas las pestañas
        const tabNavigations = document.querySelectorAll('[role="tablist"]');

        tabNavigations.forEach(nav => {
            const tabs = nav.querySelectorAll('[role="tab"]');
            tabs.forEach(tab => {
                tab.addEventListener('focus', function() {
                    // Cuando una pestaña recibe foco, la activamos
                    const tabKey = this.id.split('-').pop();
                    const navigationId = this.id.replace('-tab-' + tabKey, '');
                    switchTab(navigationId, tabKey);
                });
            });
        });
    });
</script>

<style>
    /* Estilos adicionales para mejorar la accesibilidad */
    [role="tab"]:focus {
        outline: 2px solid #39A900;
        outline-offset: 2px;
    }

    [role="tabpanel"]:focus {
        outline: none;
    }

    /* Animaciones suaves */
    [role="tab"] {
        transition: all 0.2s ease-in-out;
    }

    [role="tabpanel"] {
        animation: fadeIn 0.3s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
