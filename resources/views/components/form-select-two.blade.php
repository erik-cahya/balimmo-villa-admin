@props(
    [
        'className',
        'name',
        'label',
        'options' => null,
        'selected' => null,
        'defaultOptions' => ['Yes', 'No']
    ]
)

<div class="{{ $className }} mb-3" id="group_{{ $name }}">
    <label for="{{ $name }}" class="form-label">{{ $label }}</label>
    <select class="form-control" id="{{ $name }}" name="{{ $name }}" data-choices data-choices-sorting-false>
        
        @foreach(($options ?? $defaultOptions) as $key => $value)
            <option value="{{ is_numeric($key) ? $value : $key }}" 
                {{ $selected == (is_numeric($key) ? $value : $key) ? 'selected' : '' }}
            >
                {{ $value }}
        </option>
        @endforeach
         
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
