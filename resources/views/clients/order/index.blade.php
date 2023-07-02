@extends('layouts.base')

@section('title')
    Order Information
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/order-information.css') }}">
@endsection

@section('content')
    <div class="container py-5 h-100">
        @if (count($orders) == 0)
            <div class="row d-flex justify-content-center align-items-center h-100 mb-4">
                <img src="{{ asset('img/image_empty.gif') }}" alt="Empty" style="width: 50%">
            </div>
            <div class="text-center my-3">
                <a href="{{ route('shop') }}" class="btn btn-danger">Continue shopping</a>
            </div>
        @else
            @foreach ($orders as $order)
                <div class="d-flex justify-content-center align-items-center mb-4">
                    <div class="col-12">
                        <div class="card card-stepper text-black" style="border-radius: 16px;">
                            <div class="card-body p-5">
                                <div class="d-flex justify-content-between align-items-center mb-5">
                                    <div>
                                        <h5 class="mb-0">ORDER <span
                                                class="text-danger fw-bold">#{{ $order->id }}</span>
                                        </h5>
                                        <a href="{{ route('detailed.information', ['id' => $order->id, 'type' => 'order']) }}"
                                            class="text-danger">Track order details <i
                                                class="fa-solid fa-angles-right"></i></a>
                                    </div>
                                    <div class="text-end">
                                        <p class="mb-0">Order Date:
                                            <span
                                                class="fw-bold">{{ \Carbon\Carbon::parse($order->order_date)->format('M d, Y') }}</span>
                                        </p>
                                        <p class="mb-0">Expected Arrival:
                                            <span
                                                class="fw-bold">{{ \Carbon\Carbon::parse($order->delivery_date)->format('M d, Y') }}</span>
                                        </p>
                                    </div>
                                </div>

                                <ul id="progressbar"
                                    class="d-flex justify-content-between mx-0 mt-0 mb-5 px-0 pt-0 pb-2 text-center">
                                    <li class="step0 active"></li>
                                    <li class="step0 {{ $order->status >= 2 ? 'active' : '' }}"></li>
                                    <li class="step0 {{ $order->status >= 3 ? 'active' : '' }}"></li>
                                    <li class="step0 {{ $order->status >= 4 ? 'active' : '' }}"></li>
                                </ul>

                                <div class="d-flex justify-content-around">
                                    <div class="d-lg-flex align-items-center">
                                        <i class="fas fa-clipboard-list fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                        <div>
                                            <p class="fw-bold mb-1">Order</p>
                                            <p class="fw-bold mb-0">Processed</p>
                                        </div>
                                    </div>
                                    <div class="d-lg-flex align-items-center">
                                        <i class="fas fa-box-open fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                        <div>
                                            <p class="fw-bold mb-1">Order</p>
                                            <p class="fw-bold mb-0">Shipped</p>
                                        </div>
                                    </div>
                                    <div class="d-lg-flex align-items-center">
                                        <i class="fas fa-shipping-fast fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                        <div>
                                            <p class="fw-bold mb-1">Order</p>
                                            <p class="fw-bold mb-0">En Route</p>
                                        </div>
                                    </div>
                                    <div class="d-lg-flex align-items-center">
                                        <i class="fas fa-home fa-3x me-lg-4 mb-3 mb-lg-0"></i>
                                        <div>
                                            <p class="fw-bold mb-1">Order</p>
                                            <p class="fw-bold mb-0">Arrived</p>
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <div class="col-5 text-end">
                                        <div class="row lower">
                                            <div class="col text-left"><b>Delivery Charges</b></div>
                                            <div class="col text-right">${{ $order->shipping_fee }}</div>
                                        </div>
                                        <div class="row lower">
                                            <div class="col text-left"><b>Total to pay</b></div>
                                            <div class="col text-right">${{ $order->total_price }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
@endsection
