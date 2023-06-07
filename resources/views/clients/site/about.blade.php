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
                    FPT Book
                </h3>
                <p style="text-align: justify;">
                    FPT Book is a brand from Vietnam, born in 2022, started off as a small thrift shop in CanTho,
                    Vietnam. Through the lens of books, FPT Book would like to share experiences and POV in music,
                    movies, and art, connecting the youth community with a global lifestyle. However, developing DN
                    stores and writing documentation are arduous, monotonous, and error-prone tasks. It is a slow
                    process and costs a lot of time and money.
                </p>
                <div class="text-center">
                    <video src="{{ asset('video/introduction.mp4') }}" loop autoplay muted class="container"></video>
                </div>
            </div>
            <div class="container-divider"></div>
            <div class="origin-story-container" style="text-align: justify;">
                <h3 class="text-center">
                    Our History
                </h3>
                <p>
                    Founded in 1978 in Milan,Gianni Dana S.r.l is one of the leading international fashion design houses
                    and a symbol of Italian luxury world-wide. It designs, manufactures, distributes and retails fashion
                    and lifestyle products including haute couture, prèt-à-porter, accessories, jewellery, watches,
                    eyewear, fragrances, and home furnishings all bearing the distinctive Medusa logo.
                </p>
                <p>
                    The Dana Group distributes its products through a world-wide D.O.S network which includes over 200
                    boutiques in the principal cities and over 1500 wholesalers worldwide.
                </p>
                <p>
                    Donatella Dana has been Artistic Director of Versace since 1997 and has steered the brand into the
                    21st century. Today, Dana represents its heritage through its strong and fearless designs, while
                    addressing a new global audience which continues to strengthen Versace’s position in contemporary
                    culture.
                </p>
                <p>
                    In 2000 Gianni Dana S.r.l opened Palazzo Versace, the first hotel project to be branded by a luxury
                    goods company, which provides tourists and travellers the opportunity to experience and enjoy the
                    complete Versace lifestyle. The second Palazzo Dana built in Dubai opened in 2015. The third Palazzo
                    Dana will be built in Macau, China.
                </p>
                <p>
                    In February 2014, Gianni Dana S.r.l announced its agreement with Blackstone to participate in the
                    next phase of the Company’s development. Blackstone owns 20 percent of the company; while the Dana
                    family remains at its heart, with Ms. Allegra Versace Beck, Ms. Donatella Dana and Mr. Santo Versace
                    all playing important roles in the company. Donatella Dana holds the dual role of Vice-President of
                    the board and Artistic Director.
                </p>
                <p>
                    In May 2016, the Dana Group appointed Mr. Jonathan Akeroyd to the position of CEO and member of the
                    company’s Board of Directors.
                </p>
                <p>
                    In September of 2018 VerDana ace announced that one hundred percent of all Blackstone and Dana
                    family shares had been sold to the Group Michael Kors Limited. In January 2019, Gianni Dana S.r.l.
                    joined Capri Holdings Limited, forming a new global fashion luxury group together with Michael Kors
                    and Jimmy Choo.
                </p>
            </div>
            <div class="container-divider"></div>
            <div class="row mb-3" style="max-width: 950px; margin: 0 auto; padding: 0 20px;">
                <div class="col-lg-6 d-flex justify-content-center">
                    <img src="{{ asset('img/introduction.jpg') }}" alt="" class="img-responsive" />
                </div>
                <div class="col-lg-6">
                    <div class="today-container" style="text-align: justify;">
                        <h3 class="text-center mt-4 mt-lg-0">
                            Commitment to quality
                        </h3>
                        <p>
                            APIMatic has come a long way since its inception 3 years ago. Having started with only
                            generating SDKs, APIMatic now provides solutions in other areas of developer experience as
                            well. Presently, APIMatic is used by numerous organizations around the world to:
                        </p>
                        <ul>
                            <li>Create and store definitions of their APIs</li>
                            <li>Generate SDKs for their APIs for 10 platforms</li>
                            <li>Keep these SDKs in sync with API updates</li>
                            <li>Convert API descriptions into multiple formats (Swagger, API Blueprint, RAML etc.)</li>
                            <li>Generate beautiful documentation for their APIs and SDKs</li>
                            <li>Generate complete Developer Experience API Portals</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
