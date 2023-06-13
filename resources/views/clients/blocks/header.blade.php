<header class="ftco-section">
    <div class="container-fluid px-lg-5 pb-3">
        <div class="row">
            <div class="col-md-8 order-md-first">
                <div class="row">
                    <div class="col-md-6 order-2 order-md-1 mb-2 mb-md-0">
                        <form action="#" class="searchform order-lg-first">
                            <div class="form-group d-flex">
                                <input type="text" class="form-control pl-3" placeholder="Search">
                                <button type="submit" placeholder="" class="form-control search">
                                    <span class="fa-solid fa-magnifying-glass"></span>
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-6 my-3 my-md-0 order-1 order-md-2">
                        <div class="text-center">
                            <a class="navbar-brand" href="/">
                                <img src="{{asset('img/logo.png')}}" alt="Watch World" width="50">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 d-flex justify-content-center justify-content-lg-end align-items-center">
                <div class="social-media">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-outline-danger mx-2" role="button">
                            Sign up
                        </a>
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary me-2" role="button">
                            Sign in
                        </a>
                    @else
                        <nav class="header-nav ms-auto">
                            <ul class="d-flex align-items-center">
                                <li class="nav-item dropdown">
                                    <a class="nav-link nav-icon" href="#">
                                        <i class="bi bi-cart4"></i>
                                        <span class="badge bg-success badge-number"></span>
                                    </a>
                                </li>

                                <li class="nav-item dropdown">
                                    <a class="nav-link nav-icon" href="#" data-bs-toggle="dropdown">
                                        <i class="bi bi-bell"></i>
                                        <span class="badge bg-primary badge-number">4</span>
                                    </a><!-- End Notification Icon -->

                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow notifications">
                                        <li class="dropdown-header">
                                            You have 4 new notifications
                                            <a href="#">
                                                <span class="badge rounded-pill bg-primary p-2 ms-2">
                                                    View
                                                    all
                                                </span>
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li class="notification-item">
                                            <i class="bi bi-exclamation-circle text-warning"></i>
                                            <div>
                                                <h4>Lorem Ipsum</h4>
                                                <p>Quae dolorem earum veritatis oditseno</p>
                                                <p>30 min. ago</p>
                                            </div>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li class="notification-item">
                                            <i class="bi bi-x-circle text-danger"></i>
                                            <div>
                                                <h4>Atque rerum nesciunt</h4>
                                                <p>Quae dolorem earum veritatis oditseno</p>
                                                <p>1 hr. ago</p>
                                            </div>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li class="notification-item">
                                            <i class="bi bi-check-circle text-success"></i>
                                            <div>
                                                <h4>Sit rerum fuga</h4>
                                                <p>Quae dolorem earum veritatis oditseno</p>
                                                <p>2 hrs. ago</p>
                                            </div>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li class="notification-item">
                                            <i class="bi bi-info-circle text-primary"></i>
                                            <div>
                                                <h4>Dicta reprehenderit</h4>
                                                <p>Quae dolorem earum veritatis oditseno</p>
                                                <p>4 hrs. ago</p>
                                            </div>
                                        </li>

                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li class="dropdown-footer">
                                            <a href="#" class="text-decoration-none">Show all notifications</a>
                                        </li>

                                    </ul><!-- End Notification Dropdown Items -->

                                </li><!-- End Notification Nav -->

                                <li class="nav-item dropdown pe-3">

                                    <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#"
                                        data-bs-toggle="dropdown">
                                        <img src="{{ asset('img/default-avt.jpg') }}" alt="Profile" class="rounded-circle">
                                        <span
                                            class="d-none d-md-block dropdown-toggle ps-2">{{ Auth::user()->firstname }}</span>
                                    </a><!-- End Profile Iamge Icon -->

                                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
                                        <li class="dropdown-header">
                                            <h6>{{ Auth::user()->firstname }} {{ Auth::user()->lastname }}</h6>
                                            <span></span>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li>
                                            <a class="dropdown-item d-flex align-items-center"
                                                href="{{ route('profile') }}">
                                                <i class="bi bi-person"></i>
                                                <span>My Profile</span>
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bi bi-list-ul"></i>
                                                <span>Order infomation</span>
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li>
                                            <a class="dropdown-item d-flex align-items-center" href="#">
                                                <i class="bi bi-clock-history"></i>
                                                <span>Purchase History</span>
                                            </a>
                                        </li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>

                                        <li>
                                            <button class="dropdown-item d-flex align-items-center" id="sign-out">
                                                <i class="bi bi-box-arrow-right"></i> {{ __('Sign Out') }}
                                            </button>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="d-none">
                                                @csrf
                                            </form>
                                        </li>
                                    </ul><!-- End Profile Dropdown Items -->
                                </li><!-- End Profile Nav -->
                            </ul>
                        </nav>
                    @endguest
                </div>
            </div>
        </div>
    </div>
    <nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="fa fa-bars"></span> Menu
            </button>
            <div class="collapse navbar-collapse" id="ftco-nav">
                <ul class="navbar-nav m-auto">
                    <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                    <li class="nav-item"><a href="{{ route('shop') }}" class="nav-link">Shop</a></li>
                    <li class="nav-item"><a href="{{ route('about') }}" class="nav-link">About</a></li>
                    <li class="nav-item"><a href="{{ route('contact') }}" class="nav-link">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- END nav -->
</header>
