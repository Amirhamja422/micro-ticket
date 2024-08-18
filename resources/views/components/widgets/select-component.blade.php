<div class="{{ $inputColClass }} mb-2">
    <label class="form-label mb-1" for="{{ $inputId }}">{{ $inputLabel }}
        <span class="text-danger">{{ $required ? '*' : '' }}</span>
    </label>
    <span class="text-danger error_txt {{ $inputId }}"></span>
    <select id="{{ $inputId }}" class="result form-control" {{ $required }}>
<option value="dfsd">1dsfsdf</option>
<option value="dfsd">2dsfsdf</option>
<option value="dfsd">3dsfsdf</option>
    </select>
</div>
