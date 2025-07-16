{{--
    Componente: Date Range Picker
    Propósito: Selector de rango de fechas para préstamos y reportes
    Ubicación: resources/views/components/date-picker/date-range-picker.blade.php
    Autor: SGPTI - CFMA SENA
--}}

@props([
    'name' => 'fecha_rango',
    'label' => 'Rango de fechas',
    'startName' => 'fecha_inicio',
    'endName' => 'fecha_fin',
    'startValue' => '',
    'endValue' => '',
    'minDate' => null,
    'maxDate' => null,
    'excludeWeekends' => false,
    'required' => false,
    'disabled' => false,
    'placeholder' => 'Seleccionar rango',
    'format' => 'Y-m-d',
    'displayFormat' => 'd/m/Y',
    'locale' => 'es',
    'allowSameDay' => true,
    'maxRange' => null, // días máximos entre fechas
    'minRange' => null, // días mínimos entre fechas
    'error' => null,
    'help' => null,
    'icon' => 'calendar',
    'clearable' => true,
    'shortcuts' => true
])

@php
    $id = $name . '_' . uniqid();
    $startId = $startName . '_' . uniqid();
    $endId = $endName . '_' . uniqid();
    $hasError = $error || $errors->has($startName) || $errors->has($endName);
    $errorMessage = $error ?: $errors->first($startName) ?: $errors->first($endName);
@endphp

