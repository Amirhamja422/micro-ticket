<!-- modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ticket Information</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 mb-2">
                    <div class="row">

                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="department_id">Department<span
                                    class="text-danger">*</span>
                            </label>
                            <span class="text-danger error_txt department_id"></span>
                            <select id="department_id" class="result form-control" required>
                                <option value=""> </option>
                                @foreach ($departments as $department)
                                    <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="service_category_id">Category<span
                                    class="text-danger">*</span>
                            </label>
                            <span class="text-danger error_txt cat_id"></span>
                            <select id="cat_id" class="result form-control" onchange="getcatData()"; required>
                                <option value=""> </option>
                                @foreach ($categoryList as $categorylists)
                                    <option value="{{ $categorylists->id }}">{{ $categorylists->cat_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="sub_cat_id">Sub Category<span
                                    class="text-danger">*</span>
                            </label>
                            <span class="text-danger error_txt sub_cat_id"></span>
                            <select id="sub_cat_id" class="result form-control" required>
                            </select>
                        </div>
                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="complain_id">Complain<span
                                    class="text-danger">*</span>
                            </label>
                            <span class="text-danger error_txt complain_id"></span>
                            <select id="complain_id" class="result form-control" required>
                                <option value=""> </option>
                                @foreach ($complainList as $complainlists)
                                    <option value="{{ $complainlists->id }}">{{ $complainlists->complain_name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-xl-4 mb-2">
                            <span class="text-danger error_txt Customer Name"></span>
                            <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Customer Name"
                                inputId="contact_name" inputType="text" required='required' />
                        </div>

                        <div class="col-xl-4 mb-2">
                            <span class="text-danger error_txt Phone"></span>
                            <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Phone" inputId="phone"
                                inputType="text" required='required' />
                        </div>

                        <div class="col-xl-4 mb-2">
                            <span class="text-danger error_txt Email"></span>
                            <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Email" inputId="email"
                                inputType="text" required='required' />
                        </div>


                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="status">Status<span class="text-danger">*</span>
                            </label>
                            <span class="text-danger error_txt status"></span>
                            <select id="status" class="result form-control" required>
                                <option value=""> </option>
                                @foreach ($statusList as $status)
                                    <option value="{{ $status[0] }}">{{ $status[0] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="priority">Priority
                            </label>
                            <span class="text-danger error_txt priority"></span>
                            <select id="priority" class="result form-control" required>
                                <option value=""> </option>
                                @foreach ($priorityList as $priority)
                                    <option value="{{ $priority[0] }}">{{ $priority[0] }}</option>
                                @endforeach
                            </select>
                        </div>


                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="ticket_owner">Assign Person<span
                                    class="text-danger">*</span>
                            </label>
                            <span class="text-danger error_txt ticket_owner"></span>
                            <select id="ticket_owner" class="result form-control" required>
                                <option value=""> </option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="accordion1">
                            <div class="accordion1-item">
                                <h2 class="accordion1-header" id="headingOne">
                                    <button class="accordion1-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne"style="background: darkgray;border: royalblue;color: black;font-size: 21px;width: 69rem;text-align: left;font-weight: bold;height: 2rem;margin-top: 0rem;">
                                        Description
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion1-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordion1Example">
                                    <div class="accordion1-body">
                                        <div class="col-xl-12 mb-2">
                                            <textarea name="content" id="editor"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 mt-4">
                            <x-widgets.input-component inputColClass="col-xl-12" inputLabel="Attachment"
                                inputId="attachment" inputType="file" multiple />
                        </div>
                        <div class="amir" style="display:flex;">
                            <div id="preview-container"></div>
                            <div class="progress-bar-container" style="flex-grow:1;">
                                <div class="progress-bar progress-bar-striped" aria-valuenow="10" aria-valuemin="0"
                                    aria-valuemax="100" id="progress-bar" style="width:0%; height:20px;"></div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                <button type="button" class="btn btn-primary" id="getdata">Save changes</button>
            </div>
        </div>
    </div>
</div>


<div id="loader" style="display:none;">Loading...</div>

<script type="text/javascript">
    $(document).ready(function() {
        $('.multiple-select').select2({
            theme: 'bootstrap4',
            dropdownParent: $('#Modal'),
            width: $(this).data('width') ? $(this).data('width') : $(this).hasClass('w-100') ? '100%' :
                'style',
            placeholder: $(this).data('placeholder'),
            allowClear: Boolean($(this).data('allow-clear')),
        });

        let theEditor;
        ClassicEditor
            .create(document.querySelector('#editor'))
            .then(editor => {
                theEditor = editor;

            })
            .catch(error => {
                console.error(error);
            });



            document.getElementById('getdata').addEventListener('click', () => {
            const formData = new FormData();
            const strippedDescription = theEditor.getData();
            const description = strippedDescription.replace(/<\/?p[^>]*>/g, "");
            const department_id = $('#department_id').val();
            const complain_id = $('#complain_id').val();
            const cat_id = $('#cat_id').val();
            const sub_cat_id = $('#sub_cat_id').val();
            const contact_name = $('#contact_name').val();
            const status = $('#status').val();
            const email = $('#email').val();
            const ticket_owner = $('#ticket_owner').val();
            const phone = $('#phone').val();
            const priority = $('#priority').val();
            const attachment = $('#attachment').prop('files')[0];
            formData.append('attachment', attachment);
            formData.append('description', description);
            formData.append('department_id', department_id);
            formData.append('complain_id', complain_id);
            formData.append('cat_id', cat_id);
            formData.append('sub_cat_id', sub_cat_id);
            formData.append('contact_name', contact_name);
            formData.append('status', status);
            formData.append('email', email);
            formData.append('ticket_owner', ticket_owner);
            formData.append('phone', phone);
            formData.append('priority', priority);
            $('#loader').show(); // Show the loader immediately when button is clicked
            upsertImg("{{ route('ticket.store') }}", "POST", formData, "modal-body", "INSERT")
                .then(response => {
                    // Handle successful response
                    resetImagePreview();
                })
                .catch(error => {
                    // Handle error
                    console.error('Error:', error);
                })
                .finally(() => {
                    // Hide the loader after process completion
                    $('#loader').hide();
                });

            getData();
        });
    });



    document.getElementById('attachment').addEventListener('change', function(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('preview-container');
        const progressBar = document.getElementById('progress-bar');
        progressBar.style.width = '0%'; // Reset progress bar

        previewContainer.innerHTML = ''; // Clear previous previews

        Array.from(files).forEach(file => {
            const reader = new FileReader();

            reader.onloadstart = function(e) {
                progressBar.style.width = '0%';
            };

            reader.onprogress = function(e) {
                if (e.lengthComputable) {
                    const percentLoaded = Math.round((e.loaded / e.total) * 25);
                    progressBar.style.width = percentLoaded + '%';
                }
            };

            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.className = 'preview-img';
                img.style.maxWidth = '100px';
                img.style.margin = '5px';
                previewContainer.appendChild(img);
            };

            reader.readAsDataURL(file);
        });
    });

    function resetImagePreview() {
        document.getElementById('preview-container').innerHTML = '';
        // or
        document.getElementById('preview-container').remove();
        document.getElementById('progress-bar').innerHTML = '';
        // or
        document.getElementById('progress-bar').remove();

    }

    function removeLoader() {
        // Your logic to remove the loader goes here
        $('#loader').hide(); // Example: hiding an element with id 'loader'
    }

</script>
