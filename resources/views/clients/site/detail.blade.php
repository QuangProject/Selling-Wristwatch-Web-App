@extends('layouts.base')

@section('title')
    Detail
@endsection

@section('css')
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
@endsection

@section('content')
    <div class="pd-wrap">
        <div class="container">
            <div class="heading-section">
                <h2>Product Details</h2>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div id="slider" class="owl-carousel product-slider">
                        @foreach ($watch->images as $image)
                            <div class="item">
                                <img src="{{ route('watch.image.get', ['id' => $image->id]) }}" />
                            </div>
                        @endforeach
                    </div>
                    <div id="thumb" class="owl-carousel product-thumb">
                        @foreach ($watch->images as $image)
                            <div class="item" onclick="changeName({{ $image->id }})">
                                <img src="{{ route('watch.image.get', ['id' => $image->id]) }}" />
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="product-dtl">
                        <div class="product-info">
                            <div class="product-name" id="product-name">{{ $watch->model }}</div>
                            {{-- <div class="reviews-counter">
                                <div class="rate">
                                    <input type="radio" id="star5" name="rate" value="5" checked />
                                    <label for="star5" title="text">5 stars</label>
                                    <input type="radio" id="star4" name="rate" value="4" checked />
                                    <label for="star4" title="text">4 stars</label>
                                    <input type="radio" id="star3" name="rate" value="3" checked />
                                    <label for="star3" title="text">3 stars</label>
                                    <input type="radio" id="star2" name="rate" value="2" />
                                    <label for="star2" title="text">2 stars</label>
                                    <input type="radio" id="star1" name="rate" value="1" />
                                    <label for="star1" title="text">1 star</label>
                                </div>
                                <span>3 Reviews</span>
                            </div> --}}
                            <div class="product-price-discount">
                                @if ($watch->discount > 0)
                                    <span
                                        class="fw-bold">${{ $watch->selling_price - ($watch->selling_price * $watch->discount) / 100 }}</span>
                                    <span class="line-through text-danger">${{ $watch->selling_price }}</span>
                                @else
                                    <span class="fw-bold">${{ $watch->selling_price }}</span>
                                @endif
                            </div>
                        </div>
                        <div class="mt-3">
                            <strong>Stock:</strong> <span id="stock">{{ $watch->stock }}</span>
                        </div>
                        <div class="product-count">
                            <label for="size fw-bold">Quantity</label>
                            <div class="display-flex">
                                <div class="qtyminus">-</div>
                                <input type="text" name="quantity" value="1" class="qty" id="quantity">
                                <div class="qtyplus">+</div>
                            </div>
                        </div>
                        <button class="round-black-btn" id="btn-add-to-cart">Add to Cart</button>
                        <div class="table-responsive">
                            <table class="table table-striped table-product">
                                <thead>
                                    <tr>
                                        <td colspan="2">
                                            <h3>General Info</h3>
                                        </td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>Gender</td>
                                        <td>{{ $watch->gender }}</td>
                                    </tr>
                                    <tr>
                                        <td>Case Material</td>
                                        <td>{{ $watch->case_material }}</td>
                                    </tr>
                                    <tr>
                                        <td>Case Diameter</td>
                                        <td>{{ $watch->case_diameter }}mm</td>
                                    </tr>
                                    <tr>
                                        <td>Case Thinckness</td>
                                        <td>{{ $watch->case_thickness }}mm</td>
                                    </tr>
                                    <tr>
                                        <td>Strap Material</td>
                                        <td>{{ $watch->strap_material }}</td>
                                    </tr>
                                    <tr>
                                        <td>Dial Color</td>
                                        <td>{{ $watch->dial_color }}</td>
                                    </tr>
                                    <tr>
                                        <td>Crystal Material</td>
                                        <td>{{ $watch->crystal_material }}</td>
                                    </tr>
                                    <tr>
                                        <td>Water Resistance</td>
                                        <td>{{ $watch->water_resistance }}m</td>
                                    </tr>
                                    <tr>
                                        <td>Movement Type</td>
                                        <td>{{ $watch->movement_type }}</td>
                                    </tr>
                                    <tr>
                                        <td>Power Reserve</td>
                                        <td>{{ $watch->power_reserve }} hours</td>
                                    </tr>
                                    <tr>
                                        <td>Complications</td>
                                        <td>{{ $watch->complications }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-info-tabs">
                <h5>Reviews (0)</h5>
                <table class="table table-striped table-product">
                    <thead class="fw-bold">
                        <tr>
                            <td width="25%">Full Name</td>
                            <td width="50%">Content</td>
                            <td width="25%">Date</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>FirstName LastName</td>
                            <td>Content</td>
                            <td>FeedDate</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script src="{{ asset('js/detail.js') }}"></script>
@endsection
