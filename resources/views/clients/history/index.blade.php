@extends('layouts.base')

@section('title')
    Purchase History
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/purchase-history.css') }}">
@endsection

@section('content')
    <div class="container py-5 h-100">
        @if (count($purchaseHistories) == 0)
            <div class="row d-flex justify-content-center align-items-center h-100 mb-4">
                <img src="{{ asset('img/image_empty.gif') }}" alt="Empty" style="width: 50%">
            </div>
            <div class="text-center my-3">
                <a href="{{ route('shop') }}" class="btn btn-danger">Continue shopping</a>
            </div>
        @else
            @foreach ($purchaseHistories as $purchaseHistory)
                <div class="row d-flex justify-content-center align-items-center h-100 mb-4">
                    <div class="col">
                        <div class="card card-stepper" style="border-radius: 10px;">
                            <div class="card-body p-4">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="lead fw-normal">Your order <b>#{{ $purchaseHistory->id }}</b> has been
                                            delivered</span>
                                        <span class="text-muted small">On
                                            {{ \Carbon\Carbon::parse($purchaseHistory->delivery_date)->format('M d, Y') }}</span>
                                    </div>
                                    <div>
                                        <a href="{{ route('detailed.information', ['id' => $purchaseHistory->id, 'type' => 'history']) }}">
                                            <button class="btn btn-outline-primary" type="button">Track order
                                                details</button>
                                        </a>
                                    </div>
                                </div>
                                <hr class="my-4">
                                <div
                                    class="d-flex flex-row justify-content-between align-items-center align-content-center">
                                    <span class="dot"></span>
                                    <hr class="flex-fill track-line"><span class="dot"></span>
                                    <hr class="flex-fill track-line"><span class="dot"></span>
                                    <hr class="flex-fill track-line"><span
                                        class="d-flex justify-content-center align-items-center big-dot dot">
                                        <i class="fa fa-check text-white"></i></span>
                                </div>
                                <div class="d-flex flex-row justify-content-between align-items-center">
                                    <div class="d-flex flex-column justify-content-center">
                                        <span>Processed</span>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span>Order Sent</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-center">
                                        <span>En Route</span>
                                    </div>
                                    <div class="d-flex flex-column align-items-end">
                                        <span>Arrived</span>
                                    </div>
                                </div>
                                <hr>
                                <div class="d-flex justify-content-end">
                                    <div class="col-5 text-end">
                                        <div class="row lower">
                                            <div class="col text-left"><b>Delivery Charges</b></div>
                                            <div class="col text-right">${{ $purchaseHistory->shipping_fee }}</div>
                                        </div>
                                        <div class="row lower">
                                            <div class="col text-left"><b>Total to pay</b></div>
                                            <div class="col text-right">${{ $purchaseHistory->total_price }}</div>
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
