<!--
=========================================================
* Paper Dashboard 2 - v2.0.1
=========================================================

* Product Page: https://www.creative-tim.com/product/paper-dashboard-2
* Copyright 2020 Creative Tim (https://www.creative-tim.com)

Coded by www.creative-tim.com

 =========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="http://127.0.0.1:8000/assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="http://127.0.0.1:8000/assets/img/favicon.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>
        SI Seleksi Atlet
    </title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <!-- CSS Files -->
    <link href="http://127.0.0.1:8000/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="http://127.0.0.1:8000/assets/css/paper-dashboard.css?v=2.0.1" rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="http://127.0.0.1:8000/assets/demo/demo.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="/assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="http://127.0.0.1:8000/assets/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/assets/fontawesome/css/fontawesome.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/assets/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="http://127.0.0.1:8000/assets/fontawesome/css/all.css">
    {{-- bootstrap --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="">
    <div class="wrapper ">
        <div class="sidebar" data-color="white" data-active-color="danger">
            <div class="logo">
                <a href="https://www.creative-tim.com" class="simple-text logo-mini">
                    <div class="logo-image-small">
                        <img src="http://127.0.0.1:8000/assets/img/logo-small.png">
                    </div>
                    <!-- <p>CT</p> -->
                </a>
                <a href="https://www.creative-tim.com" class="simple-text logo-normal">
                    SELEKSI-ATLET
                    <!-- <div class="logo-image-big">
            <img src="../assets/img/logo-big.png">
          </div> -->
                </a>
            </div>
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <li class="{{ request()->routeIs('dashboard') ? 'active' : '' }} ">
                        <a href="{{ route('dashboard') }}">
                            <i class="nc-icon nc-bank"></i>
                            <p>Dashboard</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('user.index') ? 'active' : '' }} ">
                        <a href="{{ route('user.index') }}">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Data User</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('mahasiswa.index') ? 'active' : '' }} ">
                        <a href="{{ route('mahasiswa.index') }}">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Data Mahasiswa</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('pelatih.index') ? 'active' : '' }} ">
                        <a href="{{ route('pelatih.index') }}">
                            <i class="nc-icon nc-single-02"></i>
                            <p>Data Pelatih</p>
                        </a>
                    </li>
                    {{-- <li class="{{ request()->routeIs('pendaftaran.index') ? 'active' : '' }} ">
                    <a href="{{ route('pendaftaran.index') }}">
                        <i class="nc-icon nc-single-02"></i>
                        <p>Data Pendaftaran</p>
                    </a>
                    </li> --}}
                    <li class="{{ request()->routeIs('fasilitas.index') ? 'active' : '' }} ">
                        <a href="{{ route('fasilitas.index') }}">
                            <i class="nc-icon nc-tile-56"></i>
                            <p>Data Fasilitas Olahraga</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('kriteria.index') ? 'active' : '' }} ">
                        <a href="{{ route('kriteria.index') }}">
                            <i class="nc-icon nc-caps-small"></i>
                            <p>Data Kriteria</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('subKriteria.index') ? 'active' : '' }} ">
                        <a href="{{ route('subKriteria.index') }}">
                            <i class="nc-icon nc-spaceship"></i>
                            <p>Data Sub Kriteria</p>
                        </a>
                    </li>
                    <li class="{{ request()->routeIs('penilaian.index') ? 'active' : '' }} ">
                        <a href="{{ route('penilaian.index') }}">
                            <i class="nc-icon nc-spaceship"></i>
                            <p>Data Penilaian Atlet</p>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-absolute fixed-top navbar-transparent">
                <div class="container-fluid">
                    <div class="navbar-wrapper">
                        <div class="navbar-toggle">
                            <button type="button" class="navbar-toggler">
                                <span class="navbar-toggler-bar bar1"></span>
                                <span class="navbar-toggler-bar bar2"></span>
                                <span class="navbar-toggler-bar bar3"></span>
                            </button>
                        </div>
                        <a class="navbar-brand" href="javascript:;">Selamat Datang, {{ session('user.username') }}</a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation"
                        aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                        <span class="navbar-toggler-bar navbar-kebab"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navigation">
                        <form>
                            <div class="input-group no-border">
                                <input type="text" value="" class="form-control" placeholder="Search...">
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <i class="nc-icon nc-zoom-split"></i>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link btn-magnify" href="javascript:;">
                                    <i class="nc-icon nc-layout-11"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Stats</span>
                                    </p>
                                </a>
                            </li>
                            <li class="nav-item btn-rotate dropdown">
                                <a class="nav-link dropdown-toggle" href="http://example.com"
                                    id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                                    aria-expanded="false">
                                    <i class="nc-icon nc-bell-55"></i>
                                    <p>
                                        <span class="d-lg-none d-md-block">Some Actions</span>
                                    </p>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="btn btn-danger" href="{{ route('auth.logout') }}">
                                    <p class="text-white">
                                        Logout
                                    </p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- End Navbar -->
            <div class="content">
                @include('sweetalert::alert')
                @yield('content')
            </div>
            <footer class="footer footer-black footer-white ">
                <div class="container-fluid">
                    <div class="row">
                        <nav class="footer-nav">
                            <ul>
                                <li><a href="https://www.creative-tim.com" target="_blank">SELEKSI-ATLET></li>
                                <li><a href="https://www.creative-tim.com/blog" target="_blank">Blog</a></li>
                                <li><a href="https://www.creative-tim.com/license" target="_blank">Licenses</a></li>
                            </ul>
                        </nav>
                        <div class="credits ml-auto">
                            <span class="copyright">
                                ©
                                <script>
                                document.write(new Date().getFullYear())
                                </script>, made with <i class="fa fa-heart heart"></i> by SELEKSI-ATLET
                            </span>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <script src="http://127.0.0.1:8000/assets/fontawesome/js/fontawesome.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/fontawesome/js/fontawesome.js"></script>
    <script src="http://127.0.0.1:8000/assets/fontawesome/js/all.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/fontawesome/js/all.js"></script>
    <!--   Core JS Files   -->
    <script src="http://127.0.0.1:8000/assets/js/core/jquery.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/core/popper.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/core/bootstrap.min.js"></script>
    <script src="http://127.0.0.1:8000/assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
    <!--  Google Maps Plugin    -->
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
    <!-- Chart JS -->
    <script src="http://127.0.0.1:8000/assets/js/plugins/chartjs.min.js"></script>
    <!--  Notifications Plugin    -->
    <script src="http://127.0.0.1:8000/assets/js/plugins/bootstrap-notify.js"></script>
    <!-- Control Center for Now Ui Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="http://127.0.0.1:8000/assets/js/paper-dashboard.min.js?v=2.0.1" type="text/javascript"></script>
    <!-- Paper Dashboard DEMO methods, don't include it in your project! -->
    <script src="http://127.0.0.1:8000/assets/demo/demo.js"></script>
    {{-- bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
    <script>
    $(document).ready(function() {
        // Javascript method's body can be found in assets/assets-for-demo/js/demo.js
        demo.initChartsPages();
    });
    </script>
</body>

</html>