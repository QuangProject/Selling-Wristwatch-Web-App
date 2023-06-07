@extends('layouts.base')

@section('title')
    Shop page
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/shop.css') }}">
@endsection

@section('content')
    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="custom-menu">
                <button type="button" id="sidebarCollapse" class="btn btn-primary">
                    <i class="fa fa-bars"></i>
                    <span class="sr-only">Toggle Menu</span>
                </button>
            </div>
            <div class="p-4">
                <h1><a href="index.html" class="logo">Portfolic <span>Portfolio Agency</span></a></h1>
                <ul class="list-unstyled components mb-5">
                    <li class="active">
                        <a href="#"><span class="fa fa-home mr-3"></span> Home</a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-user mr-3"></span> About</a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-briefcase mr-3"></span> Works</a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-sticky-note mr-3"></span> Blog</a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-suitcase mr-3"></span> Gallery</a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-cogs mr-3"></span> Services</a>
                    </li>
                    <li>
                        <a href="#"><span class="fa fa-paper-plane mr-3"></span> Contacts</a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <div class="text-center">
                <div class="row">
                    <div class="col-xl-3 col-lg-4 col-md-6 col-sm-6 col-12 mb-4">
                        <div class="card">
                            <div class="bg-image hover-zoom ripple" data-mdb-ripple-color="light">
                                <img src="{{ asset('BookImages/fc67b4f4-9928-427f-ab3a-86e96f2e9936.jpg') }}" class="w-100"
                                    style="width: auto; height: 35rem;" />
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
                                <img src="{{ asset('BookImages/16bd3e1f-cf9a-40d5-ac9e-487cbf0e7c92.jpg') }}" class="w-100"
                                    style="width: auto; height: 35rem;" />
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
                                <img src="{{ asset('BookImages/28fb8f21-80b2-4749-8e23-06bc920080be.jpg') }}" class="w-100"
                                    style="width: auto; height: 35rem;" />
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
                                <img src="{{ asset('BookImages/7bdc3bc6-98d4-4922-8d2e-bdf57c8bbc25.jpg') }}"
                                    class="w-100" style="width: auto; height: 35rem;" />
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
                                <img src="{{ asset('BookImages/1190cd71-422c-40d7-922c-bc2f3d1529a3.jpg') }}"
                                    class="w-100" style="width: auto; height: 35rem;" />
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
                                <img src="{{ asset('BookImages/e122d20f-9e9f-4169-ad73-4ab7a8eb56b9.jpg') }}"
                                    class="w-100" style="width: auto; height: 35rem;" />
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
                                <img src="{{ asset('BookImages/85527f9e-2509-4945-bd6c-244ccda6cb71.jpg') }}"
                                    class="w-100" style="width: auto; height: 35rem;" />
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
                                <img src="{{ asset('BookImages/18d50dc5-9a18-4ae2-aa69-5c18643719c3.jpg') }}"
                                    class="w-100" style="width: auto; height: 35rem;" />
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
    </div>
@endsection
