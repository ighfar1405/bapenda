<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('dashboard/img/brand/favicon.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/argon.css?v=1.2.0') }}" type="text/css">
    {{-- select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    {{-- optional CSS --}}
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    @yield('css')
    <style>
        a.disabled {
            pointer-events: none;
            cursor: default;
        }
    </style>
</head>

<body>
    <!-- Sidenav -->
    <nav class="sidenav navbar navbar-vertical fixed-left navbar-expand-xs navbar-light bg-white" id="sidenav-main">
        <div class="scrollbar-inner">
            <!-- Brand -->
            <div class="sidenav-header  align-items-center">
                <a class="navbar-brand" href="javascript:void(0)">
                    @php
                        $appName = config('app.name');
                        $newText = wordwrap($appName, 20, '<br>');
                    @endphp
                    {!! $newText !!}
                    {{-- <img src="{{ asset('dashboard/img/brand/blue.png') }}" class="navbar-brand-img" alt="{{ config('app.name') }}"> --}}
                </a>
            </div>
            <div class="navbar-inner">
                <!-- Collapse -->
                <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                    <!-- Nav items -->
                    <ul class="navbar-nav">
                    <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin') ? 'active' : null }}"
                                href="{{ route('landing-hero') }}">
                                <i class="ni ni-tv-2"></i>
                                <span class="nav-link-text">Grafik</span>
                            </a>
                        </li>
             
                        <li class="nav-item">
                            <a class="nav-link {{ Request::is('admin') ? 'active' : null }}"
                                href="{{ route('admin.dashboard.index') }}">
                                <i class="ni ni-tv-2"></i>
                                <span class="nav-link-text">Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item nav-with-child">
                            <a class="nav-link">
                                <i class="ni ni-single-copy-04"></i> Master Data
                                <i class="ml-auto fa fa-angle-down"></i>
                            </a>
                            <ul class="nav-item-child">
                                @can('penomoran-show')
                                    <li class="nav-item {{ Request::is('admin/penomoran*') ? 'active' : null }}">
                                        <a class="nav-link " href="{{ route('penomoran.index') }}">
                                            <span class="nav-link-text">Penomoran</span>
                                        </a>
                                    </li>
                                @endcan
                                
                      
                                    <li class="nav-item {{ Request::is('admin/tanaman*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('tanaman.index') }}">
                                            Jenis Tanaman
                                        </a>
                                    </li>
                

                                @can('opd-show')
                                    <li class="nav-item {{ Request::is('admin/opd*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('opd.index') }}">
                                            OPD / SKPD
                                        </a>
                                    </li>
                                @endcan

                                @can('wilayah-show')
                                    <li class="nav-item {{ Request::is('admin/kecamatan*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('kecamatan.index') }}">
                                            Wilayah Administrasi
                                        </a>
                                    </li>
                                @endcan

                                @can('akun-show')
                                    <li class="nav-item {{ Request::is('admin/akun*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('akun.index') }}">
                                            Kode Akun
                                        </a>
                                    </li>
                                @endcan

                                @can('jenis_pembayaran-show')
                                    <li class="nav-item {{ Request::is('admin/jenispembayaran*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('jenispembayaran.index') }}">
                                            <span class="nav-link-text">Jenis Pembayaran</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('rekening_bank-show')
                                    <li class="nav-item" {{ Request::is('admin/rekening*') ? 'active' : null }}>
                                        <a class="nav-link" href="{{ route('rekening.index') }}">
                                            <span class="nav-link-text">Rekening Bank</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('pemindahan_pemakaian-show')
                                    <li class="nav-item"
                                        {{ Request::is('admin/pemindahan-pemakaian*') ? 'active' : null }}>
                                        <a class="nav-link" href="{{ route('pemindahan_pemakaian.index') }}">
                                            <span class="nav-link-text">Pemindahan Pemakaian</span>
                                        </a>
                                    </li>
                                @endcan

                                @can('tahun-show')
                                    <li class="nav-item {{ Request::is('admin/tahun*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('tahun.index') }}">
                                            <span class="nav-link-text">Daftar Tahun</span>
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>

                        @can('klasifikasi-show')
                            <li class="nav-item {{ Request::is('admin/klasifikasi*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('klasifikasi.index') }}">
                                    <i class="ni ni-bullet-list-67"></i>
                                    <span class="nav-link-text">Klasifikasi</span>
                                </a>
                            </li>
                        @endcan

                        @can('tarif_retribusi-show')
                            <li class="nav-item {{ Request::is('admin/tarif-retribusi*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('tarifretribusi.index') }}">
                                    <i class="ni ni-money-coins"></i>
                                    <span class="nav-link-text">Tarif Retribusi</span>
                                </a>
                            </li>
                        @endcan

                        @can('pemakai-show')
                            <li class="nav-item {{ Request::is('admin/pemakai*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('pemakai.index') }}">
                                    <i class="ni ni-single-02"></i>
                                    <span class="nav-link-text">Wajib Retribusi</span>
                                </a>
                            </li>
                        @endcan

                        @can('object_retribusi-show')
                            <li class="nav-item {{ Request::is('admin/object-retribusi*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('objectretribusi.index') }}">
                                    <i class="ni ni-building"></i>
                                    <span class="nav-link-text">Objek Retribusi</span>
                                </a>
                            </li>
                        @endcan

                        <li class="nav-item nav-with-child">
                            <a class="nav-link">
                                <i class="ni ni-book-bookmark"></i> Penatausahaan
                                <i class="ml-auto fa fa-angle-down"></i>
                            </a>

                            <ul class="nav-item-child">

                                @can('skrd-show')
                                    <li class="nav-item {{ Request::is('admin/skrd*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('skrd.index') }}">
                                            Penetapan SKRD
                                        </a>
                                    </li>
                                @endcan

                                @can('tbp-show')
                                    <li class="nav-item {{ Request::is('admin/tbp*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('tbp.index') }}">
                                            Pembayaran TBP
                                        </a>
                                    </li>
                                @endcan

                                @can('monitoring_piutang-show')
                                    <li class="nav-item {{ Request::is('admin/monitoring-piutang*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('monitoringpiutang.index') }}">
                                            Monitoring Piutang
                                        </a>
                                    </li>
                                @endcan

                                @can('salin_skrd-show')
                                    <li class="nav-item {{ Request::is('admin/salin-skrd*') ? 'active' : null }}">
                                        <a class="nav-link" href="{{ route('salinskrd.index') }}">
                                            Salin SKRD
                                        </a>
                                    </li>
                                @endcan
                            </ul>
                        </li>
                        <li class="nav-item nav-with-child">
                            <a class="nav-link">
                            <i class="ml-auto fa fa-table"></i>Jasa Lainnya <i class="ml-auto fa fa-angle-down"></i>
                            
                               
                            </a>

                            <ul class="nav-item-child">
                        @can('lahan_pertanian-show')
                            <li class="nav-item {{ Request::is('admin/pertanian*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('pertanian.index') }}">
                                Properti
                                </a>
                            </li>
                        @endcan

                        {{-- @can('list_opd-show') --}}
                            <li class="nav-item {{ Request::is('admin/jasa_umum') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('jasa_umum.index') }}">
                                 Jasa Umum
                                </a>
                            </li>
                        {{-- @endcan --}}
                        </ul>
                        </li>
                        @can('laporan')
                            <li class="nav-item {{ Request::is('admin/report*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('report.index') }}">
                                    <i class="fas fa-file"></i>
                                    <span class="nav-link-text">Laporan</span>
                                </a>
                            </li>
                        @endcan

                        @if (auth()->user()->hasRole('admin'))
                            <li class="nav-item {{ Request::is('admin/hak-akses*') ? 'active' : null }}">
                                <a class="nav-link" href="{{ route('role.index') }}">
                                    <i class="fas fa-users"></i>
                                    <span class="nav-link-text">Hak Akses</span>
                                </a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <!-- Topnav -->
        <nav class="navbar navbar-top navbar-expand navbar-dark bg-primary border-bottom">
            <div class="container-fluid">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Navbar links -->
                    <ul class="navbar-nav align-items-center ml-auto ml-lg-0">
                        <li class="nav-item">
                            <!-- Sidenav toggler -->
                            <div class="pr-3 sidenav-toggler sidenav-toggler-dark" id="burger-btn"
                                data-action="sidenav-pin" data-target="#sidenav-main">
                                <div class="sidenav-toggler-inner">
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                    <i class="sidenav-toggler-line"></i>
                                </div>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav align-items-center ml-lg-auto">
                        <li class="nav-item dropdown">
                            <a class="nav-link pr-0" href="#" role="button" data-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <div class="media align-items-center">
                                    <span class="avatar avatar-sm rounded-circle">
                                        <img alt="Image placeholder"
                                            src="{{ asset('dashboard/img/icons/user.jpg') }}">
                                    </span>
                                    <div class="media-body  ml-2  d-none d-lg-block">
                                        <span class="mb-0 text-sm  font-weight-bold">{{ auth()->user()->name }}</span>
                                    </div>
                                </div>
                            </a>
                            <div class="dropdown-menu  dropdown-menu-right ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome!</h6>
                                </div>
                                <!--a href="#!" class="dropdown-item">
                  <i class="ni ni-single-02"></i>
                  <span>My profile</span>
                </a-->
                                @if (auth()->user()->hasRole('admin'))
                                    <a href="{{ route('users.index') }}" class="dropdown-item">
                                        <i class="ni ni-settings-gear-65"></i>
                                        <span>Settings</span>
                                    </a>
                                @endif

                                <!--a href="#!" class="dropdown-item">
                  <i class="ni ni-calendar-grid-58"></i>
                  <span>Activity</span>
                </a>
                <a href="#!" class="dropdown-item">
                  <i class="ni ni-support-16"></i>
                  <span>Support</span>
                </a-->
                                <div class="dropdown-divider"></div>
                                <a href="{{ route('logout') }}" class="dropdown-item"
                                    onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    <i class="ni ni-user-run"></i>
                                    <span>Logout</span>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        style="display: none;">
                                        @csrf
                                    </form>
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-primary pb-6">
            <div class="container-fluid">
                <div class="header-body">
                    <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                            <h6 class="h2 text-white d-inline-block mb-0">@yield('title')</h6>
                        </div>
                    </div>

                    <!-- Card stats -->
                    @yield('cards')

                </div>
            </div>
        </div>

        <!-- Page content -->
        <div class="container-fluid mt--6">
            @yield('content')

            <!-- Footer -->
            <footer class="footer pt-0">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="copyright text-center  text-lg-left  text-muted">
                            &copy; {{ date('Y') }} <a href=""
                                class="font-weight-bold ml-1" target="_blank">IT Support</a>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('dashboard/vendor/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <script src="{{ asset('js/sidebar-toggle.js') }}"></script>
    <!-- Optional JS -->
    <script src="{{ asset('dashboard/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- Argon JS -->
    <script src="{{ asset('dashboard/js/argon.js?v=1.2.0') }}"></script>
    @yield('js')
    @yield('scripts')
</body>

</html>
