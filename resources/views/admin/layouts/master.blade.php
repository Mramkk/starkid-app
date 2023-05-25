<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    @yield('title')
    <meta content="" name="description">
    <meta content="" name="keywords">
    <!-- Favicons -->
    <link href="{{ url('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ url('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
        rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="{{ url('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ url('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <!-- Template Main CSS File -->
    <link href="{{ url('assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ url('assets/css/switch.css') }}" rel="stylesheet">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"
        integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    @yield('style')


</head>

<body>

    <!-- ======= Header ======= -->
    <header id="header" class="header fixed-top d-flex align-items-center">
        <div class="d-flex align-items-center justify-content-between">
            <i class="bi bi-list toggle-sidebar-btn"></i>
            <a href="{{ route('admin.dashboard') }}" class="logo d-flex align-items-center ms-3">
                <img src="{{ url('assets/img/logo.png') }}" alt="">
                <span class="d-none d-lg-block">Admin Panel</span>
            </a>

        </div><!-- End Logo -->
        @yield('page-title')
        @Auth('admin')
            <nav class="header-nav ms-auto">
                <ul class="d-flex align-items-center">
                    <li class="nav-item dropdown pe-3">
                        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                            data-bs-toggle="dropdown">
                            {{-- <img src="{{ url('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle"> --}}
                            <div class="rounded-circle">
                                <i class="bi bi-person fs-4"></i>
                            </div>
                        </a><!-- End Profile Iamge Icon -->

                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                            <li class="dropdown-header">
                                <h6>{{ Auth('admin')->user()->name }}</h6>

                            </li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>



                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}">
                                    @csrf
                                    <a class="dropdown-item d-flex align-items-center" href="{{ route('admin.logout') }}"
                                        onclick="event.preventDefault();
                                    this.closest('form').submit();">
                                        <i class="bi bi-box-arrow-right"></i>
                                        <span>Sign Out</span>
                                    </a>
                                </form>
                            </li>

                        </ul><!-- End Profile Dropdown Items -->
                    </li><!-- End Profile Nav -->

                </ul>
            </nav><!-- End Icons Navigation -->
        @else
            <script>
                location.assign('/admin/login')
            </script>
            @endif

        </header><!-- End Header -->

        <!-- ======= Sidebar ======= -->
        <aside id="sidebar" class="sidebar">

            <ul class="sidebar-nav" id="sidebar-nav">

                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.dashboard') }}">
                        <i class="bi bi-house text-danger"></i>
                        <span>Home</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.student') }}">
                        <i class="bi bi-people text-danger"></i>
                        <span>Students</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/admin/exam') }}">
                        <i class="bi bi-newspaper text-danger"></i>
                        <span>Exam</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.result.index') }}">
                        <i class="bi bi-newspaper text-danger"></i>
                        <span>Result</span>
                    </a>
                </li>


                <li class="nav-item">
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <a class="nav-link" href="{{ route('admin.logout') }}"
                            onclick="event.preventDefault();
                        this.closest('form').submit();">
                            <i class="bi bi-power text-danger"></i>
                            <span>Logout</span>
                        </a>
                    </form>
                </li>
                <!-- End Dashboard Nav -->


            </ul>

        </aside><!-- End Sidebar-->
        <main id="main" class="main">
            <section class="section dashboard">
                @yield('content')
            </section>
        </main><!-- End #main -->

        <!-- ======= Footer ======= -->

        <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
                class="bi bi-arrow-up-short"></i></a>
        <!-- Vendor JS Files -->
        <script src="{{ url('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <!-- Template Main JS File -->
        <script src="{{ url('assets/js/main.js') }}"></script>
        <script src="{{ url('assets/js/switch.js') }}"></script>
        @yield('scripts')
    </body>

    </html>
