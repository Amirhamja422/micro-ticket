<x-master>
    <x-slot name="title">Permission Group</x-slot>

    <x-slot name="content_area">
        <!-- start row -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <x-widgets.card-component cardTitle='Permission Group List' btnVisible='1' btnName='Create Permission Group'
                    btnClass='info'>
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
                                    <th>Name</th>
                                    <th>Status</th>
                                    <th>Create Date</th>
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
        // function submitData() {
        //     const name = $('#name').val();
        //     upsert(
        //         "{{ route('task.type.store') }}", "POST", {
        //             'name': name
        //         }
        //     );
        // }

        /**
         * changeStatus
         *
         * @return void
         */
        // function changeStatus(id) {
        //     upsert(
        //         "task-type-status-change" + '/' + id, "GET", {}
        //     );
        // }

        /**
         * createModal
         *
         * @return modal
         */
        // function createModal() {
        //     openCreateModal("{{ route('task.type.create') }}");
        // }

        /**
         * editModal
         *
         * @return modal
         */
        // function editModal(id) {
        //     openEditModal("/task-type-edit/" + id);
        // }


        /**
         * updateData
         *
         * @return void
         */
        // function updateData(id) {
        //     const name = $('#name').val();
        //     upsert(
        //         "task-type-data-update" + '/' + id, "PUT", {
        //             'id': id,
        //             'name': name
        //         }
        //     );
        // }

        /**
         * getData
         *
         * @return mixed
         */
        function getData() {
            dataTable("{{ route('permission.group.list.datatable') }}", {}, [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'is_active',
                    name: 'is_active'
                },
                {
                    data: 'created_at',
                    name: 'created_at'
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
