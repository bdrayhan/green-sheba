<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ route('admin.dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend') }}/assets/images/logo.png" alt=""
                            height="35">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend') }}/assets/images/full-amar desh-logo.png" alt=""
                            height="60">
                    </span>
                </a>
                <a href="{{ route('admin.dashboard') }}" class="logo logo-light mt-3">
                    <span class="logo-sm" style="line-height: 40px;">
                        <img src="{{ asset('backend') }}/assets/images/logo.png" alt=""
                            height="35">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend') }}/assets/images/full-amar desh-logo.png" alt=""
                            height="60">
                    </span>
                </a>
            </div>
            <button type="button" class="btn btn-sm px-3 font-size-16 header-item waves-effect" id="vertical-menu-btn">
                <i class="fa fa-fw fa-bars"></i>
            </button>
            <div class="d-flex app-search d-none d-lg-block">
                <a href="{{ route('admin.clear.cache') }}" class="btn btn-outline-danger waves-effect waves-light"
                    style="margin-right: 5px;">
                    <i class="bx bxs-analyse bx-spin font-size-16 align-middle me-2"></i> Clear Cache
                </a>
            </div>
        </div>
        <div class="d-flex">
            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ asset('backend') }}/assets/images/users/avatar-1.jpg" alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1" key="t-henry">{{ Auth::user()->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    {{-- <a class="dropdown-item" href="{{ route('admin.user.profile') }}"><i
                            class="bx bx-user font-size-16 align-middle me-1"></i>
                        <span key="t-profile">Profile</span></a> --}}
                    <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end">11</span><i
                            class="bx bx-wrench font-size-16 align-middle me-1"></i> <span
                            key="t-settings">Settings</span></a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                            class="bx bx-power-off font-size-16 align-middle me-1 text-danger"></i> <span
                            key="t-logout">Logout</span></a>
                </div>
            </div>
        </div>
    </div>
</header>
