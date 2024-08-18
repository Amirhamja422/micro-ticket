<!--navigation-->
<div class="nav-container primary-menu">
    <div class="mobile-topbar-header">
        <div>
            <img src="{{ URL::asset('images/OIP.jpeg') }}" class="logo-icon" alt="logo icon" style="height:2rem;">
        </div>
        <div>
            <h4 class="logo-text">iHelpBD</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class="bi bi-arrow-bar-left"></i></div>
    </div>
    <nav class="navbar navbar-expand-xl w-100">
        <ul class="navbar-nav justify-content-start flex-grow-1 gap-1 justify-content-center text-capitalize">

            <li class="nav-item">
                <a class="nav-link" href="{{ route('dashboard') }}">
                    <div class="parent-icon"><i class='bi bi-house'></i></div>
                    <div class="menu-title">Dashboard</div>
                </a>
            </li>

            @if(Auth::User()->can('user') || Auth::User()->can('client') || Auth::User()->can('server') || Auth::User()->can('host')|| Auth::User()->can('support.type')|| Auth::User()->can('task.type')|| Auth::User()->can('notice') || Auth::User()->can('signature'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;"
                        data-bs-toggle="dropdown">
                        <div class="parent-icon"><i class="bi bi-gear"></i></div>
                        <div class="menu-title">Settings</div>
                    </a>
                    <ul class="dropdown-menu">
                        @if(Auth::User()->can('user'))<li><a class="dropdown-item" href="{{ route('user') }}" ><i class="bi bi-arrow-right"></i>Users</a></li>@endif

                        @if(Auth::User()->can('user'))<li><a class="dropdown-item" href="{{ route('department') }}" ><i class="bi bi-arrow-right"></i>Department</a></li>@endif

                        @if(Auth::User()->can('user'))<li><a class="dropdown-item" href="{{ route('category') }}" ><i class="bi bi-arrow-right"></i>category</a></li>@endif

                        @if(Auth::User()->can('user'))<li><a class="dropdown-item" href="{{ route('subcategory') }}" ><i class="bi bi-arrow-right"></i>Sub category</a></li>@endif

                        @if(Auth::User()->can('user'))<li><a class="dropdown-item" href="{{ route('status') }}" ><i class="bi bi-arrow-right"></i>Status</a></li>@endif
                    </ul>
                </li>
            @endif

            @if(Auth::User()->can('ticket'))
                <li class="nav-item dropdown">
                    <a class="nav-link" href="{{ route('ticket') }}">
                        <div class="parent-icon"><i class='bi bi-ticket-detailed'></i></div>
                        <div class="menu-title">Ticket</div>
                    </a>
                </li>
            @endif

            @if(Auth::User()->can('permission.group') || Auth::User()->can('permission') || Auth::User()->can('role'))
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" href="javascript:;" data-bs-toggle="dropdown">
                        <div class="parent-icon"><i class="bi bi-file-lock"></i></div>
                        <div class="menu-title">Permission</div>
                    </a>
                    <ul class="dropdown-menu">
                        @if(Auth::User()->can('permission.group'))<li><a class="dropdown-item" href="{{ route('permission.group') }}"><i class="bi bi-arrow-right"></i>Permission Group</a></li>@endif
                        @if(Auth::User()->can('permission'))<li><a class="dropdown-item" href="{{ route('permission') }}"><i class="bi bi-arrow-right"></i>Permission</a></li>@endif
                        @if(Auth::User()->can('role'))<li><a class="dropdown-item" href="{{ route('role') }}"><i class="bi bi-arrow-right"></i>Role</a></li>@endif
                    </ul>
                </li>
            @endif

            @if(Auth::User()->can('support') || Auth::User()->can('project') || Auth::User()->can('task'))

            </li>
            @endif


        </ul>
    </nav>
</div>
<!--end navigation-->
