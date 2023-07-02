<!DOCTYPE html>
<html>

<head>
    <!-- Basic Page Info -->
    <meta charset="utf-8">
    <title>Restoran Sudan Nikmat</title>

    <!-- Site favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="vendors/images/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="vendors/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="vendors/images/favicon-16x16.png">

    <!-- Mobile Specific Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    <!-- CSS -->
    <link href="{{asset('assets/styles/core.css') }}" rel="stylesheet">
    <link href="{{asset('assets/styles/icon-font.min.css') }}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datatables/css/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{asset('assets/plugins/datatables/css/responsive.bootstrap4.min.css') }}" rel="stylesheet">
    <link href="{{asset('assets/styles/style.css') }}" rel="stylesheet">
</head>

<body>

    <div class="header">
        <div class="header-left">
            <div class="menu-icon dw dw-menu"></div>
        </div>
        <div class="header-right">
            <div class="user-info-dropdown mt-2">
                <div class="dropdown">
                    <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown">
                        <span class="user-name">
                            <!-- {{ session('nama') }} -->
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list">
                        <a class="dropdown-item" href="/admin/profile"><i class="dw dw-user1"></i> Profile</a>
                        <a class="dropdown-item" href="/logout"><i class="dw dw-logout"></i> Log Out</a>
                    </div>
                </div>
            </div>
            <div class="github-link">
                <a href="https://github.com/dropways/deskapp" target="_blank"><img src="vendors/images/github.svg"
                        alt=""></a>
            </div>
        </div>
    </div>

    <div class="left-side-bar">
        <div class="brand-logo">
            <a href="/admin/dashboard" style="font-size:14px;">
                Restoran Sunda Nikmat
                <!-- <img src="vendors/images/deskapp-logo.svg" alt="" class="dark-logo">
                <img src="vendors/images/deskapp-logo-white.svg" alt="" class="light-logo"> -->
            </a>
            <div class="close-sidebar" data-toggle="left-sidebar-close">
                <i class="ion-close-round"></i>
            </div>
        </div>
        <div class="menu-block customscroll">
            <div class="sidebar-menu">
                <ul id="accordion-menu">
                    <li>
                        <a href="/admin/dashboard" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-home"></span><span class="mtext">Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/produk" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-box"></span><span class="mtext">Produk</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/produk_masuk" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-box"></span><span class="mtext">Produk Masuk</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/produk_keluar" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-box"></span><span class="mtext">Produk Keluar</span>
                        </a>
                    </li>
                    <li>
                        <a href="/admin/transaksi" class="dropdown-toggle no-arrow">
                            <span class="micon dw dw-analytics-21"></span><span class="mtext">Daftar Transaksi</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="mobile-menu-overlay"></div>


    @yield('content')


    <!-- js -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{asset('assets/scripts/core.js') }}"></script>
    <script src="{{asset('assets/scripts/script.min.js') }}"></script>
    <script src="{{asset('assets/scripts/process.js') }}"></script>
    <script src="{{asset('assets/scripts/layout-settings.js') }}"></script>
    <script src="{{asset('assets/plugins/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{asset('assets/plugins/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{asset('assets/plugins/datatables/js/dataTables.bootstrap4.min.js') }}"></script>
    <script src="{{asset('assets/plugins/datatables/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{asset('assets/plugins/datatables/js/responsive.bootstrap4.min.js') }}"></script>
    <script src="{{asset('assets/scripts/dashboard.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/4.2.0/chart.min.js"></script>

    <!-- buttons for Export datatable -->
    <script src="{{asset('assets/plugins/datatables/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{asset('assets/plugins/datatables/js/buttons.bootstrap4.min.js') }}"></script>
    <script src="{{asset('assets/plugins/datatables/js/buttons.html5.min.js') }}"></script>
    <script src="{{asset('assets/plugins/datatables/js/buttons.print.min.js') }}"></script>
    <script src="{{asset('assets/plugins/datatables/js/buttons.flash.min.js') }}"></script>
    <script src="{{asset('assets/plugins/datatables/js/pdfmake.min.js') }}"></script>
    <script src="{{asset('assets/plugins/datatables/js/vfs_fonts.js') }}"></script>
    <script src="src/"></script>
    <!-- Datatable Setting js -->
    <script src="{{asset('assets/scripts/datatable-setting.js') }}"></script>
</body>

</html>