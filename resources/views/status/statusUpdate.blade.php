<!-- modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Status Update</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Name" inputId="name" inputType="text"
                    required='required' :inputVal="$resultData->name" />

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
