<!-- modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Role Create</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <x-widgets.input-component inputColClass="col-xl-12 col-md-12" inputLabel="Role Name" inputId="name" inputType="text"
                    required='required' />

                <h6>All Permissions<span class="text-danger error_txt checkPermission" style="margin-top: 5px!important;"></span></h6>
                <hr style="background-color: black!important;">
                <table class="hundred_percent">
                    <tbody>
                        @foreach($results as $result)
                            @if (count($result['permissions']) > 0)
                                <tr class="table_bottom_border">
                                    <td class="fifty_percent">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" value="{{ $result['group_id'] }}"
                                                id="permission_group_{{$result['group_id']}}"
                                                onclick="checkAllPermissionByGroup({{$result['group_id']}})">
                                            <label class="form-check-label" for="permission_group_">{{$result['group_name']}}</label>
                                        </div>
                                    </td>

                                    <td class="fifty_percent">
                                        @foreach($result['permissions'] as $permission)
                                        <div class="form-check">
                                            <input class="form-check-input checkAllPermissionByGroup_{{$result['group_id']}}"
                                                onclick="checkGroupByPermission({{$result['group_id']}},{{count($result['permissions'])}})" name="checkPermission"
                                                type="checkbox" value="{{$permission['name']}}" id="checkPermission{{$permission['id']}}">
                                            <label class="form-check-label" for="checkPermission{{$permission['id']}}">{{$permission['name']}}</label>
                                        </div>
                                        @endforeach
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                <button type="button" onclick="submitData()" class="btn btn-success">Save</button>
            </div>
        </div>
    </div>
</div>
<!-- modal end -->
