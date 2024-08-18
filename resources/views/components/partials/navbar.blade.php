<!--start header -->
<header>
    <div class="topbar d-flex align-items-center">
        <nav class="navbar navbar-expand">
            <div class="topbar-logo-header">
                <div class="">
                    <img src="{{ URL::asset('images/OIP.jpeg') }}" class="logo-icon" alt="logo icon" style="height:2rem;">
                </div>
                <div class="">
                    <h4 class="logo-text"></h4>
                </div>
            </div>
            <div class="mobile-toggle-menu"><i class="bi bi-list"></i></div>
            <div class="search-bar flex-grow-1">
                <div class="position-relative">
                    <marquee behavior="" direction=""></marquee>
                </div>
            </div>
            <div class="top-menu ms-auto">
                <ul class="navbar-nav align-items-center">
                    <li class="nav-item mobile-search-icon">
                        <a class="nav-link" href="#"> <i class='bx bx-search'></i>
                        </a>
                    </li>
                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"> <i class='bx bx-category'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <div class="row row-cols-3 g-3 p-3">
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-cosmic text-white"><i
                                            class='bx bx-group'></i>
                                    </div>
                                    <div class="app-title">Teams</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-burning text-white"><i
                                            class='bx bx-atom'></i>
                                    </div>
                                    <div class="app-title">Projects</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-lush text-white"><i
                                            class='bx bx-shield'></i>
                                    </div>
                                    <div class="app-title">Tasks</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-kyoto text-dark"><i
                                            class='bx bx-notification'></i>
                                    </div>
                                    <div class="app-title">Feeds</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-blues text-dark"><i class='bx bx-file'></i>
                                    </div>
                                    <div class="app-title">Files</div>
                                </div>
                                <div class="col text-center">
                                    <div class="app-box mx-auto bg-gradient-moonlit text-white"><i
                                            class='bx bx-filter-alt'></i>
                                    </div>
                                    <div class="app-title">Alerts</div>
                                </div>
                            </div>
                        </div>
                    </li>
                    <div id="ticketRefresh" onclick="testTimeAutoRefresh()">
                        <li class="nav-item dropdown dropdown-large">
                            <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                    class="alert-count allticketnotification"></span>
                                <i class='bi bi-bell-fill'></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:;">
                                    <div class="msg-header">
                                        <p class="msg-header-title">Notifications</p>
                                        <p class="msg-header-clear ms-auto">Marks all as read</p>
                                    </div>
                                </a>
                                <div class="header-notifications-list" id="notificationListData">
                                    {{-- @foreach (deptWiseTicketGet() as $ticket)
                                        <a class="dropdown-item" href="javascript:;"
                                            style="background: lightgoldenrodyellow" onclick="getData({{ $ticket->id }})">
                                            <div class="d-flex align-items-center">
                                                <div class="notify bg-light-primary text-primary"><i
                                                        class="bx bx-group"></i>
                                                </div>
                                                <div class="flex-grow-1" id="notiFicationData"> --}}
                                                    {{-- @php
                                                        $createdAt = $ticket->created_at;
                                                        $seconds = $createdAt->diffInMinutes();
                                                    @endphp
                                                    <h6 class="msg-name">New Ticket<span
                                                            class="msg-time float-end">{{ $seconds }} minutes
                                                            ago</span></h6>
                                                    <p class="msg-name"><strong>Ticket ID:</strong> {{ $ticket->id }}</p>
                                                    <p class="msg-name"><strong>Subject:</strong> {{ $ticket->subject }}</p>
                                                    <p class="msg-name"><strong>Status:</strong> {{ $ticket->status }}</p> --}}

                                                {{-- </div>
                                            </div>
                                        </a> --}}
                                    {{-- @endforeach --}}
                                    {{-- <link rel="stylesheet"
                                        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
                                    @push('js')
                                        <script>
                                            // Enable pusher logging - don't include this in production
                                            Pusher.logToConsole = true;

                                            var pusher = new Pusher('fd6b8cf3b157ab605bbc', {
                                                cluster: 'ap2'
                                            });

                                            var channel = pusher.subscribe('my-channel');
                                            if(channel!=''){
                                                var channel = pusher.subscribe('my-channel');


                                                channel.bind('form-submitted', function(datas) {
                                                    // Log the full data received for debugging
                                                    console.log(JSON.stringify(datas));
                                                    // Access the specific fields from the datas object
                                                    const { name } = datas;

                                                    // Get the notification div by its ID
                                                    const notificationDivs = document.getElementById('notiFicationData');
                                                    // Update the inner HTML of the notification div with the desired field
                                                    notificationDivs.innerHTML = `<h6 class="msg-name">New Ticket<span class="msg-time float-end">14 Sec ago</span></h6>
                                                        <p  class="msg-name"><strong>New Ticket ID:</strong> ${name.id}</p><p  class="msg-name"><strong>Subject:</strong> ${name.subject}</p><p class="msg-name"><strong>Status:</strong> ${name.status}</p>`;
                                                       let allticketnotification = $(".allticketnotification").html();
                                                        if (allticketnotification) {
                                                            // Convert the content to a number and increment by 1
                                                            let ticketCount = parseInt(allticketnotification) + 1;
                                                            $('.allticketnotification').html(ticketCount);

                                                        }
                                                        // Content has changed, show a success message using Toastr
                                                        toastr.success("New ticket created", "Successfully");


                                                });

                                            }
                                        </script>
                                    @endpush --}}

                                </div>
                                <a href="javascript:;">
                                    <div class="text-center msg-footer">View All Notifications</div>
                                </a>
                            </div>
                        </li>
                    </div>

                    <li class="nav-item dropdown dropdown-large">
                        <a class="nav-link dropdown-toggle dropdown-toggle-nocaret position-relative" href="#"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"> <span
                                class="alert-count">1</span>
                            <i class='bi bi-chat'></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end">
                            <a href="javascript:;">
                                <div class="msg-header">
                                    <p class="msg-header-title">Messages</p>
                                    <p class="msg-header-clear ms-auto">Marks all as read</p>
                                </div>
                            </a>
                            <div class="header-message-list">
                                <a class="dropdown-item" href="javascript:;">
                                    <div class="d-flex align-items-center">
                                        <div class="user-online">
                                            <img src="{{ URL::asset('images/avatars/avatar-4.png') }}"
                                                class="msg-avatar" alt="user avatar">
                                        </div>
                                        <div class="flex-grow-1">
                                            <h6 class="msg-name">Mr User 01 <span class="msg-time float-end">15
                                                    min ago</span></h6>
                                            <p class="msg-info">Making this the first true generator</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <a href="javascript:;">
                                <div class="text-center msg-footer">View All Messages</div>
                            </a>
                        </div>
                    </li>
                </ul>
            </div>
            <div class="user-box dropdown">
                <a class="d-flex align-items-center nav-link dropdown-toggle dropdown-toggle-nocaret" href="#"
                    role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{-- <img src="{{ URL::asset('images/OIP.jpeg') }}" class="logo-icon" alt="user avatar"  style="height:2rem;"> --}}
                    <div class="user-info ps-3">
                        <p class="user-name mb-0 userNmae">{{ Auth::user()->name }}</p>
                        <p class="designattion mb-0">{{ showDeptName() }}</p>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li><a class="dropdown-item" href="javascript:;" onclick="updateProfileModal()"><i
                                class="bx bx-user"></i><span>Update Profile</span></a>
                    </li>
                    <li><a class="dropdown-item" href="javascript:;" onclick="changePasswordModal()"><i
                                class="bx bx-cog"></i><span>Change Password</span></a>
                    </li>
                    <li>
                        <div class="dropdown-divider mb-0"></div>
                    </li>
                    <li><a class="dropdown-item" href="{{ route('auth.logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                                class='bx bx-log-out-circle'></i><span>Logout</span></a></li>

                    <form id="logout-form" action="{{ route('auth.logout') }}" method="POST"
                        style="display: none;">
                        @csrf
                    </form>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!--end header -->
