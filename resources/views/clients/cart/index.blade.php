@extends('layouts.base')

@section('title')
    Cart
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endsection

@section('content')
    <div class="cart-container py-5">
        <div class="card">
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
                    <div class="col-xl-8 cart">
                        <div class="title">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <h4><b>Shopping Cart</b></h4>
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
                                    <div class="col-md-3 col-lg-4 text-center text-md-start mt-3 mt-md-0">
                                        <div class="text-muted">
                                            <a href="{{ route('detail', ['id' => $cart->watch_id]) }}"
                                                class="p-0">{{ $cart->model }}</a>
                                        </div>
                                        <div class="">{{ $cart->gender }}</div>
                                    </div>
                                    <div class="col-md-3 col-lg-2 col-xl-3 text-center mt-3 mt-md-0">
                                        <span onclick="changeQuantity({{ $cart->id }}, 'minus')"
                                            style="cursor: pointer">-</span>
                                        <span class="border px-3 mx-2"
                                            id="quantity_{{ $cart->id }}">{{ $cart->quantity }}</span>
                                        <span onclick="changeQuantity({{ $cart->id }}, 'plus')"
                                            style="cursor: pointer">+</span>
                                    </div>
                                    <div class="col-md-3 col-xl-2 text-center mt-3 mt-md-0">&dollar;<span
                                            id="watchPrice_{{ $cart->id }}">{{ $cart->selling_price }}</span></div>
                                    <span class="col-md-1 close text-center text-md-end mt-3 mt-md-0"
                                        onclick="removeItem({{ Auth::user()->id }}, {{ $cart->id }})"
                                        style="cursor: pointer;">&#10005;</span>
                                </div>
                            @endforeach
                        </div>
                        <div class="back-to-shop"><a href="{{ route('shop') }}">&leftarrow;</a><span
                                class="text-muted">Back
                                to shop</span>
                        </div>
                    </div>
                    <form action="{{ route('payment') }}" method="POST" class="col-xl-4 summary">
                        @csrf
                        <div>
                            <h5><b>Summary</b></h5>
                        </div>
                        <hr>
                        <div class="mb-3 d-flex justify-content-between">
                            <div style="padding-left:0;">ITEMS <span
                                    class="item">{{ session()->get('countCart') }}</span></div>
                            <div class="text-right">&dollar;<span id="sub-total">{{ $totalPrice }}</span></div>
                        </div>
                        <div>
                            <p class="mb-1">SHIPPING</p>
                            <select id="shipping" name="shipping">
                                <option class="text-muted" value="3">Economical-Delivery - &dollar;3.00</option>
                                <option class="text-muted" value="5" selected>Standard-Delivery - &dollar;5.00</option>
                                <option class="text-muted" value="10">Fast-Delivery - &dollar;10.00</option>
                            </select>
                            <p class="mb-1">GIVE CODE</p>
                            <input id="code" class="input-cart" placeholder="Enter your code">
                        </div>
                        <div class="d-flex justify-content-between"
                            style="border-top: 1px solid rgba(0,0,0,.1); padding: 2vh 0;">
                            <div>TOTAL PRICE</div>
                            <div class="text-right">&dollar;<span id="total-price">{{ $totalPrice + 5 }}</span></div>
                        </div>
                        <button class="btn-cart" type="submit">CHECKOUT</button>
                    </form>
                </div>
            @endif
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/cart.js') }}"></script>
@endsection
