@props([
    'inputClassName' => null,
    'className' => null,
    'name' => null,
    'label',
    'type',
    'disabled' => false,
    'required' => false,
    'value',
    'placeholder',
])

{{-- Jika tidak diberikan atribut placeholder, maka akan menggunakan Input + label --}}
<div class="{{ $className }} mb-1" id="group_{{ $name }}">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>

    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" class="form-control {{ $inputClassName }} @error($name) validation-form @enderror" placeholder="{{ isset($placeholder) ? $placeholder : 'Input ' . $label }}" value="{{ isset($value) ? old($name, $value) : old($name) }}" {{ $disabled ? 'disabled' : '' }} {{ $required ? 'required' : '' }}>

    @error($name)
        <div class="alert alert-danger fs-11 m-0 p-1">

            {{ $message }}
        </div>
    @enderror
</div>

{{-- Ga Pake Component
    <div class="col-lg-6 mb-3" id="group_owner_name">
        <label for="owner_name" class="form-label">Masukkan Nama Owner</label>
        <input type="text" id="owner_name" name="owner_name" class="form-control" placeholder="Input Owner Name">
    </div>

    <div class="col-lg-6 mb-3" id="group_owner_contact">
        <label for="owner_contact" class="form-label">Masukkan Contact Owner</label>
        <input type="text" id="owner_contact" name="owner_contact" class="form-control" placeholder="Input Owner Contact">
    </div>





{{-- Pake Component --}}
{{-- <x-form-input type="text" name="owner_name" label="Masukkan Nama Owner" placeholder="Input Owner Name" /> --}}
{{-- <x-form-input type="text" name="owner_contact" label="Masukkan Kontak Owner" placeholder="Input Owner Contact" /> --}}
