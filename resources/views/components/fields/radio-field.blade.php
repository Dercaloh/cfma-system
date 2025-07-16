@props([
    'name',
    'label',
    'value',
    'checked' => false,
    'description' => null,
    'disabled' => false,
    'id' => $name . '-' . Str::slug($value),
])

<div class="flex items-start gap-3">
    <input
        type="radio"
        id="{{ $id }}"
        name="{{ $name }}"
        value="{{ $value }}"
        @checked($checked)
        @disabled($disabled)
        aria-describedby="{{ $id }}-desc"
        {{ $attributes->merge([
            'class' => 'form-checkbox rounded-full text-sena-verde focus:ring-sena-azul',
        ]) }}
    >

    <div>
        <label for="{{ $id }}" class="form-label">
            {{ $label }}
        </label>

        @if($description)
            <p id="{{ $id }}-desc" class="form-description">
                {{ $description }}
            </p>
        @endif
    </div>
</div>
