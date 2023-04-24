<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
        <div class="sidebar-header">
            <div class="d-flex justify-content-start" style="margin-top: -15px;">
                <div class="logo">
                    <img src="{{ asset('assets/images/logo/logo-sipp.png') }}" alt="Logo" style="height: 50px !important">
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu mt-4">
                <li class="sidebar-title">Menu</li>

                {{-- Admin --}}
                @if(auth()->user()->role == 'admin')
                    <li class="sidebar-item {{ Request::url() == url('/dashboard-admin') ? 'active' : ' ' }}">
                        <a href="{{ route('dashboard.admin') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="sidebar-item {{ Request::url() == url('/users') ? 'active' : ' ' }}">
                        <a href="{{ route('users.index') }}" class='sidebar-link'>
                            <i class="fa-solid fa-user"></i>
                            <span>User</span>
                        </a>
                    </li>
                @endif

                {{-- Customer Services --}}
                @if(auth()->user()->role == 'customer_service')
                    <li class="sidebar-item {{ Request::url() == url('/dashboard-cs') ? 'active' : ' ' }}">
                        <a href="{{ url('dashboard-cs') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Schedule</span>
                        </a>
                        <ul class="submenu
                            {{
                                Request::url() == url('/schedule/offsets') ||
                                Request::url() == url('/schedule/offsets/create') ||
                                Request::url() == url('/schedule/productions') ||
                                Request::url() == url('/schedule/productions/create') ||
                                Request::url() == url('/schedule/finishings') ? 'active' : ' '
                            }}"
                        >
                            <li
                                class="submenu-item"
                                style="
                                {{
                                    Request::url() == url('/schedule/offsets') ||
                                    Request::url() == url('/schedule/offsets/create') ? 'background-color: #435EBE; border-radius:5px;' : ' '
                                }}"
                            >
                                <a
                                    href="{{ url('/schedule/offsets') }}"
                                    style="
                                    {{
                                        Request::url() == url('/schedule/offsets') ||
                                        Request::url() == url('/schedule/offsets/create') ? 'color: #fff' : ' '
                                    }}"
                                >Offset</a>
                            </li>
                            <li
                                class="submenu-item"
                                style="
                                {{
                                    Request::url() == url('/schedule/productions') ||
                                    Request::url() == url('/schedule/productions/create') ? 'background-color: #435EBE; border-radius:5px;' : ' '
                                }}"
                            >
                                <a
                                    href="{{ url('/schedule/productions') }}"
                                    style="
                                    {{
                                        Request::url() == url('/schedule/productions') ||
                                        Request::url() == url('/schedule/productions/create') ? 'color: #fff' : ' '
                                    }}"
                                    >Produksi</a>
                            </li>
                            <li
                                class="submenu-item"
                                style="
                                {{
                                    Request::url() == url('/schedule/finishings') ||
                                    Request::url() == url('/schedule/finishings/create') ? 'background-color: #435EBE; border-radius:5px;' : ' '
                                }}"
                            >
                            <a
                                href="{{ url('/schedule/finishings') }}"
                                style="
                                {{
                                    Request::url() == url('/schedule/finishings') ||
                                    Request::url() == url('/schedule/finishings/create') ? 'color: #fff' : ' '
                                }}"
                                >Finishing</a>
                            </li>
                        </ul>
                    </li>
                @endif

                {{-- Pimpinan --}}
                @if(auth()->user()->role == 'pimpinan')
                    <li class="sidebar-item {{ Request::url() == url('/dashboard-pimpinan') ? 'active' : ' ' }}">
                        <a href="{{ url('dashboard-pimpinan') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item has-sub">
                        <a href="#" class='sidebar-link'>
                            <i class="bi bi-stack"></i>
                            <span>Schedule</span>
                        </a>
                        <ul class="submenu
                            {{
                                Request::url() == url('/schedule/pimpinan-offsets') ||
                                Request::url() == url('/schedule/pimpinan-productions') ||
                                Request::url() == url('/schedule/pimpinan-finishings') ? 'active' : ' '
                            }}"
                        >
                            <li
                                class="submenu-item"
                                style="
                                {{
                                    Request::url() == url('/schedule/pimpinan-offsets') ? 'background-color: #435EBE; border-radius:5px;' : ' '
                                }}"
                            >
                                <a
                                    href="{{ url('/schedule/pimpinan-offsets') }}"
                                    style="
                                    {{
                                        Request::url() == url('/schedule/pimpinan-offsets') ? 'color: #fff' : ' '
                                    }}"
                                >Offset</a>
                            </li>
                            <li
                                class="submenu-item"
                                style="
                                {{
                                    Request::url() == url('/schedule/pimpinan-productions') ? 'background-color: #435EBE; border-radius:5px;' : ' '
                                }}"
                            >
                                <a
                                    href="{{ url('/schedule/pimpinan-productions') }}"
                                    style="
                                    {{
                                        Request::url() == url('/schedule/pimpinan-productions') ? 'color: #fff' : ' '
                                    }}"
                                    >Produksi</a>
                            </li>
                            <li
                                class="submenu-item"
                                style="
                                {{
                                    Request::url() == url('/schedule/pimpinan-finishings') ? 'background-color: #435EBE; border-radius:5px;' : ' '
                                }}"
                            >
                            <a
                                href="{{ url('/schedule/pimpinan-finishings') }}"
                                style="
                                {{
                                    Request::url() == url('/schedule/pimpinan-finishings') ? 'color: #fff' : ' '
                                }}"
                                >Finishing</a>
                            </li>
                        </ul>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/cetak-laporan') ? 'active' : ' ' }}">
                        <a href="{{ url('cetak-laporan') }}" class='sidebar-link'>
                            <i class="fa-solid fa-print"></i>
                            <span>Cetak Laporan</span>
                        </a>
                    </li>
                @endif

                {{-- Kadiv Offset --}}
                @if(auth()->user()->role == 'kadiv_offset')
                    <li class="sidebar-item {{ Request::url() == url('/dashboard-kadiv-offset') ? 'active' : ' ' }}">
                        <a href="{{ url('dashboard-kadiv-offset') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/kadiv-offset') ? 'active' : ' ' }}">
                        <a href="{{ url('kadiv-offset') }}" class='sidebar-link'>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Offset</span>
                        </a>
                    </li>
                @endif

                {{-- Kadiv Produksi --}}
                @if(auth()->user()->role == 'kadiv_produksi')
                    <li class="sidebar-item {{ Request::url() == url('/dashboard-kadiv-produksi') ? 'active' : ' ' }}">
                        <a href="{{ url('dashboard-kadiv-produksi') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/kadiv-produksi') ? 'active' : ' ' }}">
                        <a href="{{ url('kadiv-produksi') }}" class='sidebar-link'>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Produksi</span>
                        </a>
                    </li>
                @endif

                {{-- Kadiv Finishing --}}
                @if(auth()->user()->role == 'kadiv_finishing')
                    <li class="sidebar-item {{ Request::url() == url('/dashboard-kadiv-finishing') ? 'active' : ' ' }}">
                        <a href="{{ url('dashboard-kadiv-finishing') }}" class='sidebar-link'>
                            <i class="bi bi-grid-fill"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li class="sidebar-item {{ Request::url() == url('/kadiv-finishing') ? 'active' : ' ' }}">
                        <a href="{{ url('kadiv-finishing') }}" class='sidebar-link'>
                            <i class="fa-solid fa-circle-check"></i>
                            <span>Finishing</span>
                        </a>
                    </li>
                @endif

                <li class="sidebar-item">
                    <a href="{{ route('logout') }}" class='sidebar-link'>
                        <i class="fa-solid fa-right-from-bracket"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
