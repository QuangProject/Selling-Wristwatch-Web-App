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
                            <span class="header">Payment</span>
                            <div class="form-payment">
                                <div class="row">
                                    <div class="form-inputs">
                                        <label>Choose Reciver:</label>
                                        <div class="d-flex">
                                            <select name="" id="" class="input-payment">
                                                <option value="1">Current User</option>
                                                <option value="2">Mr. John</option>
                                                <option value="3">Mr. John</option>
                                                <option value="4">Mr. John</option>
                                            </select>
                                            <span class="input-group-append">
                                                <button class="btn-add-reciver" id="btn-search-add-watch-model"
                                                    type="button">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-inputs col-lg-6">
                                        <label>First name:</label>
                                        <input class="input-payment">
                                    </div>
                                    <div class="form-inputs col-lg-6">
                                        <label>Last name:</label>
                                        <input class="input-payment">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-inputs col-12">
                                        <label>Telephone:</label>
                                        <input class="input-payment">
                                    </div>
                                    <div class="form-inputs col-12">
                                        <label>Address:</label>
                                        <input class="input-payment">
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
                            <div class="row lower">
                                <div class="col text-left">Subtotal</div>
                                <div class="col text-right">${{ $totalPrice }}</div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left">Delivery</div>
                                <div class="col text-right">{{ $shipping }}</div>
                            </div>
                            <div class="row lower">
                                <div class="col text-left"><b>Total to pay</b></div>
                                <div class="col text-right"><b>${{ $totalPrice + $shipping }}</b></div>
                            </div>
                            <button class="btn-payment" id="btn-payment">Place order</button>
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
