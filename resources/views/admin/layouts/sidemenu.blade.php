<aside class="main-sidebar sidebar-light-info elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('admin.home')}}" class="brand-link">
        <img src="{{asset('dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">WorkOrBit</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{asset('dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="{{route('admin.home')}}" class="d-block">{{auth()->guard('admin')->user()->name??''}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
    {{--<div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-sidebar">
                    <i class="fas fa-search fa-fw"></i>
                </button>
            </div>
        </div>
    </div>--}}

    <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @if(auth()->guard('admin')->user()->type=='admin')
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.admin_user.index')}}" class="nav-link">
                                    <i class="far fa-users nav-icon"></i>
                                    <p>Users List</p>
                                </a>
                            </li>
                        </ul>
                        <!--
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{route('admin.permission.index')}}" class="nav-link">
                                        <i class="far fa-users nav-icon"></i>
                                        <p>Permissions</p>
                                    </a>
                                </li>
                            </ul>
                        -->
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.user_permission.index')}}" class="nav-link">
                                    <i class="far fa-users nav-icon"></i>
                                    <p>Permissions</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                @if(hasPermission('client_list'))
                    <li class="nav-item">
                        <a href="javascript:;" class="nav-link">
                            <i class="nav-icon fas fa-user"></i>
                            <p>
                                Clients
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.client.index')}}" class="nav-link">
                                    <i class="far fa-users nav-icon"></i>
                                    <p>Clients List</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @endif
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i class="nav-icon fas fa-location-arrow"></i>
                        <p>
                            Sites
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(hasPermission('site_type_list'))
                            <li class="nav-item">
                                <a href="{{route('admin.site.index')}}" class="nav-link">
                                    <i class="far fa-users nav-icon"></i>
                                    <p>Site Type</p>
                                </a>
                            </li>
                        @endif
                        @if(hasPermission('site_list'))
                        <li class="nav-item">
                            <a href="{{route('admin.site.index')}}" class="nav-link">
                                <i class="far fa-users nav-icon"></i>
                                <p>Site List</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Subcontractor
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(hasPermission('subcontractor_list'))
                            <li class="nav-item">
                                <a href="{{route('admin.sub_contractor.index')}}" class="nav-link">
                                    <i class="far fa-users nav-icon"></i>
                                    <p>Sub Contractor</p>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i class="nav-icon fas fa-address-card"></i>
                        <p>
                            Staff
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(hasPermission('staff_designation_list'))
                            <li class="nav-item">
                                <a href="{{route('admin.designation.index')}}" class="nav-link">
                                    <i class="far fa-users nav-icon"></i>
                                    <p>Staff Designation</p>
                                </a>
                            </li>
                        @endif
                        @if(hasPermission('staff_list'))
                        <li class="nav-item">
                            <a href="{{route('admin.staff.index')}}" class="nav-link">
                                <i class="far fa-users nav-icon"></i>
                                <p>Staff</p>
                            </a>
                        </li>
                        @endif
                        @if(hasPermission('staff_vetting_name_list'))
                        <li class="nav-item">
                            <a href="{{route('admin.vetting.index')}}" class="nav-link">
                                <i class="far fa-users nav-icon"></i>
                                <p>Vetting</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i class="nav-icon fas fa-clock"></i>
                        <p>
                            Shift
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(hasPermission('shift_list'))
                        <li class="nav-item">
                            <a href="{{route('admin.shift.index')}}" class="nav-link">
                                <i class="far fa-users nav-icon"></i>
                                <p>Shift List</p>
                            </a>
                        </li>
                        @endif
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        @if(hasPermission('client_report_list'))
                        <li class="nav-item">
                            <a href="{{route('admin.report.client')}}" class="nav-link">
                                <i class="far fa-users nav-icon"></i>
                                <p>Client Report</p>
                            </a>
                        </li>
                        @endif
                        @if(hasPermission('site_report_list'))
                        <li class="nav-item">
                            <a href="{{route('admin.report.site')}}" class="nav-link">
                                <i class="far fa-users nav-icon"></i>
                                <p>Sites Report</p>
                            </a>
                        </li>
                        @endif
                        @if(hasPermission('subcontractor_report_list'))
                        <li class="nav-item">
                            <a href="{{route('admin.report.subcontractor')}}" class="nav-link">
                                <i class="far fa-users nav-icon"></i>
                                <p>SubContractor Report</p>
                            </a>
                        </li>
                        @endif
                        @if(hasPermission('staff_report_list'))
                        <li class="nav-item">
                            <a href="{{route('admin.report.staff')}}" class="nav-link">
                                <i class="far fa-users nav-icon"></i>
                                <p>Staff Report</p>
                            </a>
                        </li>
                        @endif
                        <li class="nav-item">
                            <a href="javascript:;" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Shift Reports<i class="right fas fa-angle-left"></i></p>
                            </a>
                            <ul class="nav nav-treeview">
                            @if(hasPermission('today_shift_list'))
                                <li class="nav-item">
                                    <a href="{{route('admin.report.today.shift')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Today Shifts Report</p>
                                    </a>
                                </li>
                                @endif
                                @if(hasPermission('total_shift_list'))
                                <li class="nav-item">
                                    <a href="{{route('admin.report.total.shift')}}" class="nav-link">
                                        <i class="far fa-dot-circle nav-icon"></i>
                                        <p>Total Shifts Report</p>
                                    </a>
                                </li>
                                @endif
                            </ul>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="javascript:;" class="nav-link">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>
                            Settings
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('admin.option.index')}}" class="nav-link">
                                    <i class="far fa-users nav-icon"></i>
                                    <p>Setting</p>
                                </a>
                            </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
