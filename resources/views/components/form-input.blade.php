{{-- Jika tidak diberikan atribut placeholder, maka akan menggunakan Input + label --}}
<div class="col-lg-6 mb-3" id="group_{{ $name }}">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" class="form-control" placeholder="{{ isset($placeholder) ? $placeholder : 'Input ' . $label }}">
</div>
