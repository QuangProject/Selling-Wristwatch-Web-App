@extends('layouts.base')

@section('title')
    Cart
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
    @if (session('msg'))
        <div class="alert alert-success my-1 text-center">{{ session('msg') }}</div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger my-1 text-center">{{ session('error') }}</div>
    @endif
    <div class="cart-container py-5">
        <div class="card" id="cart">
            @if ($carts->count() == 0)
                <div class="row">
                    <div class="text-center">
                        <img src="{{ asset('img/shopping-bag.gif') }}" alt="Empty cart" style="width: 50%">
                    </div>
                    <div class="text-center my-3">
                        <a href="{{ route('shop') }}" class="btn btn-danger">Continue shopping</a>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col-12 cart">
                        <div class="title">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <div>
                                        <a href="{{ route('shop') }}">&leftarrow;</a>
                                        <span class="text-muted">Back to shop</span>
                                    </div>
                                </div>
                                <div class="align-self-center text-right text-muted"><span
                                        class="item">{{ session()->get('countCart') }}</span> items
                                </div>
                            </div>
                        </div>
                        <div class="row border-top border-bottom">
                            @foreach ($carts as $cart)
                                <div class="row main align-items-center" id="cart_{{ $cart->id }}">
                                    <div class="col-md-2 text-center">
                                        <img class="img-fluid" class="img-cart"
                                            src="{{ route('watch.image.get', ['id' => $cart->image_id]) }}">
                                    </div>
                                    <div class="col-md-4 text-center text-md-start mt-3 mt-md-0">
                                        <div class="text-muted">
                                            <a href="{{ route('detail', ['id' => $cart->watch_id]) }}"
                                                class="p-0">{{ $cart->model }}</a>
                                        </div>
                                        <div class="">{{ $cart->gender }}</div>
                                    </div>
                                    <div class="col-md-3 text-center mt-3 mt-md-0">
                                        <span onclick="changeQuantity({{ $cart->id }}, 'minus')"
                                            style="cursor: pointer">-</span>
                                        <span class="border px-3 mx-2"
                                            id="quantity_{{ $cart->id }}">{{ $cart->quantity }}</span>
                                        <span onclick="changeQuantity({{ $cart->id }}, 'plus')"
                                            style="cursor: pointer">+</span>
                                    </div>
                                    <div class="col-md-2 text-center mt-3 mt-md-0">&dollar;<span
                                            id="watchPrice_{{ $cart->id }}">{{ $cart->selling_price }}</span></div>
                                    <span class="col-md-1 close text-center text-md-end mt-3 mt-md-0"
                                        onclick="removeItem({{ Auth::user()->id }}, {{ $cart->id }})"
                                        style="cursor: pointer;">&#10005;</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-end">
                            <div class="col-5 col-md-4 col-lg-3">
                                <div class="d-flex justify-content-between"
                                    style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                                    <div>TOTAL PRICE</div>
                                    <div class="text-right fw-bold">&dollar;<span
                                            id="total-price">{{ $totalPrice }}</span>
                                    </div>
                                </div>
                                <a href="{{ route('payment') }}">
                                    <button class="btn-cart" type="submit">CHECKOUT</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection
