<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <title>@yield('title') - {{ config('app.name') }}</title>
    <!-- Favicon -->
    <link rel="icon" href="{{ asset('dashboard/img/brand/favicon.png') }}" type="image/png">
    <link rel="icon" href="{{ asset('img/logo.png') }}" type="image/png">
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700">
    <!-- Icons -->
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/nucleo/css/nucleo.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('dashboard/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}"
        type="text/css">
    <!-- Page plugins -->
    <!-- Argon CSS -->
    <link rel="stylesheet" href="{{ asset('dashboard/css/argon.css?v=1.2.0') }}" type="text/css">
    <!-- morris js graphick chart -->
    <!--script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script-->
    <script src="{{ asset('dashboard/vendor/jquery/dist/jquery.min.js') }}"></script>

    {{--
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script> --}}
    {{--
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> --}}
    {{--
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> --}}
    {{--
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> --}}
    {{--
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> --}}

    {{--
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css"> --}}
    {{--
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script> --}}
    {{--
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script> --}}
    {{--
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script> --}}

    <link rel="stylesheet" href="{{ asset('asset/0.5.1/morris.css') }}">
    <style>
        .bg-red {
            background-color: #ff0000 !important;
        }
    </style>
    <script src="{{ asset('asset/raphael-min.js') }}"></script>
    <script src="{{ asset('asset/0.5.1/morris.min.js') }}"></script>
    <script src="{{ asset('asset/raphael-min.js') }}"></script>

    @yield('css')
</head>

<body>
    <!-- Main content -->
    <div class="main-content" id="panel">
        <nav class="navbar navbar-expand-lg navbar-light">
        </nav>
        <!-- Header -->
        <!-- Header -->
        <div class="header bg-purple pb-6 mb-20" style="height:320px;font-size:3.3em;color:#ffffff;">
            <div class="container-fluid text-center align-middle">
                <div class="row" style="padding:0px; height:0px%;">
                    <div class="col-12">
                        Selamat Datang di Aplikasi E-Retribusi<br>
                        Provinsi Maluku
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center mt-5">
            <button class="btn btn-secondary"><a class="nav-link"  href="{{ route('login') }}">Go To Login<span class="sr-only">(current)</span></a></button>
            <button class="btn btn-primary"><a class="nav-link"  href="{{ route('register') }}">Go To Register<span class="sr-only">(current)</span></a></button>
        </div>

        <!-- Page content -->
        <div class="container-fluid" style="margin-top:50px;">
            @yield('content')

            <!-- Footer -->
            <footer class="footer pt-0">
                <div class="row align-items-center justify-content-lg-between">
                    <div class="col-lg-6">
                        <div class="copyright text-center  text-lg-left  text-muted" style="color:#ffffff !important;">
                            &copy; {{ date('Y') }} <a href="https://www.asimnetwork.id" style="color:#ffffff !important;" class="font-weight-bold ml-1"
                                target="_blank">IT Support</a>
                        </div>
                    </div>
                    <div class="col-lg-6"></div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Argon Scripts -->
    <!-- Core -->
    <script src="{{ asset('dashboard/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/js-cookie/js.cookie.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery.scrollbar/jquery.scrollbar.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js') }}"></script>
    <!-- Optional JS -->

    <script src="{{ asset('dashboard/vendor/chart.js/dist/Chart.min.js') }}"></script>
    <script src="{{ asset('dashboard/vendor/chart.js/dist/Chart.extension.js') }}"></script>
    <!-- Argon JS -->
    <script src="{{ asset('dashboard/js/argon.js?v=1.2.0') }}"></script>
    @yield('js')
</body>

</html>
{{--
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script> --}}