<script>

function updateTicketCount() {
    // alert('ok');
    $.ajax({
        url: "ticket-count",
        success: function(data) {
            // console.log(data);
            document.querySelector('.allticketnotification').innerHTML = data;

        }
    });
}

setInterval(updateTicketCount, 3000);

function testTimeAutoRefresh() {
    $.ajax({
        url: "ticket-new-refresh",
        success: function(data) {
            console.log(data);
            const notificationDivs = document.getElementById('notificationListData');
            let ticketsHtml = '';

            data.forEach(function(ticket) {
                const createdAt = new Date(ticket.created_at);
                const now = new Date();
                const diffInMinutes = Math.floor((now - createdAt) / 60000);

                ticketsHtml += `<a class="dropdown-item" href="javascript:;"
                                    style="background: lightgoldenrodyellow" onclick="getData(${ticket.id})">
                                    <div class="d-flex align-items-center">
                                        <div class="notify bg-light-primary text-primary">
                                            <i class="bx bx-group"></i>
                                        </div>
                                        <div class="flex-grow-1" id="notiFicationData">
                                            <h6 class="msg-name">New Ticket<span class="msg-time float-end">${diffInMinutes} minutes ago</span></h6>
                                            <p class="msg-name"><strong>Ticket ID:</strong> ${ticket.id}</p>
                                            <p class="msg-name"><strong>Subject:</strong> ${ticket.subject}</p>
                                            <p class="msg-name"><strong>Status:</strong> ${ticket.status}</p>
                                        </div>
                                    </div>
                                </a>`;
            });
            notificationDivs.innerHTML = ticketsHtml;
        }
    });
}



</script>
