<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="{{ URL::asset('images/favicon-32x32.png') }}" type="image/png" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">

    @stack('css')

    <title>iHelpBD-{{ $title ?? '' }}</title>

    <style>
        #container {
            width: 1000px;
            margin: 20px auto;
        }

        .ck-editor__editable[role="textbox"] {
            /* Editing area */
            min-height: 200px;
        }

        .ck-content .image {
            /* Block images */
            max-width: 80%;
            margin: 20px auto;
        }
    </style>
</head>

<body>
    <!--wrapper-->
    <div class="wrapper">

        <!--start header wrapper-->
        <div class="header-wrapper">
            <!--start header -->
            <x-partials.navbar />
            <!--end header -->

            <!--start menu-->
            <x-partials.menu />
            <!--end menu-->
        </div>
        <!--end header wrapper-->

        <!--start page wrapper -->
        <div class="page-wrapper">
            <div class="page-content">
                {{ $content_area ?? '' }}
                {{ $slot }}
            </div>
        </div>
        <!--end page wrapper -->

        <!-- start footer -->
        <x-partials.footer />
        <!-- end footer -->
    </div>
    <!--end wrapper-->


    {{-- <script src="{{ mix('js/app.js') }}"></script> --}}
    <script type="text/javascript" src="{{ URL::asset('js/app.js') }}"></script>
    <script src="https://js.pusher.com/8.2.0/pusher.min.js"></script> <!-- pusher cdn -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.3.1/classic/ckeditor.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        /**
         * openCreateModal
         *
         * @param route
         * @return mixed
         */
        function openCreateModal(route) {
            $.ajax({
                url: route,
                method: 'GET',
                success: function(response) {
                    $('body').append(response);
                    $("#Modal").modal('show');

                },
            });
        }

        /**
         * openEditModal
         *
         * @param route
         * @return mixed
         */
        function openEditModal(route) {
            $.ajax({
                url: route,
                method: 'GET',
                success: function(response) {
                    console.log(response);
                    $('body').append(response);
                    $("#Modal").modal('show');
                },
            });
        }


        // function testDtas(data){
        //     $('#collapse'+data).append("<input type='text' value='"+data+"' id='history_id'>");
        //     // $("#history_id").val(data);


        // }

        // function ckeditorOpen(){
        //    var tset =  $('.ckeditor').ckeditor();
        // //    var tset =  'ok';
        // console.log(tset);
        // }



        /**
         * fetchAllDataAppend
         *
         * @param route
         * @return mixed
         */
        function fetchAllDataAppend(route, divId) {
            $('#' + divId).html('');
            $.ajax({
                url: route,
                method: 'GET',
                success: function(response) {
                    $('#' + divId).append(response);
                },
            });
        }

        /**
         * closeModal
         *
         * @return void
         */
        function closeModal() {
            $("#Modal").modal("hide");
            $("#Modal").remove();
        }

        /**
         * dataTable
         *
         * @return mixed
         */
        function dataTable(route, data, columns, tblid = '') {
            const tableId = (tblid != '') ? (tblid) : ('dataTable');
            $('#' + tableId).DataTable({
                processing: true,
                serverSide: true,
                bDestroy: true,
                ordering: true,
                ajax: ({
                    url: route,
                    type: "GET",
                    data: data,
                }),
                displayLength: 10,
                columns: columns,
            });
            $.fn.dataTable.ext.errMode = 'none';
        }

        /**
         * upsert
         * insert, update function
         *
         * @return mixed
         */
        function upsert(route, method, data, divClass = '') {
            // alert(route+method+data);
            const classDiv = (divClass != '') ? (divClass) : ('modal-body');
            $.ajax({
                url: route,
                method: method,
                data: data,
                success: function(response) {
                    console.log(response);
                    method != 'GET' ? rmvErrorClass(classDiv) : '';
                    method == 'POST' ? blankValue(classDiv) : '';

                    successMsg(response);
                },

                error: function(error) {
                    method != 'GET' ? rmvErrorClass(classDiv) : '';
                    errorMsg(error);
                },
            });
        }

        /**
         * upsertImg
         * insert, update function
         *
         * @return mixed
         */
        function upsertImg(route, method, formData, divClass, requestType) {
            $.ajax({
                url: route,
                method: method,
                data: formData, // Use formData parameter for data
                contentType: false,
                cache: false,
                processData: false,
                success: function(response) {
                    if (requestType !== 'UPDATE') {
                        rmvErrorClass(divClass);

                    }
                    if (requestType === 'INSERT') {
                        blankValue(divClass);
                    }
                    successMsg(response);
                    removeLoader(); // Call to remove loader

                },
                error: function(error) {
                    if (requestType !== 'UPDATE') {
                        rmvErrorClass(divClass);
                    }
                    errorMsg(error);
                    removeLoader(); // Call to remove loader

                }
            });
        }

        /**
         * errorMsg
         *
         * @params error
         * @return alert
         */
        function errorMsg(error) {
            $.each(error.responseJSON.errors, function(key, value) {
                $("." + key).text(value[0]);
                $("#" + key).addClass("error_box");
            });
        }


        /**
         * rmvErrorClass
         *
         * @param class
         */
        function rmvErrorClass(class_id) {
            $('.' + class_id).find('.error_txt').text('');
            $('.' + class_id).find('select, textarea, input').removeClass('error_box');
        }

        /**
         * blank input value
         */
        function blankValue(class_id) {
            $('.' + class_id).find('select, textarea, input').val('');
        }

        /**
         * successMsg
         *
         * @param success
         * @return alert
         */
        function successMsg(success) {
            if (success.status == '200') {
                $('#dataTable').DataTable().draw(false);
                successAlert(success.msg);
            } else {
                // $("#Modal").modal("hide");
                errorAlert(success.msg);
            }
        }

        /**
         * success alert
         *
         * @param msg
         */
        function successAlert(msg) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'success',
                title: msg
            })
        }
        /**
         * Error alert
         *
         * @param msg
         */
        function errorAlert(msg) {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });

            Toast.fire({
                icon: 'error',
                title: msg
            })
        }

        /**
         * updateProfileModal
         *
         * @return modal
         */
        function updateProfileModal() {
            openCreateModal("{{ route('profile.edit') }}");
        }

        /**
         * updateProfileData
         *
         * @return void
         */
        window.updateProfileData = function(id) {
            const name = $('#name').val();
            const email = $('#email').val();
            const number = $('#number').val();

            upsert("profile/" + id + "/update", "PUT", {
                'name': name,
                'email': email,
                'number': number
            });
        }

        /**
         * changePasswordModal
         *
         * @return modal
         */
        function changePasswordModal() {
            openCreateModal("{{ route('password.edit') }}");
        }

        /**
         * dropZoneInit
         */
        function dropZoneInit(upload_id, action_url) {
            Dropzone.autoDiscover = false;

            var dropzone = new Dropzone('#' + upload_id, {
                thumbnailWidth: 200,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                maxFilesize: 10,
                addRemoveLinks: true,
                autoProcessQueue: true,
                pasteDataUrl: true,
                url: action_url,
                acceptedFiles: ".jpeg,.jpg,.png,.gif,.pdf"
            });

            document.getElementById(upload_id).addEventListener('paste', function(event) {
                var items = (event.clipboardData || event.originalEvent.clipboardData).items;

                for (var index in items) {
                    var item = items[index];

                    if (item.kind === 'file') {
                        var blob = item.getAsFile();
                        var fileName = 'pasted-image-' + new Date().getTime() + '.png';
                        var newFile = new File([blob], fileName, {
                            type: blob.type
                        });

                        // Add the pasted file to Dropzone
                        dropzone.addFile(newFile);
                    }
                }
            });

            return dropzone
        }




        /**
         * updatePasswordData
         *
         * @return void
         */
        window.updatePasswordData = function(id) {
            const old_password = $('#old_password').val();
            const password = $('#password').val();
            const confirm_new_password = $('#confirm_new_password').val();

            upsert("password/" + id + "/update", "PUT", {
                'old_password': old_password,
                'password': password,
                'confirm_new_password': confirm_new_password
            });
        }

    //    $(document).ready(function() {
    //             Echo.channel("Test").listen("TestEvent", (e) => {
    //                 console.log('test');
    //             });
    //        });

    </script>
    @stack('js')
</body>

</html>
