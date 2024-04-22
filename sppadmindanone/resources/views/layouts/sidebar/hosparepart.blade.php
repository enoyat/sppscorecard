<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>



                <li>
                    <a href="{{ route('root') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">@lang('translation.Dashboard')</span>
                    </a>
                </li>


                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="battery"></i>
                        <span data-key="t-apps">Sparepart</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">

                        <li>
                            <a href="{{ route('orders.index') }}">
                                <span data-key="t-calendar">Orders</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('orders.history') }}">
                                <span data-key="t-calendar">History Orders</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">@lang('translation.Authentication')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{ route('gantipassword') }}"
                                data-key="t-recover-password">@lang('translation.Recover_Password')</a></li>

                </li>
            </ul>
            </li>



            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
