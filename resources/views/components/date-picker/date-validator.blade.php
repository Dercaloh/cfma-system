{{--
* Componente: Date Validator - SGPTI CFMA-SENA
* Propósito: Validador visual de fechas con feedback en tiempo real
* Ubicación: resources/views/components/date-picker/date-validator.blade.php
* Autor: Sistema SGPTI - Centro de Formación Minero Ambiental SENA
--}}

@props([
    'name' => 'fecha',
    'label' => 'Fecha',
    'value' => '',
    'minDate' => null,
    'maxDate' => null,
    'excludeWeekends' => false,
    'excludeDates' => [],
    'required' => false,
    'placeholder' => 'Seleccione una fecha',
    'format' => 'Y-m-d',
    'displayFormat' => 'd/m/Y',
    'showValidation' => true,
    'validationRules' => [],
    'helpText' => null,
    'size' => 'md'
])

@php
    $id = $name . '_' . uniqid();
    $sizeClasses = [
        'sm' => 'text-sm py-2 px-3',
        'md' => 'text-base py-3 px-4',
        'lg' => 'text-lg py-4 px-5'
    ];
    $inputClass = $sizeClasses[$size] ?? $sizeClasses['md'];
@endphp

<div class="w-full space-y-2" x-data="dateValidator({
    name: '{{ $name }}',
    value: '{{ $value }}',
    minDate: '{{ $minDate }}',
    maxDate: '{{ $maxDate }}',
    excludeWeekends: {{ $excludeWeekends ? 'true' : 'false' }},
    excludeDates: {{ json_encode($excludeDates) }},
    required: {{ $required ? 'true' : 'false' }},
    format: '{{ $format }}',
    displayFormat: '{{ $displayFormat }}',
    validationRules: {{ json_encode($validationRules) }}
})" x-init="init()">

    <!-- Label -->
    <div class="flex items-center justify-between">
        <label for="{{ $id }}" class="block text-sm font-semibold text-sena-azul-900">
            {{ $label }}
            @if($required)
                <span class="ml-1 text-red-500">*</span>
            @endif
        </label>

        @if($showValidation)
            <div class="flex items-center space-x-2">
                <!-- Indicador de validación -->
                <div x-show="validationState === 'validating'" class="flex items-center">
                    <div class="w-4 h-4 border-2 rounded-full animate-spin border-sena-verde border-t-transparent"></div>
                    <span class="ml-2 text-xs text-sena-gris-600">Validando...</span>
                </div>

                <div x-show="validationState === 'valid'" class="flex items-center text-green-600">
                    <x-heroicon-s-check-circle class="w-4 h-4"/>
                    <span class="ml-1 text-xs">Válida</span>
                </div>

                <div x-show="validationState === 'invalid'" class="flex items-center text-red-600">
                    <x-heroicon-s-x-circle class="w-4 h-4"/>
                    <span class="ml-1 text-xs">Inválida</span>
                </div>
            </div>
        @endif
    </div>

    <!-- Input Container -->
    <div class="relative">
        <input
            type="text"
            id="{{ $id }}"
            name="{{ $name }}"
            x-model="displayValue"
            x-on:input="validateInput"
            x-on:blur="validateDate"
            x-on:focus="onFocus"
            placeholder="{{ $placeholder }}"
            class="w-full {{ $inputClass }} bg-white border-2 rounded-xl
                   shadow-neumorph focus:shadow-neumorph-inset
                   transition-all duration-300 font-medium
                   placeholder-sena-gris-400 text-sena-azul-900
                   focus:outline-none focus:ring-0"
            :class="{
                'border-sena-gris-300': validationState === 'idle',
                'border-sena-verde': validationState === 'valid',
                'border-red-400': validationState === 'invalid',
                'border-yellow-400': validationState === 'warning'
            }"
            autocomplete="off"
            {{ $required ? 'required' : '' }}
        >

        <!-- Icono de calendario -->
        <div class="absolute transform -translate-y-1/2 pointer-events-none right-3 top-1/2">
            <x-heroicon-o-calendar-days class="w-5 h-5 text-sena-gris-500"/>
        </div>

        <!-- Input oculto con valor real -->
        <input type="hidden" name="{{ $name }}_formatted" x-model="formattedValue">
    </div>

    <!-- Mensajes de validación -->
    <div class="min-h-[1.5rem]">
        <!-- Mensaje de error -->
        <div x-show="validationState === 'invalid' && errorMessage"
             class="flex items-center mt-1 text-sm text-red-600"
             x-transition>
            <x-heroicon-s-exclamation-triangle class="w-4 h-4 mr-2"/>
            <span x-text="errorMessage"></span>
        </div>

        <!-- Mensaje de advertencia -->
        <div x-show="validationState === 'warning' && warningMessage"
             class="flex items-center mt-1 text-sm text-yellow-600"
             x-transition>
            <x-heroicon-s-exclamation-triangle class="w-4 h-4 mr-2"/>
            <span x-text="warningMessage"></span>
        </div>

        <!-- Mensaje de éxito -->
        <div x-show="validationState === 'valid' && successMessage"
             class="flex items-center mt-1 text-sm text-green-600"
             x-transition>
            <x-heroicon-s-check-circle class="w-4 h-4 mr-2"/>
            <span x-text="successMessage"></span>
        </div>

        <!-- Texto de ayuda -->
        @if($helpText)
            <div x-show="validationState === 'idle'" class="mt-1 text-sm text-sena-gris-500">
                <x-heroicon-o-information-circle class="inline w-4 h-4 mr-1"/>
                {{ $helpText }}
            </div>
        @endif
    </div>

    <!-- Información adicional de la fecha -->
    <div x-show="validationState === 'valid' && dateInfo"
         class="p-3 mt-2 border rounded-lg bg-sena-verde-50 border-sena-verde-200"
         x-transition>
        <div class="flex items-start space-x-2">
            <x-heroicon-s-information-circle class="h-5 w-5 text-sena-verde mt-0.5"/>
            <div class="text-sm text-sena-verde-800">
                <div class="mb-1 font-medium">Información de la fecha:</div>
                <div x-html="dateInfo"></div>
            </div>
        </div>
    </div>
