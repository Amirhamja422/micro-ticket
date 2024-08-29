<x-master>
    <x-slot name="title">Ticket</x-slot>

    <x-slot name="content_area">
        <!-- start row -->
        <div class="row">
            <div class="col-12 col-lg-12">

            <x-widgets.card-component cardTitle='' cardHeaderVisible='0' btnVisible='0' btnName='' btnClass='' btnIcon=''>
                <div class="row">

                    <div class="col-xl-4">
                        <label class="form-label mb-1" for="department_idtest">Department<span class="text-danger">*</span></label>
                        <span class="text-danger error_txt status"></span>
                        <select id="department_idtest" class="result form-control" onchange="getData();" required>
                            <option value="">Department </option>
                            @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4">
                        <label class="form-label mb-1" for="ticket_owner">Assign Person<span class="text-danger">*</span>
                        </label>
                        <span class="text-danger error_txt ticket_owner"></span>
                        <select id="ticket_owners" class="result form-control"  onchange="getData();" required>
                            <option value=""> Asign Person</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-xl-4">
                        <label class="form-label mb-1" for="status">Status<span class="text-danger">*</span>
                        </label>
                        <span class="text-danger error_txt status"></span>
                        <select id="statusTest" class="result form-control"  onchange="getData();" required>
                            <option value=""> Status</option>
                            @foreach ($statusList as $status)
                                <option value="{{ $status[0] }}">{{ $status[0] }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </x-widgets.card-component>

                <x-widgets.card-component cardTitle='Ticket List' btnVisible='1' btnName='Create Ticket' btnClass='info'
                    btnIcon='person-plus-fill'>

                    <a class="" href="http://127.0.0.1:8000/ticket-download" style="margin-left: 63rem;"><span class="badge bg-info text-dark" style="margin-top: -42px;position: absolute;margin-left: 5rem;">Export Ticket</span></a>
                    {{-- <button type="button" id="download" class="btn btn-sm btn-info px-3" onclick="download()" style="margin-top: -6rem;margin-left: 65rem;height: 23px;padding: 0rem;"><i class="bi bi-download"></i>Download</button> --}}


                    <div class="table-responsive">
                        <style>
                            table.table-bordered.dataTable tbody th,
                            table.table-bordered.dataTable tbody td {
                                border-bottom-width: 0;
                                text-wrap: wrap;
                            }
                        </style>
                        <table id="dataTable" class="table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Ticket ID</th>
                                    <th>Department</th>
                                    <th>Contact Name</th>
                                    <th>Email</th>
                                    <th>status</th>
                                    <th>Assign Person</th>
                                    <th>SLA Time</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </x-widgets.card-component>
            </div>
        </div>
        <!--end row-->
    </x-slot>

    @push('js')
        <script>
            $(document).ready(function() {
                getData();
            });

            /**
             * createModal
             *
             * @return modal
             */
            function createModal() {
                openCreateModal("{{ route('ticket.create') }}");
            }

            /**
             * editModal
             *
             * @return modal
             */
            function editModal(id) {
                openEditModal("/ticket-edit/" + id);
                // ckeditorOpen();
            }

            /**
             * product id onchange classification show
             *
             * @return modal
             */

            function getcatData() {
                const cat_id = $('#cat_id').val();
                const sub_cat_id = $('#sub_cat_id');
                $("#sub_cat_id").html("");
                $.ajax({
                    url: "ticket-cat-name-get",
                    method: "GET",
                    data: {
                        'id': cat_id,
                    },
                    success: function(success) {
                        console.log(success);
                        sub_cat_id.append('<option value=""></option>');
                        if (success != null) {
                            $('#sub_cat_id').attr('required', 'required');
                            success.map((notedata) => {
                                var noteList =
                                    `<option value="${notedata.id}">${notedata.sub_cat_name} </option>`;
                                    sub_cat_id.append(noteList);
                            });
                        }

                    }
                });
            }



            /**
             * updateData
             *
             * @return void
             */
            function updateData(id) {
                const client_id = $('#client_id').val();
                const support_type_id = $('#support_type_id').val();
                const assign_user_id = $('#assign_user_id').val();
                const status = $('#status').val();
                const description = $('#description').val();
                upsert(
                    "support-data-update" + '/' + id, "PUT", {
                        'id': id,
                        'client_id': client_id,
                        'support_type_id': support_type_id,
                        'assign_user_id': assign_user_id,
                        'status': status,
                        'description': description
                    }
                );
            }


            /**
             * updateData
             *
             * @return void
             */
            function handleSelectAssign(id, selectElement) {
                const assign_person = $(selectElement).val();
                upsert(
                    "assign-data-update" + '/' + id, "PUT", {
                        'id': id,
                        'assign_person': assign_person
                    }
                );
            }

            /**
             * updateData
             *
             * @return void
             */
            function handleSelectStatus(id, selectElement) {
                const status = $(selectElement).val();
                upsert(
                    "status-data-update" + '/' + id, "PUT", {
                        'id': id,
                        'status': status
                    }
                );
            }

            /**
             * getData
             *
             * @return mixed
             */
             function getData(ticketId) {
                const department_idtest = $('#department_idtest').val();
                const ticket_owners = $('#ticket_owners').val();
                const statusTest = $('#statusTest').val();

                // Clear other fields when any field is clicked
                $('#department_idtest').on('click', function() {
                    $('#ticket_owners').val('');
                    $('#statusTest').val('');
                });

                $('#ticket_owners').on('click', function() {
                    $('#department_idtest').val('');
                    $('#statusTest').val('');
                });

                $('#statusTest').on('click', function() {
                    $('#department_idtest').val('');
                    $('#ticket_owners').val('');
                });

                const datas = {
                    ticketId: ticketId,
                    department_idtest: department_idtest,
                    ticket_owners: ticket_owners,
                    statusTest: statusTest
                };


                    dataTable("{{ route('ticket.list.datatable') }}", {datas}, [
                        {
                            data: 'id',
                            name: 'ticket_id'
                        },
                        {
                            data: 'department_name.name',
                            name: 'department_name.name'
                        },
                        {
                            data: 'contact_name',
                            name: 'contact_name'
                        },
                        {
                            data: 'email',
                            name: 'email'
                        },

                        {
                            data: 'status',
                            name: 'status'
                        },
                        {
                            data: 'ticket_owner_id',
                            name: 'ticket_owner_id'
                        },
                        {
                            data: 'ticket_sla_time',
                            name: 'ticket_sla_time'
                        },

                        {
                            data: 'actions',
                            name: 'actions'
                        },
                    ]);
                }

        </script>
    @endpush
</x-master>
