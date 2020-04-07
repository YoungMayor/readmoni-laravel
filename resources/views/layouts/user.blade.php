<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <title>@yield("title")</title>
    
    @BS_CSS()
    @FAW_ALL()

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akronim">


    @css(general, 1)
    @css(animate.min, 1)
    @yield('page-css')
</head>

<body id="page-top">
    <div id="wrapper">
        <nav class="navbar navbar-light navbar-expand bg-white shadow topbar static-top" id="topBar">
            <div class="container-fluid">
                <button class="btn btn-link bg-light shadow d-md-none rounded-circle mr-3" id="sidebarToggleTop" type="button">
                    <i class="fas fa-bars"></i>
                </button>

                {{-- Search Form 
                    For Users and News. 
                    Temporarily disabled --}}
                {{-- <form class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                    <div class="input-group">
                        <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                        <div class="input-group-append">
                            <button class="btn btn-primary py-0" type="button">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form> --}}
                <ul class="nav navbar-nav align-items-center flex-nowrap ml-auto">
                    {{-- <li class="nav-item dropdown d-sm-none no-arrow">
                        <a class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false" href="#">
                            <i class="fas fa-search"></i>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right p-3 animated--grow-in" role="menu" aria-labelledby="searchDropdown">
                            <form class="form-inline mr-auto navbar-search w-100">
                                <div class="input-group">
                                    <input class="bg-light form-control border-0 small" type="text" placeholder="Search for ...">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary py-0" type="button">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </li> --}}

                    <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                        <div class="nav-item dropdown no-arrow">
                            <button class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false" type="button">
                                <span class="badge badge-danger badge-counter">3+</span>
                                <i class="fas fa-bell fa-fw"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in" role="menu">
                                <h6 class="dropdown-header">alerts center</h6>
                                <a class="d-flex align-items-center dropdown-item" href="#">
                                    <div class="mr-3">
                                        <div class="bg-primary icon-circle">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="small text-gray-500">December 12, 2019</span>
                                        <p>A new monthly report is ready to download!</p>
                                    </div>
                                </a>
                                <a class="d-flex align-items-center dropdown-item" href="#">
                                    <div class="mr-3">
                                        <div class="bg-success icon-circle">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="small text-gray-500">December 7, 2019</span>
                                        <p>$290.29 has been deposited into your account!</p>
                                    </div>
                                </a>
                                <a class="d-flex align-items-center dropdown-item" href="#">
                                    <div class="mr-3">
                                        <div class="bg-warning icon-circle">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <span class="small text-gray-500">December 2, 2019</span>
                                        <p>Spending Alert: We've noticed unusually high spending for your account.</p>
                                    </div>
                                </a>
                                <a class="text-center dropdown-item small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </div>
                    </li>

                    <div class="d-none d-sm-block topbar-divider"></div>
                    
                    <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                        <div class="nav-item dropdown no-arrow">
                            <button class="btn dropdown-toggle p-0" data-toggle="dropdown" aria-expanded="false" type="button" style="width: 50px;">
                                <img class="img-fluid" src="@imgURL(readmoni_icon.png)">
                            </button>

                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-right animated--grow-in" role="menu">
                                <a class="dropdown-item" role="presentation" href="{{ route('user.about.page') }}">
                                    <i class="fas fa-info fa-sm fa-fw mr-2 text-gray-400"></i>
                                    About ReadMONI
                                </a>

                                <a class="dropdown-item" role="presentation" href="{{ route('user.privacy.page') }}">
                                    <i class="fas fa-scroll fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Privacy Policy
                                </a>

                                <a class="dropdown-item" role="presentation" href="{{ route('user.faq.page') }}">
                                    <i class="fas fa-question fa-sm fa-fw mr-2 text-gray-400"></i>
                                    FAQ's
                                </a>

                                <div class="mt-3 mb-3 border"></div>

                                <a class="dropdown-item" role="presentation" href="{{ route('user.testimony.page') }}">
                                    Testimonies
                                </a>

                                <a class="dropdown-item" role="presentation" href="{{ route('user.feedback.page') }}">
                                    Send Feedback
                                </a>

                                <a class="dropdown-item" role="presentation" href="{{ route('user.news.page') }}">
                                    News
                                </a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </nav>

        <nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0" id="sidenav">
            <div class="container-fluid d-flex flex-column p-0" id="sidenav-menu">
                <ul class="nav navbar-nav text-light" id="accordionSidebar">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('user.profile.page') }}">
                            <div>
                                <img class="rounded-circle img-fluid" src="@imgURL(default_avatar.jpeg)">
                            </div>
                            <span>My Account</span>
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('user.dashboard.page') }}">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a class="nav-link" href="{{ route('user.news.page') }}">
                            <i class="far fa-newspaper"></i>
                            <span>Read News</span>
                        </a>
                    </li>

                    {{-- Messages Link, temporarily disabled --}}
                    {{-- <li class="nav-item" role="presentation">
                        <a class="nav-link active" href="{{ route('') }}">
                            <i class="fas fa-envelope"></i>
                            <span>Messages</span>
                        </a>
                    </li> --}}

                    <li class="nav-item" role="presentation">
                        <a class="nav-link border rounded border-success" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt"></i>
                            <span>Sign In</span>
                        </a>
                    </li>
                    
                    <li class="nav-item" role="presentation">
                        <a class="nav-link border rounded border-danger" href="{{ route('user.logout.page') }}">
                            <i class="fas fa-sign-out-alt"></i>
                            <span>Sign Out</span>
                        </a>
                    </li>

                </ul>

                <div class="text-center d-none d-md-inline">
                    <button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button>
                </div>
            </div>
        </nav>

        <div class="d-flex flex-column" id="content-wrapper">
            <div id="content">
                <div class="container-fluid @yield('page-body-class')" id="pageBody">
                    @yield('page-body')
                </div>
            </div>

            <footer class="bg-white sticky-footer">
                <div class="container my-auto">
                    <div class="text-center my-auto copyright">
                        <span>Copyright © ReadMONI 2020</span>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    
    <a class="border rounded scroll-to-top" id="scroll-to-top" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    @JQUERY()
    @BS_JS()
    @js(chart.min)
    @js(bs-charts)
    @js(theme)
    @js(jquery.easing)

    @yield("page-js")


    {{-- <script src="assets/js/edit-profile.js?h=9f91cf91684efcc5e6d9b34bd2b0a8d7"></script>
    <script src="assets/js/imgPreviewer.js?h=b2a1aead4b26b9e0850c87f9c1a9abfa"></script> --}}
</body>
</html>
