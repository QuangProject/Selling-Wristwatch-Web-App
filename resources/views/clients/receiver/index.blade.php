@extends('layouts.base')

@section('title')
    Receiver
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('css/receiver.css') }}">
@endsection

@section('content')
    <div class="container">
        <div class="mt-4 mb-3">
            <div class="text-center lh-1 mb-2">
                <h2 class="fw-bold">Receiver List</h2>
                <button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#addReceiverModal">
                    Add New Receiver
                </button>
            </div>
        </div>
        <ul class="address-list" id="listReceiver">
            @foreach ($receivers as $receiver)
                <li id="receiver_{{ $receiver->id }}">
                    <div class="card row" data-receiver-id="{{ $receiver->id }}">
                        <div class="col-11">
                            <h3 class="name">{{ $receiver->first_name }} {{ $receiver->last_name }}</h3>
                            <p class="address">
                                {{ $receiver->sub_address }}<br>
                                {{ $receiver->address }}
                            </p>
                            <p class="phone">Phone: {{ $receiver->telephone }}</p>
                        </div>
                        <div class="col-1">
                            <div class="dots-container">
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="dot"></div>
                                <div class="popup">
                                    <ul>
                                        <li data-bs-toggle="modal" data-bs-target="#updateReceiverModal">Edit</li>
                                        <li>Delete</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            @endforeach
        </ul>
        <input type="hidden" name="user-id" id="user-id" value="{{ Auth::user()->id }}">
        <div class="text-center mb-5">
            {{-- Back to payment --}}
            <a href="{{ route('payment') }}">
                <button class="btn btn-primary" id="btn-back-to-payment">Back to payment</button>
            </a>
        </div>
        <!-- Add Receiver -->
        <div class="modal fade" id="addReceiverModal" tabindex="-1" aria-labelledby="addReceiverModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="addReceiverModalLabel">Adding Receiver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <!-- First Name -->
                                    <div class="forms-inputs col-lg-6">
                                        <label for="add-first-name">
                                            <h6 class="fw-bold">First Name</h6>
                                        </label>
                                        <input type="text" id="add-first-name" class="form-control" autocomplete="off">
                                        <span class="text-danger" id="error-add-first-name"></span>
                                    </div>
                                    <!-- Last Name -->
                                    <div class="forms-inputs col-lg-6 mt-3 mt-lg-0">
                                        <label for="add-last-name">
                                            <h6 class="fw-bold">Last Name</h6>
                                        </label>
                                        <input type="text" id="add-last-name" class="form-control" autocomplete="off">
                                        <span class="text-danger" id="error-add-last-name"></span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="forms-inputs col-lg-6">
                                        <label for="add-telephone">
                                            <h6 class="fw-bold">Telephone</h6>
                                        </label>
                                        <input type="text" id="add-telephone" class="form-control" autocomplete="off">
                                        <span class="text-danger" id="error-add-telephone"></span>
                                    </div>
                                    <div class="forms-inputs col-lg-6 mt-3 mt-lg-0">
                                        <label for="add-address">
                                            <h6 class="fw-bold">Street name, building, house number</h6>
                                        </label>
                                        <input type="text" id="add-address" class="form-control" autocomplete="off">
                                        <span class="text-danger" id="error-add-address"></span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-inputs col-lg-4">
                                        <label for="add-province">
                                            <h6 class="fw-bold">Choose Province</h6>
                                        </label>
                                        <select name='add-province' id="add-province" class='form-control'>
                                            <option value='0' selected disabled>Please choose province</option>
                                        </select>
                                        <span class="text-danger" id="error-add-province"></span>
                                    </div>
                                    <div class="form-inputs col-lg-4 mt-3 mt-lg-0">
                                        <label for="add-district">
                                            <h6 class="fw-bold">Choose District</h6>
                                        </label>
                                        <select name='add-district' id="add-district" class='form-control'>
                                            <option value='0' selected disabled>Please choose district</option>
                                        </select>
                                        <span class="text-danger" id="error-add-district"></span>
                                    </div>
                                    <div class="form-inputs col-lg-4 mt-3 mt-lg-0">
                                        <label for="add-commune">
                                            <h6 class="fw-bold">Choose Commune</h6>
                                        </label>
                                        <select name='add-commune' id="add-commune" class='form-control'>
                                            <option value='0' selected disabled>Please choose commune</option>
                                        </select>
                                        <span class="text-danger" id="error-add-commune"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                id="btn-add-receiver">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Update Receiver -->
        <div class="modal fade" id="updateReceiverModal" tabindex="-1" aria-labelledby="updateReceiverModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title fw-bold" id="updateReceiverModalLabel">Updating Receiver</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="post">
                        <div class="modal-body">
                            <div class="col-md-12">
                                <div class="row mt-3">
                                    <!-- First Name -->
                                    <div class="forms-inputs col-lg-6">
                                        <label for="update-first-name">
                                            <h6 class="fw-bold">First Name</h6>
                                        </label>
                                        <input type="text" id="update-first-name" class="form-control"
                                            autocomplete="off">
                                        <span class="text-danger" id="error-update-first-name"></span>
                                    </div>
                                    <!-- Last Name -->
                                    <div class="forms-inputs col-lg-6 mt-3 mt-lg-0">
                                        <label for="update-last-name">
                                            <h6 class="fw-bold">Last Name</h6>
                                        </label>
                                        <input type="text" id="update-last-name" class="form-control"
                                            autocomplete="off">
                                        <span class="text-danger" id="error-update-last-name"></span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="forms-inputs col-lg-6">
                                        <label for="update-telephone">
                                            <h6 class="fw-bold">Telephone</h6>
                                        </label>
                                        <input type="text" id="update-telephone" class="form-control"
                                            autocomplete="off">
                                        <span class="text-danger" id="error-update-telephone"></span>
                                    </div>
                                    <div class="forms-inputs col-lg-6 mt-3 mt-lg-0">
                                        <label for="update-address">
                                            <h6 class="fw-bold">Street name, building, house number</h6>
                                        </label>
                                        <input type="text" id="update-address" class="form-control"
                                            autocomplete="off">
                                        <span class="text-danger" id="error-update-address"></span>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="form-inputs col-lg-4">
                                        <label for="update-province">
                                            <h6 class="fw-bold">Choose Province</h6>
                                        </label>
                                        <select name='update-province' id="update-province" class='form-control'>
                                            <option value='0' selected disabled>Please choose province</option>
                                        </select>
                                        <span class="text-danger" id="error-update-province"></span>
                                    </div>
                                    <div class="form-inputs col-lg-4 mt-3 mt-lg-0">
                                        <label for="update-district">
                                            <h6 class="fw-bold">Choose District</h6>
                                        </label>
                                        <select name='update-district' id="update-district" class='form-control'>
                                            <option value='0' selected disabled>Please choose district</option>
                                        </select>
                                        <span class="text-danger" id="error-update-district"></span>
                                    </div>
                                    <div class="form-inputs col-lg-4 mt-3 mt-lg-0">
                                        <label for="update-commune">
                                            <h6 class="fw-bold">Choose Commune</h6>
                                        </label>
                                        <select name='update-commune' id="update-commune" class='form-control'>
                                            <option value='0' selected disabled>Please choose commune</option>
                                        </select>
                                        <span class="text-danger" id="error-update-commune"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"
                                id="btn-update-receiver">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="{{ asset('js/receiver.js') }}"></script>
@endsection
