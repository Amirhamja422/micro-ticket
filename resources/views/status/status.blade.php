<x-master>
    <x-slot name="title">Status Create</x-slot>

    <x-slot name="content_area">
        <!-- start row -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <x-widgets.card-component cardTitle='Status List' btnVisible='1' btnName='Create Status' btnClass='info'>
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
                upsert(
                    "{{ route('status.store') }}", "POST", {
                        'name': name,
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
                    "status-status-change" + '/' + id, "GET", {}
                );
            }

            /**
             * createModal
             *
             * @return modal
             */
            function createModal() {
                // alert('ok');
                openCreateModal("{{ route('status.create') }}");
            }

            /**
             * editModal
             *
             * @return modal
             */
            function editModal(id) {
                openEditModal("/status-edit/" + id);
            }


            /**
             * updateData
             *
             * @return void
             */
            function updateData(id) {
                const name = $('#name').val();
                upsert(
                    "status-data-update" + '/' + id, "PUT", {
                        'id': id,
                        'name': name
                    }
                );
            }


            /**
             * getData
             *
             * @return mixed
             */
            function getData() {
                dataTable("{{ route('status.list.datatable') }}", {}, [{
                        data: 'name',
                        name: 'name'
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
