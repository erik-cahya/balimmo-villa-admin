@props([
    'className' => null,
    'name',
    'label',
    'disabled' => false,
])

@php
    preg_match('/\[(.*?)\]/', $name, $matches);
    $key = $matches[1] ?? null;
    $isChecked = $key ? old('feature.' . $key) : old($name);
@endphp

<div class="{{ $className }}">
    <input type="checkbox" class="form-check-input" id="{{ $name }}" name="{{ $name }}" {{ $isChecked ? 'checked' : '' }} {{ $disabled ? 'disabled' : '' }}>
    <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
</div>
