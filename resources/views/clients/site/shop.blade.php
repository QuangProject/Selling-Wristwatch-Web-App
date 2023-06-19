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
            <nav class="accordion arrows col-lg-2 col-md-3 custom-dropdown my-3">
                <!-- Navbar -->
                <nav class="navbar navbar-expand-md navbar-light bg-danger rounded">
                    <!-- Toggle button -->
                    <button class="navbar-toggler ms-2" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <!-- Brand -->
                    <a class="text-white" style="text-decoration: none;" href="/">
                        <h3 class="fw-bold mx-3">Watch World</h3>
                    </a>
                </nav>
                <!-- Navbar -->
                <nav id="sidebarMenu" class="collapse d-md-block bg-white">
                    <input type="radio" name="accordion" id="cb1" />
                    <section class="box">
                        <label class="box-title" for="cb1">Brands</label>
                        <label class="box-close" for="acc-close"></label>
                        @foreach ($brands as $brand)
                            <div class="box-content">
                                <a class="nav-link text-reset"
                                    href="{{ route('shop', ['brand_id' => $brand->id]) }}">{{ $brand->name }}</a>
                            </div>
                        @endforeach
                    </section>
                    <input type="radio" name="accordion" id="cb2" />
                    <section class="box">
                        <label class="box-title" for="cb2">Collections</label>
                        <label class="box-close" for="acc-close"></label>
                        @foreach ($collections as $collection)
                            <div class="box-content">
                                <a class="nav-link text-reset"
                                    href="{{ route('shop', ['collection_id' => $collection->id]) }}">{{ $collection->name }}</a>
                            </div>
                        @endforeach
                    </section>
                    <input type="radio" name="accordion" id="cb3" />
                    <section class="box">
                        <label class="box-title" for="cb3">Categories</label>
                        <label class="box-close" for="acc-close"></label>
                        @foreach ($categories as $category)
                            <div class="box-content">
                                <a class="nav-link text-reset"
                                    href="{{ route('shop', ['category_id' => $category->id]) }}">{{ $category->name }}</a>
                            </div>
                        @endforeach
                    </section>
                    <input type="radio" name="accordion" id="acc-close" />
                </nav>
            </nav>
            <div class="col-lg-10 col-md-9">
                <div class="row">
                    @foreach ($watches as $watch)
                        <div class="col-xl-3 col-lg-4 col-sm-6 mt-3">
                            <div class="product-grid">
                                <div class="product-image">
                                    <a href="{{ route('detail', ['id' => $watch->id]) }}" class="image">
                                        <img src="{{ route('watch.image.get', ['id' => $watch->images[0]->id]) }}"
                                            loading="lazy">
                                    </a>
                                    @if ($watch->discount > 0)
                                        <span class="product-discount-label">-{{ $watch->discount }}%</span>
                                    @endif
                                    <ul class="product-links">
                                        <li><a href="#"><i class="fa fa-search"></i></a></li>
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-random"></i></a></li>
                                    </ul>
                                    <button class="add-to-cart border-0">Add to Cart</button>
                                </div>
                                <div class="product-content">
                                    <h3 class="title">
                                        <a href="{{ route('detail', ['id' => $watch->id]) }}" class="content">
                                            {{ $watch->model }}
                                        </a>
                                    </h3>
                                    @if ($watch->discount > 0)
                                        <div class="price">
                                            ${{ $watch->selling_price - ($watch->selling_price * $watch->discount) / 100 }}
                                            <span class="text-danger">${{ $watch->selling_price }}</span>
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
        </section>
    </main>
@endsection

@section('js')
    <script>
        var content = document.getElementsByClassName('content');
        var minWords = 3; // Minimum number of words to display
        for (var i = 0; i < content.length; i++) {
            var words = content[i].innerText.split(' ');
            if (words.length > minWords) {
                content[i].innerText = words.slice(0, minWords).join(' ') + '...';
            }
        }
    </script>
@endsection
