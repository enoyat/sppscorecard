<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu">@lang('translation.Menu')</li>


                <li>
                    <a href="{{ route('lokasi.customer') }}">
                        <i data-feather="user"></i>
                        <span data-key="t-dashboard">@lang('translation.Customer')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('root') }}">
                        <i data-feather="home"></i>
                        <span data-key="t-dashboard">@lang('translation.Dashboard')</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('delivery.index') }}">
                        <i data-feather="clock"></i>
                        <span data-key="t-horizontal">Delivery Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('unit.index') }}">
                        <i data-feather="truck"></i>
                        <span data-key="t-horizontal">Unit</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('maintenance.index') }}">
                        <i data-feather="settings"></i>
                        <span data-key="t-horizontal">Maintenance</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('maintenance.listactionall') }}">
                        <i data-feather="settings"></i>
                        <span data-key="t-horizontal">List of Maintenance</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('physical.index') }}">
                        <i data-feather="package"></i>
                        <span data-key="t-horizontal">Phisical Availibility</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('trouble.index') }}">
                        <i data-feather="alert-triangle"></i>
                        <span data-key="t-horizontal">List of Trouble</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="battery"></i>
                        <span data-key="t-apps">Sparepart</span>
                    </a>
                <ul class="sub-menu" aria-expanded="false">
                    <li>
                        <a href="{{ route('sparepartstok.index') }}">
                            <span data-key="t-chat">Spare Part Stock</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sparepartstoktrans.index') }}">
                            <span data-key="t-chat">Stock Transaction</span>
                        </a>
                    </li>

                </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="battery"></i>
                        <span data-key="t-apps">Order Sparepart</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('sparepart.index') }}">
                                <span data-key="t-calendar">Master Sparepart</span>
                            </a>
                        </li>
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
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Pallete</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('pallete.index') }}">
                                <span data-key="t-calendar">Withdrawal/Delivery</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('palleterenew.index') }}">
                                <span data-key="t-chat">Pallete Renewal</span>
                            </a>
                        </li>


                    </ul>
                </li>
                <li>
                    <a href="{{ route('beritaacara.index') }}">
                        <i data-feather="file-text"></i>
                        <span data-key="t-horizontal">Official Report</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('suratjalan.index') }}">
                        <i data-feather="file"></i>
                        <span data-key="t-horizontal">Delivery Note</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('ticket.index') }}">
                        <i data-feather="file-text"></i>
                        <span data-key="t-horizontal">Ticket</span>
                    </a>
                </li>
                @if(Session::get('roles_id')==1 || Session::get('roles_id')==5)

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">@lang('translation.Master')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('masterunit.index') }}">

                                <span data-key="t-horizontal">Unit</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('customer.listcustomer') }}">
                                <span data-key="t-calendar">Customer</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('cbu.index') }}">
                                <span data-key="t-calendar">CBU</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('region.index') }}">
                                <span data-key="t-chat">Region</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('sitename.index') }}">
                                <span data-key="t-chat">Site Name</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('forklifttype.index') }}">
                                <span data-key="t-chat">Forklift Type</span>
                            </a>
                        </li>

                    </ul>
                </li>
                @endif
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">@lang('translation.Authentication')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @if(Session::get('roles_id')==1 || Session::get('roles_id')==5)
                        <li><a href="{{ route('utility.userpassword') }}" data-key="t-register">User List</a></li>
                        <li><a href="{{ route('utility.register') }}"
                                data-key="t-register">@lang('translation.Register')</a></li>
                        @endif
                        <li><a href="{{ route('gantipassword') }}"
                                data-key="t-recover-password">@lang('translation.Recover_Password')</a></li>
                        <li><a href="{{ route('utility.userlog') }}" data-key="t-register">Login History</a></li>
                </li>
            </ul>
            </li>



            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
