<x-master>
    <x-slot name="title">User Create</x-slot>

    <x-slot name="content_area">
        <!-- start row -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <x-widgets.card-component cardTitle='User List' btnVisible='1' btnName='Create User' btnClass='info'>
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
                                    <th>Name </th>
                                    <th>Email</th>
                                    <th>Number</th>
                                    <th>Department</th>
                                    <th>Role & Designation</th>
                                    <th>Status</th>
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
             * submitData
             *
             * @return void
             */
            function submitData() {
                const name = $('#name').val();
                const email = $('#email').val();
                const number = $('#number').val();
                const department_id = $('#department_id').val();
                const designation_id = $('#designation_id').val();
                const role_id = $('#role_id').val();

                upsert(
                    "{{ route('user.store') }}", "POST", {
                        'name': name,
                        'email': email,
                        'number': number,
                        'department_id': department_id,
                        'designation_id': designation_id,
                        'role_id': role_id,
                    }
                );
            }

            /**
             * changeStatus
             *
             * @return void
             */
            function changeStatus(id) {
                upsert(
                    "user-status-change" + '/' + id, "GET", {}
                );
            }

            /**
             * createModal
             *
             * @return modal
             */
            function createModal() {
                // alert('ok');
                openCreateModal("{{ route('user.create') }}");
            }

            /**
             * editModal
             *
             * @return modal
             */
            function editModal(id) {
                openEditModal("/user-edit/" + id);
            }


            /**
             * updateData
             *
             * @return void
             */
            function updateData(id) {
                const name = $('#name').val();
                const email = $('#email').val();
                const number = $('#number').val();
                const department_id = $('#department_id').val();
                const designation_id = $('#designation_id').val();
                const role_id = $('#role_id').val();
                upsert(
                    "user-data-update" + '/' + id, "PUT", {
                        'id': id,
                        'name': name,
                        'email': email,
                        'number': number,
                        'department_id': department_id,
                        'designation_id': designation_id,
                        'role_id': role_id,
                    }
                );
            }

            /**
             * getData
             *
             * @return mixed
             */
            function getData() {
                dataTable("{{ route('user.list.datatable') }}", {}, [{
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'email',
                        name: 'email'
                    },
                    {
                        data: 'number',
                        name: 'number'
                    },
                    {
                        name: 'department',
                        data: 'department'

                    },
                    {
                        name: 'role_designation',
                        data: 'role_designation'
                    },
                    {
                        data: 'is_active',
                        name: 'is_active'
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
