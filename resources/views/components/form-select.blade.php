
{{-- Jika slot dikosongkan, akan menampilkan pilihan yes/no --}}
<div class="{{ $className }} mb-3" id="group_{{ $name }}">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select class="form-control" id="{{ $name }}" name="{{ $name }}" data-choices data-choices-sorting-false data-toggle-target="{{ isset($toggle) ? $toggle : '' }}" >
        
        @if($slot->isNotEmpty())
            {{ $slot }}
        @else
            {{-- <option selected disabled>Select {{ $label }}</option> --}}
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
</div>
