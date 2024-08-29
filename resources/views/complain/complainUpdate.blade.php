<!-- modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Complain Update</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">

                <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Complain" inputId="complain_name"
                inputType="text" required='required'  :inputVal="$resultData->complain_name" />

                <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Complain SLA (Min)" inputId="complain_sla_time"
                inputType="text" required='required'  :inputVal="number_format($resultData->complain_sla_time/60, 2)" />

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
