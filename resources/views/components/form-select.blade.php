<div class="col-lg-6" id="group_{{ $name }}">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select class="form-control" id="{{ $name }}" name="{{ $name }}[]" multiple="multiple">
         {{ $slot }}
    </select>
</div>