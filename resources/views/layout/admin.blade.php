<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1" />
    <title>Restoran Sunda Nikmat</title>
    <!-- Favicon icon -->
    <link href="{{asset('assets/images/logo.png') }}" rel="shortcut icon">
    <link href="{{asset('assets/css/style.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Datatable -->
    <link href="{{asset('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">


    <!-- select 2-->
    <link rel="stylesheet" href="{{asset('assets/vendor/select2/css/select2.min.css') }}">

    <link href="{{asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet" />
    <link href="{{asset('assets/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet" />

</head>

<body>

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/admin/dashboard" class="brand-logo">
                <img src="{{asset('assets/images/logo.png')}}" alt="" width='80' />&nbsp;
                <span class="nav-text">Restoran SN</span>
            </a>
            <div class="nav-control">
                <div class="hamburger" style=''>
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <i class="mdi mdi-account"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a href="/admin/profile" class="dropdown-item">
                                        <i class="icon-user"></i>
                                        <span class="ml-2">Profile </span>
                                    </a>
                                    <a href="/logout" class="dropdown-item">
                                        <i class="icon-key"></i>
                                        <span class="ml-2">Logout </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="quixnav">
            <div class="quixnav-scroll">
                <ul class="metismenu">
                    <li class="nav-label first text-white">Main Menu</li>
                    <li>
                        <a href="/admin/dashboard" aria-expanded="false">
                            <i class="icon icon-app-store"></i>
                            <span class="nav-text">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="/admin/users" aria-expanded="false">
                            <i class="fa fa-users"></i>
                            <span class="nav-text">Users</span></a>
                    </li>
                    <li>
                        <a href="/admin/produk" aria-expanded="false">
                            <i class="fa-regular fa-boxes-stacked"></i>
                            <span class="nav-text">Produk</span></a>
                    </li>
                    <li>
                        <a href="/admin/produk_masuk" aria-expanded="false">
                            <i class="fa-regular fa-box-archive"></i>
                            <span class="nav-text">Produk Masuk</span></a>
                    </li>
                    <li>
                        <a href="/admin/transaksi" aria-expanded="false">
                            <i class="fa fa-money"></i>
                            <span class="nav-text">Daftar Transaksi</span></a>
                    </li>
                    <li>
                        <a href="/admin/laporan" aria-expanded="false">
                            <i class="bi bi-file-pdf-fill"></i>
                            <span class="nav-text">Laporan</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->

        <!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            @yield('content')
        </div>
        <!--**********************************
            Content body end
        ***********************************-->

        <!--**********************************
           Support ticket button start
        ***********************************-->

        <!--**********************************
           Support ticket button end
        ***********************************-->
    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->

    <!-- Required vendors -->
    <script src="{{asset('assets/vendor/global/global.min.js') }}"></script>
    <script src="{{asset('assets/js/quixnav-init.js') }}"></script>
    <script src="{{asset('assets/js/custom.min.js') }}"></script>

    <!-- Datatable -->
    <script src="{{asset('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('assets/js/plugins-init/datatables.init.js') }}"></script>
    <!-- select 2 -->
    <script src="{{asset('assets/vendor/select2/js/select2.full.min.js') }}"></script>
    <script src="{{asset('assets/js/plugins-init/select2-init.js') }}"></script>

</body>

</html>