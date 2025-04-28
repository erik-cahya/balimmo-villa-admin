<div class="col-lg-6 mb-3" id="group_{{ $name }}">
    <label for="{{ $name }}" class="form-label d-flex flex-column">{{ $label }}</label>
    <select class="form-control" id="{{ $name }}" name="{{ $name }}[]" multiple="multiple">
         {{ $slot }}
    </select>
</div>