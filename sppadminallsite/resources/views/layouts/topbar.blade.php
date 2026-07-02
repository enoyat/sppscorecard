<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                @if (!empty(Session::get('logo')))
                <a href="{{ route('root') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('img/' . Session::get('logo')) }}" alt="" class="img-fluid"
                            style="max-height:50px">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('img/' . Session::get('logo')) }}" alt="" class="img-fluid"
                            style="max-height:50px">
                        <span class="logo-txt"></span>
                    </span>
                </a>

                <a href="{{ route('root') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('img/' . Session::get('logo')) }}" alt="" class="img-fluid"
                            style="max-height:50px">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('img/' . Session::get('logo')) }}" alt="" class="img-fluid"
                            style="max-height:50px">
                        <span class="logo-txt"></span>
                    </span>
                </a>
                @else
                {{ Session::get('logo') }}
                @endif
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <div style="margin-top:20px">
                <span class="logo-txt header-item">{{ Session::get('namacustomer') }}</span>
            </div>
            <div style="margin-top:20px">

            </div>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item" id="page-header-search-dropdown" data-bs-toggle="dropdown"
                    aria-haspopup="true" aria-expanded="false">
                    <i data-feather="search" class="icon-lg"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="form-group m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ..."
                                    aria-label="Search Result">

                                <button class="btn btn-primary" type="submit"><i class="mdi mdi-magnify"></i></button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>



            <style>
            .notification-item {
                padding: 10px 15px;
            }

            .notif-title {
                font-weight: 600;
                margin-bottom: 5px;
            }

            .notif-subject {
                color: #777;
                font-size: 13px;

                display: block;
                margin-left: 18px;

                white-space: normal;
                word-break: break-word;
                overflow-wrap: break-word;
                line-height: 1.4;
            }
            </style>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon position-relative"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-haspopup="true"
                    aria-expanded="false">
                    <i data-feather="bell" class="icon-lg"></i>
                    <span class="badge bg-danger rounded-pill">{{ auth()->user()->unreadNotifications->count() }}</span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('notifications.unread') }}" class="small text-reset text-decoration-underline"> Unread
                                    ({{ auth()->user()->unreadNotifications->count() }})</a>
                                <ul>
                                    @forelse(auth()->user()->unreadNotifications as $notif)


                                    <li class="notification-item">
                                        <a href="{{ route('notifications.read', $notif->id) }}" class="dropdown-item">



                                            <small>

                                                <div class="notif-title">
                                                    <i class="fa fa-bell"></i>
                                                    {{ $notif->data['title'] }} 
                                                </div>

                                                <div class="notif-subject">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ $notif->data['message'] }}
                                                </div>

                                            </small>
                                        </a>
                                    </li>

                                    @empty

                                    <li>
                                        <span class="dropdown-item">
                                            Tidak ada notifikasi
                                        </span>
                                    </li>

                                    @endforelse
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">

                    </div>
                    <div class="p-2 border-top d-grid">
                        <a class="btn btn-sm btn-link font-size-14 text-center" href="{{ route('notifications.index') }}">
                            <i class="mdi mdi-arrow-right-circle me-1"></i> <span>View More..</span>
                        </a>
                    </div>
                </div>
            </div>

            

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item topbar-light bg-light-subtle border-start border-end"
                    id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="@if (Auth::user()->avatar != '') {{ URL::asset('build/images/users/' . Auth::user()->avatar) }}@else{{ URL::asset('build/images/users/avatar-1.jpg') }} @endif"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="mdi mdi-face-man font-size-16 align-middle me-1"></i>
                        Profile</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="javascript:void();"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"><i
                            class="mdi mdi-logout font-size-16 align-middle me-1"></i> <span key="t-logout">Log
                            Out</span></a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>

        </div>
    </div>
</header>