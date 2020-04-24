<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    
    <title>@yield("title")</title>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    @BS_CSS()
    @FAW_ALL()

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Akronim">


    @css(general, 3)
    @css(animate.min, 1)
    @yield('page-css')

    
    @Vue_JS()

    <script data-ad-client="ca-pub-9777382863618110" async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
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

                    @auth
                        <li class="nav-item dropdown no-arrow mx-1" role="presentation">
                            {!! RM::notificationIconMap() !!}

                            <div class="nav-item dropdown no-arrow">
                                <button id="load-alert-center" class="btn btn-primary dropdown-toggle" data-store="#alert-center" data-url="{{ route('user.alert_center.process') }}" data-page="0" data-toggle="dropdown" aria-expanded="false" type="button">
                                    {!! RM::unreadNotifications() !!}
                                    <i class="fas fa-bell fa-fw"></i>
                                </button>

                                <div class="dropdown-menu dropdown-menu-right dropdown-list dropdown-menu-right animated--grow-in shadow-lg" role="menu">
                                    <h6 class="dropdown-header">
                                        alerts center
                                    </h6>

                                    <div id="alert-center" class="dropdown-item p-0"></div>

                                    <a class="text-center dropdown-item small text-gray-500" href="{{ route('user.notifications.page') }}">
                                        Show All Alerts
                                    </a>
                                </div>
                            </div>
                        </li>
                    @endauth

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
                    @auth
                        <li class="nav-item" role="presentation">
                            <a class="nav-link p-1" href="{{ route('user.profile.page') }}">
                                <div>
                                    <img class="rounded-circle img-fluid profile-avatar" src="{{ RM::avatar() }}">
                                </div>
                                <span class="d-block text-center">
                                    My Account 
                                    <br/>
                                    <b>{{ Auth::user()->user_key }}</b>
                                </span>
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link p-1" href="{{ route('user.dashboard.page') }}">
                                <i class="fas fa-tachometer-alt"></i>
                                <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="nav-item" role="presentation">
                            <a class="nav-link p-1" href="{{ route('user.news.page') }}">
                                <i class="far fa-newspaper"></i>
                                <span>Read News</span>
                            </a>
                        </li>

                        @isAdmin
                            <div class="h6 small text-center bg-gradient-dark p-1">
                                Admin Controls
                            </div>
                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link p-1" href="{{ route('admin.payouts.page') }}">
                                    <i class="fas fa-wallet"></i>
                                    <span>Payout Requests</span>
                                </a>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link p-1" href="{{ route('admin.faq.page') }}">
                                    <i class="fas fa-question"></i>
                                    <span>FAQ's</span>
                                </a>
                            </li>
                        @endisAdmin

                        @isOwner
                            <div class="h6 small text-center bg-gradient-dark p-1">
                                Owners Controls
                            </div>

                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link p-1" href="{{ route('owner.site.summary.page') }}">
                                    <i class="far fa-newspaper"></i>
                                    <span>Site Summary</span>
                                </a>
                            </li>
                            
                            <li class="nav-item" role="presentation">
                                <a class="nav-link p-1" href="{{ route('owner.admins.page') }}">
                                    <i class="fas fa-user-secret"></i>
                                    <span>Manage Admins</span>
                                </a>
                            </li>
                        @endisOwner

                        {{-- Messages Link, temporarily disabled --}}
                        {{-- <li class="nav-item" role="presentation">
                            <a class="nav-link active" href="{{ route('') }}">
                                <i class="fas fa-envelope"></i>
                                <span>Messages</span>
                            </a>
                        </li> --}}
                                                
                        <li class="nav-item" role="presentation">
                            <a class="nav-link border rounded border-danger" href="{{ route('user.logout.page') }}">
                                <i class="fas fa-sign-out-alt"></i>
                                <span>Sign Out</span>
                            </a>
                        </li>

                    @else

                        <li class="nav-item" role="presentation">
                            <a class="nav-link border rounded border-success" href="{{ route('login') }}">
                                <i class="fas fa-sign-in-alt"></i>
                                <span>Sign In</span>
                            </a>
                        </li>

                    @endauth

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
    @js(readmoni)
    @js(general)
    @js(chart.min)
    @js(bs-charts)
    @js(theme)
    @js(jquery.easing)
    @js(bs-alerts)
    @js(alert-center)
    @yield("page-js")

</body>
</html>