<div class="space-y-2" x-data="dateRangePicker({
    startId: '{{ $startId }}',
    endId: '{{ $endId }}',
    startValue: '{{ $startValue }}',
    endValue: '{{ $endValue }}',
    minDate: '{{ $minDate }}',
    maxDate: '{{ $maxDate }}',
    excludeWeekends: {{ $excludeWeekends ? 'true' : 'false' }},
    format: '{{ $format }}',
    displayFormat: '{{ $displayFormat }}',
    locale: '{{ $locale }}',
    allowSameDay: {{ $allowSameDay ? 'true' : 'false' }},
    maxRange: {{ $maxRange ? $maxRange : 'null' }},
    minRange: {{ $minRange ? $minRange : 'null' }},
    clearable: {{ $clearable ? 'true' : 'false' }}
})" x-init="init()">

    <!-- Label -->
    @if($label)
        <label for="{{ $id }}" class="block mb-1 text-sm font-semibold text-sena-azul-900">
            {{ $label }}
            @if($required)
                <span class="ml-1 text-red-500">*</span>
            @endif
        </label>
    @endif

    <!-- Shortcuts (opcional) -->
    @if($shortcuts)
        <div class="flex flex-wrap gap-2 mb-3">
            <button type="button" @click="setRange('today')"
                    class="px-3 py-1 text-xs transition-colors rounded-md bg-sena-gris-100 hover:bg-sena-verde-100 text-sena-azul-800">
                Hoy
            </button>
            <button type="button" @click="setRange('yesterday')"
                    class="px-3 py-1 text-xs transition-colors rounded-md bg-sena-gris-100 hover:bg-sena-verde-100 text-sena-azul-800">
                Ayer
            </button>
            <button type="button" @click="setRange('this_week')"
                    class="px-3 py-1 text-xs transition-colors rounded-md bg-sena-gris-100 hover:bg-sena-verde-100 text-sena-azul-800">
                Esta semana
            </button>
            <button type="button" @click="setRange('last_week')"
                    class="px-3 py-1 text-xs transition-colors rounded-md bg-sena-gris-100 hover:bg-sena-verde-100 text-sena-azul-800">
                Semana pasada
            </button>
            <button type="button" @click="setRange('this_month')"
                    class="px-3 py-1 text-xs transition-colors rounded-md bg-sena-gris-100 hover:bg-sena-verde-100 text-sena-azul-800">
                Este mes
            </button>
            <button type="button" @click="setRange('last_month')"
                    class="px-3 py-1 text-xs transition-colors rounded-md bg-sena-gris-100 hover:bg-sena-verde-100 text-sena-azul-800">
                Mes pasado
            </button>
        </div>
    @endif

    <!-- Input Container -->
    <div class="relative">
        <!-- Input Principal -->
        <div class="relative">
            <input
                type="text"
                id="{{ $id }}"
                x-model="displayValue"
                @click="toggleCalendar()"
                @keydown.enter.prevent="toggleCalendar()"
                @keydown.escape="closeCalendar()"
                placeholder="{{ $placeholder }}"
                readonly
                {{ $required ? 'required' : '' }}
                {{ $disabled ? 'disabled' : '' }}
                class="w-full px-4 py-3 pl-12 pr-10 text-sm border-2 rounded-xl transition-all duration-200 focus:outline-none
                    {{ $hasError
                        ? 'border-red-300 bg-red-50 focus:border-red-500 focus:ring-red-500/20'
                        : 'border-sena-gris-300 bg-white focus:border-sena-verde focus:ring-sena-verde/20'
                    }}
                    {{ $disabled ? 'bg-sena-gris-100 text-sena-gris-500 cursor-not-allowed' : 'cursor-pointer' }}
                    shadow-neumorph hover:shadow-neumorph-hover focus:shadow-neumorph-inset focus:ring-4"
                aria-describedby="{{ $id }}_help {{ $id }}_error"
                aria-expanded="false"
                x-bind:aria-expanded="isOpen"
                role="combobox"
                aria-haspopup="dialog"
            >

            <!-- Ícono -->
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                <svg class="w-5 h-5 text-sena-gris-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
            </div>

            <!-- Botón Clear -->
            @if($clearable)
                <button
                    type="button"
                    @click.stop="clearRange()"
                    x-show="startDate || endDate"
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0 scale-95"
                    x-transition:enter-end="opacity-100 scale-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100 scale-100"
                    x-transition:leave-end="opacity-0 scale-95"
                    class="absolute inset-y-0 right-0 flex items-center pr-3 transition-colors text-sena-gris-400 hover:text-sena-gris-600"
                    aria-label="Limpiar fechas"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            @endif
        </div>

        <!-- Inputs Ocultos -->
        <input type="hidden" name="{{ $startName }}" x-model="startDate" id="{{ $startId }}">
        <input type="hidden" name="{{ $endName }}" x-model="endDate" id="{{ $endId }}">

        <!-- Calendario Desplegable -->
        <div x-show="isOpen"
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             @click.away="closeCalendar()"
             @keydown.escape="closeCalendar()"
             class="absolute left-0 z-50 w-full max-w-md mt-2 overflow-hidden bg-white border shadow-lg top-full rounded-xl border-sena-gris-200"
             role="dialog"
             aria-modal="true"
             aria-labelledby="{{ $id }}_title">

            <!-- Encabezado -->
            <div class="p-4 text-white bg-sena-verde">
                <h3 id="{{ $id }}_title" class="text-sm font-semibold">
                    Seleccionar rango de fechas
                </h3>
                <div class="flex items-center justify-between mt-2">
                    <div class="flex items-center space-x-2">
                        <button type="button" @click="previousMonth()"
                                class="p-1 transition-colors rounded hover:bg-sena-verde-700"
                                aria-label="Mes anterior">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <span class="text-sm font-medium" x-text="formatMonth(currentMonth, currentYear)"></span>
                        <button type="button" @click="nextMonth()"
                                class="p-1 transition-colors rounded hover:bg-sena-verde-700"
                                aria-label="Mes siguiente">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>
                    </div>
                    <div class="text-xs" x-text="currentYear"></div>
                </div>
            </div>

            <!-- Calendario -->
            <div class="p-4">
                <!-- Días de la semana -->
                <div class="grid grid-cols-7 gap-1 mb-2">
                    <template x-for="day in ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb']">
                        <div class="p-2 text-xs font-medium text-center text-sena-gris-500" x-text="day"></div>
                    </template>
                </div>

                <!-- Días del mes -->
                <div class="grid grid-cols-7 gap-1">
                    <template x-for="day in calendarDays" :key="day.date">
                        <button
                            type="button"
                            @click="selectDate(day.date)"
                            @keydown.enter.prevent="selectDate(day.date)"
                            :disabled="day.disabled"
                            :class="{
                                'bg-sena-verde text-white': day.isSelected,
                                'bg-sena-verde-100 text-sena-verde-800': day.isInRange,
                                'bg-sena-gris-100 text-sena-gris-400': day.isOtherMonth,
                                'text-sena-gris-400 cursor-not-allowed': day.disabled,
                                'hover:bg-sena-verde-50': !day.disabled && !day.isSelected && !day.isInRange,
                                'border-2 border-sena-verde': day.isToday && !day.isSelected
                            }"
                            class="w-8 h-8 text-xs transition-all duration-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-sena-verde focus:ring-offset-1"
                            x-text="day.day"
                            :aria-label="formatDateLabel(day.date)"
                            :aria-selected="day.isSelected"
                            role="gridcell"
                        ></button>
                    </template>
                </div>
            </div>

            <!-- Información de rango -->
            <div class="p-3 border-t bg-sena-gris-50 border-sena-gris-200">
                <div class="flex items-center justify-between text-xs text-sena-gris-600">
                    <span>Inicio: <span x-text="formatDisplayDate(startDate)" class="font-medium"></span></span>
                    <span>Fin: <span x-text="formatDisplayDate(endDate)" class="font-medium"></span></span>
                </div>
                <div x-show="rangeDays > 0" class="mt-1 text-xs text-sena-verde-700">
                    <span x-text="rangeDays"></span> día(s) seleccionado(s)
                </div>
            </div>
        </div>
    </div>

    <!-- Mensaje de ayuda -->
    @if($help)
        <p id="{{ $id }}_help" class="mt-1 text-xs text-sena-gris-600">
            {{ $help }}
        </p>
    @endif

    <!-- Mensaje de error -->
    @if($hasError)
        <p id="{{ $id }}_error" class="flex items-center mt-1 text-xs text-red-600">
            <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
            </svg>
            {{ $errorMessage }}
        </p>
    @endif
