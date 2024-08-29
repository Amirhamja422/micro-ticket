<x-master>
    <x-slot name="title">Category Create</x-slot>

    <x-slot name="content_area">
        <!-- start row -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <x-widgets.card-component cardTitle='Complain List' btnVisible='1' btnName='Create Complain' btnClass='info'>
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
                                    <th>Complain SLA</th>
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
                const complain_name = $('#complain_name').val();
                const complain_sla_time = $('#complain_sla_time').val();
                upsert(
                    "{{ route('complain.store') }}", "POST", {
                        'complain_name': complain_name,
                        'complain_sla_time': complain_sla_time
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
                    "complain-status-change" + '/' + id, "GET", {}
                );
            }

            /**
             * createModal
             *
             * @return modal
             */
            function createModal() {
                // alert('ok');
                openCreateModal("{{ route('complain.create') }}");
            }

            /**
             * editModal
             *
             * @return modal
             */
            function editModal(id) {
                openEditModal("/complain-edit/" + id);
            }


            /**
             * updateData
             *
             * @return void
             */
            function updateData(id) {
                const complain_name = $('#complain_name').val();
                const complain_sla_time = $('#complain_sla_time').val();
                upsert(
                    "complain-data-update" + '/' + id, "PUT", {
                        'id': id,
                        'complain_name': complain_name,
                        'complain_sla_time': complain_sla_time
                    }
                );
            }


            /**
             * getData
             *
             * @return mixed
             */
            function getData() {
                dataTable("{{ route('complain.list.datatable') }}", {}, [{
                        data: 'complain_name',
                        name: 'complain_name'
                    },
                    {
                        data: 'complain_sla_time',
                        name: 'complain_sla_time'
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
