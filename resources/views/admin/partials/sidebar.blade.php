 <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="{{route('admin.dashboard')}}">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link" href="{{route('admin.addcategory')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-address-card"></i></div>
                                Categories
                            </a>
                            <a class="nav-link" href="{{route('admin.addcard')}}">
                                <div class="sb-nav-link-icon"><i class="fa-solid fa-list"></i></div>
                                Cards
                            </a>
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logged in as:</div>
                        {{ Auth::guard('admin')->user()->name }}
                    </div>
                </nav>
            </div>