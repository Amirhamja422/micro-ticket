<!-- modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Create</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Name" inputId="name" inputType="text"
                    required='required' />

                <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Email" inputId="email"
                    inputType="email" required='required' />

                <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Number" inputId="number"
                    inputType="text" required='required' />

                <div class="col-xl-12 mb-2">
                    <label class="form-label mb-1" for="department_id"> Department <span class="text-danger">*</span>
                    </label>
                    <span class="text-danger error_txt department_id"></span>
                    <select id="department_id" name="department_id[]" class="result form-control multiple-select" multiple="multiple" required>
                        <option value=""> </option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xl-12 mb-2">
                    <label class="form-label mb-1" for="role_id"> Role & Designation <span class="text-danger">*</span>
                    </label>
                    <span class="text-danger error_txt role"></span>
                    <select id="role_id" class="result form-control" required>
                        <option value=""> </option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                {{-- <button type="button" onclick="submitData('New')" class="btn btn-primary">Save New</button> --}}
                <button type="button" onclick="submitData()" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
<script>
    $('.multiple-select').select2({
        theme: 'bootstrap4',
        dropdownParent: $('#Modal'),
        width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' : 'style',
        placeholder: $(this).data('placeholder'),
        allowClear: Boolean($(this).data('allow-clear')),
    });
</script>
