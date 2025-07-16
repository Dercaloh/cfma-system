{{-- resources/views/components/date-picker/date-selector.blade.php --}}
{{--
    Componente de Selector de Fechas para SGPTI
    Framework: Laravel 12 + Blade Components + Tailwind CSS
    Institución: Centro de Formación Minero Ambiental del SENA (CFMA-SENA)
    Autor: Sistema SGPTI
    Versión: 1.0
    Fecha: 2025

    PROPÓSITO:
    Selector de fechas con calendario visual interactivo, validación inteligente
    y soporte completo para accesibilidad WCAG 2.1 AA
--}}

@props([
    'name' => 'fecha',
    'label' => 'Seleccionar fecha',
    'value' => old('fecha', ''),
    'minDate' => null,
    'maxDate' => null,
    'excludeWeekends' => false,
    'excludeDates' => [],
    'format' => 'Y-m-d',
    'displayFormat' => 'd/m/Y',
    'required' => false,
    'disabled' => false,
    'placeholder' => 'Seleccione una fecha',
    'helpText' => null,
    'error' => null,
    'id' => null,
    'class' => ''
])

@php
    $inputId = $id ?? 'date-' . $name . '-' . uniqid();
    $calendarId = $inputId . '-calendar';
    $hasError = $error || $errors->has($name);
    $errorMessage = $error ?? $errors->first($name);

    // Procesar fechas mínimas y máximas
    $minDateProcessed = null;
    $maxDateProcessed = null;

    if ($minDate) {
        if ($minDate === 'today') {
            $minDateProcessed = date('Y-m-d');
        } elseif (str_starts_with($minDate, '+')) {
            $minDateProcessed = date('Y-m-d', strtotime($minDate));
        } elseif (str_starts_with($minDate, '-')) {
            $minDateProcessed = date('Y-m-d', strtotime($minDate));
        } else {
            $minDateProcessed = $minDate;
        }
    }

    if ($maxDate) {
        if ($maxDate === 'today') {
            $maxDateProcessed = date('Y-m-d');
        } elseif (str_starts_with($maxDate, '+')) {
            $maxDateProcessed = date('Y-m-d', strtotime($maxDate));
        } elseif (str_starts_with($maxDate, '-')) {
            $maxDateProcessed = date('Y-m-d', strtotime($maxDate));
        } else {
            $maxDateProcessed = $maxDate;
        }
    }
@endphp