</div>

<script>
function dateRangePicker(config) {
    return {
        isOpen: false,
        currentMonth: new Date().getMonth(),
        currentYear: new Date().getFullYear(),
        startDate: config.startValue || '',
        endDate: config.endValue || '',
        tempStartDate: null,
        displayValue: '',
        calendarDays: [],
        rangeDays: 0,

        init() {
            this.updateDisplayValue();
            this.generateCalendar();
            this.$watch('startDate', () => this.updateDisplayValue());
            this.$watch('endDate', () => this.updateDisplayValue());
        },

        toggleCalendar() {
            this.isOpen = !this.isOpen;
            if (this.isOpen) {
                this.generateCalendar();
            }
        },

        closeCalendar() {
            this.isOpen = false;
        },

        selectDate(dateStr) {
            const date = new Date(dateStr);

            if (!this.startDate || (this.startDate && this.endDate)) {
                // Nuevo rango
                this.startDate = dateStr;
                this.endDate = '';
                this.tempStartDate = date;
            } else if (this.startDate && !this.endDate) {
                // Completar rango
                if (date < this.tempStartDate) {
                    this.endDate = this.startDate;
                    this.startDate = dateStr;
                } else {
                    this.endDate = dateStr;
                }
                this.validateRange();
            }

            this.generateCalendar();
        },

        validateRange() {
            if (!this.startDate || !this.endDate) return;

            const start = new Date(this.startDate);
            const end = new Date(this.endDate);
            const diffTime = Math.abs(end - start);
            const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));

            this.rangeDays = diffDays;

            if (config.minRange && diffDays < config.minRange) {
                this.endDate = '';
                this.showError(`Rango mínimo: ${config.minRange} días`);
            }

            if (config.maxRange && diffDays > config.maxRange) {
                this.endDate = '';
                this.showError(`Rango máximo: ${config.maxRange} días`);
            }
        },

        generateCalendar() {
            this.calendarDays = [];
            const firstDay = new Date(this.currentYear, this.currentMonth, 1);
            const lastDay = new Date(this.currentYear, this.currentMonth + 1, 0);
            const startDate = new Date(firstDay);
            startDate.setDate(startDate.getDate() - firstDay.getDay());

            for (let i = 0; i < 42; i++) {
                const date = new Date(startDate);
                date.setDate(startDate.getDate() + i);

                this.calendarDays.push({
                    date: date.toISOString().split('T')[0],
                    day: date.getDate(),
                    isToday: this.isToday(date),
                    isSelected: this.isSelected(date),
                    isInRange: this.isInRange(date),
                    isOtherMonth: date.getMonth() !== this.currentMonth,
                    disabled: this.isDisabled(date)
                });
            }
        },

        isToday(date) {
            const today = new Date();
            return date.toDateString() === today.toDateString();
        },

        isSelected(date) {
            const dateStr = date.toISOString().split('T')[0];
            return dateStr === this.startDate || dateStr === this.endDate;
        },

        isInRange(date) {
            if (!this.startDate || !this.endDate) return false;
            const dateStr = date.toISOString().split('T')[0];
            return dateStr > this.startDate && dateStr < this.endDate;
        },

        isDisabled(date) {
            if (config.excludeWeekends && (date.getDay() === 0 || date.getDay() === 6)) {
                return true;
            }

            if (config.minDate && date < new Date(config.minDate)) {
                return true;
            }

            if (config.maxDate && date > new Date(config.maxDate)) {
                return true;
            }

            return false;
        },

        previousMonth() {
            if (this.currentMonth === 0) {
                this.currentMonth = 11;
                this.currentYear--;
            } else {
                this.currentMonth--;
            }
            this.generateCalendar();
        },

        nextMonth() {
            if (this.currentMonth === 11) {
                this.currentMonth = 0;
                this.currentYear++;
            } else {
                this.currentMonth++;
            }
            this.generateCalendar();
        },

        updateDisplayValue() {
            if (this.startDate && this.endDate) {
                const start = this.formatDisplayDate(this.startDate);
                const end = this.formatDisplayDate(this.endDate);
                this.displayValue = `${start} - ${end}`;
            } else if (this.startDate) {
                this.displayValue = this.formatDisplayDate(this.startDate);
            } else {
                this.displayValue = '';
            }
        },

        formatDisplayDate(dateStr) {
            if (!dateStr) return '';
            const date = new Date(dateStr);
            return date.toLocaleDateString('es-ES');
        },

        formatMonth(month, year) {
            const months = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
                          'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
            return months[month];
        },

        formatDateLabel(dateStr) {
            const date = new Date(dateStr);
            return date.toLocaleDateString('es-ES', { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' });
        },

        setRange(type) {
            const today = new Date();
            const start = new Date(today);
            const end = new Date(today);

            switch (type) {
                case 'today':
                    break;
                case 'yesterday':
                    start.setDate(today.getDate() - 1);
                    end.setDate(today.getDate() - 1);
                    break;
                case 'this_week':
                    start.setDate(today.getDate() - today.getDay());
                    end.setDate(start.getDate() + 6);
                    break;
                case 'last_week':
                    start.setDate(today.getDate() - today.getDay() - 7);
                    end.setDate(start.getDate() + 6);
                    break;
                case 'this_month':
                    start.setDate(1);
                    end.setMonth(today.getMonth() + 1, 0);
                    break;
                case 'last_month':
                    start.setMonth(today.getMonth() - 1, 1);
                    end.setMonth(today.getMonth(), 0);
                    break;
            }

            this.startDate = start.toISOString().split('T')[0];
            this.endDate = end.toISOString().split('T')[0];
            this.generateCalendar();
        },

        clearRange() {
            this.startDate = '';
            this.endDate = '';
            this.tempStartDate = null;
            this.rangeDays = 0;
            this.generateCalendar();
        },

        showError(message) {
            // Implementar notificación de error
            console.error(message);
        }
    }
}
</script>
