<!-- modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Subcategory Create</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">

                <div class="col-xl-12 mb-2">
                    <label class="form-label mb-1" for="cat_id">Category<span class="text-danger">*</span>
                    </label>
                    <span class="text-danger error_txt cat_id"></span>
                    <select id="cat_id" class="result form-control" required>
                        <option value=""> </option>
                        @foreach ($subcategory as $subcategory)
                            <option value="{{ $subcategory->id }}">{{ $subcategory->cat_name }}</option>
                        @endforeach
                    </select>
                </div>

                <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Subcatgory Name" inputId="sub_cat_name"
                inputType="text" required='required' />


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                <button type="button" onclick="submitData()" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
