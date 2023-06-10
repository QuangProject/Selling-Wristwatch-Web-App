@extends('layouts.base')

@section('title')
    About Us
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/about.css') }}">
@endsection

@section('content')
    <div id="about-main">
        <div class="story-container">
            <div class="need-for-dx-container">
                <h3 class="text-center">
                    Watch World
                </h3>
                <p style="text-align: justify;">
                    Discover a world where precision meets artistry, where every tick of the hand tells a story of timeless
                    elegance. Welcome to WatchWorld, a destination for watch enthusiasts and connoisseurs alike. With a
                    legacy spanning over five decades, we are proud to offer a curated selection of exceptional timepieces
                    that blend masterful craftsmanship with exquisite design.
                </p>
                <div class="text-center">
                    <video src="{{ asset('video/classic-watches-datejust-cover-autoplay.mp4') }}" loop autoplay muted
                        class="container"></video>
                </div>
            </div>
            <div class="container-divider"></div>
            <div class="origin-story-container" style="text-align: justify;">
                <h3 class="text-center">
                    Our History
                </h3>
                <p>
                    In the vast realm of horology, WatchWorld has stood as a beacon of timekeeping excellence for over half
                    a century. Founded in 1970 by renowned watchmaker, Mr. Alexander Grant, the brand emerged as a pioneer
                    in crafting exquisite timepieces that seamlessly blended precision, artistry, and innovation.
                </p>
                <p>
                    From its humble beginnings in a small workshop, WatchWorld quickly gained recognition for its meticulous
                    craftsmanship and attention to detail. Mr. Grant's unwavering passion for horology guided the brand's
                    trajectory, propelling it to new heights. With a team of skilled artisans and engineers, WatchWorld
                    embraced traditional watchmaking techniques while embracing the spirit of innovation.
                </p>
                <p>
                    In the 1980s, WatchWorld introduced a groundbreaking collection of quartz watches, harnessing the
                    cutting-edge technology of the time. These timepieces offered unparalleled accuracy and reliability,
                    capturing the hearts of watch enthusiasts worldwide. The brand's dedication to excellence and the
                    pursuit of perfection earned WatchWorld a prestigious reputation in the industry.
                </p>
                <p>
                    As the years rolled on, WatchWorld expanded its offerings, presenting a diverse range of wristwatches
                    that catered to various tastes and lifestyles. From classic dress watches exuding elegance to robust
                    sports watches built for adventure, every timepiece bore the signature mark of WatchWorld's commitment
                    to quality.
                </p>
                <p>
                    In the late 1990s, WatchWorld embraced the digital age, launching an online platform to connect directly
                    with its global customer base. The brand's website became a virtual horological haven, offering a
                    seamless shopping experience and a wealth of information about their collections. Watch enthusiasts
                    could explore the intricate details of each watch, read about the brand's rich history, and engage in
                    forums to share their passion for timepieces.
                </p>
                <p>
                    In recent years, under the leadership of Mr. Grant's visionary successors, WatchWorld has continued to
                    evolve and adapt to the ever-changing landscape of watchmaking. Embracing technological advancements
                    while preserving the artistry of traditional craftsmanship, WatchWorld has remained at the forefront of
                    the industry.
                </p>
                <p>
                    Today, WatchWorld continues to enchant watch connoisseurs with its iconic collections, from
                    limited-edition masterpieces that push the boundaries of design to everyday timepieces that combine
                    style and functionality. The brand's commitment to excellence, integrity, and timeless elegance ensures
                    that every WatchWorld watch is not just a timekeeping instrument but a symbol of prestige and
                    sophistication.
                </p>
                <p>
                    With a rich heritage spanning decades, WatchWorld remains dedicated to preserving the legacy of
                    horological excellence established by Mr. Alexander Grant. As the brand looks towards the future, it
                    continues to inspire watch enthusiasts around the globe, reminding them that time is a precious gift
                    best measured by the masterful craftsmanship of a WatchWorld timepiece.
                </p>
            </div>
            <div class="container-divider"></div>
        </div>
    </div>
@endsection
