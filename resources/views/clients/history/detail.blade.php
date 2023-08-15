@extends('layouts.base')

@section('title')
    Detailed Purchase History
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
                            <div class="mb-4">
                                <a href="{{ route('purchase.history') }}">
                                    <i class="fa-solid fa-arrow-left-long"></i> Back
                                </a>
                            </div>
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
                                <div class="shadow-0 border mb-4 d-md-flex align-items-center">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-2 text-center">
                                                <a href="{{ route('detail', ['id' => $orderDetail->watch_id]) }}">
                                                    <img src="{{ route('watch.image.get', ['id' => $orderDetail->image_id]) }}"
                                                        class="img-fluid" width="100" class="my-3" loading="lazy">
                                                </a>
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
                                    <div class="me-0 me-md-3 text-center mb-3 mb-md-0">
                                        @if ($orderDetail->comment == null)
                                            <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal"
                                                aria-label="Feedback" data-bs-target="#exampleModal"
                                                onclick="feedback({{ $orderDetail->watch_id }})">
                                                Feedback
                                            </button>
                                        @else
                                            <button type="button" class="btn btn-outline-success" style="margin: 0 30px"
                                                aria-label="Completed" disabled>
                                                <i class="fa-solid fa-check"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog mx-0 mx-sm-auto">
                                    <div class="modal-content">
                                        <div class="modal-header bg-danger">
                                            <h5 class="modal-title text-white" id="exampleModalLabel">Feedback request</h5>
                                            <button type="button" class="btn-close text-white" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="text-center">
                                                <i class="far fa-file-alt fa-4x mb-3 text-danger"></i>
                                                <p>
                                                    <strong>Your opinion matters</strong>
                                                </p>
                                                <p>
                                                    Have some ideas how to improve our product?
                                                    <strong>Give us your feedback.</strong>
                                                </p>
                                            </div>
                                            <hr />
                                            <div class="px-4">
                                                <input type="hidden" id="feedback-user-id" value="{{ Auth::user()->id }}">
                                                <input type="hidden" id="feedback-watch-id">
                                                <p class="text-center"><strong>Your rating:</strong></p>

                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="very-good" value="5" />
                                                    <label class="form-check-label" for="very-good">
                                                        Very good
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="good" value="4" />
                                                    <label class="form-check-label" for="good">
                                                        Good
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="medicore" value="3" />
                                                    <label class="form-check-label" for="medicore">
                                                        Medicore
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="bad" value="2" />
                                                    <label class="form-check-label" for="bad">
                                                        Bad
                                                    </label>
                                                </div>
                                                <div class="form-check mb-2">
                                                    <input class="form-check-input" type="radio" name="rating"
                                                        id="very-bad" value="1" />
                                                    <label class="form-check-label" for="very-bad">
                                                        Very bad
                                                    </label>
                                                </div>

                                                <p class="text-center"><strong>What could we improve?</strong></p>

                                                <!-- Message input -->
                                                <div class="form-outline mb-4">
                                                    <textarea class="form-control" id="comment" rows="4" placeholder="Your feedback"></textarea>
                                                    <label class="form-label" for="comment"></label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-danger"
                                                data-bs-dismiss="modal">
                                                Close
                                            </button>
                                            <button type="button" class="btn btn-danger"
                                                onclick="submitFeedback()">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
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

@section('js')
    <script src="{{ asset('js/detail-history.js') }}"></script>
@endsection
