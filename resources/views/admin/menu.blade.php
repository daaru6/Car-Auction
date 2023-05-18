<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{route('admin.dashboard')}}" class="logo logo-dark">
                    <span class="logo-sm">
                       
                    </span>
                    <span class="logo-lg">
                        <span class="logo-txt">Admin Dashboard</span>
                    </span>
                </a>

                <a href="index.php" class="logo logo-light">
                    <span class="logo-sm">
                       
                    </span>
                    <span class="logo-lg">
                        <span class="logo-txt">Admin Dashboard</span>
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-16 header-item" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>

           
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item bg-soft-light border-start border-end" id="page-header-user-dropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="d-none d-xl-inline-block ms-1 fw-medium">Admin</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    
                    <a class="dropdown-item" href="{{route('logout')}}"><i class="mdi mdi-logout font-size-16 align-middle me-1"></i> Logout</a>
                </div>
            </div>

        </div>
    </div>
</header>

<!-- ========== Left Sidebar Start ========== -->
<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="current">
                    <a href="{{route('admin.dashboard')}}" class="current">
                        <i class="fas fa-home"></i>
                        <span data-key="t-dashboard">Dashboard</span>
                    </a>
                </li>
                
                <li class="">
                    <a href="{{route('admin.agents')}}" class="">
                        <i class="fas fa-user"></i>
                   
                        <span data-key="t-users">All Users</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('admin.userregistrationamount')}}" class="">
                        <i class="fas fa-credit-card"></i>
                   
                        <span data-key="t-users">Registration Amount</span>
                    </a>
                </li>

                <li class="">
                    <a href="{{route('admin.car.category.create')}}" class="">
                        <i class="fas fa-car"></i>
                        <span data-key="t-users">Car Category</span>
                    </a>
                </li>
                <li class="">
                    <a href="{{route('admin.car.brand.create')}}" class="">
                        <i class="fas fa-car"></i>
                        <span data-key="t-users">Car Brands</span>
                    </a>
                </li>
                
                



            </ul>



        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->