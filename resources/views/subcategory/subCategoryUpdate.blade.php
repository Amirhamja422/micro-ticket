<!-- modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Classification Update</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 mb-2">
                    <label class="form-label mb-1" for="product_id"> Category <span class="text-danger">*</span>
                    </label>
                    <span class="text-danger error_txt product_id"></span>
                    <select id="cat_id" class="result form-control" required>
                        <option value=""> Select a Category</option>
                        @foreach ($categoryData as $category)
                            <option {{ $subcategoryData->cat_id == $category->id ? 'selected' : '' }}
                                value="{{ $category->id }}">{{ $category->cat_name }}</option>
                        @endforeach
                    </select>
                </div>

                <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Subcategory" inputId="sub_cat_name"
                inputType="text" required='required'  :inputVal="$subcategoryData->sub_cat_name" />


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                <button type="button" onclick="updateData({{ $subcategoryData->id }})" class="btn btn-primary">Save
                    changes</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
