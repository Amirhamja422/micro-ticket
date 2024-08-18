<x-master>
    <x-slot name="title">Category Create</x-slot>

    <x-slot name="content_area">
        <!-- start row -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <x-widgets.card-component cardTitle='Category List' btnVisible='1' btnName='Create Category' btnClass='info'>
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
                const cat_name = $('#cat_name').val();
                upsert(
                    "{{ route('category.store') }}", "POST", {
                        'cat_name': cat_name,
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
                    "category-status-change" + '/' + id, "GET", {}
                );
            }

            /**
             * createModal
             *
             * @return modal
             */
            function createModal() {
                // alert('ok');
                openCreateModal("{{ route('category.create') }}");
            }

            /**
             * editModal
             *
             * @return modal
             */
            function editModal(id) {
                openEditModal("/category-edit/" + id);
            }


            /**
             * updateData
             *
             * @return void
             */
            function updateData(id) {
                const cat_name = $('#cat_name').val();
                upsert(
                    "category-data-update" + '/' + id, "PUT", {
                        'id': id,
                        'cat_name': cat_name
                    }
                );
            }


            /**
             * getData
             *
             * @return mixed
             */
            function getData() {
                dataTable("{{ route('category.list.datatable') }}", {}, [{
                        data: 'cat_name',
                        name: 'cat_name'
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
