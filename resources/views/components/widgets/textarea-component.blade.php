<div class="{{ $inputColClass }} mb-1">
    <label class="form-label mb-1" for="{{ $inputId }}">{{ $inputLabel }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <span class="text-danger error_txt {{ $inputId }}"></span>
    <textarea class="ckeditor form-control" id="{{ $inputId }}" cols="2" rows="{{ $textRows }}" {{ $required }}>{{ $textareaVal }}</textarea>
</div>

