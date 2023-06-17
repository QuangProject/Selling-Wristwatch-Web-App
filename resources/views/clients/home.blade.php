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
        <div class="container d-flex justify-content-center justify-content-xl-end" data-aos="fade-up" data-aos-delay="500">
            <div class="text-center">
                <h1>Welcome to WatchWorld</h1>
                <h2>Unlock Time's Beauty: WatchWorld, Where Elegance Never Stops.</h2>
                <a href="#about" class="btn-get-started scrollto">Get Started</a>
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

                <div class="col-lg-2 col-md-4 col-6">
                    <img src="{{ asset('img/clients/client-1.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6">
                    <img src="{{ asset('img/clients/client-2.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6">
                    <img src="{{ asset('img/clients/client-3.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6">
                    <img src="{{ asset('img/clients/client-4.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6">
                    <img src="{{ asset('img/clients/client-5.png') }}" class="img-fluid" alt="">
                </div>

                <div class="col-lg-2 col-md-4 col-6">
                    <img src="{{ asset('/img/clients/client-6.png') }}" class="img-fluid" alt="">
                </div>

            </div>

        </div>
    </section><!-- End Clients Section -->

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
        <div class="container">

            <div class="section-title">
                <span>Top Brands</span>
                <h2>Top Brands</h2>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="fade-up">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bxl-dribbble"></i></div>
                        <h4><a href="">Lorem Ipsum</a></h4>
                        <p>Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-md-0" data-aos="fade-up"
                    data-aos-delay="150">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-file"></i></div>
                        <h4><a href="">Sed ut perspiciatis</a></h4>
                        <p>Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4 mt-lg-0" data-aos="fade-up"
                    data-aos-delay="300">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-tachometer"></i></div>
                        <h4><a href="">Magni Dolores</a></h4>
                        <p>Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="450">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-world"></i></div>
                        <h4><a href="">Nemo Enim</a></h4>
                        <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="600">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-slideshow"></i></div>
                        <h4><a href="">Dele cardo</a></h4>
                        <p>Quis consequatur saepe eligendi voluptatem consequatur dolor consequuntur</p>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch mt-4" data-aos="fade-up" data-aos-delay="750">
                    <div class="icon-box">
                        <div class="icon"><i class="bx bx-arch"></i></div>
                        <h4><a href="">Divera don</a></h4>
                        <p>Modi nostrum vel laborum. Porro fugit error sit minus sapiente sit aspernatur</p>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Services Section -->

    <!-- ======= Cta Section ======= -->
    <section id="cta" class="cta">
        <div class="container" data-aos="zoom-in">

            <div class="text-center">
                <h3>Introduction</h3>
                <p>At WatchWorld, we invite you to experience the magic of timekeeping. Discover the perfect union of
                    craftsmanship, elegance, and innovation as you embark on a journey through our exquisite collections.
                    Your time is precious, and at WatchWorld, we ensure that every second is counted with impeccable style.
                </p>
                <a class="cta-btn" href="#">About</a>
            </div>

        </div>
    </section><!-- End Cta Section -->

    <!-- ======= Team Section ======= -->
    <section id="team" class="team">
        <div class="container">

            <div class="section-title">
                <span>Team</span>
                <h2>Team</h2>
                <p>Sit sint consectetur velit quisquam cupiditate impedit suscipit alias</p>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                    <div class="member">
                        <img src="{{ asset('img/team/team-1.jpg') }}" alt="">
                        <h4>Walter White</h4>
                        <span>Chief Executive Officer</span>
                        <p>
                            Magni qui quod omnis unde et eos fuga et exercitationem. Odio veritatis perspiciatis
                            quaerat qui aut aut aut
                        </p>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                    <div class="member">
                        <img src="{{ asset('img/team/team-2.jpg') }}" alt="">
                        <h4>Sarah Jhinson</h4>
                        <span>Product Manager</span>
                        <p>
                            Repellat fugiat adipisci nemo illum nesciunt voluptas repellendus. In architecto rerum
                            rerum temporibus
                        </p>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6 d-flex align-items-stretch" data-aos="zoom-in">
                    <div class="member">
                        <img src="{{ asset('img/team/team-3.jpg') }}" alt="">
                        <h4>William Anderson</h4>
                        <span>CTO</span>
                        <p>
                            Voluptas necessitatibus occaecati quia. Earum totam consequuntur qui porro et laborum
                            toro des clara
                        </p>
                        <div class="social">
                            <a href=""><i class="bi bi-twitter"></i></a>
                            <a href=""><i class="bi bi-facebook"></i></a>
                            <a href=""><i class="bi bi-instagram"></i></a>
                            <a href=""><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </section><!-- End Team Section -->
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>
    <div id="preloader"></div>
@endsection
