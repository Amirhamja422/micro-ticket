<div class="{{ $inputColClass }} mb-2">
    <label class="form-label mb-1" for="{{ $inputId }}">{{ $inputLabel }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <span class="text-danger error_txt {{ $inputId }}"></span>
    <input class="result form-control datepicker" placeholder="{{ $placeholder }}" id="{{ $inputId }}" type="{{ $inputType }}" value="{{ $inputVal }}" {{ $required }}>
</div>
