{{--
Docs
    - jika tidak memberikan options="", maka form select akan menjadi yes/no..
    - jika memberikan options="[array]", akan menjadi value dari options tersebut
    - toggles="" : digunakan untuk memberikan toggling hide/show sebuah form dengan pointing ke id=#group_{{ $name }}
--}}
@props(['className', 'name', 'label', 'options' => null, 'selected' => null, 'defaultOptions' => ['Yes', 'No'], 'toggle'])

<div class="{{ $className }} text-capitalize mb-3" id="group_{{ $name }}">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select class="form-control" id="{{ $name }}" name="{{ $name }}" data-choices data-choices-sorting-false data-toggle-target="{{ isset($toggle) ? $toggle : '' }}">
        <option value="" selected disabled>Choose {{ $label }}</option>
        @foreach ($options ?? $defaultOptions as $key => $value)
            <option value="{{ is_numeric($key) ? $value : $key }}" {{ old($name, $selected) === (is_numeric($key) ? $value : $key) ? 'selected' : '' }}>
                {{ $value }}
            </option>
        @endforeach

    </select>

    @error($name)
        <style>
            .choices__inner {
                border-color: #e96767 !important;
            }
        </style>

        <div class="alert alert-danger m-0">
            {{ $message }}
        </div>
    @enderror
</div>

{{-- Jika slot dikosongkan, akan menampilkan pilihan yes/no
<div class="{{ $className }} mb-3" id="group_{{ $name }}">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select class="form-control" id="{{ $name }}" name="{{ $name }}" data-choices data-choices-sorting-false data-toggle-target="{{ isset($toggle) ? $toggle : '' }}" >

        @if ($slot->isNotEmpty())
            {{ $slot }}
        @else
            <option value="No" selected>No</option>
            <option value="Yes">Yes</option>
        @endif

    </select>

    @error($name)
        <style>
            .choices__inner{ border-color: #e96767!important;}
        </style>

        <div class="validation-message mt-1">
            {{ $message }}
        </div>
    @enderror
</div> --}}
