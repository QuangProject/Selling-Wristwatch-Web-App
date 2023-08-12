@extends('layouts.base')

@section('title')
    Home page
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/homepage.css') }}">
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success my-1">{{ session('msg') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger my-1">{{ session('error') }}</div>
    @endif
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container d-flex justify-content-center justify-content-xl-end" data-aos="fade-up" data-aos-delay="100">
            <div class="text-center">
                <h1>Welcome to WatchWorld</h1>
                <h2>Unlock Time's Beauty: WatchWorld, Where Elegance Never Stops.</h2>
                <a href="{{ route('shop') }}" class="btn-get-started scrollto">Get Started</a>
            </div>
        </div>
    </section><!-- End Hero -->
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 order-1 order-lg-2" data-aos="fade-left">
                    <img src="{{ asset('img/home/watchmaking-navigation-WMPolish_2212jb_0005.jpg') }}" class="img-fluid"
                        alt="">
                </div>
                <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content" data-aos="fade-right">
                    <h3>At WatchWorld, we believe that a watch is more than a mere accessory</h3>
                    <p class="fst-italic">
                        It is a reflection of one's personality and style. Explore our meticulously curated collections,
                        each bearing the hallmark of our dedication to quality and timeless elegance.
                    </p>
                    <ul>
                        <li><i class="bi bi-check-circle"></i> Heritage Collection: Step into the past with our Heritage
                            Collection, where classic design elements meet modern sophistication.</li>
                        <li><i class="bi bi-check-circle"></i> Artisan Edition: Immerse yourself in the realm of horological
                            artistry with our Artisan Edition watches.</li>
                        <li><i class="bi bi-check-circle"></i> Lifestyle Collection: Find the perfect watch to complement
                            your unique lifestyle with our Lifestyle Collection.</li>
                    </ul>
                </div>
            </div>

        </div>
    </section><!-- End About Section -->

    <!-- ======= Why Us Section ======= -->
    <section id="why-us" class="why-us">
        <div class="container">
            <div class="row">
                <div class="col-lg-4" data-aos="fade-up">
                    <div class="box">
                        <span>01</span>
                        <h4>Craftsmanship and Innovation</h4>
                        <p>At WatchWorld, we believe in the seamless fusion of traditional craftsmanship and innovative
                            technology. Every watch in our collection is meticulously crafted by skilled artisans and
                            watchmakers who take pride in their art.</p>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="150">
                    <div class="box">
                        <span>02</span>
                        <h4>Customer Experience</h4>
                        <p>We are committed to providing an exceptional customer experience from the moment you step into
                            the world of WatchWorld. Our knowledgeable team is here to guide you in finding
                            the timepiece that suits your preferences and requirements.</p>
                    </div>
                </div>

                <div class="col-lg-4 mt-4 mt-lg-0" data-aos="fade-up" data-aos-delay="300">
                    <div class="box">
                        <span>03</span>
                        <h4>WatchWorld Community:</h4>
                        <p>Become a part of our vibrant community of watch enthusiasts by joining our forums and social
                            media channels. Share your passion, engage in discussions, and stay updated with the latest
                            trends and releases in the world of horology.</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Why Us Section -->

    <!-- ======= Clients Section ======= -->
    <section id="clients" class="clients">
        <div class="container" data-aos="zoom-in">
            <div class="row d-flex align-items-center">
                @foreach ($brands as $brand)
                    <div class="col-lg-3 col-6">
                        <img src="{{ route('brand.image', ['id' => $brand->id]) }}" class="img-fluid"
                            alt="{{ $brand->name }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Clients Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="text-center">
                <h3>Introduction</h3>
                <p>At WatchWorld, we invite you to experience the magic of timekeeping. Discover the perfect union of
                    craftsmanship, elegance, and innovation as you embark on a journey through our exquisite collections.
                    Your time is precious, and at WatchWorld, we ensure that every second is counted with impeccable style.
                </p>
                <a class="cta-btn" href="{{ route('about') }}">About</a>
            </div>

        </div>
    </section><!-- End Cta Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">

            <div class="section-title">
                <span>Best Selling</span>
                <h2>Best Selling</h2>
            </div>

            <div class="row">
                @foreach ($watches as $watch)
                    <div class="col-md-4 col-sm-6 mt-3">
                        <div class="product-grid">
                            <div class="product-image">
                                <a href="#" class="image">
                                    <img class="pic-1" src="{{ route('watch.image.get', ['id' => $watch->image_id]) }}">
                                    <img class="pic-2" src="{{ route('watch.image.get', ['id' => $watch->image_id]) }}">
                                </a>
                                @if ($watch->discount > 0)
                                    <span class="product-discount-label">-{{ $watch->discount }}%</span>
                                @endif
                                <ul class="product-links">
                                    <li><a href="#" data-tip="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                    {{-- <li><a href="#" data-tip="Compare"><i class="fa fa-random"></i></a></li> --}}
                                    <li><a href="#" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
                                </ul>
                            </div>
                            <div class="product-content">
                                <a class="add-to-cart" href="#">
                                    <i class="fas fa-plus"></i>Add to cart
                                </a>
                                <h3 class="title"><a href="#">{{ $watch->model }}</a></h3>
                                {{-- <ul class="rating">
                                    <li class="fas fa-star"></li>
                                    <li class="fas fa-star"></li>
                                    <li class="fas fa-star"></li>
                                    <li class="far fa-star"></li>
                                    <li class="far fa-star"></li>
                                </ul> --}}
                                @if ($watch->discount > 0)
                                    <div class="price">
                                        ${{ $watch->selling_price - ($watch->selling_price * $watch->discount) / 100 }}
                                        <span>${{ $watch->selling_price }}</span>
                                    </div>
                                @else
                                    <div class="price">${{ $watch->selling_price }}</div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section><!-- End Services Section -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>
@endsection