</div>

<script>
function dateValidator(config) {
    return {
        displayValue: '',
        formattedValue: '',
        validationState: 'idle', // idle, validating, valid, invalid, warning
        errorMessage: '',
        warningMessage: '',
        successMessage: '',
        dateInfo: '',

        init() {
            if (config.value) {
                this.displayValue = this.formatDisplayDate(config.value);
                this.formattedValue = config.value;
                this.validateDate();
            }
        },

        validateInput() {
            if (!this.displayValue) {
                this.validationState = 'idle';
                this.clearMessages();
                return;
            }

            this.validationState = 'validating';

            // Debounce validation
            clearTimeout(this.validationTimeout);
            this.validationTimeout = setTimeout(() => {
                this.validateDate();
            }, 500);
        },

        validateDate() {
            const dateValue = this.parseDate(this.displayValue);

            if (!dateValue) {
                this.setInvalid('Formato de fecha inválido');
                return;
            }

            // Validar fecha mínima
            if (config.minDate && dateValue < this.parseDate(config.minDate)) {
                this.setInvalid(`La fecha debe ser posterior a ${this.formatDisplayDate(config.minDate)}`);
                return;
            }

            // Validar fecha máxima
            if (config.maxDate && dateValue > this.parseDate(config.maxDate)) {
                this.setInvalid(`La fecha debe ser anterior a ${this.formatDisplayDate(config.maxDate)}`);
                return;
            }

            // Validar fines de semana
            if (config.excludeWeekends && this.isWeekend(dateValue)) {
                this.setWarning('La fecha seleccionada es fin de semana');
                return;
            }

            // Validar fechas excluidas
            if (config.excludeDates.includes(this.formatDate(dateValue))) {
                this.setInvalid('Esta fecha no está disponible');
                return;
            }

            // Validar requerido
            if (config.required && !this.displayValue) {
                this.setInvalid('Este campo es requerido');
                return;
            }

            this.setValid(dateValue);
        },

        parseDate(dateString) {
            if (!dateString) return null;

            // Intentar parsear diferentes formatos
            const formats = ['d/m/Y', 'Y-m-d', 'm/d/Y', 'd-m-Y'];

            for (let format of formats) {
                const date = this.parseWithFormat(dateString, format);
                if (date) return date;
            }

            return null;
        },

        parseWithFormat(dateString, format) {
            try {
                const parts = dateString.split(/[\/\-]/);
                if (parts.length !== 3) return null;

                let day, month, year;

                if (format === 'd/m/Y' || format === 'd-m-Y') {
                    day = parseInt(parts[0]);
                    month = parseInt(parts[1]) - 1;
                    year = parseInt(parts[2]);
                } else if (format === 'Y-m-d') {
                    year = parseInt(parts[0]);
                    month = parseInt(parts[1]) - 1;
                    day = parseInt(parts[2]);
                } else if (format === 'm/d/Y') {
                    month = parseInt(parts[0]) - 1;
                    day = parseInt(parts[1]);
                    year = parseInt(parts[2]);
                }

                const date = new Date(year, month, day);
                return date.getFullYear() === year && date.getMonth() === month && date.getDate() === day ? date : null;
            } catch (e) {
                return null;
            }
        },

        formatDate(date) {
            if (!date) return '';
            return date.toISOString().split('T')[0];
        },

        formatDisplayDate(dateString) {
            const date = typeof dateString === 'string' ? this.parseDate(dateString) : dateString;
            if (!date) return '';

            return date.toLocaleDateString('es-CO', {
                day: '2-digit',
                month: '2-digit',
                year: 'numeric'
            });
        },

        isWeekend(date) {
            const day = date.getDay();
            return day === 0 || day === 6; // Domingo o Sábado
        },

        setValid(dateValue) {
            this.validationState = 'valid';
            this.formattedValue = this.formatDate(dateValue);
            this.errorMessage = '';
            this.warningMessage = '';
            this.successMessage = 'Fecha válida';
            this.generateDateInfo(dateValue);
        },

        setInvalid(message) {
            this.validationState = 'invalid';
            this.errorMessage = message;
            this.warningMessage = '';
            this.successMessage = '';
            this.dateInfo = '';
            this.formattedValue = '';
        },

        setWarning(message) {
            this.validationState = 'warning';
            this.warningMessage = message;
            this.errorMessage = '';
            this.successMessage = '';
        },

        clearMessages() {
            this.errorMessage = '';
            this.warningMessage = '';
            this.successMessage = '';
            this.dateInfo = '';
        },

        generateDateInfo(date) {
            const dayName = date.toLocaleDateString('es-CO', { weekday: 'long' });
            const monthName = date.toLocaleDateString('es-CO', { month: 'long' });
            const dayOfYear = Math.floor((date - new Date(date.getFullYear(), 0, 0)) / (1000 * 60 * 60 * 24));

            this.dateInfo = `
                <strong>${dayName}</strong>, ${date.getDate()} de ${monthName} de ${date.getFullYear()}<br>
                Día ${dayOfYear} del año • ${this.isWeekend(date) ? 'Fin de semana' : 'Día hábil'}
            `;
        },

        onFocus() {
            if (this.validationState === 'idle' && !this.displayValue) {
                this.validationState = 'idle';
            }
        }
    }
}
</script>
