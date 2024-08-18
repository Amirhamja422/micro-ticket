<x-master>
    <x-slot name="title">Role</x-slot>

    <x-slot name="content_area">
        <!-- start row -->
        <div class="row">
            <div class="col-12 col-lg-12">
                <x-widgets.card-component cardTitle='Role List' btnVisible='1' btnName='Create Role'
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
                                    <th>Permissions</th>
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
        function submitData() {
            const name = $('#name').val();
            var permissionArray = [];
            $.each($("input[name='checkPermission']:checked"), function(){
                permissionArray.push($(this).val());
            });

            upsert(
                "{{ route('role.store') }}", "POST", {
                    'name': name,
                    'checkPermission': permissionArray,
                }
            );
        }

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
        function createModal() {
            openCreateModal("{{ route('role.create') }}");
        }

        /**
         * editModal
         *
         * @return modal
         */
        function editModal(id) {
            openEditModal("/role-edit/" + id);
        }


        /**
         * updateData
         *
         * @return void
         */
        function updateData(id) {
            const name = $('#name').val();
            var permissionArray = [];
            $.each($("input[name='checkPermission']:checked"), function(){
                permissionArray.push($(this).val());
            });

            upsert(
                'role/' + id + '/update', "PUT", {
                    'id': id,
                    'name': name,
                    'checkPermission': permissionArray,
                }
            );
        }

        /**
         * getData
         *
         * @return mixed
         */
        function getData() {
            dataTable("{{ route('role-list-datatable') }}", {}, [{
                    data: 'name',
                    name: 'name'
                },
                {
                    data: 'permissions',
                    name: 'permissions'
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

        /**
         * checkAllPermissionByGroup
         *
         * @return mixed
        */
        function checkAllPermissionByGroup(id){
            var groupIdName = $('#permission_group_'+id);

            if (groupIdName.is(':checked')) {
                $('.checkAllPermissionByGroup_'+id).prop('checked', true);
            } else {
                $('.checkAllPermissionByGroup_'+id).prop('checked', false);
            }
        }

        /**
         * checkGroupByPermission
         *
         * return mixed
        */
        function checkGroupByPermission(group_id, count){
            var permissionClass = $('.checkAllPermissionByGroup_'+group_id+':checked');
            var groupCheckBox = $('#permission_group_'+group_id);

            if (permissionClass.length === count) {
                $('#permission_group_'+group_id).prop('checked', true);
            } else {
                $('#permission_group_'+group_id).prop('checked', false);
            }
        }
    </script>
    @endpush
</x-master>
