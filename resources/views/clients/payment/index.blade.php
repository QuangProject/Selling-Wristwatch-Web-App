@extends('layouts.base')

@section('title')
    Payment
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/payment.css') }}">
@endsection

@section('content')
    <div class="payment-container">
        <div class="card">
            <div class="card-top border-bottom text-center">
                <span id="logo">Watch World</span>
            </div>
            <div class="card-body">
                <div class="upper">
                    <span><i class="fa-solid fa-circle-check"></i> <a href="#">Shopping bag</a></span>
                    <span id="payment"><span id="three">2</span>Payment</span>
                </div>
                <div class="row">
                    <div class="col-md-7">
                        <div class="left border">
                            <span class="ms-3 header">Payment</span>
                            <div class="form-payment">
                                <div class="text-center">
                                    <span class="text-danger text-center" id="error-payment"></span>
                                </div>
                                <div class="row">
                                    <div class="form-inputs">
                                        <label>Choose Reciver:</label>
                                        <div class="d-flex">
                                            <select name="select-receiver" id="select-receiver" class="input-payment">
                                                <option value="0">Choose receiver</option>
                                                @foreach ($receivers as $receiver)
                                                    <option value="{{ $receiver->id }}">{{ $receiver->first_name }}
                                                        {{ $receiver->last_name }}</option>
                                                @endforeach
                                            </select>
                                            <span class="input-group-append">
                                                <a href="{{ route('receiver') }}">
                                                    <button class="btn-add-reciver" id="btn-search-add-watch-model"
                                                        type="button">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </a>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-inputs col-lg-6">
                                        <label>First name:</label>
                                        <input class="input-payment" id="first-name" value="" readonly>
                                    </div>
                                    <div class="form-inputs col-lg-6">
                                        <label>Last name:</label>
                                        <input class="input-payment" id="last-name" value="" readonly>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-inputs col-12">
                                        <label>Telephone:</label>
                                        <input class="input-payment" id="telephone" value="" readonly>
                                    </div>
                                    <div class="form-inputs col-12">
                                        <label>Address:</label>
                                        <input class="input-payment" id="address" value="" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="right border">
                            <div class="header">Order Summary</div>
                            <p>{{ session()->get('countCart') }} items</p>
                            @foreach ($carts as $cart)
                                <div class="row item mt-2">
                                    <div class="col-4 align-self-center"><img class="img-fluid"
                                            src="{{ route('watch.image.get', ['id' => $cart->image_id]) }}"></div>
                                    <div class="col-8">
                                        <div class="row">
                                            @if ($cart->discount > 0)
                                                <b class="p-0 price">${{ $watch->selling_price - ($watch->selling_price * $watch->discount) / 100 }}
                                                    <span class="text-danger">${{ $cart->selling_price }}</span></b>
                                            @else
                                                <b class="p-0 price">${{ $cart->selling_price }}</b>
                                            @endif
                                        </div>
                                        <div class="row text-muted">{{ $cart->model }}</div>
                                        <div class="row">Quantity: {{ $cart->quantity }}</div>
                                    </div>
                                </div>
                            @endforeach
                            <hr>
                            <div>
                                <p class="mb-1">SHIPPING</p>
                                <select id="shipping" name="shipping">
                                    <option class="text-muted" value="3">Economical-Delivery - &dollar;3.00</option>
                                    <option class="text-muted" value="5" selected>Standard-Delivery - &dollar;5.00
                                    </option>
                                    <option class="text-muted" value="10">Fast-Delivery - &dollar;10.00</option>
                                </select>
                                {{-- <p class="mb-1">GIVE CODE</p>
                                <input id="code" class="input-cart" placeholder="Enter your code"> --}}
                            </div>
                            <div class="row lower">
                                <div class="col text-left">Subtotal</div>
                                <div class="col text-right">$<span id="sub-total">{{ $totalPrice }}</span></div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left">Delivery</div>
                                <div class="col text-right" id="shipping-price">$5.00</div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left"><b>Total to pay</b></div>
                                <div class="col text-right">$<b id="total-price">{{ $totalPrice + 5 }}</b></div>
                            </div>
                            <button class="btn-payment" id="btn-payment" data-user-id="{{ Auth::user()->id }}">Place
                                order</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/payment.js') }}"></script>
@endsection
