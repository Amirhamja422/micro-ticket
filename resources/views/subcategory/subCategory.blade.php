<x-master>
    <x-slot name="title">Subcategory Create</x-slot>

    <x-slot name="content_area">
        <!-- start row -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <x-widgets.card-component cardTitle='Subcategory List' btnVisible='1' btnName='Create Subcategory' btnClass='info'>
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
                                    <th>Catagory </th>
                                    <th>Subcategory</th>
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
                const cat_id = $('#cat_id').val();
                const sub_cat_name = $('#sub_cat_name').val();
                upsert(
                    "{{ route('subcategory.store') }}", "POST", {
                        'cat_id': cat_id,
                        'sub_cat_name': sub_cat_name,

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
                    "subcategory-status-change" + '/' + id, "GET", {}
                );
            }

            /**
             * createModal
             *
             * @return modal
             */
            function createModal() {
                // alert('ok');
                openCreateModal("{{ route('subcategory.create') }}");
            }

            /**
             * editModal
             *
             * @return modal
             */
            function editModal(id) {
                openEditModal("/subcategory-edit/" + id);
            }


            /**
             * updateData
             *
             * @return void
             */
            function updateData(id) {
                const cat_id = $('#cat_id').val();
                const sub_cat_name = $('#sub_cat_name').val();
                upsert(
                    "subcategory-data-update" + '/' + id, "PUT", {
                        'id': id,
                        'cat_id': cat_id,
                        'sub_cat_name': sub_cat_name
                    }
                );
            }

            /**
             * getData
             *
             * @return mixed
             */
            function getData() {
                dataTable("{{ route('subcategory.list.datatable') }}", {}, [{
                        data: 'cat_name.cat_name',
                        name: 'cat_name.cat_name'
                    },
                    {
                        data: 'sub_cat_name',
                        name: 'sub_cat_name'
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
