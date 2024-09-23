<!-- modal -->
<div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
    data-bs-backdrop="static" aria-labelledby="staticBackdropLabel">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ticket Information ID : {{ $resultData->id }}</h5>
                <button type="button" class="btn-close" onclick="closeModal()"></button>
            </div>
            <div class="modal-body">
                <div class="col-xl-12 mb-2">
                    <div class="row">
                        <div class="col-xl-4 mb-2" style="display:none;">
                            <x-widgets.input-component inputColClass="col-xls-12" inputLabel="ID" inputId="ticket_id"
                                inputType="text" :inputVal="$resultData->id" />
                        </div>
                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="department_id"> Department <span
                                    class="text-danger"></span>
                            </label>
                            <span class="text-danger error_txt department_id"></span>
                            <select id="department_id" class="result form-control" required>
                                <option value=""> Select a department</option>
                                @foreach ($departments as $department)
                                    <option {{ $resultData->department_id == $department->id ? 'selected' : '' }}
                                        value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="cat_id">Category<span
                                    class="text-danger"></span>
                            </label>
                            <span class="text-danger error_txt cat_id"></span>
                            <select id="cat_id" class="result form-control" onchange="getcatData()"; required>
                                <option value=""> </option>
                                @if (empty($ticketDetailsData))
                                    @foreach ($categoryList as $categorylists)
                                        <option value="{{ $categorylists->id }}">{{ $categorylists->cat_name }}
                                        </option>
                                    @endforeach
                                @else
                                    @foreach ($categoryList as $categorylists)
                                        <option
                                            {{$resultData->cat_id == $categorylists->id ? 'selected' : '' }}
                                            value="{{ $categorylists->id }}">{{ $categorylists->cat_name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="cat_id">Sub Category<span
                                    class="text-danger"></span>
                            </label>
                            <span class="text-danger error_txt cat_id"></span>
                            <select id="cat_id" class="result form-control" required>
                                <option value=""> </option>
                                    @foreach ($subcategoryList as $subcategoryLists)
                                        <option
                                            {{$resultData->sub_cat_id == $subcategoryLists->id ? 'selected' : '' }}
                                            value="{{ $subcategoryLists->id }}">{{ $subcategoryLists->sub_cat_name }}</option>
                                    @endforeach

                            </select>
                        </div>

                        <div class="col-xl-4 mb-2" style="width: 396px;margin-left: -13px;">
                            <x-widgets.input-component inputColClass="col-lg-12" inputLabel="Customer Name"
                                inputId="contact_name" inputType="text" required="required" :inputVal="$resultData->contact_name" />
                        </div>


                        <div class="col-xl-4 mb-2" style="margin-left: -2rem;width: 379px;">
                            <x-widgets.input-component inputColClass="col-lg-12" inputLabel="Phone"
                                inputId="phone" inputType="text" :inputVal="$resultData->phone" />
                        </div>

                        <div class="col-xl-4 mb-2" style="margin-left: -1rem;width: 383px;">
                            <x-widgets.input-component inputColClass="col-lg-12" inputLabel="Email" inputId="email"
                                inputType="text" :inputVal="$resultData->email" />
                        </div>

                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="status"> Status <span class="text-danger">*</span>
                            </label>
                            <span class="text-danger error_txt status"></span>
                            <select id="status" class="result form-control" required>
                                <option value=""> </option>
                                @foreach ($statusList as $status)
                                    <option {{ $resultData->status == $status[0] ? 'selected' : '' }}
                                        value="{{ $status[0] }}">{{ $status[0] }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="priority"> Priority
                            </label>
                            <span class="text-danger error_txt priority"></span>
                            <select id="priority" class="result form-control" required>
                                <option value=""> </option>
                                    @foreach ($priorityList as $priority)
                                        <option
                                            {{$resultData->priority == $priority[0] ? 'selected' : '' }}
                                            value="{{ $priority[0] }}">{{ $priority[0] }}
                                        </option>
                                    @endforeach

                            </select>

                        </div>


                        <div class="col-xl-4 mb-2">
                            <label class="form-label mb-1" for="ticket_owner"> Ticket Owner <span
                                    class="text-danger"></span>
                            </label>
                            <span class="text-danger error_txt ticket_owner"></span>
                            <select id="ticket_owner" class="result form-control" required>
                                <option value=""> </option>
                                @if (empty($ticketDetailsData))
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @else
                                    @foreach ($users as $user)
                                        <option {{ $user->id == $ticketDetailsData->ticket_owner ? 'selected' : '' }}
                                            value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="accordion">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne" style="background: darkgray;border: royalblue;color: black;font-size: 21px;width: 69rem;text-align: left;font-weight: bold;height: 1rem;margin-top: 0rem;">Description</button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
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
                <button type="button" class="btn btn-primary" id="TicketReplayData">Save changes</button>
            </div>




            <div class="modal-footer">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">From</th>
                            <th scope="col">Status</th>
                            <th scope="col">Description</th>
                            <th scope="col">Attachment</th>
                            <th scope="col">Create Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ticketHistoryData as $history)
                            <tr>
                                <td>
                                    @foreach ($users as $user)
                                        @if ($user->id == $history->from)
                                            {{ $user->name }}
                                        @endif
                                    @endforeach
                                </td>
                                <td>{{ $history->status }}</td>
                                <td>{{ $history->description }}</td>
                                <td>
                                    @if($history->attachments != '')
                                    <img src="{{ asset('storage/attachments/images/'.$history->attachments) }}" alt="" height="100" width="150">
                                    @else
                                        {{ 'Attachment not found' }}
                                    @endif

                                </td>
                                <td>{{ date('j M, y, g:i A', strtotime($history->created_at)) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<div id="loader" style="display:none;">Loading...</div>

<script type="text/javascript">
    $(document).ready(function() {
        let theEditor;
        ClassicEditor
            .create(document.querySelector('#editor'), {
                removePlugins: ['Heading', 'Link', 'CKFinder'],
                toolbar: ['bold', 'italic', 'bulletedList', 'numberedList', 'blockQuote']
            })
            .then(editor => {
                theEditor = editor;

            })
            .catch(error => {
                console.log(error);
            });


        document.getElementById('TicketReplayData').addEventListener('click', () => {
            const formData = new FormData();
            const ticket_id = $('#ticket_id').val();
            const department_id = $('#department_id').val();
            const contact_name = $('#contact_name').val();
            const status = $('#status').val();
            const email = $('#email').val();
            const ticket_owner = $('#ticket_owner').val();
            const sub_cat_id = $('#sub_cat_id').val();
            const phone = $('#phone').val();
            const priority = $('#priority').val();
            const strippedDescription = theEditor.getData();
            const description = strippedDescription.replace(/<\/?p[^>]*>/g, "");
            const attachment = $('#attachment').prop('files')[0];
            formData.append('attachment', attachment);
            formData.append('ticket_id', ticket_id);
            formData.append('department_id', department_id);
            formData.append('contact_name', contact_name);
            formData.append('status', status);
            formData.append('email', email);
            formData.append('ticket_owner', ticket_owner);
            formData.append('sub_cat_id', sub_cat_id);
            formData.append('description', description);
            formData.append('phone', phone);
            formData.append('priority', priority);
            $('#loader').show(); // Show the loader immediately when button is clicked
            upsertImg("{{ route('ticket.replay') }}", "POST", formData, "modal-body", "UPDATE")
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

</script>
