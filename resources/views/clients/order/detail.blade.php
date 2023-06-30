@extends('layouts.base')

@section('title')
    Detailed Order Information
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/detailed-order-information.css') }}">
@endsection

@section('content')
    <section class="h-100 gradient-custom">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-lg-10 col-xl-9">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-header px-4 py-5">
                            <h5 class="text-muted mb-0">Thanks for your Order, <span
                                    style="color: #a8729a;">{{ Auth::user()->firstname }}</span>!
                            </h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <p class="lead fw-normal mb-0" style="color: #a8729a;">Receipt</p>
                                {{-- <p class="small text-muted mb-0">Receipt Voucher : 1KAU9-84UIL</p> --}}
                            </div>

                            @foreach ($orderDetails as $orderDetail)
                                <div class="card shadow-0 border mb-4">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2">
                                                <img src="{{ route('watch.image.get', ['id' => $orderDetail->image_id]) }}"
                                                    class="img-fluid" width="100" class="my-3" loading="lazy">
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0">{{ $orderDetail->model }}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">{{ $orderDetail->gender }}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">${{ $orderDetail->selling_price }}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">Qty: {{ $orderDetail->quantity }}</p>
                                            </div>
                                            <div
                                                class="col-md-2 text-center d-flex justify-content-center align-items-center">
                                                <p class="text-muted mb-0 small">${{ $orderDetail->price }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                            <div class="d-flex justify-content-end">
                                <div class="col-5 text-end">
                                    <div class="row lower">
                                        <div class="col text-left"><b>Delivery Charges</b></div>
                                        <div class="col text-right">${{ $orderDetail->shipping_fee }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer border-0 px-4 py-5">
                            <div class="d-flex justify-content-end align-items-center">
                                <div class="col-5 text-end">
                                    <div class="row text-white text-uppercase align-items-center">
                                        <div class="col text-left"><b>Total paid</b></div>
                                        <div class="col text-right h2">${{ $orderDetail->total_price }}</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
