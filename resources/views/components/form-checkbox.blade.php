@props([
    'className' => null,
    'name',
    'label',
    'disabled' => false,
])

<div class="{{ $className }}">
    <input type="checkbox" class="form-check-input" id="{{ $name }}" name="{{ $name }}">
    <label class="form-check-label" for="{{ $name }}">{{ $label }}</label>
</div>




{{-- Equipped Kitchen (Fridge, Oven, Stove, Extractor Hood) --}}
