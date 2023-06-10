@extends('layouts.base')

@section('title')
    Shop page
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('content')
    <main role="main" class="pb-3">
        <section class="container-fluid row my-3">
            <nav class="accordion arrows col-lg-2 col-md-3 custom-dropdown">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-md navbar-light bg-danger rounded">
                    <!-- Toggle button -->
                    <button class="navbar-toggler ms-2" type="button" data-toggle="collapse" data-target="#sidebarMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Brand -->
                    <a class="text-white" style="text-decoration: none;" href="/">
                        <h3 class="fw-bold mx-3">Watch World</h3>
                    </a>
                </nav>
                <!-- Navbar -->
                <nav id="sidebarMenu" class="collapse d-md-block bg-white">
                    <input type="radio" name="accordion" id="cb2" />
                    <section class="box">
                        <label class="box-title" for="cb2">Genre</label>
                        <label class="box-close" for="acc-close"></label>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Genre/10">Fiction</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Genre/9">Horror</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Genre/7">Non-Fiction</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Genre/15">Novel</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Genre/8">Thrilling</a>
                        </div>
                    </section>
                    <input type="radio" name="accordion" id="cb3" />
                    <section class="box">
                        <label class="box-title" for="cb3">Author</label>
                        <label class="box-close" for="acc-close"></label>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Author/9">Anne Rice</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Author/12">Charles Todd</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Author/10">Dale Carnegie</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Author/6">Freida McFadden</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Author/13">Jane Harper</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Author/4">Kristan Higgins</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Author/5">Lauren Asher</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Author/7">Lucy Score</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Author/11">Rebert Morgan</a>
                        </div>
                        <div class="box-content">
                            <a class="nav-link text-reset" href="/Home/Shop/Author/8">Stephen King</a>
                        </div>
                    </section>
                    <input type="radio" name="accordion" id="acc-close" />
                </nav>
            </nav>
            <div class="col-lg-10 col-md-9">
                <div class="text-center">
                    <div class="row">
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                                    <img src="{{ asset('img/watch/omega-speedmaster-super-racing-co-axial-master-chronometer-chronograph-44-25-mm-32930445101003-l.png') }}"
                                        class="w-100" style="width: auto; height: 25rem;" />
                                    <a href="#">
                                        <div class="mask">
                                            <div class="d-flex justify-content-start align-items-end h-100">
                                                <h5>
                                                    <span class="badge bg-primary ms-2">New</span>
                                                    <span class="badge bg-danger ms-2">-5%</span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a class="text-reset" href="#">
                                        <h5 class="card-title mb-3">The Creative Act A Way</h5>
                                    </a>
                                    <a class="text-reset" href="#">
                                        <p>Fiction</p>
                                    </a>
                                    <h6 class="mb-3">
                                        <s>$12.58</s>
                                        <strong class="ms-2 text-danger">$11.95</strong>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                                    <img src="{{ asset('img/watch/m126234-0051_collection_upright_landscape.png') }}"
                                        class="w-100" style="width: auto; height: 25rem;" />
                                    <a href="#">
                                        <div class="mask">
                                            <div class="d-flex justify-content-start align-items-end h-100">
                                                <h5>
                                                    <span class="badge bg-primary ms-2">New</span>
                                                    <span class="badge bg-danger ms-2">-5%</span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a class="text-reset" href="#">
                                        <h5 class="card-title mb-3">Things We Hide the Light</h5>
                                    </a>
                                    <a class="text-reset" href="#">
                                        <p>Fiction</p>
                                    </a>
                                    <h6 class="mb-3">
                                        <s>$30.00</s>
                                        <strong class="ms-2 text-danger">$28.50</strong>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                                    <img src="{{ asset('img/watch/dong-ho-rolex-18238-day-date-president-coc-kim-cuong-vang-khoi-18k.png') }}"
                                        class="w-100" style="width: auto; height: 25rem;" />
                                    <a href="#">
                                        <div class="mask">
                                            <div class="d-flex justify-content-start align-items-end h-100">
                                                <h5>
                                                    <span class="badge bg-primary ms-2">New</span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a class="text-reset" href="#">
                                        <h5 class="card-title mb-3">Book</h5>
                                    </a>
                                    <a class="text-reset" href="#">
                                        <p>Non-Fiction</p>
                                    </a>
                                    <h6 class="mb-3">
                                        <strong class="ms-2 text-danger">$12.00</strong>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                                    <img src="{{ asset('img/watch/omega-speedmaster-anniversary-series-co-axial-master-chronometer-chronograph-42-mm-31032425002001-l.png') }}"
                                        class="w-100" style="width: auto; height: 25rem;" />
                                    <a href="#">
                                        <div class="mask">
                                            <div class="d-flex justify-content-start align-items-end h-100">
                                                <h5>
                                                    <span class="badge bg-primary ms-2">New</span>
                                                    <span class="badge bg-danger ms-2">-30%</span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a class="text-reset" href="#">
                                        <h5 class="card-title mb-3">If He Had Been with Me</h5>
                                    </a>
                                    <a class="text-reset" href="#">
                                        <p>Fiction</p>
                                    </a>
                                    <h6 class="mb-3">
                                        <s>$2.99</s>
                                        <strong class="ms-2 text-danger">$2.09</strong>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                                    <img src="{{ asset('img/watch/omega-speedmaster-moonwatch-31193423099001-l.png') }}"
                                        class="w-100" style="width: auto; height: 25rem;" />
                                    <a href="#">
                                        <div class="mask">
                                            <div class="d-flex justify-content-start align-items-end h-100">
                                                <h5>
                                                    <span class="badge bg-primary ms-2">New</span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a class="text-reset" href="#">
                                        <h5 class="card-title mb-3">The Housemaid by Freida</h5>
                                    </a>
                                    <a class="text-reset" href="#">
                                        <p>Fiction</p>
                                    </a>
                                    <h6 class="mb-3">
                                        <strong class="ms-2 text-danger">$28.00</strong>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                                    <img src="{{ asset('img/watch/omega-speedmaster-moonwatch-31130403001001-l.png') }}"
                                        class="w-100" style="width: auto; height: 25rem;" />
                                    <a href="#">
                                        <div class="mask">
                                            <div class="d-flex justify-content-start align-items-end h-100">
                                                <h5>
                                                    <span class="badge bg-primary ms-2">New</span>
                                                    <span class="badge bg-danger ms-2">-8%</span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a class="text-reset" href="#">
                                        <h5 class="card-title mb-3">All My Knotted-Up Life</h5>
                                    </a>
                                    <a class="text-reset" href="#">
                                        <p>Non-Fiction</p>
                                    </a>
                                    <h6 class="mb-3">
                                        <s>$21.99</s>
                                        <strong class="ms-2 text-danger">$20.23</strong>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                                    <img src="{{ asset('img/watch/omega-speedmaster-speedmaster-57-co-axial-master-chronometer-chronograph-40-5-mm-33210415101001-l.png') }}"
                                        class="w-100" style="width: auto; height: 25rem;" />
                                    <a href="#">
                                        <div class="mask">
                                            <div class="d-flex justify-content-start align-items-end h-100">
                                                <h5>
                                                    <span class="badge bg-primary ms-2">New</span>
                                                    <span class="badge bg-danger ms-2">-10%</span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a class="text-reset" href="#">
                                        <h5 class="card-title mb-3">Roald Dahl&#x27;s Book</h5>
                                    </a>
                                    <a class="text-reset" href="#">
                                        <p>Horror</p>
                                    </a>
                                    <h6 class="mb-3">
                                        <s>$23.24</s>
                                        <strong class="ms-2 text-danger">$20.92</strong>
                                    </h6>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                            <div class="card">
                                <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                                    <img src="{{ asset('img/watch/Rolex_Datejust_126234_Mat_Vi_tinh_Xanh_Navy.png') }}"
                                        class="w-100" style="width: auto; height: 25rem;" />
                                    <a href="#">
                                        <div class="mask">
                                            <div class="d-flex justify-content-start align-items-end h-100">
                                                <h5>
                                                    <span class="badge bg-primary ms-2">New</span>
                                                </h5>
                                            </div>
                                        </div>
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(251, 251, 251, 0.15);">
                                            </div>
                                        </div>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <a class="text-reset" href="#">
                                        <h5 class="card-title mb-3">Caste The Origins</h5>
                                    </a>
                                    <a class="text-reset" href="#">
                                        <p>Non-Fiction</p>
                                    </a>
                                    <h6 class="mb-3">
                                        <strong class="ms-2 text-danger">$17.00</strong>
                                    </h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <nav class="pagination-container">
                    <div class="pagination justify-content-center">
                        <a class="pagination-newer" href="#">PREV</a>
                        <span class="pagination-inner">
                            <a class="pagination-active" href="#">1</a>
                            <a href="#">2</a>
                            <a href="#">3</a>
                            <a href="#">4</a>
                            <a href="#">5</a>
                            <a href="#">6</a>
                        </span>
                        <a class="pagination-older" href="#">NEXT</a>
                    </div>
                </nav>
            </div>
        </section>
    </main>
@endsection