<div class="relative w-full">
    {{-- Label --}}
    @if($label)
        <label for="{{ $inputId }}" class="block mb-2 text-sm font-semibold text-sena-azul-900">
            {{ $label }}
            @if($required)
                <span class="ml-1 text-red-500" aria-label="Campo obligatorio">*</span>
            @endif
        </label>
    @endif

    {{-- Input Container --}}
    <div class="relative">
        {{-- Input Field --}}
        <input
            type="text"
            id="{{ $inputId }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            readonly
            @if($required) required @endif
            @if($disabled) disabled @endif
            class="w-full px-4 py-3 pr-12 text-sm border-2 rounded-xl shadow-neumorph bg-white/90 backdrop-blur-sm transition-all duration-300 cursor-pointer
                {{ $hasError
                    ? 'border-red-300 focus:border-red-500 focus:ring-red-500'
                    : 'border-sena-gris-300 focus:border-sena-verde focus:ring-sena-verde hover:border-sena-verde-sec'
                }}
                {{ $disabled ? 'opacity-50 cursor-not-allowed' : '' }}
                {{ $class }}"
            aria-describedby="{{ $helpText ? $inputId . '-help' : '' }} {{ $hasError ? $inputId . '-error' : '' }}"
            aria-expanded="false"
            aria-haspopup="dialog"
            role="combobox"
        />

        {{-- Calendar Icon --}}
        <button
            type="button"
            class="absolute transition-colors duration-200 transform -translate-y-1/2 right-3 top-1/2 text-sena-gris-600 hover:text-sena-verde"
            aria-label="Abrir calendario"
            @if($disabled) disabled @endif
        >
            <x-heroicon-o-calendar-days class="w-5 h-5" />
        </button>

        {{-- Calendar Dropdown --}}
        <div
            id="{{ $calendarId }}"
            class="absolute z-50 hidden mt-2 bg-white border w-80 rounded-xl shadow-glass border-sena-gris-200 backdrop-blur-sm"
            role="dialog"
            aria-modal="true"
            aria-labelledby="{{ $inputId }}-calendar-title"
        >
            {{-- Calendar Header --}}
            <div class="flex items-center justify-between p-4 border-b border-sena-gris-200">
                <h3 id="{{ $inputId }}-calendar-title" class="text-sm font-semibold text-sena-azul-900">
                    Seleccionar fecha
                </h3>
                <button
                    type="button"
                    class="transition-colors text-sena-gris-500 hover:text-sena-azul-900"
                    aria-label="Cerrar calendario"
                >
                    <x-heroicon-o-x-mark class="w-5 h-5" />
                </button>
            </div>

            {{-- Calendar Navigation --}}
            <div class="flex items-center justify-between p-4 border-b border-sena-gris-200">
                <button
                    type="button"
                    class="p-2 transition-colors rounded-lg text-sena-gris-600 hover:text-sena-verde hover:bg-sena-gris-100"
                    aria-label="Mes anterior"
                >
                    <x-heroicon-o-chevron-left class="w-4 h-4" />
                </button>

                <div class="flex items-center space-x-2">
                    <select class="text-sm font-medium bg-transparent border-0 cursor-pointer text-sena-azul-900 focus:ring-0">
                        <option value="0">Enero</option>
                        <option value="1">Febrero</option>
                        <option value="2">Marzo</option>
                        <option value="3">Abril</option>
                        <option value="4">Mayo</option>
                        <option value="5">Junio</option>
                        <option value="6">Julio</option>
                        <option value="7">Agosto</option>
                        <option value="8">Septiembre</option>
                        <option value="9">Octubre</option>
                        <option value="10">Noviembre</option>
                        <option value="11">Diciembre</option>
                    </select>

                    <select class="text-sm font-medium bg-transparent border-0 cursor-pointer text-sena-azul-900 focus:ring-0">
                        @for($year = date('Y') - 5; $year <= date('Y') + 5; $year++)
                            <option value="{{ $year }}" {{ $year == date('Y') ? 'selected' : '' }}>
                                {{ $year }}
                            </option>
                        @endfor
                    </select>
                </div>

                <button
                    type="button"
                    class="p-2 transition-colors rounded-lg text-sena-gris-600 hover:text-sena-verde hover:bg-sena-gris-100"
                    aria-label="Mes siguiente"
                >
                    <x-heroicon-o-chevron-right class="w-4 h-4" />
                </button>
            </div>

            {{-- Calendar Grid --}}
            <div class="p-4">
                {{-- Days Headers --}}
                <div class="grid grid-cols-7 gap-1 mb-2">
                    <div class="py-2 text-xs font-medium text-center text-sena-gris-600">Dom</div>
                    <div class="py-2 text-xs font-medium text-center text-sena-gris-600">Lun</div>
                    <div class="py-2 text-xs font-medium text-center text-sena-gris-600">Mar</div>
                    <div class="py-2 text-xs font-medium text-center text-sena-gris-600">Mié</div>
                    <div class="py-2 text-xs font-medium text-center text-sena-gris-600">Jue</div>
                    <div class="py-2 text-xs font-medium text-center text-sena-gris-600">Vie</div>
                    <div class="py-2 text-xs font-medium text-center text-sena-gris-600">Sáb</div>
                </div>

                {{-- Days Grid --}}
                <div class="grid grid-cols-7 gap-1" id="{{ $inputId }}-calendar-grid">
                    {{-- Los días se generarán dinámicamente con JavaScript --}}
                </div>
            </div>

            {{-- Calendar Footer --}}
            <div class="flex items-center justify-between p-4 border-t border-sena-gris-200">
                <button
                    type="button"
                    class="text-sm transition-colors text-sena-verde hover:text-sena-verde-sec"
                >
                    Hoy
                </button>
                <button
                    type="button"
                    class="text-sm transition-colors text-sena-gris-600 hover:text-sena-azul-900"
                >
                    Limpiar
                </button>
            </div>
        </div>
    </div>

    {{-- Help Text --}}
    @if($helpText)
        <p id="{{ $inputId }}-help" class="mt-2 text-sm text-sena-gris-600">
            {{ $helpText }}
        </p>
    @endif

    {{-- Error Message --}}
    @if($hasError)
        <div id="{{ $inputId }}-error" class="flex items-center mt-2 text-red-600" role="alert">
            <x-heroicon-o-exclamation-triangle class="flex-shrink-0 w-4 h-4 mr-2" />
            <span class="text-sm">{{ $errorMessage }}</span>
        </div>
    @endif
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const dateSelector = new DateSelector({
        inputId: '{{ $inputId }}',
        calendarId: '{{ $calendarId }}',
        name: '{{ $name }}',
        minDate: @json($minDateProcessed),
        maxDate: @json($maxDateProcessed),
        excludeWeekends: {{ $excludeWeekends ? 'true' : 'false' }},
        excludeDates: @json($excludeDates),
        format: '{{ $format }}',
        displayFormat: '{{ $displayFormat }}',
        required: {{ $required ? 'true' : 'false' }},
        disabled: {{ $disabled ? 'true' : 'false' }}
    });
});

