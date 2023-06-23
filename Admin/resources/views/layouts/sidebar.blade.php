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
                    <a href="{{ route('delivery.index') }}">
                    <i class="fas fa-car-side"></i> 
                        <span data-key="t-horizontal">Delivery Schedule</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('maintenance.index') }}">
                        <i class=" fas fa-cogs"></i>
                        <span data-key="t-horizontal">Maintenance</span>
                    </a>
                </li>               
                <li>
                    <a href="{{ route('physical.index') }}">
                        <i class=" fas fa-coins"></i>
                        <span data-key="t-horizontal">Phisical Availibility</span>
                    </a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">Sparepart</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li>
                            <a href="{{ route('sparepart.index') }}">
                                <span data-key="t-calendar">Master Sparepart</span>
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('sparepartstok.index') }}">
                                <span data-key="t-chat">Spare Part Stok</span>
                            </a>
                        </li>
                        
                        
                    </ul>
                </li>
                <li>
                    <a href="{{ route('trouble.index') }}">
                    <i class="fas fa-car-crash"></i>
                        <span data-key="t-horizontal">List of Trouble</span>
                    </a>
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
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="grid"></i>
                        <span data-key="t-apps">@lang('translation.Master')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
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
                        
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i data-feather="users"></i>
                        <span data-key="t-authentication">@lang('translation.Authentication')</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="auth-login" data-key="t-login">@lang('translation.Login')</a></li>
                        <li><a href="auth-register" data-key="t-register">@lang('translation.Register')</a></li>
                        <li><a href="auth-recoverpw" data-key="t-recover-password">@lang('translation.Recover_Password')</a></li>
                        <li><a href="auth-logout" data-key="t-logout">@lang('translation.Logout')</a>
                        </li>
                    </ul>
                </li>

               

            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->
