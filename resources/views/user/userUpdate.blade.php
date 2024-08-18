<!-- modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">User Update</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Name" inputId="name" inputType="text"
                    required='required' :inputVal="$resultData->name" />

                <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Email" inputId="email" inputType="text"
                    required='required' :inputVal="$resultData->email" />

                    <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Number" inputId="number"
                    inputType="text" required='required'  :inputVal="$resultData->number" />

                <div class="col-xl-12 mb-2">
                    <label class="form-label mb-1" for="department_id"> Department <span class="text-danger">*</span>
                    </label>
                    <span class="text-danger error_txt department_id"></span>
                    <select id="department_id" class="result form-control" required>
                        <option value=""> Select a department</option>
                        @foreach ($departments as $department)
                            <option {{ $resultData->department_id == $department->id ? 'selected' : '' }}
                                value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-xl-12 mb-2">
                    <label class="form-label mb-1" for="role_id"> Role & Designation <span class="text-danger">*</span>
                    </label>
                    <span class="text-danger error_txt department_id"></span>
                    <select id="role_id" class="result form-control" required>
                        <option value=""> </option>
                        @foreach ($rolesData as $role)
                        <option value="{{ $role->id }}" @if ($selectedRole[0] == $role->id) {{"Selected"}}@endif >{{ $role->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                <button type="button" onclick="updateData({{ $resultData->id }})" class="btn btn-primary">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