class DateSelector {
    constructor(options) {
        this.options = options;
        this.input = document.getElementById(options.inputId);
        this.calendar = document.getElementById(options.calendarId);
        this.currentDate = new Date();
        this.selectedDate = null;
        this.isOpen = false;

        this.init();
    }

    init() {
        this.setupEventListeners();
        this.renderCalendar();

        // Set initial value if provided
        if (this.input.value) {
            this.selectedDate = new Date(this.input.value);
        }
    }

    setupEventListeners() {
        // Input click
        this.input.addEventListener('click', (e) => {
            if (!this.options.disabled) {
                this.toggleCalendar();
            }
        });

        // Calendar navigation
        const prevBtn = this.calendar.querySelector('[aria-label="Mes anterior"]');
        const nextBtn = this.calendar.querySelector('[aria-label="Mes siguiente"]');
        const closeBtn = this.calendar.querySelector('[aria-label="Cerrar calendario"]');
        const todayBtn = this.calendar.querySelector('button:contains("Hoy")');
        const clearBtn = this.calendar.querySelector('button:contains("Limpiar")');

        prevBtn?.addEventListener('click', () => this.previousMonth());
        nextBtn?.addEventListener('click', () => this.nextMonth());
        closeBtn?.addEventListener('click', () => this.closeCalendar());

        // Month/Year selectors
        const monthSelect = this.calendar.querySelector('select');
        const yearSelect = this.calendar.querySelectorAll('select')[1];

        monthSelect?.addEventListener('change', (e) => {
            this.currentDate.setMonth(parseInt(e.target.value));
            this.renderCalendar();
        });

        yearSelect?.addEventListener('change', (e) => {
            this.currentDate.setFullYear(parseInt(e.target.value));
            this.renderCalendar();
        });

        // Today button
        this.calendar.addEventListener('click', (e) => {
            if (e.target.textContent === 'Hoy') {
                this.selectToday();
            }
        });

        // Clear button
        this.calendar.addEventListener('click', (e) => {
            if (e.target.textContent === 'Limpiar') {
                this.clearDate();
            }
        });

        // Outside click
        document.addEventListener('click', (e) => {
            if (!this.input.contains(e.target) && !this.calendar.contains(e.target)) {
                this.closeCalendar();
            }
        });

        // Keyboard navigation
        this.input.addEventListener('keydown', (e) => {
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                this.toggleCalendar();
            } else if (e.key === 'Escape') {
                this.closeCalendar();
            }
        });
    }

    toggleCalendar() {
        if (this.isOpen) {
            this.closeCalendar();
        } else {
            this.openCalendar();
        }
    }

    openCalendar() {
        this.calendar.classList.remove('hidden');
        this.input.setAttribute('aria-expanded', 'true');
        this.isOpen = true;

        // Focus first focusable element
        const firstFocusable = this.calendar.querySelector('button, select, [tabindex]:not([tabindex="-1"])');
        if (firstFocusable) {
            firstFocusable.focus();
        }

        this.renderCalendar();
    }

    closeCalendar() {
        this.calendar.classList.add('hidden');
        this.input.setAttribute('aria-expanded', 'false');
        this.isOpen = false;
        this.input.focus();
    }

    previousMonth() {
        this.currentDate.setMonth(this.currentDate.getMonth() - 1);
        this.renderCalendar();
    }

    nextMonth() {
        this.currentDate.setMonth(this.currentDate.getMonth() + 1);
        this.renderCalendar();
    }

    selectToday() {
        const today = new Date();
        if (this.isDateSelectable(today)) {
            this.selectDate(today);
        }
    }

    clearDate() {
        this.selectedDate = null;
        this.input.value = '';
        this.closeCalendar();
        this.input.dispatchEvent(new Event('change', { bubbles: true }));
    }

    selectDate(date) {
        if (!this.isDateSelectable(date)) {
            return;
        }

        this.selectedDate = new Date(date);
        this.input.value = this.formatDate(date, this.options.displayFormat);
        this.closeCalendar();

        // Trigger change event
        this.input.dispatchEvent(new Event('change', { bubbles: true }));
    }

    isDateSelectable(date) {
        // Check min date
        if (this.options.minDate) {
            const minDate = new Date(this.options.minDate);
            if (date < minDate) return false;
        }

        // Check max date
        if (this.options.maxDate) {
            const maxDate = new Date(this.options.maxDate);
            if (date > maxDate) return false;
        }

        // Check weekends
        if (this.options.excludeWeekends) {
            const dayOfWeek = date.getDay();
            if (dayOfWeek === 0 || dayOfWeek === 6) return false;
        }

        // Check excluded dates
        if (this.options.excludeDates.length > 0) {
            const dateStr = this.formatDate(date, 'Y-m-d');
            if (this.options.excludeDates.includes(dateStr)) return false;
        }

        return true;
    }

    renderCalendar() {
        const grid = document.getElementById(this.options.inputId + '-calendar-grid');
        if (!grid) return;

        grid.innerHTML = '';

        const year = this.currentDate.getFullYear();
        const month = this.currentDate.getMonth();

        // Update month/year selectors
        const monthSelect = this.calendar.querySelector('select');
        const yearSelect = this.calendar.querySelectorAll('select')[1];

        if (monthSelect) monthSelect.value = month;
        if (yearSelect) yearSelect.value = year;

        // Get first day of month and number of days
        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const daysInMonth = lastDay.getDate();
        const startingDayOfWeek = firstDay.getDay();

        // Add empty cells for days before the first day of the month
        for (let i = 0; i < startingDayOfWeek; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'w-8 h-8';
            grid.appendChild(emptyCell);
        }

        // Add days of the month
        for (let day = 1; day <= daysInMonth; day++) {
            const date = new Date(year, month, day);
            const dayButton = document.createElement('button');

            dayButton.type = 'button';
            dayButton.textContent = day;
            dayButton.className = 'w-8 h-8 text-sm rounded-lg transition-all duration-200 hover:bg-sena-gris-100 focus:outline-none focus:ring-2 focus:ring-sena-verde';

            // Check if date is selectable
            if (this.isDateSelectable(date)) {
                dayButton.className += ' text-sena-azul-900 hover:bg-sena-verde hover:text-white';
            } else {
                dayButton.className += ' text-sena-gris-400 cursor-not-allowed';
                dayButton.disabled = true;
            }

            // Check if date is selected
            if (this.selectedDate && this.isSameDay(date, this.selectedDate)) {
                dayButton.className += ' bg-sena-verde text-white';
            }

            // Check if date is today
            if (this.isSameDay(date, new Date())) {
                dayButton.className += ' font-bold ring-2 ring-sena-verde ring-opacity-50';
            }

            dayButton.addEventListener('click', () => {
                if (this.isDateSelectable(date)) {
                    this.selectDate(date);
                }
            });

            grid.appendChild(dayButton);
        }
    }

    isSameDay(date1, date2) {
        return date1.getDate() === date2.getDate() &&
               date1.getMonth() === date2.getMonth() &&
               date1.getFullYear() === date2.getFullYear();
    }

    formatDate(date, format) {
        const year = date.getFullYear();
        const month = String(date.getMonth() + 1).padStart(2, '0');
        const day = String(date.getDate()).padStart(2, '0');

        return format
            .replace('Y', year)
            .replace('m', month)
            .replace('d', day);
    }
}
</script>
@endpush
