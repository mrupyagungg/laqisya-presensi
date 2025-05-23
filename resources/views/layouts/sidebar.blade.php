<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">

            <li class="nav-item">
                <a class="nav-link {{ Request::is('dashboard.presensi') ? 'active' : '' }}" aria-current="page"
                    href="/dashboard/index2">
                    <span data-feather="home"></span>
                    Dashboard
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('employees*') ? 'active' : '' }}" href="/employees">
                    <span data-feather="users"></span>
                    Pegawai
                </a>
            </li> --}}
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('groups*') ? 'active' : '' }}" href="/groups">
                    <span data-feather="bar-chart"></span>
                    Gaji
                </a>
            </li> --}}
            <li class="nav-item">
                <a class="nav-link {{ Request::is('presensi*') ? 'active' : '' }}" href="/dashboard/presensi">
                    <span data-feather="check-circle"></span>
                    Presensi
                </a>
            </li>
            {{-- <li class="nav-item">
                <a class="nav-link {{ Request::is('pembayaran*') ? 'active' : '' }}" href="/pembayaran">
                    <span data-feather="credit-card"></span>
                    Pembayaran Gaji
                </a>
            </li> --}}

        </ul>
    </div>
</nav>
